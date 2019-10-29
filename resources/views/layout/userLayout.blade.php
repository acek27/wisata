<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/assets/img/jbr.png')}}">
    <link rel="icon" type="image/png" href="{{asset('/assets/img/jbr.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Pengunjung Wisata Jember - @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link href="{{'https://fonts.googleapis.com/css?family=Montserrat:400,700,200'}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{'https://use.fontawesome.com/releases/v5.7.1/css/all.css'}}"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('/assets/css/now-ui-dashboard.css?v=1.3.0')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{--<link href="{{asset('/assets/demo/demo.css')}}" rel="stylesheet"/>--}}
    <link href="{{asset('plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
    @yield('css')

</head>

<body class="">
<div class="main-panel" id="main-panel" style="width: 100%">
    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="col-lg-12">
                <h5 class="text-center" style="color: white; margin-top: 10px; text-transform: uppercase">@yield('sub')</h5>
            </div>
        </div>
    </nav>
    @yield('content')
</div>

@yield('content1')

<footer class="footer">
    <div class="container">
        <div class="text-center" id="copyright">
            &copy;
            <script>
                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
            , Kabupaten Jember.
            <br>Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
        </div>
    </div>
</footer>
<script src="{{asset('/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('/assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chart JS -->
<script src="{{asset('/assets/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('/assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('/assets/js/now-ui-dashboard.min.js?v=1.3.0')}}" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
{{--<script src="{{asset('/assets/demo/demo.js')}}"></script>--}}
<script src="{{asset('plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack ('script')

</body>
</html>
