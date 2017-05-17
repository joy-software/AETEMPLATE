<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Promot-Vogt Espace Memebre">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Karmanta, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="{{ asset('karmanta/img/favicon.png') }}">
    <script>
        // rename myToken as you like
        window.Laravel ={!! json_encode([
              'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <title>@yield('title')</title>


<!--link href="{{-- asset('karmanta/css/bootstrap.min.css') --}}" rel="stylesheet">
    <!-- bootstrap theme -->
<!--link href="{{-- asset('karmanta/css/bootstrap-theme.css') --}}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <!-- font icon -->
    <link href="{{ asset('assets/css/site.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"-->
    <!--link href="{{-- asset('karmanta/css/elegant-icons-style.css') --}}" rel="stylesheet" />



    <link href="{{-- asset('karmanta/css/style.css') --}}" rel="stylesheet">
    <link href="{{-- asset('karmanta/css/style-responsive.css') --}}" rel="stylesheet" />
    <link href="{{-- asset('css/app.css') --}}" rel="stylesheet"-->
    <link rel="manifest" href="/manifest.json">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
    <script>
        var OneSignal = window.OneSignal || [];
        OneSignal.push(["init", {
            appId: "{{env('ONESIGNAL_APP_ID')}}",
            autoRegister: false,
            notifyButton: {
                enable: true /* Set to false to hide */
            }
        }]);
    </script>

@yield('css')

    <link href="{{ asset('assets/css/header.css') }}" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/kar.js') }}"></script>

    <![endif]-->
</head>


<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->


@include('layouts/headerII')
<!--header end-->

    <!--sidebar start-->


<!--sidebar end-->

    <!--main content start-->

@include('layouts/main-content')
<!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->

<!-- nice scroll -->


<script>
    var userId = {!! json_encode( Auth::id()) !!};
    var compta = {!! session('role_compt') !!};

</script>
@yield('script')


<script src="{{ asset('assets/js/kar3.js') }}"></script>


<script>

    //knob
    $(function() {
        $(".knob").knob({
            'draw' : function () {
                $(this.i).val(this.cv + '%')
            }
        })
    });

    //carousel
    $(document).ready(function() {
        $("#owl-slider").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true

        });
    });

    //custom select box

    $(function(){
        $('select.styled').customSelect();
    });

</script>

</body>
</html>
