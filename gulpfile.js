var gulp = require('gulp');
var elixir = require('laravel-elixir');
var del = require('del');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */


gulp.task('remove', function () {
    del(['public/css', 'public/js']);
});

elixir(function (mix) {

    mix.styles([
        'bootstrap.min.css',
        'font-awesome.min.css',
        'prettyPhoto.css',
        'animate.css',
        'loading.css',
        'main.css',
        'responsive.css',
    ], 'public/css/all.css')

        .scripts([
            'jquery.js',
            'bootstrap.min.js',
            'jquery.scrollUp.min.js',
            'price-range.js',
            'jquery.prettyPhoto.js',
            'main.js',
        ], 'public/js/all.js')

        .version([
            'public/css/all.css',
            'public/js/all.js'
        ])

        .copy('resources/assets/fonts', 'public/build/fonts')
        .copy('resources/assets/images', 'public/build/images')
        .task('remove');

});