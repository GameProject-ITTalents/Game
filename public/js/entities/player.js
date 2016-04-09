var Player = (function() {
    var PLAYER_MAX_SPEED = 120,
        PLAYER_MAX_SPRINT_SPEED = 180,
        PLAYER_ACCEL = 182,
        PLAYER_DRAG = 165,
        PLAYER_JUMP_SPEED = -385,
        PLAYER_MAX_FALL_SPEED = 320,

        PlayerStates = {
            Idle: 0,
            Walking: 1,
            Jumping: 2,
            Turning: 3,
            Ducking: 4
        };

    function Player(game, x, y, id) {
        Entity.call(this, game, x, y, 'playersheet', 0, PLAYER_ACCEL);

        this.id = id || 0;
        this.maxSpeed = PLAYER_MAX_SPEED;
        this.currentState = PlayerStates.Idle;
        this.jumpReleased = true;
        this.facing = Phaser.RIGHT;

        this._prevFacing = this.facing;
        this._jumping = false;
        this._grounded = false;
        this._sprinting = false;
        this._turning = false;
        this._moving = [];

        this.addAnimations([{ 
                name: 'walk', 
                frames: [1, 2, 3] 
            }], 8, true);
    }

    Player.prototype = Object.create(Entity.prototype);
    Player.prototype.constructor = Player;

    Player.prototype.setup = function(level) {
        Entity.prototype.setup.call(this, level);

        this._velocity = this.body.velocity;
        this._accel = this.body.acceleration;
        this.body.maxVelocity.set(this.maxSpeed, this.maxSpeed * 10);
        this.body.drag.set(PLAYER_DRAG, 0);
        this.body.setSize(this.body.width - 2, this.body.height);
        this.body.collideWorldBounds = true;
    };

    Player.prototype.method = function() {
        Entity.prototype.method.call(this);
    };

    Player.prototype.update = function() {
        var currentAnim = this.animations.currentAnim,
            delay = Math.min(200, (PLAYER_MAX_SPEED / (Math.abs(this._velocity.x) / 80)));

        if (this.facing !== this._prevFacing) {
            this.flip();
            this._prevFacing = this.facing;
        }

        switch (this.currentState) {
            case PlayerStates.Walking:
                currentAnim.delay = delay;
                this.animations.play('walk');
                break;
            case PlayerStates.Jumping:
                this.frame = 5;
                break;
            case PlayerStates.Turning:
                this.frame = 4;
                break;
            // case PlayerStates.Idle:
            default:
                this.frame = 0;
                break;
        }

        this._grounded = this.body.onFloor() || this.body.touching.down;

        if (this._moving[Phaser.LEFT] ) {
            this._accel.x = -this.moveSpeed;
        } else if (this._moving[Phaser.RIGHT]) {
            this._accel.x = this.moveSpeed;
        } else {
            this._accel.x = 0;
            if (this._velocity.x === 0 && this._grounded) {
                this.currentState = PlayerStates.Idle;
            }
        }

        if (this._grounded && !this._turning &&
                ((this._velocity.x < -PLAYER_MAX_SPEED * 0.6 && this._accel.x > 0) ||
                (this._velocity.x > PLAYER_MAX_SPEED * 0.6 && this._accel.x < 0))) {
            this._turning = true;
            this.currentState = PlayerStates.Turning;
        }

        if (Math.abs(this._velocity.x) > 0 && this._grounded && !this._turning) {
            this.currentState = PlayerStates.Walking;
        }

        if (this._grounded && this._jumping && !this._turning) {
            this._jumping = false;
            this.currentState = PlayerStates.Idle;
        }

        if (this._jumping && this.jumpReleased &&
                this._velocity.y < PLAYER_JUMP_SPEED / 4) {
            this._velocity.y = PLAYER_JUMP_SPEED / 4;
        }

        this._velocity.y = Math.min(this._velocity.y, PLAYER_MAX_FALL_SPEED);
    };

    Player.prototype.jump = function() {
        if (this._grounded && !this._jumping && this.jumpReleased) {
            this.jumpReleased = false;
            this._jumping = true;
            this._turning = false;
            this.currentState = PlayerStates.Jumping;
            this._velocity.y = PLAYER_JUMP_SPEED;
            this.game.jumpSound.play();
        }
    };

    Player.prototype.sprint = function(active) {
        if (!this._jumping && Math.abs(this._accel.x) > 0 && active) {
            this.body.maxVelocity.x = PLAYER_MAX_SPRINT_SPEED;
        } else if (!active) {
            this.body.maxVelocity.x = this.maxSpeed;
        }

        this._sprinting = active;
    };

    Player.prototype.move = function(direction, active) {
        this._turning = false;
        this._moving[direction] = active;

        if (!this._jumping) {
            this.currentState = PlayerStates.Walking;
            this.facing = direction;
        }
    };

    return Player;
}());