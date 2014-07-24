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

    $("#the_cock").load(function() {
        var cock_height = $(this).height();
        var cock_width = $(this).width();

        alert('cock_height: ' + cock_height + ' ::: cock_width: ' + cock_width);

        $(this).remove();
    });
    $("#the_doodle").load(function() {
        var doodle_height = $(this).height();
        var doodle_width = $(this).width();

        alert('doodle_height: ' + doodle_height + ' ::: doodle_width: ' + doodle_width);

        $(this).remove();
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