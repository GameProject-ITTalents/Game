window.onload = function() {
	// $.ajax({
	//     url:  "/userInfo",
	//     success: function(data) {
			var game = new Game();

			data = {
				"id":3,
				"name":"administrator",
				"email":"admin@admin.com",
				"active":0,
				"coins":10,
				"mario":3,
				"mushroom":0,
				"shooting":1,
				"double_jump":1,
				"low_gravity":0,
				"games_played":0,
				"score":20,
				"level_reached":0,
				"highest_score":0,
				"avatar":"profile\/XkqlJl9t4qDIjrQ5g2n4Yf3CNTOvHx-chuck_norris.jpg",
				"social":0,
				"created_at":"2016-04-04 23:34:29",
				"updated_at":"2016-04-09 19:20:23",
				"user":1
			};

			game.userId = data.id;
			game.coins = data.coins;
			game.marios = data.mario;
			game.mushrooms = data.mushroom;
			game.shootings = data.shooting;
			game.doubleJumps = data.double_jump;
			game.lowGravities = data.low_gravity;
			game.gamesPlayed = data.games_played;
			game.score = data.score;
			game.levelReached = data.level_reached;

			game.start();
		// }
	// });
};