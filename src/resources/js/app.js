require('./bootstrap');

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}