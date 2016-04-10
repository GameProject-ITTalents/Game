var MainMenuState = (function() {
	function MainMenuState(game) {
		MenuState.call(this, game);
	}

	MainMenuState.prototype = Object.create(MenuState.prototype);
	MainMenuState.prototype.constructor = MainMenuState();

	MainMenuState.prototype.create = function() {
		var that = this;

		MenuState.prototype.create.call(that);

		that.background = that.game.add.sprite(0, 0, 'mainmenu');
	    that.background.height = that.game.height;
	    that.background.width = that.game.width;

	    that.inputHandler.setInputMap({
            start: Phaser.Keyboard.ENTER
        });

        that.inputHandler.addListener('start', that, start);

        function start(keycode) {
            that.state.start('play');
        }
	};

	return MainMenuState;
}());