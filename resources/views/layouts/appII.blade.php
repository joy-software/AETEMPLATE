<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Karmanta - Bootstrap 3 Responsive Admin Template">
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
    <link href="{{ asset('karmanta/css/elegant-icons-style.css') }}" rel="stylesheet" />


    <!-- Custom styles -->
    <link href="{{ asset('karmanta/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('karmanta/css/style-responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


@yield('css')

    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('karmanta/js/html5shiv.js') }}"></script>
    <script src="{{ asset('karmanta/js/respond.min.js') }}"></script>
    <script src="{{ asset('karmanta/js/lte-ie7.js') }}"></script>



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



@yield('script')

<script src="{{ asset('karmanta/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('karmanta/js/scripts.js') }}"></script>

<script src="{{ asset('karmanta/js/custom.js') }}"></script>
<!--script src="{{--asset('js/app.js')--}}"></script-->
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
