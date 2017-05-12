<!DOCTYPE html><html lang="fr"><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1.0">    <meta name="description" content="Promot-Vogt Espace Memebre">    <meta name="author" content="LACY 2017">    <meta name="keyword" content="Promo-vogt, alumni, anciens, vogtois">    <meta name="csrf-token" content="{{ csrf_token() }}">    <link rel="shortcut icon" href={!! url('cache/original/'."img/favicon.png") !!}>    <script>        // rename myToken as you like        window.Laravel ={!! json_encode([              'csrfToken' => csrf_token(),        ]) !!};    </script>    <title>@yield('title')</title>    <!-- Bootstrap CSS -->    <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet">    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>    <script>        var OneSignal = window.OneSignal || [];        OneSignal.push(["init", {            appId: "{{env('ONESIGNAL_APP_ID')}}",            autoRegister: false, /* Set to true to automatically prompt visitors */            subdomainName: 'member-promotvogt',            /*             subdomainName: Use the value you entered in step 1.4: http://imgur.com/a/f6hqN             */            httpPermissionRequest: {                enable: true            },            notifyButton: {                enable: true /* Set to false to hide */            }        }]);    </script>@yield('css')<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->    <!--[if lt IE 9]>    <script src="{{ asset('js/kar.js') }}"></script>    <![endif]--></head><body><!-- container section start --><section id="container" class="">    <!--header start-->@include('layouts/header')<!--header end-->    <!--sidebar start-->@include('layouts/aside')<!--sidebar end-->    <!--main content start-->    <!--input type="hidden" val="{{-- Auth::id() --}}" id="userId"-->    <script>        var userId = {!! json_encode( Auth::id()) !!};        var compta = {!! session('role_compt') !!}    </script>    <div id='app'></div>@include('layouts/main-content')<!--main content end--></section><!-- container section start --><script src="{{asset('assets/js/site.js')}}"></script><script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>@yield('script')<!--script>    //knob    $(function() {        $(".knob").knob({            'draw' : function () {                $(this.i).val(this.cv + '%')            }        })    });    //carousel    $(document).ready(function() {        $("#owl-slider").owlCarousel({            navigation : true,            slideSpeed : 300,            paginationSpeed : 400,            singleItem : true        });    });    //custom select box    $(function(){        $('select.styled').customSelect();    });</script--></body></html>