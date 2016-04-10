@extends('layouts.app')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        background: #222 url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAMAAAC67D+PAAAAFVBMVEUqKiopKSkoKCgjIyMuLi4kJCQtLS0dJckpAAAAO0lEQVR42iXLAQoAUQhCQSvr/kfe910jHIikElsl5qVFa1iE5f0Pom/CNZdbNM6756lQ41NInMfuFPgAHVEAlGk4lvIAAAAASUVORK5CYII=");
        color: black;
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
{{ csrf_field() }}
<div class="container-fluid">
<div class="col-md-10 pull-right" id="game"></div>
</div>
<script src="js/phaser.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/index.js"></script>
<script src="js/game.js"></script>
<script src="js/states/state.js"></script>
<script src="js/states/preload.js"></script>
<script src="js/states/splash.js"></script>
<script src="js/states/menu.js"></script>
<script src="js/states/main_menu.js"></script>
<script src="js/states/levelup.js"></script>
<script src="js/states/play.js"></script>
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

@endsection
