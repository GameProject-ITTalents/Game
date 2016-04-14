<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Super Mario</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Poiret+One&amp;subset=latin,cyrillic" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Carter+One' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css" type="text/css">
    <link rel="stylesheet" href="../css/app.css" type="text/css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        body {
            margin: 0;
            padding: 0;
            color: black;
            background: #222;
        }
        /*#game {
            width: 100%;
            height: 100%;
        }*/
        #game canvas {
            image-rendering:optimizeSpeed;             /* Legal fallback */
            image-rendering:-moz-crisp-edges;          /* Firefox        */
            image-rendering:-o-crisp-edges;            /* Opera          */
            image-rendering:-webkit-optimize-contrast; /* Safari         */
            image-rendering:optimize-contrast;         /* CSS3 Proposed  */
            image-rendering:crisp-edges;               /* CSS4 Proposed  */
            image-rendering:pixelated;                 /* CSS4 Proposed  */
            -ms-interpolation-mode:nearest-neighbor;   /* IE8+           */
        }
    </style>
</head>

<body id="app-layout">
{{ csrf_field() }}
<div class="container-fluid">
    <div id="game"></div>
</div>
<script src="js/phaser.min.js"></script>
<script src="js/index.js"></script>
<script src="js/game.js"></script>
<script src="js/states/state.js"></script>
<script src="js/states/preload.js"></script>
<script src="js/states/menu.js"></script>
<script src="js/states/main_menu.js"></script>
<script src="js/states/play.js"></script>
<script src="js/states/levelup.js"></script>
<script src="js/states/gameover.js"></script>
<script src="js/levels/level.js"></script>
<script src="js/levels/level_manager.js"></script>
<script src="js/levels/worlds/world_1.js"></script>
<script src="js/input/input_handler.js"></script>
<script src="js/input/keyboard_handler.js"></script>
<script src="js/entities/entity.js"></script>
<script src="js/entities/block.js"></script>
<script src="js/entities/item_block.js"></script>
<script src="js/entities/coin.js"></script>
<script src="js/entities/player.js"></script>
<script src="js/entities/goomba.js"></script>

<!-- JavaScripts -->
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>






