const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */


elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js');
    mix.styles([
        '../../../public/css/app.css',
        '../../../public/css/header.css',
        '../../../public/karmanta/css/elegant-icons-style.css',
        '../../../public/karmanta/assets/font-awesome/css/font-awesome.css',
        '../../../public/karmanta/css/style-responsive.css',
    ], 'public/assets/css/site.css')
    .styles([
        '../../../public/karmanta/css/elegant-icons-style.css',
        '../../../public/karmanta/assets/font-awesome/css/font-awesome.css',
        '../../../public/karmanta/css/style-responsive.css'
    ], 'public/assets/css/site1.css')
    .styles([
        '../../../public/css/login.css'
    ], 'public/assets/css/login.css')
    .styles([
        '../../../public/css/signup.css'
    ], 'public/assets/css/signup.css')
    .styles([
        '../../../public/karmanta/css/style.css'
    ], 'public/assets/css/style.css')
    .styles([
        '../../../public/karmanta/css/line-icons.css'
    ], 'public/assets/css/line-icons.css')
    .styles([
        '../../../public/css/header.css'
    ], 'public/assets/css/header.css');
    mix.scripts([
        '../../../public/karmanta/js/html5shiv.js',
        '../../../public/karmanta/js/lte-ie7.js'
    ], 'public/js/kar.js')
    .scripts([
        '../../../public/karmanta/js/jquery-ui-1.9.2.custom.min.js',
        '../../../public/karmanta/js/jquery.scrollTo.min.js',
        '../../../public/karmanta/js/jquery.nicescroll.js',
        '../../../public/karmanta/js/scripts.js',
        '../../../public/js/header.js'
    ], 'public/assets/js/kar2.js')
    .scripts([
        '../../../public/karmanta/js/jquery.scrollTo.min.js',
        '../../../public/karmanta/js/jquery.nicescroll.js',
        '../../../public/karmanta/js/scripts.js',
    ], 'public/assets/js/kar3.js')
    .scripts([
        '../../../public/js/app.js',
        '../../../public/assets/js/kar2.js'
    ], 'public/assets/js/site.js')
    .scripts([
        '../../../public/js/upload.js'
    ], 'public/assets/js/upload.js');

});


