var ItemBlock = (function() {
    function ItemBlock(game, x, y, key, frame) {
        Block.call(this, game, x, y, key, frame);

        this._bumped = false;

        this.addAnimations([{ 
	        	name: 'blink', 
	        	frames: [24, 25, 26] 
        	}], 4, true);
        
        this._anim = this.animations.getAnimation('blink');
        this._anim.play();
    }

    ItemBlock.prototype = Object.create(Block.prototype);
    ItemBlock.prototype.constructor = ItemBlock;

    ItemBlock.prototype.bump = function() {
        if (!this._bumped) {
            this._bumped = true;
            this.game.bumpSound.play();
            this.loadTexture('tilesheet', 27);
        	this.animations.stop();
        }
    };

    return ItemBlock;
}());