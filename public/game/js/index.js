window.onload = function() {

    $.ajax({
        url:  "/userInfo",
        success: function( data ) {
            console.log(data);
            var game = new Game().start();
        }
    });
};