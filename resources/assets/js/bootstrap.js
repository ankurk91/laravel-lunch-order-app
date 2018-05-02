import 'jquery/dist/jquery.slim';
import 'expose-loader?Popper!popper.js';

// Selective bootstrap.js build
// https://github.com/twbs/bootstrap/issues/20709
import 'expose-loader?Util!exports-loader?Util!bootstrap/js/dist/util';
import 'bootstrap/js/dist/dropdown';
import 'bootstrap/js/dist/collapse';

