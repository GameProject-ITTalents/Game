@extends('layouts.app')

@section('content')
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="intro-message">
                    <h1>Game Name</h1>
                    <h3>Another Game Name</h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-gamepad fa-fw"></i> <span class="network-name">Play</span></a>
                        </li>
                        <li>
                            <a href="{{ url('/forum') }}" class="btn btn-default btn-lg"><i class="fa fa-comment fa-fw"></i> <span class="network-name">Forum</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-arrow-up fa-fw"></i> <span class="network-name">High Scores</span></a>
                        </li>
                        <li>
                            <a href="{{ url('/shop') }}" class="btn btn-default btn-lg"><i class="fa fa-shopping-cart fa-fw"></i> <span class="network-name">E-SHOP</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-info fa-fw"></i> <span class="network-name">About</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
