var LevelupState = (function() {
	function LevelupState(game) {
		MenuState.call(this, game, 'levelup');

		this.game = game;
	}

	LevelupState.prototype = Object.create(MenuState.prototype);
	LevelupState.prototype.constructor = LevelupState;

	LevelupState.prototype.create = function() {
		var that = this;

		MenuState.prototype.create.call(that);

		this.game.add.text(32, 32, "Level " + this.game.levelReached, {
			font: "32px Arial", 
			fill: "#fff"
		});

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
			 },
			dataType: 'application/json'
		});

		that.inputHandler.setInputMap({
			start: Phaser.Keyboard.ENTER
		});

		that.inputHandler.addListener('start', that, start);
		this.game.add.button(60, 80, 'start', start, this, 2, 1, 0).fixedToCamera = true;

		function start(keycode) {
			that.game.state.start('play');
		}
	};

	return LevelupState;
}());