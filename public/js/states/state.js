var State = (function() {
    function State(game) {
        Phaser.State.call(this, game);

        this.inputHandler = new KeyboardHandler();
    }

    State.prototype = Object.create(Phaser.State.prototype);
    State.prototype.constructor = State;

    State.prototype.create = function() {
        Phaser.State.prototype.create.call(this);

        this.inputHandler.create(this.input);
    };

    return State;
}());