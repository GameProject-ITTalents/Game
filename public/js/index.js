window.onload = function() {
    $.ajax({
        url:  "/userInfo",
        success: function(data) {
            var game = new Game();

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
        }
    });
};