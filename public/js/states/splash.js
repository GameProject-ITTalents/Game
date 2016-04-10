var SplashState = (function() {
    function SplashState(game) {
        State.call(this, game);
    }

    SplashState.prototype = Object.create(State.prototype);
    SplashState.prototype.constructor = SplashState;

    SplashState.prototype.create = function() {
        State.prototype.create.call(this);

        this.state.start('mainmenu');
    };

    return SplashState;
}());