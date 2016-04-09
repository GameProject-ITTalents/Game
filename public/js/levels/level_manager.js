var LevelManager = (function() {
    function LevelManager(level) {
        this.player = null;
        this.map = null;
        this.blocksGroup = null;
        this.itemBlocksGroup = null;
        this.coinsGroup = null;

        this._level = level;
        this._game = level.game;
        this._physics = level.physics;
        this._inputHandler = level.inputHandler;
        this._timer = level.timer;
        this._score = 0;
        this._scoreImage = this._game.add.sprite(10, 10, 'tilesheet', 57);
        this._scoreImage.fixedToCamera = true;
        this._scoreText = this._game.add.text(30, 14, "x 0", {
            font: "12px Arial", 
            fill: "#fff"
        });
        this._scoreText.fixedToCamera = true;
        this._lifes = this._game._lifes;
        this._lifesImage = this._game.add.sprite(60, 10, 'playersheet', 0);
        this._lifesImage.fixedToCamera = true;
        this._lifesText = this._game.add.text(80, 14, "x " + this._lifes, {
            font: "12px Arial", 
            fill: "#fff"
        });
        this._lifesText.fixedToCamera = true;
        this._mainGroup = null;
        this._entitiesGroup = null;
        this._collisionLayer = null;
        this._staticLayer = null;
    }

    LevelManager.prototype.create = function() {
        this._mainGroup = this._level.add.group();
        this._entitiesGroup = this._level.add.group();
        this._mainGroup.add(this._entitiesGroup);

        // create Map
        this.map = this._level.add.tilemap(this._level.mapKey);
        this.map.addTilesetImage('tiles', 'tiles');

        this._collisionLayer = this.map.createLayer('collision_layer');
        this._collisionLayer.visible = false;
        this._staticLayer = this.map.createLayer('static_layer');
        this._collisionLayer.resizeWorld();

        this.map.setCollision(475, true, this._collisionLayer);
        this._mainGroup.add(this._staticLayer);

        // create Map Objects
        this.blocksGroup = this._level.add.group();
        this.itemBlocksGroup = this._level.add.group();
        this.coinsGroup = this._level.add.group();

        this.map.createFromObjects('block_layer', 2, 'tilesheet', 1, true, false, this.blocksGroup, Block);
        this.map.createFromObjects('itemblock_layer', 25, 'tilesheet', 24, true, false, this.itemBlocksGroup, ItemBlock);
        this.map.createFromObjects('coins_layer', 58, 'tilesheet', 57, true, false, this.coinsGroup, Coin);
        this.blocksGroup.callAll('setup', null, this._level);
        this.blocksGroup.callAll('body.setSize', 'body', 10, 16);
        this.itemBlocksGroup.callAll('setup', null, this._level);
        this.coinsGroup.callAll('setup', null, this._level);
        this.blocksGroup.callAll('body.setSize', 'body', 10, 16);

        this._mainGroup.add(this.blocksGroup);
        this._mainGroup.add(this.itemBlocksGroup);
        this._mainGroup.add(this.coinsGroup);
        
        this.player = new Player(this._game, 32, this._game.height - 64);
        this.player.setup(this._level);
        this._entitiesGroup.add(this.player);

        this._mainGroup.bringToTop(this._entitiesGroup);

        this._level.camera.follow(this.player, Phaser.FOLLOW_PLATFORMER);
        this._physics.arcade.gravity.y = this._level.gravity;
    };

    LevelManager.prototype.update = function() {
        this._physics.arcade.collide(this.player, this._collisionLayer);
        this._physics.arcade.collide(this.player, this.blocksGroup, onBlockBump, null, this);
        this._physics.arcade.collide(this.player, this.itemBlocksGroup, onItemBlockBump, null, this);
        this._physics.arcade.collide(this.coinsGroup, this.itemBlocksGroup, onCoinBump, null, this);

        this.blocksGroup.callAll('update');
        this.itemBlocksGroup.callAll('update');
        this._entitiesGroup.callAll('update');
        this.coinsGroup.callAll('update');

        function onBlockBump(player, block) {
            if (player.body.touching.up) {
                block.bump();
            }
        }

        function onItemBlockBump(player, itemBlock) {
            if (player.body.touching.up) {
                itemBlock.bump();
            }
        }

        function onCoinBump(coin, itemBlock) {
            if (itemBlock._bumped) {
                coin.bump();

                if (!coin._bumped) {
                    this._score += 1;
                    this._scoreText.text = 'x ' + this._score;
                }

                coin._bumped = true;
            }
        }

        if (this.player.body.bottom >= this._game.world.bounds.bottom) {
            this._game.state.start(this._game.state.current);
            this._game._lifes -= 1;
            this._lifesText.text = 'x ' + this._lifes;
        }
    };

    return LevelManager;
}());