@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-4">
            <h1>Super Mario</h1>
            <h3>DEV window</h3>
            <hr class="intro-divider">

            <form class="list-group-item" method="post" action="{{url('/userRequest')}}">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">ID</label>
                    <input name="id" class="form-control" type="text" value="{{$user->id}}">
                </div>
                <div class="form-group">
                    <label for="">Coins</label>
                    <input name="coins" class="form-control" type="text" value="{{$user->coins}}">
                </div>
                <div class="form-group">
                    <label for="">Mario</label>
                    <input name="mario" class="form-control" type="text" value="{{$user->mario}}">
                </div>
                <div class="form-group">
                    <label for="">Mushroom</label>
                    <input name="mushroom" class="form-control" type="text" value="{{$user->mushroom}}">
                </div>
                <div class="form-group">
                    <label for="">Shooting</label>
                    <input name="shooting" class="form-control" type="text" value="{{$user->shooting}}">
                </div>
                <div class="form-group">
                    <label for="">Double Jump</label>s
                    <input name="double_jump" class="form-control" type="text" value="{{$user->double_jump}}">
                </div>
                <div class="form-group">
                    <label for="">Low Gravity</label>
                    <input name="low_jump" class="form-control" type="text" value="{{$user->low_gravity}}">
                </div>
                <div class="form-group">
                    <label for="">Games played</label>
                    <input name="games_played" class="form-control" type="text" value="{{$user->games_played}}">
                </div>
                <div class="form-group">
                    <label for="">Score</label>
                    <input name="score" class="form-control" type="text" value="{{$user->score}}">
                </div>
                <div class="form-group">
                    <label for="">Highest Score</label>
                    <input name="highest_score" class="form-control" type="text" value="{{$user->highest_score}}">
                </div>
                <div class="form-group">
                    <label for="">Level Reached</label>
                    <input name="level_reached" class="form-control" type="text" value="{{$user->level_reached}}">
                </div>
                <input type="submit" class="btn btn-primary"/>
            </form>
        </div>
    </div>
@endsection