define([
    "jquery"
], function($) {
    "use strict";

    return function (options, element) {
        $(element).click(function (event) {
            $('.student-mark').toggleClass('active');
        });

    };
});