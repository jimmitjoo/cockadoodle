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
top: 50%;
left: 50%;
background: url('/{{$cock->doodle_uri}}') no-repeat center center;
background-size: contain;
}
#doodle {
background: url('/{{$doodle->doodle_uri}}') no-repeat center center;
background-size: contain;
}
.send {
width: 100%;
}

@stop

@section('content')

<img id="the_cock" src="/{{$cock->doodle_uri}}" alt=""/>
<img id="the_doodle" src="/{{$doodle->doodle_uri}}" alt=""/>

<div id="cock"></div>
<div id="doodle"></div>


<div id="reviewSlider"></div>

<ul class="menu">
    <li class="redo">50</li>
    <li class="send">Send</li>
</ul>

<div class="doneDiv">
    <span class="text"></span>
</div>

@stop


@section('scripts')

<script src="/js/jquery.js"></script>
<script src="/js/jquery.nouislider.min.js"></script>

<script>

    $(document).ready(function(){

        var cock_height,
            cock_width,
            doodle_height,
            doodle_width;

        /*alert(
            'cock height:' + cock_height + ' :::' +
            'cock width:' + cock_width + ' :::' +
            'doodle height:' + doodle_height + ' :::' +
            'doodle width:' + doodle_width
        );*/

        setTimeout(function(){

            cock_height = $("#the_cock").height();
            cock_width = $("#the_cock").width();
            doodle_height = $("#the_doodle").height();
            doodle_width = $("#the_doodle").width();

            var win_width = $(window).width();
            var win_height = $(window).height();

            if (cock_width > doodle_width) {
                var view_scale = win_width / cock_width;
            } else {
                var view_scale = win_width / doodle_width;
            }

            var cw = cock_width * view_scale;
            var ch = cock_height * view_scale;
            var dw = doodle_width * view_scale;
            var dh = doodle_height * view_scale;


            $('#cock').css({
                'width': cw + 'px',
                'height': ch + 'px',
                'margin-top': '-' + (ch/2) + 'px',
                'margin-left': '-' + (cw/2) + 'px'
            });
            $('#doodle').css({
                'width': dw + 'px',
                'height': dh + 'px',
                'margin-top': '-' + (dh/2) + 'px',
                'margin-left': '-' + (dw/2) + 'px'
            });
        }, 500);

        setTimeout(function(){
            $('#the_cock, #the_doodle').remove();
        }, 500);

    });

    $('.send').on('touchstart', function(){

        // Grade doodle
        $.ajax({
            type: 'POST',
            url: 'http://cockadoodle.in/api/grade_doodle',
            data: {
                doodle_id: {{ $doodle->id }},
                grade: Math.round($('#reviewSlider').val())
            },
            cache: false
        });

        // send doodle, maybe that's done when sending to the game table?

        // display message that confirm it is sent
        $('.doneDiv .text').text('Doodle review sent!!');

        setTimeout(function(){
            document.location.href = '/friends';
        },4000);

        $('.doneDiv .text').css({'top': '85px'});

        $('.doneDiv').animate({'top': '0'}, 300);

    });

    var doodle = $('#doodle');

    doodle.on('touchstart', function(){
        doodle.css({'opacity': '.1'});
    }).on('touchend', function(){
        doodle.css({'opacity': '1'});
    });

    /*$('#doodle').on('click', function(){
        var doodle = $(this);
        if (doodle.css('opacity') < '1') {
            doodle.css({'opacity': '1'});
        } else {
            doodle.css({'opacity': '.1'});
        }
    });*/

    $('.send').animate({'right':0}, 250);
    $('.redo').animate({'left':0}, 250);

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
            vars[key] = value;
        });
        return vars;
    }


    $("#reviewSlider").noUiSlider({
        start: [ 50 ],
        step: 10,
        range: {
            'min': [ 0 ],
            'max': [ 100 ]
        }
    });

    $('#reviewSlider').on('slide', function(){
        var sVal = Math.round($(this).val());
        $('.redo').text( sVal );
    });

</script>

@stop