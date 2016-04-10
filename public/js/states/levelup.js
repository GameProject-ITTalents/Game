var LevelupState = (function() {
	function LevelupState(game) {
		MenuState.call(this, game);
	}

	LevelupState.prototype = Object.create(MenuState.prototype);
	LevelupState.prototype.constructor = LevelupState();

	LevelupState.prototype.create = function() {
		var that = this;

		MenuState.prototype.create.call(that);

		that.background = that.game.add.sprite(0, 0, 'levelup');
	    that.background.height = that.game.height;
	    that.background.width = that.game.width;

	    data = {
                "id": this.game.userId,
                "coins": this.game.coins,
                "mario": this.game.marios,
                "mushroom": this.game.mushrooms,
                "shooting": this.game.shootings,
                "double_jump": this.game.doubleJumps,
                "low_gravity": this.game.lowGravities,
                "games_played": this.game.gamesPlayed,
                "score": this.game.score,
                "level_reached": this.game.levelReached
            };

	    $.ajax({
	        type: "POST",
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        },
	        url:  "/userRequest",
	        data: data,
	        success: function(response) {
	            console.log(response);
	         },
	        dataType: 'application/json'
	    });

	    that.inputHandler.setInputMap({
            start: Phaser.Keyboard.ENTER
        });

        that.inputHandler.addListener('start', that, start);

        function start(keycode) {
            that.state.start('play');
        }
	};

	return LevelupState;
}());