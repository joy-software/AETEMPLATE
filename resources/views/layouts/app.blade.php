<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Karmanta - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Karmanta, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="{{ asset('karmanta/img/favicon.png') }}">

    <title>Karmanta - Bootstrap 3 Responsive Admin Template</title>

    <!-- Bootstrap CSS -->

    <link href="{{ asset('karmanta/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="{{ asset('karmanta/css/bootstrap-theme.css') }}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{ asset('karmanta/css/elegant-icons-style.css') }}" rel="stylesheet" />
    <link href="{{ asset('karmanta/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- full calendar css-->
    <link href="{{ asset('karmanta/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css') }}" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="{{ asset('karmanta/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css') }}" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('karmanta/css/owl.carousel.css') }}" type="text/css">

    <!-- Custom styles -->
    <link href="{{ asset('karmanta/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('karmanta/css/style-responsive.css') }}" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="{{ asset('karmanta/js/html5shiv.js') }}"></script>
    <script src="{{ asset('karmanta/js/respond.min.js') }}"></script>
    <script src="{{ asset('karmanta/js/lte-ie7.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <![endif]-->
</head>

<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->


    @include('layouts/header')
    <!--header end-->

    <!--sidebar start-->

    @include('layouts/aside')
    <!--sidebar end-->

    <!--main content start-->

    @include('layouts/main-content')
    <!--main content end-->
</section>
<!-- container section start -->

<!-- javascripts -->
<script src="{{ asset('karmanta/js/jquery.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('karmanta/js/jquery-ui-1.9.2.custom.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ asset('karmanta/js/bootstrap.min.js') }}"></script>
<!-- nice scroll -->
<script src="{{ asset('karmanta/js/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<!-- charts scripts -->
<script src="{{ asset('karmanta/assets/jquery-knob/js/jquery.knob.js') }}"></script>
<script src="{{ asset('karmanta/js/jquery.sparkline.js') }}" type="text/javascript"></script>
<script src="{{ asset('karmanta/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/owl.carousel.js') }}" ></script>
<!-- jQuery full calendar -->
<script src="{{ asset('karmanta/assets/fullcalendar/fullcalendar/fullcalendar.min.js') }}"></script>
<!--script for this page only-->
<script src="{{ asset('karmanta/js/calendar-custom.js') }}"></script>
<!-- custom select -->
<script src="{{ asset('karmanta/js/jquery.customSelect.min.js') }}" ></script>
<!--custome script for all page-->
<script src="{{ asset('karmanta/js/scripts.js') }}"></script>
<!-- custom script for this page-->
<script src="{{ asset('karmanta/js/sparkline-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/easy-pie-chart.js') }}"></script>
<script src="{{ asset('karmanta/js/custom.js') }}"></script>

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
