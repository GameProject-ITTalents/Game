@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: rgba(36,75,84,0.15)">

        <h1>Forum</h1>
        <hr>
        @if (Session::has('status'))
            <div class="bg-success" style="padding: 20px">
                {{ Session::get('status') }}
            </div>
            <hr>
        @endif
        {{--@if (Auth::check())--}}
            <form method="post" action="{{ url('user/createComment') }}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ url(Auth::user()->avatar) }}" class="img-responsive" style="max-width: 60px" alt="Profile Picture">
                            <strong>{{Auth::user()->name}}</strong>
                        </div>
                        <div class="col-md-6">
                            <textarea name="comment" class="form-control" id="" cols="30" rows="3"></textarea>
                            <br>
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                    </div>
                </div>
            </form>
            <hr>
            <?php
                $comments = App\Comments::select()->orderBy('id', 'desc')->get();
                foreach ($comments as $comment) :
                    $user = App\User::select()->where('id', '=', $comment->id_user)->first();
            ?>
            <div class="row">
                <div class="col-md-1">
                    <img src="{{ url($user->avatar) }}" class="img-responsive" style="max-width: 60px" alt="Profile Picture">
                    <strong>{{ $user->name }}</strong>
                </div>
                <div class="col-md-6" style="max-width: 500px">
                    <div class="col-md-6" style="max-width: 500px">{{ $comment->comment }}</div>
                    <br>
                    <i>On: {{ $comment->date }} at: {{ $comment->time }}</i>
                </div>
            </div>
            <hr>
            <?php endforeach; ?>
        {{--@else
            <hr>
            <p class="bg-info" style="padding: 20px">Post some text <a href="{{ url('auth/login') }}">Start Session</a></p>
            <hr>
        @endif--}}
    </div>
@endsection