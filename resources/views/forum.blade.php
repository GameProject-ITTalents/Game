@extends('layouts.app')

@section('content')
    <div class="container" style="background-color: rgba(36,75,84,0.15)">

        <h1>Forum</h1>
        <hr>
        @if (Session::has('status'))
            <div class="bg-primary" style="padding: 20px">
                {{ Session::get('status') }}
            </div>
            <hr>
        @endif
        @if (Session::has('deletionStatus'))
            <div class="bg-danger" style="padding: 20px">
                {{ Session::get('deletionStatus') }}
            </div>
            <hr>
        @endif
        @if (Session::has('updateStatus'))
            <div class="bg-success" style="padding: 20px">
                {{ Session::get('updateStatus') }}
            </div>
            <hr>
        @endif
        {{--@if (Auth::check())--}}
            <form method="post" action="{{ url('/forum') }}">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="{{ url(Auth::user()->avatar) }}" class="img-responsive" style="max-width: 80px" alt="Profile Picture">
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
                $modal = 0;
                foreach ($comments as $comment) :
                    $user = App\User::select()->where('id', '=', $comment->id_user)->first();
            ?>
            <div class="row">
                <div class="col-md-1">
                    <img src="{{ url($user->avatar) }}" class="img-responsive" style="max-width: 60px" alt="Profile Picture">
                    <strong>{{ $user->name }}</strong>
                </div>
                <div class="col-md-8" style="max-width: 600px">
                    <div class="col-md-12">{{ wordwrap($comment->comment, 50, "\n", true) }} </div>
                    <i>On: {{ $comment->date }} at: {{ $comment->time }}</i>
                    <br><br>
                    @if($comment->id_user == Auth::user()->id || Auth::user()->user == 1)
                        <button type="button" data-toggle="modal" data-target="#deleteComment{{$modal}}" class="btn btn-danger">Delete Post</button>
                        <div class="modal fade" id="deleteComment{{$modal}}" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Are you sure you want to delete the post?</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{ wordwrap($comment->comment, 70, "\n", true) }}
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left">
                                        {{ Form::open(['method' => 'delete', 'route' => ['forum.destroy', $comment->id]]) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                        </div>
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editComment{{$modal}}">Edit Post</button>
                        <div class="modal fade" id="editComment{{$modal}}" tabindex="-1"  role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Edit the post</h4>
                                    </div>
                                    <div class="modal-body">
                                            {{ Form::open(['method' => 'put', 'route' => ['forum.update', $comment->id]]) }}
                                            {{ Form::textarea('comment', $comment->comment, ['style' => 'width: 100%']) }}
                                    </div>
                                    <div class="modal-footer">
                                        <div class="pull-left">
                                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                                            {{ Form::close() }}
                                        </div>
                                        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $modal++ ?>
                    @endif
                </div>
            </div>
            <hr>
            <?php endforeach; ?>
    </div>
@endsection