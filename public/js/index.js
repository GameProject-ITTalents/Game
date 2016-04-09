window.onload = function() {
    $.ajax({
        url:  "/userInfo",
        success: function( data ) {
            userData = data;

            console.log(userData);

            var game = new Game().start();
        }
    });

    var user = {
        id: 1,
        coins: 7,
        mario: 3,
        mushroom: 0,
        shooting: 0,
        double_jump: 0,
        low_gravity: 1,
        games_played: 0,
        highest_score: 0,
        score: 200,
        level_reached: 1,
    };

    var userData = JSON.stringify(user);

    $.ajax({
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:  "/userRequest",
        data: userData,
        success: function( response ) {
            console.log(response);
         },
        dataType: 'application/json'
    });
};