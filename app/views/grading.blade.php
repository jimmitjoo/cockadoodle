@extends('master/master')

@section('title', 'Friendslist of Cock-A-Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('styles')
html, body {
overflow: hidden !important;
}
#cock, #doodle {
width: 100%;
height: 100%;
position: fixed;
top: 0;
left: 0;
background: url('/{{$cock->doodle_uri}}') no-repeat center center;
background-size: contain;
}
#doodle {
background: url('/{{$doodle->doodle_uri}}') no-repeat center center;
background-size: contain;
}
@stop

@section('content')

<img id="the_cock" src="/{{$cock->doodle_uri}}" alt=""/>
<img id="the_doodle" src="/{{$doodle->doodle_uri}}" alt=""/>

<div id="cock"></div>
<div id="doodle"></div>

<ul class="menu">
    <li class="send">Grade</li>
</ul>

<div class="doneDiv">
    <span class="text"></span>
</div>

@stop


@section('scripts')

<script src="/js/jquery.js"></script>

<script>

    var cock_height,
        cock_width,
        doodle_height,
        doodle_width;

    $("#the_cock").load(function() {
        cock_height = $("#the_cock").height();
        cock_width = $("#the_cock").width();

        alert('cock_height: ' + cock_height + ' ::: cock_width: ' + cock_width);
    });
    $("#the_doodle").load(function() {
        doodle_height = $("#the_doodle").height();
        doodle_width = $("#the_doodle").width();

        alert('doodle_height: ' + doodle_height + ' ::: doodle_width: ' + doodle_width);
    });

    $(document).ready(function(){

        var win_width = $(window).width();

        if (cock_width > doodle_width) {
            var view_scale = win_width / cock_width;
        } else {
            var view_scale = win_width / doodle_width;
        }

        var cw = cock_width * view_scale;
        var dw = doodle_width * view_scale;

        $('#cock').css({'width': cw + 'px' });
        $('#doodle').css({'width': dw + 'px' });

        $('#the_cock, #the_doodle').remove();

    });

    $('.send').on('touchstart', function(){

        // Grade doodle
        $.ajax({
            type: 'POST',
            url: 'http://cockadoodle.in/api/grade_doodle',
            data: {
                doodle_id: {{ $doodle->id }},
                grade: getUrlVars()["user_id"]
            },
            cache: false
        });

        // send doodle, maybe that's done when sending to the game table?

        // display message that confirm it is sent
        $('.doneDiv .text').text('Doodle review sent!!');

        setTimeout(function(){
            document.location.href = '/friends';
        },4000);

        $('.doneDiv').slideDown();
    });



    $('.send').animate({'right':0}, 250);
    //$('.redo').animate({'left':0}, 250);

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
            vars[key] = value;
        });
        return vars;
    }


</script>

@stop