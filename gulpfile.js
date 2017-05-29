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
        '../../../public/karmanta/css/line-icons.css',
    ], 'public/assets/css/site.css')
    .styles([
        '../../../public/karmanta/css/elegant-icons-style.css',
        '../../../public/karmanta/assets/font-awesome/css/font-awesome.css',
        '../../../public/karmanta/css/line-icons.css',
    ], 'public/assets/css/site1.css')
    .styles([
        '../../../public/karmanta/css/bootstrap.min.css',
        '../../../public/karmanta/css/bootstrap-theme.css',
        '../../../public/karmanta/css/elegant-icons-style.css',
        '../../../public/karmanta/assets/font-awesome/css/font-awesome.css',
    ], 'public/assets/css/site2.css')
    .styles([
        '../../../public/css/login.css'
    ], 'public/assets/css/login.css')
    .styles([
        '../../../public/css/annuaire.css',
        '../../../public/css/avatar.css',
    ], 'public/assets/css/annuaire.css')
    .styles([
        '../../../public/css/dataTables.bootstrap.min.css',
        '../../../public/css/dataTables.foundation.css',
        '../../../public/css/jquery.dataTables.min.css'
    ], 'public/assets/css/table.css')


    .styles([
        '../../../public/css/signup.css'
    ], 'public/assets/css/signup.css')



    .styles([
        '../../../public/karmanta/css/style.css',
        '../../../public/karmanta/css/style-responsive.css',
    ], 'public/assets/css/style.css')

    .styles([
        '../../../public/css/header.css'
    ], 'public/assets/css/header.css')
    .styles([
        '../../../public/css/login.css'
    ], 'public/assets/css/login.css')
    .styles([
        '../../../public/css/signup.css'
    ], 'public/assets/css/signup.css')

    .styles([
        '../../../public/karmanta/css/elegant-icons-style.css'
    ], 'public/assets/css/elegant-icons-style.css')
    .styles([
        '../../../public/css/admin.css'
    ], 'public/assets/css/admin.css')
    .styles([
        '../../../public/css/group.css',
        '../../../public/css/avatar.css'
    ], 'public/assets/css/group.css')
    .styles([
        '../../../public/css/comptabilite.css'
    ], 'public/assets/css/comptabilite.css')
    .styles([
        '../../../public/css/print.css'
    ], 'public/assets/css/print.css')
    .styles([
        '../../../public/css/listViewVideo.css'
    ], 'public/assets/css/listViewVideo.css')
    .styles([
        '../../../public/css/uploadVideo.css'
    ], 'public/assets/css/uploadVideo.css')

    .styles([
        '../../../public/css/deleteAside.css'
    ], 'public/assets/css/deleteAside.css')
    .styles([
        '../../../public/css/displayAside.css'
    ], 'public/assets/css/displayAside.css')
    .styles([
        '../../../public/css/upload.css'
    ], 'public/assets/css/upload.css')
    .styles([
        '../../../public/css/profile.css',
        '../../../public/css/avatar.css'
    ], 'public/assets/css/profile.css');
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
        '../../../public/js/header.js'
    ], 'public/assets/js/kar3.js')
    .scripts([
        '../../../public/js/app.js',
        '../../../public/karmanta/js/jquery-ui-1.9.2.custom.min.js',
        '../../../public/karmanta/js/jquery.scrollTo.min.js',
        '../../../public/karmanta/js/jquery.nicescroll.js',
        '../../../public/karmanta/js/scripts.js',
        '../../../public/js/header.js'
    ], 'public/assets/js/site.js')
    .scripts([
        '../../../public/js/admin.js'
    ], 'public/assets/js/admin.js')
    .scripts([
        '../../../public/js/annuaire.js'
    ], 'public/assets/js/annuaire.js')
    .scripts([
        '../../../public/js/jquery.dataTables.js',
        '../../../public/js/dataTables.bootstrap.min.js'
    ], 'public/assets/js/table.js')
    .scripts([
        '../../../public/js/upload.js'
    ], 'public/assets/js/upload.js')
    .scripts([
        '../../../public/js/group.js'
    ], 'public/assets/js/group.js')
    .scripts([
        '../../../public/js/upload.js'
    ], 'public/assets/js/upload.js')
    .scripts([
        '../../../public/js/acceuil.js'
    ], 'public/assets/js/acceuil.js')
    .scripts([
        '../../../public/js/app.js'
    ], 'public/assets/js/app.js')
    .scripts([
        '../../../public/js/listViewVideo.js'
    ], 'public/assets/js/listViewVideo.js')
    .scripts([
        '../../../public/js/uploadVideo.js'
    ], 'public/assets/js/uploadVideo.js')
    .scripts([
        '../../../public/js/header.js'
    ], 'public/assets/js/header.js')
        .scripts([
            '../../../public/js/view_meeting.js'
        ], 'public/assets/js/view_meeting.js')
    .scripts([
        '../../../public/js/comptabilite.js'
    ], 'public/assets/js/comptabilite.js');


});


