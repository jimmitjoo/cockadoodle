@extends('master/master')

@section('title', 'Cock A Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('content')
<div class="startscreen">
    <div class="logo">
        <video style="width: 100%; height: 100%" autoplay="autoplay">
            <source src="videos/Cad_Logo_anim_mk1.mp4.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
</div>


<a href="/fbver" class="facebook_box">
    <div class="facebook_logo">
        <i class="fa fa-facebook-square"></i>
    </div>
</a>

<div class="login_box">
    Login
</div>

<div class="email_box">

    {{ Form::open(['url' => '/user', 'method' => 'post']) }}
    {{ Form::text('username', '', ['placeholder' => 'Choose username']) }}
    {{ Form::email('email', '', ['placeholder' => 'your@email.com']) }}
    {{ Form::password('password', ['placeholder' => 'Password']) }}
    {{ Form::submit('Sign up') }}
    {{ Form::close() }}

</div>

@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function() {
        setTimeout(function(){
            $('.startscreen').animate({'left': - ($('body').width()) + 'px'}, 1500);
        }, 2100);
    });
</script>
@stop