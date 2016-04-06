var MenuState = (function() {
    function MenuState(game) {
        State.call(this, game);
    }

    MenuState.prototype = Object.create(State.prototype);
    MenuState.prototype.constructor = MenuState;

    MenuState.prototype.create = function() {
        State.prototype.create.call(this);

        this.state.start('play');
    };

    return MenuState;
}());