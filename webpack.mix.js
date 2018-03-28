'use strict';

let mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Configure default options
// @see https://github.com/JeffreyWay/laravel-mix/blob/master/docs/options.md
mix.options({
  processCssUrls: true,
  purifyCss: false,
  extractVueStyles: false,
  imgLoaderOptions: {
    enabled: false
  },
  uglify: {
    uglifyOptions: {
      compress: {
        drop_console: true,
        drop_debugger: true
      }
    }
  }
});

mix.js('resources/assets/js/app.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css')
  .sourceMaps(false)
  .disableNotifications();

// Version does not work in HMR mode
if (process.env.npm_lifecycle_event !== 'hot') {
  mix.version()
}
