// CSS
import '../css/global.scss';
import '../css/app.css';

// Images
import '../images/favicon.ico';

// JS
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';
import 'select2';

$(document).ready(function () {
  $('.select2').select2();
});
