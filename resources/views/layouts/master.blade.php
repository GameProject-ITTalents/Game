<html>
<head>
    <title>Super Mario E-SHOP</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
@section('sidebar')
    <nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/shop') }}">Super Mario E-SHOP</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    @if (Auth::user() && Auth::user()->user == 1)
                        <li><a href="{{ url('/admin/panel') }}">admin</a></li>
                    @endif
                    <li><a href="{{ url('/') }}"> Home </a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::user())
                        <li><a href="/auth/login">Login</a></li>
                        <li><a href="/auth/register">Signup</a></li>
                    @else
                        @if(Auth::user()->user == 0)
                        <li>
                            <?php
                                $cart_id = DB::table('carts')->where('user_id', Auth::user()->id)->first()->id;
                            $count = DB::table('cart_items')->where('cart_id', $cart_id)->count();
                                ?>
                            <a href="{{ url('/cart') }}">Cart  <span class="fa fa-shopping-cart"></span> {{ $count }} items</a>
                        </li>
                        @endif
                        <li><a href="{{ url('/logout') }}">Logout {{ Auth::user()->name}}</a></li>
                        <li><a href="{{ url('/buyCoins') }}">{{ Auth::user()->coins }} coins  </a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@show

<div class="container">
    @yield('content')
            <!-- JavaScripts -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</div>
</body>
</html>