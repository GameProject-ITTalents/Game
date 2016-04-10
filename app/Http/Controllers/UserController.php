<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use DB;
use Validator;
use Hash;
use App\Comments;
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
            /*$user->where('email', '=', Auth::user()->email)
                ->update(['email' => $request->email]);*/

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

    public function createComment(Request $request)
    {
        $comment = e($request->comment);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        Comments::insert([
           'comment' => $comment,
            'id_user' => Auth::user()->id,
            'date' => $date,
            'time' => $time,
        ]);
        return redirect('forum')->with('status', 'Post published');
    }

    public function show($total, $items)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $array = json_decode($items);
        /*$mario = 0;
        $mushroom = 0;
        $shooting = 0;
        $double_jump = 0;
        $low_gravity = 0;*/
        if ($total <= $user->coins) {
            $coins = $user->coins - $total;
            $mario = $user->mario;
            $mushroom = $user->mushroom;
            $shooting = $user->shooting;
            $double_jump = $user->double_jump;
            $low_gravity = $user->low_gravity;
            foreach ($array as $item) {
                switch ($item) {
                    case 1:
                        $mario++;
                        break;
                    case 2:
                        $mushroom++;
                        break;
                    case 3:
                        $shooting++;
                        break;
                    case 4:
                        $double_jump++;
                        break;
                    case 5:
                        $low_gravity++;
                }
            }
            User::where('id', $user->id)
                ->update([
                    'coins' => $coins,
                    'mario' => $mario,
                    'mushroom' => $mushroom,
                    'shooting' => $shooting,
                    'double_jump' => $double_jump,
                    'low_gravity' => $low_gravity
                ]);
            return redirect('/cart');
        }
        else {
            return redirect('/buyCoins');
        }
    }
    
    public function createUser(Request $request)
    {
        if (Auth::user()->user == 1) {
            $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move('profile', $name);
            $user = new User;
            $user->avatar = 'profile/' . $name;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user = $request->admin;

            $user->save();
            
        } 
        return redirect('/viewAllUsers/0');
    }

    public function deleteUser($id)
    {
        if (Auth::user()->user == 1) {
            User::destroy($id);
        }
        return redirect('/viewAllUsers/0')->with('status', 'User deleted successfully');
    }

    public function makeAdmin($id)
    {
        if (Auth::user()->user == 1) {
            $user = DB::table('users')->where('id', $id)
                ->update(['user' => 1]);
        }
        return redirect('/viewAllUsers/0')->with('status', 'User deleted successfully');
    }
}
