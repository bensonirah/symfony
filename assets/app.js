/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
const $ = require('jquery');
// any CSS you import will output into a single css file (app.scss in this case)
require('bootstrap');

import './styles/app.scss';
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
})
// start the Stimulus application
import './bootstrap';
