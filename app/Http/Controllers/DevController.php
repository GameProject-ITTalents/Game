<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Auth;
use App\User;

class DevController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userRequest(Request $request)
    {
        /*$returnedUser = $request->json()->all();
        return view('welcome', compact('returnedUser'));*/

        //$user = DB::table('users')->where('id', Auth::user()->id)->first();

        /*
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
        $level_reached = $user->level_reached;*/

        //$id = $request->id;
        $coins = $request->coins;
        $mario = $request->mario;
        $mushroom = $request->mushroom;
        $shooting = $request->shooting;
        $double_jump = $request->double_jump;
        $low_gravity = $request->low_gravity;
        $games_played = $request->games_played;
        $highest_score = $request->highest_score;
        $score = $request->score;
        $level_reached = $request->level_reached;

        //dd($coins);

        User::where('id', Auth::user()->id)
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
        return redirect('/dev');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('dev', compact('user'));
    }
    
    public function addLife()
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        $life = $user->mario;
        $life++;

        User::where('id', $user->id)
            ->update(['mario' => $life]);
        return redirect('/dev');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
