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

    public function allUsers(Request $request)
    {
        $users = DB::table('users')->pluck('name');
        $data = json_encode($users);
        return $data;
    }

    public function showUserData()
    {

    }

    public function userRequest(Request $request)
    {
        $id = $request->id;
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

        if ($score > $highest_score) {
            $highest_score = $score;
        }

        User::where('id', $id)
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

        //return redirect('/dev');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->user == 1) {
            $user = DB::table('users')->where('id', Auth::user()->id)->first();
            return view('dev', compact('user'));
        } else {
            return redirect('/home');
        }
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
        if (Auth::user()->user == 1) {
            $user = DB::table('users')->where('id', $id)->first();
            return view('dev', compact('user'));
        } else {
            return redirect('/home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('dev', compact('user'));
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
