@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: rgba(36,75,84,0.15)">

        <h1>Edit Post</h1>
        <hr>

        <form method="post" action="{{ url('/forum/') }}">
            {{csrf_field()}}
            <div class="form-group">
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ url(Auth::user()->avatar) }}" class="img-responsive" style="max-width: 80px" alt="Profile Picture">
                        <strong>{{Auth::user()->name}}</strong>
                    </div>
                    <div class="col-md-8">
                        <textarea name="comment" class="form-control" id="" cols="30" rows="10">{{ $comment->comment }}</textarea>
                        <br>
                        {{--<a href="{{ url('/forum' . $comment->id) }}"><button class="btn btn-success">Update Post</button></a>--}}
                        {{--{{ Form::open(array('action' => ['ProductController@update', $comment->id],'_method' => 'PUT')) }}--}}
                        {{ Form::open(['method' => 'post', 'route' => ['forum.update', $comment->id]]) }}
                        {{ Form::hidden('id', $comment->id) }}
                        {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection