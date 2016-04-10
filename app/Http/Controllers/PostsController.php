<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comments;
use Auth;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('forum');
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
        $comment = e($request->comment);
        $date = date('Y-m-d');
        $time = date('H:i:s');
        Comments::insert([
            'comment' => $comment,
            'id_user' => Auth::user()->id,
            'date' => $date,
            'time' => $time,
        ]);
        return redirect('/forum')->with('status', 'Post published');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = Comments::where('id_user', $id)->get();
        return view('admin.postsByUsers', compact('comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comments::findOrFail($id);
        return view('admin.editPost', compact('comment'));
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
        $comment = e($request->comment);
        Comments::where('id', $id)
                ->update(['comment' => $comment]);
        return view('forum')->with('status', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Comments::findOrFail($id);
        $post->delete();

        return redirect('/forum')->with('status', 'Post deleted');
    }
}
