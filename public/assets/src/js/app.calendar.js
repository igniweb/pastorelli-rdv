;(function (app, $, window, document) {

    'use strict';

    var module = {};

    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    function _onDomReady() {
    }

    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    module.run = function () {
        $(document).ready(_onDomReady);
    };

    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------
    // --------------------------------------------------------------------------------------------

    app.calendar = module;

})(App, jQuery, window, document);
