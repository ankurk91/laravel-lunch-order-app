'use strict';

const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');
require('laravel-mix-auto-extract');
require('laravel-mix-purgecss');

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
// https://github.com/JeffreyWay/laravel-mix/blob/master/docs/options.md
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
  },
  // Make vue-loader future ready
  // https://github.com/vuejs/vue-loader/blob/v14.0.0/docs/en/options.md#esmodule
  vue: {
    esModule: true
  }
});

mix.js('./resources/js/app.js', './public/js')
  .autoload({
    'jquery/dist/jquery.slim': ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('./resources/sass/app.scss', './public/css')
  .sass('./resources/sass/vendor.scss', './public/css/')
  .purgeCss({
    whitelistPatterns: [
      // bootstrap pagination templates resides in `vendor/laravel/framework`
      /^pagination/, /^page-*/,
      // vinkla-alert
      /^alert*/,
    ]
  })
  .autoExtract()
  .sourceMaps(false)
  .disableNotifications();

mix.webpackConfig({
  resolve: {
    alias: {
      'jquery$': 'jquery/dist/jquery.slim.js',
      '@vendor': path.resolve(__dirname, 'vendor'),
    }
  }
});

// Version does not work in HMR mode
if (process.env.npm_lifecycle_event !== 'hot') {
  mix.version()
}
