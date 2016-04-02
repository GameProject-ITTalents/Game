<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use DB;
use Validator;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        $social = DB::table('social_accounts')->where('user_id', $id)->first();
        return view('user', compact('user', 'social'));
    }

    public function profile($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('profile', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $rules = ['image' => 'image|required'];
        $messages = [
            'image.image' => 'Non supported format',
            'image.required' => 'No file selected'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('user/profile/' . Auth::user()->id)->withErrors($validator);
        } else {
            $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('profile', $name);
            $user = new User;
            $user->where('email', '=', Auth::user()->email)
                ->update(['avatar' => 'profile/' . $name]);
            return redirect('user/' . Auth::user()->id)->with('status', 'Your profile picture has been changed');
        }
    }

    public function updateInfo(Request $request)
    {
        $rules = [
            'name' => 'required|max:63',
            'email' => 'required|email|max:63|unique:users'
        ];
        $messages = [
            'name.max' => 'Max limit of characters reached',
            'name.required' => 'Required field',
            'email.required' => 'Required field',
            'email.email' => 'Email must be in correct format',
            'email.unique' => 'Email must be unique',
            'email.max' => 'Max limit of characters reached'

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('user/profile/' . Auth::user()->id)->withErrors($validator);
        } else {
            $user = new User;
            $user->where('email', '=', Auth::user()->email)
                ->update(['name' => $request->name]);
            $user->where('email', '=', Auth::user()->email)
                ->update(['email' => $request->email]);

            return redirect('user/' . Auth::user()->id)->with('status', 'Your info has been changed');
        }
    }

    public function updatePassword(Request $request)
    {
        $rules = [
            'currentPassword' => 'required',
            'password' => 'required|confirmed|min:6'
        ];
        $messages = [
            'currentPassword.required' => 'Required field',
            'password.required' => 'Required field',
            'password.confirmed' => 'Passwords do not match',
            'password.min' => 'Password must be at least 6 characters long',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return redirect('user/profile/' . Auth::user()->id)->withErrors($validator);
        } else {
            $user = new User;
            if (Hash::check($request->currentPassword, Auth::user()->password)) {
                $user->where('email', '=', Auth::user()->email)
                    ->update(['password' => bcrypt($request->password)]);
            }

            return redirect('user/'. Auth::user()->id)->with('status', 'Your password has been changed changed');
        }
    }
}
