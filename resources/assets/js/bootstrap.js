
try {
    window.$ = window.jQuery = require('jquery');
    window.moment = require('moment');
    window.Chart = require('chart.js');

    require('bootstrap-sass');
    require('daterangepicker');
} catch (e) {}