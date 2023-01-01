<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('theme/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('theme/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('theme/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('theme/css/paper-dashboard.css')}}?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
{{--    <link href="{{asset('theme/demo/demo.css')}}" rel="stylesheet" />--}}
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('theme/vendor/toastr/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/vendor/full_calender/lib/main.min.css')}}">

    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        .main-panel form label{
            font-size: 15px !important;
            font-weight: 600 !important;
            color: #595959 !important;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 8px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    @yield('css')
</head>

<body class="">
<div class="wrapper ">
    @include('components.aside')
    <div class="main-panel">
        @include('components.upper_nav')
        @yield('content')
        @include('components.footer')
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('theme/js/core/jquery.min.js')}}"></script>
<script src="{{asset('theme/js/core/popper.min.js')}}"></script>
<script src="{{asset('theme/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="{{asset('theme/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('theme/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('theme/demo/demo.js')}}"></script>

<!-- Toastr -->
<script src="{{asset('theme/vendor/toastr/js/toastr.min.js')}}"></script>
<script src="{{asset('theme/vendor/full_calender/lib/main.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var BASE = '{{url('/')}}';
</script>
@if(session('common_msg'))
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        toastr["{{session('common_msg')['type']}}"]("{{session('common_msg')['message']}}");
    </script>
@endif

@yield('js')

</body>

</html>
