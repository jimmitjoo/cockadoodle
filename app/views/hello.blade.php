@extends('master/master')

@section('title', 'Cock-A-Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('style')
.logo {
    display:none;
}
@stop

@section('content')
<div class="startscreen">
    <!--<div class="logo">
        <video style="width: 100%; height: 100%" autoplay="autoplay">
            <source src="videos/Cad_Logo_anim_mk4.mp4.mp4" type="video/mp4">
            <source src="videos/Cad_Logo_anim_mk4.oggtheora.ogg" type="video/ogg">
            <source src="videos/Cad_Logo_anim_mk4.webmhd.webm" type="video/webm">
            Your browser does not support the video tag.
        </video>
    </div>-->
    <div class="lightweight_logo"></div>
</div>


<a href="/fbver" class="facebook_box">
    <div class="facebook_logo">
        <i class="fa fa-facebook-square"></i>
    </div>
</a>

<div class="login_box">
    Login
</div>

<div class="email_box sign_up" style="display: none">

    {{ Form::open(['url' => '/user', 'method' => 'post']) }}
    {{ Form::text('username', '', ['placeholder' => 'Choose username']) }}
    {{ Form::email('email', '', ['placeholder' => 'your@email.com']) }}
    {{ Form::password('password', ['placeholder' => 'Choose password']) }}
    {{ Form::submit('Sign up') }}
    {{ Form::close() }}

    <a href="#" class="login_to_account">Login</a>

</div>
<div class="email_box sign_in">

    {{ Form::open(['url' => '/login', 'method' => 'post']) }}
    {{ Form::text('username', '', ['placeholder' => 'Username']) }}
    {{ Form::password('password', ['placeholder' => 'Password']) }}
    {{ Form::submit('Login') }}
    {{ Form::close() }}

    <a href="#" class="create_account">Sign up</a>

</div>

@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    var setLoginHeight = function(){
        var lb_h = $('.login_box').height();
        $('.login_box').css({'line-height': lb_h + 'px'});

        if (lb_h < 70) {
            $('.login_box').css({'font-size': '35px'});
        } else {
            $('.login_box').css({'font-size': ''});
        }
    }


    var setLoginFormHeight = function(){
        var eb = $('.email_box');
        var lib_h = eb.height();

        if (lib_h < 260) {
            eb.find('form').css({'margin-top': '0'});
            eb.find('input').css({'margin-top': '5px'});
        } else {
            eb.find('form').css({'margin-top': ''});
            eb.find('input').css({'margin-top': ''});
        }
    }

    $(window).on('resize', function(){
        setLoginHeight();
    });

    $(function() {

        $('.lightweight_logo').animate({'opacity': '1'}, 500);

        setLoginHeight();

        $('.login_to_account, .create_account').on('touchstart', function(){
            $('.sign_in').toggle();
            $('.sign_up').toggle();
        });

        setTimeout(function(){
            $('.startscreen').animate({'left': - ($('body').width()) + 'px'}, 1000);
        }, 3100);
        setTimeout(function(){
            $('.startscreen').remove();
        }, 4500);
    });
</script>
@stop