<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Validator;
use Auth;

class AdminController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'createAdmin']);
    }

    private function isAdmin()
    {
        if (Auth::user()->user == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function admin() {
        if ($this->isAdmin()) {
            return view('admin/admin');
        } else {
            return redirect()->back();
        }
    }

    public function createAdmin(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $rules = [
                'name' => 'required|min:3|max:16|regex:/^[a-záéíóúä\s]+$/i',
                'email' => 'required|email|max:63|unique:users,email',
                'password' => 'required|min:6|max:118|confirmed'
            ];

            $messages = [
                'name.required' => 'Required field',
                'name.max' => 'Max limit of characters reached',
                'name.min' => 'Name must be at least 3 characters long',
                'name.regex' => 'Symbols not allowed',
                'email.required' => 'Required field',
                'email.email' => 'Email must be in correct format',
                'email.unique' => 'Email must be unique',
                'email.max' => 'Max limit of characters reached',
                'password.required' => 'Required field',
                'password.confirmed' => 'Passwords do not match',
                'password.min' => 'Password must be at least 6 characters long',
                'password.max' => 'Max limit of characters reached'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->remember_token = str_random(100);
                $user->confirm_token = str_random(100);
                $user->active = 1;
                $user->user  = 1;

                if ($user->save()) {
                    return redirect()->back()->with('message', 'new ADMIN');
                } else {
                    return redirect()->back()->with('error', 'NO ADMIN');
                }

                //return redirect('admin/createAdmin');
            }
        }
        return View('admin.createAdmin');
    }
}
