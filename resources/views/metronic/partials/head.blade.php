<head>
    <base href="">
    <meta charset="utf-8" />
    <title>
        داشبورد
        @if(Auth::guard('tenant')->check())
            کاربران
        @else
            مدیریت
        @endif
    </title>
    <meta name="description" content="{{ env('APP_NAME') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href='https://fonts.googleapis.com/css?family=Noto Sans Arabic:300,400,500,600,700' rel='stylesheet'>
    <link href="{{ asset('metronic-assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('metronic-assets/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    {{--fav ico--}}
    <link rel="shortcut icon" href="{{ asset('metronic-assets/media/minimal-logo.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('metronic-assets/css/custom_style.css') }}" rel="stylesheet" type="text/css" />

    <link type="text/css" rel="stylesheet" href="{{ asset('metronic-assets/css/jalalipicker.css') }}" />
    <script type="text/javascript" src="{{ asset('metronic-assets/js/jalalipicker.js') }}"></script>
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>

    @stack('head')

</head>
