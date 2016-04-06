var WorldOne = (function() {
	var NORMAL_GRAVITY = 960,
		SKY_BLUE = '#6D93FC';

	function WorldOne(game) {
		Level.call(this, game, NORMAL_GRAVITY);
		this.mapKey = 'world_1';
	}

	WorldOne.prototype = Object.create(Level.prototype);
	WorldOne.prototype.constructor = WorldOne;

	WorldOne.prototype.create = function() {
		Level.prototype.create.call(this);
		
		this.stage.backgroundColor = SKY_BLUE;
	};

	return WorldOne;
}());