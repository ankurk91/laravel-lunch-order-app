import jQuery from 'jquery/dist/jquery.slim';

window.jQuery = jQuery;
import Popper from 'expose-loader?Popper!popper.js';

window.Popper = Popper;

// Selective bootstrap.js build
// https://github.com/twbs/bootstrap/issues/20709
import 'expose-loader?Util!exports-loader?Util!bootstrap/js/dist/util';
import 'bootstrap/js/dist/alert';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';

