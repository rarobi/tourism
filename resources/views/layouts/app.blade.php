<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Ansonika">
    @yield('meta')
    <title>{{ env('APP_NAME','Navigator Tourism') }}</title>

    <!-- Fav icons-->
    {!! Html::style('assets/img/favicon.ico') !!}
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- COMMON CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    {!! Html::style('assets/css/bootstrap.min.css') !!}
    {!! Html::style('assets/css/style.css') !!}
    {!! Html::style('assets/css/vendors.css') !!}
    {!! Html::style('assets/css/select2.min.css') !!}

    <!-- CUSTOM CSS -->
    {!! Html::style('assets/css/custom.css') !!}

    @yield('header-css')
</head>
<body>

<div id="preloader">
    <div class="sk-spinner sk-spinner-wave">
        <div class="sk-rect1"></div>
        <div class="sk-rect2"></div>
        <div class="sk-rect3"></div>
        <div class="sk-rect4"></div>
        <div class="sk-rect5"></div>
    </div>
</div>
<!-- End Preload -->

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<!-- Header================================================== -->
@include('includes.header')
@yield('search')

<main>
    @yield('content')
</main>
<!-- End main -->

@include('includes.footer')

<div id="toTop"></div><!-- Back to top button -->
<!-- Common scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
{!! Html::script('assets/js/jquery-2.2.4.min.js') !!}
{!! Html::script('assets/js/common_scripts_min.js') !!}
{!! Html::script('assets/js/functions.js') !!}
{!! Html::script('assets/js/select2.min.js') !!}
{{--{!! Html::script('assets/js/backfix.min.js') !!}--}}

<script>
    $('input.date-pick').datepicker('setDate', 'today');
    $('input.time-pick').timepicker({
        minuteStep: 15,
        showInpunts: false
    })
</script>
{!! Html::script('assets/js/jquery.ddslick.js') !!}
@yield('footer-script')
<script>
    $("select.ddslick").each(function() {
        $(this).ddslick({
            showSelectedHTML: true
        });
    });
</script>

<!-- Check box and radio style iCheck -->
<script>
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-grey',
        radioClass: 'iradio_square-grey'
    });
</script>

</body>
</html>
