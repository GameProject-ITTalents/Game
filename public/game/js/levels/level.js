var Level = (function() {
    function Level(game, gravity) {
        State.call(this, game);

        this.gravity = gravity;
        this.mapKey = '';
        this.levelManager = null;
        this.timer = null;

        this._player = null;
    }

    Level.prototype = Object.create(State.prototype);
    Level.prototype.constructor = Level;

    Level.prototype.preload = function() {
        State.prototype.preload.call(this);
    };

    Level.prototype.create = function() {
        State.prototype.create.call(this);

        // this.timer = new Phaser.Timer(this.game, false);
        // this.time.add(this.timer);

        // initInputHandler
        this.inputHandler.setInputMap({
            jump: Phaser.Keyboard.C,
            sprint: Phaser.Keyboard.X
        });

        this.inputHandler.addListener('left', this, onMove);
        this.inputHandler.addListener('right', this, onMove);
        this.inputHandler.addListener('jump', this, null, onJump, onJumpReleased);
        this.inputHandler.addListener('sprint', this, onSprint);

        // input listeners
        function onMove(keycode, active) {
            var dir = (keycode === Phaser.Keyboard.LEFT ? Phaser.LEFT : Phaser.RIGHT);
            this._player.move(dir, active);
        }

        function onJump(keycode) {
            this._player.jump();
        }

        function onJumpReleased(keycode) {
            this._player.jumpReleased = true;
        }

        function onSprint(keycode, active) {
            this._player.sprint(active);
        }
        
        this.levelManager = new LevelManager(this);

        this.levelManager.create();
        this._player = this.levelManager.player;
    };

    Level.prototype.update = function() {
        this.levelManager.update();
    };

    return Level;
}());