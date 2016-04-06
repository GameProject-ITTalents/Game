var InputHandler = (function() {
    function InputHandler() {
        this._inputMap =  {};
        this._listenerMap = {};
    }

    InputHandler.prototype.setInputMap = function(inputMap) {
        this._inputMap = inputMap || {};
    };

    InputHandler.prototype.addListener = function(key, ctx, handler, onDown, onUp) {
        ctx = ctx || null;
        handler = handler || null;
        onDown = onDown || null;
        onUp = onUp || null;

        if (this._inputMap.hasOwnProperty(key)) {
            this._listenerMap[key] = {
                handler: handler,
                ctx: ctx,
                onDown: onDown,
                onUp: onUp
            };
        }
    };

    InputHandler.prototype.getListenerByInputCode = function(code) {
        var key;
        var listener = null;

        for (var k in this._inputMap) {
            if (this._inputMap[k] === code) {
                key = k;
            }
        }

        if (this._listenerMap.hasOwnProperty(key)) {
            listener = this._listenerMap[key];
        }

        return listener;
    };

    return InputHandler;
}());