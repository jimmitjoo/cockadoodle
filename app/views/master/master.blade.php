<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Title')</title>
    @yield('meta','')

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/cockadoodlestyle.css">

        <style>
            #sketch {
                width: 100%;
                height: 100%;
                position: fixed;
                top: 0;
                left: 0;
                z-index: 0;
            }
            #canvasDiv {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: block;
                z-index: 0;
                background: transparent;
                overflow: hidden;
            }
        </style>

    @include('partials/apple-icons')
</head>
<body>

@yield('content')

@yield('scripts','')

@include('partials/footer')