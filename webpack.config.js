module.exports = require('laravel-bundler')({
    entry: {
      app: './resources/js/app.js',
    },
  },
  require('laravel-bundler/src/recipes/jquery'),
  require('laravel-bundler/src/recipes/alias'),
);
