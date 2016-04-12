@extends('layouts.app')

@section('content')
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <div class="intro-message">
                    <h1 style="font-family: 'Carter One', cursive">Super Mario</h1>
                    <h3 style="font-family: 'Carter One', cursive">IT Talents Style</h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li style="margin: 10px">
                            <a href="{{ url('/startGame') }}" class="btn btn-info btn-lg"><i class="fa fa-gamepad fa-fw"></i> <span class="network-name">Play</span></a>
                        </li>
                        <br>
                        <li style="margin: 10px">
                            <a href="{{ url('/forum') }}" class="btn btn-info btn-lg"><i class="fa fa-comment fa-fw"></i> <span class="network-name">Forum</span></a>
                        </li>
                        <br>
                        <li style="margin: 10px">
                            <a href="{{ url('/highScore') }}" class="btn btn-info btn-lg"><i class="fa fa-arrow-up fa-fw"></i> <span class="network-name">High Scores</span></a>
                        </li>
                        <br>
                        <li style="margin: 10px">
                            <a href="{{ url('/shop') }}" class="btn btn-info btn-lg"><i class="fa fa-shopping-cart fa-fw"></i> <span class="network-name">E-SHOP</span></a>
                        </li>
                        <br>
                        <li style="margin: 10px">
                            <a href="{{ url('/about') }}" class="btn btn-info btn-lg"><i class="fa fa-info fa-fw"></i> <span class="network-name">About</span></a>
                        </li>
                        <br>
                        {{--@if(Auth::user()->user == 1)
                        <li style="margin: 10px">
                            <a href="{{ url('/dev') }}" class="btn btn-info btn-lg"><i class="fa fa-cog fa-fw"></i> <span class="network-name">DEV</span></a>
                        </li>
                        @endif--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
