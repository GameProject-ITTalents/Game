@extends('layouts.app')

@section('content')
    <br>
    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url($user->avatar)}}" style="width: 200px" class="img-rounded img-responsive" />
                    <br />
                    <div class="alert alert-info">
                        <label>Title Reached</label>
                        <h3>{{$user->name}}</h3>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="form-group col-md-8">
                        <h2>Profile Info</h2>
                        @if (Auth::user()->id == $user->id)
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="{{$user->name}}">
                        <br>
                        <label>Email</label>
                        <input type="text" class="form-control" placeholder="{{$user->email}}">
                        <br>
                        <a href="{{url('user/profile/' . Auth::user()->id)}}" class="btn btn-success">Edit Info</a>
                        <br />
                        @else
                            <label>Name</label>
                            <p>{{$user->name}}</p>
                            <label>Email</label>
                            <p>{{$user->email}}</p>
                            <br>
                        @endif
                    </div>
                    @if ($user->social == 1)
                    <div class="form-group col-md-8">
                        @if($social->provider == 'facebook')
                            <a href="https://www.facebook.com/{{$social->uid_provider}}" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i>&nbsp; Facebook</a>
                        @else
                            <a href="https://plus.google.com/u/0/{{$social->uid_provider}}" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i>&nbsp; Google</a>
                        @endif
                    </div>
                    @endif
                    <div class="form-group col-md-8">
                        <h3>Gamer Info</h3>
                        <br />
                        <label>Games Played:</label>   {{ $user->games_played }}
                        <br>
                        <label>Highest Score:</label>   {{ $user->highest_score }}
                        <hr>
                        <label>Wallet:</label>   {{ $user->coins }}
                        <br><br>
                        <label>Mario:</label>   {{ $user->mario }}</p>
                        <label>Mushroom:</label>   {{ $user->mushroom }}</p>
                        <label>Shooting:</label>   {{ $user->shooting }}</p>
                        <label>Double Jump:</label>   {{ $user->double_jump }}</p>
                        <label>Low Gravity:</label>   {{ $user->low_gravity }}</p>
                    </div>
                    {{--<div class="form-group col-md-8">
                        <h3>Forum Activity</h3>
                        <br />
                        <label>Post Title</label>
                        <p class="form-control"></p>
                        <br>
                    </div>--}}
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
@endsection