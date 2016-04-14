@extends('layouts.admin_app')

@section('content')

    <div class="container-fluid col-lg-12">

        <!-- Page Heading -->
        <div class="row list-group-item">
            <div>
                <h2 class="col-lg-6">Users</h2>
                <div class="col-lg-6">
                    <label>Sort By: </label>
                    <a href="{{url('/viewAllUsers/0')}}" class="btn btn-default">Name</a>
                    <a href="{{url('/viewAllUsers/1')}}" class="btn btn-default">Oldest</a>
                    <a href="{{url('/viewAllUsers/2')}}" class="btn btn-default">Newest</a>
                </div>
            </div>
        </div>

        @foreach ($users as $user)
            <div class="row list-group-item">
                <div class="col-sm-4 col-md-3">
                    <a href="{{url('user/' . $user->id)}}">
                        <img class="img-responsive" src="{{url($user->avatar)}}" style="width: 150px" alt="Profile picture">
                        @if ($user->user == 1)
                            <label>Admin</label>
                        @endif
                    </a>
                </div>
                <div class="col-sm-4 col-md-4">
                    <h3>Personal Info</h3>
                    <label for="">Name</label>
                    <p>{{$user->name}}</p>
                    <label for="">Email</label>
                    <p>{{$user->email}}</p>
                </div>
                <div class="col-sm-4 col-md-5">
                    <h3>Gamer Info</h3>
                    <label for="">Games Playes</label>
                    <p>{{$user->games_played}}</p>
                    <label for="">Highest Score</label>
                    <p>{{$user->highest_score}}</p>
                    <label for="">Wallet</label>
                    <p>{{$user->coins}}</p>
                </div>
                <div class="col-md-12">
                    <h4>Forum Activity</h4>
                    <?php
                        $comments = DB::table('comments')->where('id_user', $user->id)->count();
                    ?>
                    <label for="">Posts  </label>  {{ $comments }}
                    <a href="{{ url('/forum/' . $user->id) }}"> See all posts</a>
                    <br>
                    @if (Auth::user()->id == $user->id)
                    <a href="{{url('user/profile/' . $user->id)}}" class="btn btn-success">Edit User</a>
                    @endif
                    <a href="{{url('user/delete/' . $user->id)}}" class="btn btn-danger">Delete User</a>
                    @if ($user->user == 0)
                        <a href="{{url('user/makeAdmin/' . $user->id)}}" class="btn btn-primary">Make Admin</a>
                    @endif
                </div>
            </div>

        @endforeach

        <hr>

            {{--<!-- Pagination -->
            <div class="row text-center">
                <div class="col-lg-12">
                    <ul class="pagination">
                        <li>
                            <a href="#">&laquo;</a>
                        </li>
                        @for ($i = 1; $i <= $users->count(); $i++)
                            <li>
                                <a href="#">{{ $i }}</a>
                            </li>
                        @endfor
                        --}}{{--class="active"--}}{{--
                        <li>
                            <a href="#">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.row -->--}}
        </div>
        <!-- /.container -->

    <script>
        $(document).ready(function() {
            $('#list').click(function(event){
                event.preventDefault();
                $('#products .item').addClass('list-group-item');
            });
            $('#grid').click(function(event){
                event.preventDefault();
                $('#products .item').removeClass('list-group-item');
                $('#products .item').addClass('grid-group-item');
            });
        });
    </script>

@endsection