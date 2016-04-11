@extends('layouts.app')

@section('content')
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-md-offset-1" style="background-color: rgba(36,75,84,0.15)">
                    <div class="intro-message">
                        <h1 style="font-family: 'Carter One', cursive">Super Mario</h1>
                        <h3 style="font-family: 'Carter One', cursive">Highest Score</h3>
                        <hr class="intro-divider">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Position</th>
                                <th>User</th>
                                <th>Highest Score</th>
                                <th>Games Played</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $position = 1; ?>
                            @foreach($highestScores as $user)
                            <tr>
                                <td><?= $position++; ?></td>
                                <td><a href="{{url('user/' . $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->highest_score}}</td>
                                <td>{{$user->games_played}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
