;(function (app, $, window, document) {

    'use strict';

    var module = {
        pusher: null
    };

    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    module.run = function () {
        //
    };

    module.setup = function (pusherKey) {
        module.pusher = new Pusher(pusherKey);
    };

    module.initLog = function () {
        Pusher.log = function (message) {
            if (window.console && window.console.log) {
                window.console.log(message);
            }
        };
    };

    module.subscribe = function (channel, event, callback) {
        var subscribedChannel = module.pusher.subscribe(channel);

        subscribedChannel.bind(event, callback);
    };

    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    app.pusher = module;

})(App, jQuery, window, document);
