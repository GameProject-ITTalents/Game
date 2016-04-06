<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function game()
    {
        redirect('/game');
        //return view('game');
    }

    /*public function user($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('user', compact('user'));
    }*/
    
}
