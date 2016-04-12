@extends('layouts.app')

@section('content')
    <br>
    <div class="container" style="background-color: rgba(36,75,84,0.15)">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url($user->avatar)}}" style="width: 200px" class="img-rounded img-responsive" />
                    <br />
                    <div class="alert alert-info">
                        <label>Player</label>
                        <hr>
                        <h4>{{$user->name}}</h4>
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
                </div>
            </div>
            <!-- ROW END -->
            <div class="row">
                <div class="form-group col-md-8">
                    <div class="col-md-4">
                        <h3>Gamer Info</h3>
                        <br>
                        <div class="col-md-9"><h4>Games Played : </h4></div>
                        <div class="col-md-3" style="color: #31AFD4">
                            <h3 style="margin: 0">{{ $user->games_played }}</h3>
                        </div>
                        <br><br>
                        <div class="col-md-9"><h4>Highest Score : </h4></div>
                        <div class="col-md-3" style="color: #31AFD4">
                            <h3  style="margin: 0">{{$user->highest_score}}</h3>
                        </div>
                        <br>
                        <div class="col-md-9"><h4>Wallet : </h4></div>
                        <div class="col-md-3" style="color: #31AFD4">
                            <h3  style="margin: 0">{{ $user->coins }}</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <br><br>
                        <div class="col-md-8"><h4>Mario : </h4></div>
                        <div class="col-md-4" style="color: #31AFD4"><h3  style="margin: 0">{{$user->mario}}</h3></div>
                        <br>
                        <div class="col-md-8"><h4>Mushroom : </h4></div>
                        <div class="col-md-4" style="color: #31AFD4"><h3  style="margin: 0">{{$user->mushroom}}</h3></div>
                        <br>
                        <div class="col-md-8"><h4>Shooting : </h4></div>
                        <div class="col-md-4" style="color: #31AFD4"><h3  style="margin: 0">{{$user->shooting}}</h3></div>
                        <br>
                        <div class="col-md-8"><h4>Double Jump : </h4></div>
                        <div class="col-md-4" style="color: #31AFD4"><h3  style="margin: 0">{{$user->double_jump}}</h3></div>
                        <br>
                        <div class="col-md-8"><h4>Low Gravity : </h4></div>
                        <div class="col-md-4" style="color: #31AFD4"><h3  style="margin: 0">{{$user->low_gravity}}</h3></div>
                    </div>
                </div>
            </div>

        </section>
        <!-- SECTION END -->
    </div>
@endsection