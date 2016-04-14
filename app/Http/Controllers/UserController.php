<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use DB;
use Validator;
use Hash;
use App\Comments;
use App\Transaction;
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
        $rules = ['image' => 'image|required|size:5'];
        $messages = [
            'image.image' => 'Non supported format',
            'image.required' => 'No file selected',
            'image.size' => 'The image is too big'
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
            $user->where('id', Auth::user()->id)
                ->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
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
            $transaction = new Transaction;
            $transaction->buyer_id = Auth::user()->id;
            $transaction->objects = $items;
            $transaction->date = date('Y-m-d');
            $transaction->time = date('H:i:s');
            $transaction->save();

            $cart_id = DB::table('carts')->where('user_id', Auth::user()->id)->first()->id;
            DB::table('cart_items')->where('cart_id', $cart_id)->delete();


            User::where('id', $user->id)
                ->update([
                    'coins' => $coins,
                    'mario' => $mario,
                    'mushroom' => $mushroom,
                    'shooting' => $shooting,
                    'double_jump' => $double_jump,
                    'low_gravity' => $low_gravity
                ]);
            return redirect('/shop')->with('status', 'Power-ups purchased');
        }
        else {
            return redirect('/buyCoins')->with('status', 'You don\'t have enough coins');

        }
    }
    
    public function createUser(Request $request)
    {
        if (Auth::user()->user == 1) {
            $rules = [
                'name' => 'required|min:3|max:16|regex:/^[a-záéíóúä\s]+$/i',
                'email' => 'required|email|max:63|unique:users,email',
                'password' => 'required|min:6|max:118'
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
                'password.min' => 'Password must be at least 6 characters long',
                'password.max' => 'Max limit of characters reached'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            } else {

                $user = new User;
                if($request->file('image')) {
                    $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();
                    $request->file('image')->move('profile', $name);
                    $user->avatar = 'profile/' . $name;
                } else {
                    $user->avatar = 'profile/profile.jpg';
                }
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                if ($request->admin) {
                    $user->user = $request->admin;
                } else {
                    $user->user = 0;
                }
                $user->save();
            }
        }
        return redirect('/viewAllUsers/0')->with('status', 'User created');
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
