<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Game Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <link href="../css/1-col-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/app.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/admin/panel') }}">Admin control</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li><a href="{{ url('/') }}"> Home </a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name}} <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href=" {{ url('/user/' . Auth::user()->id) }}"><i class="fa fa-user fa-fw"></i>Profile</a></li>

                    <li class="divider"></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="users" class="collapse">
                        <li>
                            <a href="{{ url('/viewAllUsers/0') }}">View all users</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/addUser') }}">Add User</a>
                        </li>
                        <li>
                            <a href="{{ url('/dev') }}">Modify Player</a>
                        </li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#forum"><i class="fa fa-comment"></i> Forum <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="forum" class="collapse">
                        <li>
                            <a href="{{ url('/forum') }}">View all posts</a>
                        </li>
                        {{--<li>
                            <a href="#">Forum catogories</a>
                        </li>--}}
                    </ul>
                </li>
                {{--<li>
                    <a href="#"><i class="fa fa-fw fa-comments-o"></i> Post Comments</a>
                </li>--}}
                <li class="divider"></li>
                {{--PROFILE--}}
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#e-shop"><i class="fa fa-shopping-cart"></i> E-Shop <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="e-shop" class="collapse">
                        <li>
                            <a href="{{ url('/shop') }}">View all Products</a>
                        </li>
                        {{--<li>
                            <a href="{{ url('/newObject') }}">Add Object</a>
                        </li>--}}
                        <li>
                            <a href="{{ url('/buyCoins') }}">View Coins Shop</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/transactions') }}">View Transactions</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    @yield('content')



</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

</body>

</html>