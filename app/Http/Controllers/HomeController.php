<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

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

    public function startGame()
    {
        //return json_encode(Auth::user());
        
        //redirect('/game');
        return view('startGame');
    }

    public function userInfo()
    {
        return Auth::user();
    }

    public function userRequest(Request $request)
    {
        $returnedUser = $request->json()->all();
        return view('welcome', compact('returnedUser'));

        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $id = $user->id;
        $coins = $user->coins;
        $mario = $user->mario;
        $mushroom = $user->mushroom;
        $shooting = $user->shooting;
        $double_jump = $user->double_jump;
        $low_gravity = $user->low_gravity;
        $games_played = $user->games_played;
        $highest_score = $user->highest_score;
        $score = $user->score;
        $level_reached = $user->level_reached;

        User::where('id', $user->id)
            ->update([
                'coins' => $coins,
                'mario' => $mario,
                'mushroom' => $mushroom,
                'shooting' => $shooting,
                'double_jump' => $double_jump,
                'low_gravity' => $low_gravity,
                'games_played' => $games_played,
                'highest_score' => $highest_score,
                'score' => $score,
                'level_reached' => $level_reached,
            ]);
        return redirect('/home');
    }

    
}
