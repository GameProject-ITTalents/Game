var Game = (function() {
    function Game() {
        Phaser.Game.call(this, 400, 240, Phaser.AUTO, 'game', null, false, false);

        this._totalScore = 0;
        this._lifes = 3;
    }

    Game.prototype = Object.create(Phaser.Game.prototype);
    Game.prototype.constructor = Game;

    Game.prototype.boot = function() {
        Phaser.Game.prototype.boot.call(this);

        // set custom resize strategy
        this.scale.pageAlignHorizontally = true;
        this.scale.pageAlignVertically = true;
        //this.scale.owerflow = hidden;
        this.scale.scaleMode = Phaser.ScaleManager.SHOW_ALL;
        this.scale.setScreenSize();

        this.renderer.renderSession.roundPixels = true;
        this.stage.smoothed = false;

        this.physics.startSystem(Phaser.Physics.ARCADE);
        this.input.maxPointers = 1;
    };

    Game.prototype.start = function() {
        this.state.add('preload', PreloadState, true);
        this.state.add('splash', SplashState, false);
        this.state.add('mainmenu', MenuState, false);
        this.state.add('play', PlayState, false);
        this.state.add('world_1', WorldOne, false);
    };

    return Game;
}());