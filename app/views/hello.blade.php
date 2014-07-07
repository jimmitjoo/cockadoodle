@extends('master/master')

@section('title', 'Cock A Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('content')
<div class="startscreen">
    <div class="logo"></div>
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

    <form action="/user" method="post">
        <input placeholder="email" type="text"/>
        <input placeholder="password" type="password"/>
        <input value="sign up / login" type="submit"/>
    </form>

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