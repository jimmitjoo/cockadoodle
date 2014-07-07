<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Title')</title>
    @yield('meta','')

    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <style>
        html, body {
            overflow: hidden;
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }
        body {
        }
        * {
            outline: none;
            font-weight: 700;
        }
        ::-webkit-input-placeholder {
            color: #ffffff;
        }

        :-moz-placeholder { /* Firefox 18- */
            color: #ffffff;
        }

        ::-moz-placeholder {  /* Firefox 19+ */
            color: #ffffff;
        }

        :-ms-input-placeholder {
            color: #ffffff;
        }
        .startscreen {
            width: 100%;
            height: 100%;
            display: block;
            float: left;
            background: rgba(255,111,4,1);
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            box-shadow: 1px 0px 5px rgba(0,0,0,0.3);
        }
        .logo {
            width: 100%;
            height: 100%;
            /*background: url('/img/cadlogo.png') center center no-repeat;*/
            display: block;
            float: left;
        }

        [class^="arrow-"] {
            position: absolute;
        }


        .facebook_box,
        .email_box {
            width: 100%;
            height: 42%;
            float: left;
            position: relative;
        }
        .facebook_box {
            background: #e2f4ff;
        }
        .facebook_logo {
            width: 86px;
            height: 86px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin-top: -50px;
            margin-left: -50px;
            background: #ffffff;
            border-radius: 20px;
        }
        .facebook_logo .fa {
            font-size: 100px;
            margin-top: -6px;
            color: #3b5998;
        }

        .email_box {
            background: #ffc109;
            border-top: 1px solid #eee;
        }
        .email_box form {
            width: 100%;
            display: block;
            margin-top: 30px;
        }
        .email_box input {
            width: 60%;
            margin-top: 20px;
            margin-left: 20%;
            float: left;
            height: 30px;
            background: #ffffff;
            border: 0;
            font-family: 'Montserrat', sans-serif;
            padding: 0;
            text-transform: uppercase;
            text-align: center;
            background: #ffc109;
            border-radius: 3px;
            border: 1px solid rgba(238,238,238,.5);
            font-weight: 400;
            letter-spacing: 1px;
        }
        .email_box input[placeholder] {
            color: #fff;
        }
        .email_box input[type=submit] {
            width: 40%;
            margin-left: 30%;
            margin-top: 30px;
            background: rgba(255,111,4,1);
            color: #fff;
        }

        .login_box {
            width: 100%;
            height: 16%;
            box-sizing: border-box;
            float: left;
            background: #ffffff;
            font-size: 60px;
            padding-top: 20px;
            text-align: center;
            text-transform: uppercase;
            color: rgba(255,111,4,1);
            line-height: 100%;
            font-weight: bold;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

@yield('content')

@yield('scripts','')

@include('partials/footer')