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
                    <div class="form-group col-md-8">
                        <h3>Gamer Info</h3>
                        <br />
                        <label>Games Played:</label>   {{ $user->games_played }}
                        <br>
                        <label>Highest Score:</label>   {{ $user->highest_score }}
                        <hr>
                        <label>Wallet:</label>   {{ $user->coins }}
                        <br><br>

                       <h4>Mario : </h4>{{$user->mario}}
                        </div>


                        <div>
                            <table class="table">

                                <tr>
                                    <td><h4>Mushroom : </h4></td>
                                    <td>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-info
                                        <?php if($user->mushroom == 1): ?>
                                                    active
                                                    <?php endif; ?>
                                                    ">
                                                <input type="checkbox">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h4>Shooting : </h4></td>
                                    <td>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-info
                                        <?php if($user->shooting == 1): ?>
                                                    active
                                                    <?php endif; ?>
                                                    ">
                                                <input type="checkbox">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h4>Double Jump : </h4></td>
                                    <td>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-info
                                        <?php if($user->double_jump == 1): ?>
                                                    active
                                                    <?php endif; ?>
                                                    ">
                                                <input type="checkbox">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h4>Low Gravity : </h4></td>
                                    <td>
                                        <div class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-info
                                        <?php if($user->low_gravity == 1): ?>
                                                    active
                                                    <?php endif; ?>
                                                    ">
                                                <input type="checkbox">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW END -->


        </section>
        <!-- SECTION END -->
    </div>
@endsection