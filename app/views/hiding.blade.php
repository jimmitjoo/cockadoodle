@extends('master/master')

@section('title', 'Friendslist of Cock-A-Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('styles')
html, body {
overflow: hidden !important;
}
#hide_this {
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background: url('/{{$cockuri}}') no-repeat center center;
}
@stop

@section('content')

<div class="background_text">Hide<br/>The <br/>Cock</div>

<div id="hide_this"></div>
<div id="canvasDiv"></div>

<ul class="menu">
    <li class="redo">Redo</li>
    <li class="send">Send</li>
</ul>

<div class="doneDiv">
    <span class="text"></span>
</div>

@stop


@section('scripts')

<script src="/js/jquery.js"></script>

<script>

    var canvas = startdrawing();

    var context = canvas.getContext("2d");
    context.strokeStyle = "#777777";
    context.lineJoin = "round";
    context.lineWidth = 3;

    var startedDrawing = false;
    $('#canvas').on('touchstart', function(e){
        e.preventDefault();

        var fingerX = e.originalEvent.touches[0].pageX - this.offsetLeft;
        var fingerY = e.originalEvent.touches[0].pageY - this.offsetTop;

        paint = true;

        addClick(fingerX - this.offsetLeft, fingerY - this.offsetTop);
        redraw();
    });
    $('#canvas').on('touchmove', function(e){
        if(paint){
            addClick(e.originalEvent.touches[0].pageX - this.offsetLeft, e.originalEvent.touches[0].pageY - this.offsetTop, true);
            redraw();
        }
    });

    var doneDrawing = false;
    $('#canvas').on('touchend', function(){
        paint = false;
    });


    var clickX = new Array();
    var clickY = new Array();
    var clickDrag = new Array();
    var paint;

    function addClick(x, y, dragging)
    {
        clickX.push(x);
        clickY.push(y);
        clickDrag.push(dragging);
    }


    function redraw()
    {
        context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas

        context.beginPath();
        for(var i=0; i < clickX.length; i++) {

            if (clickDrag[i] && i){
                context.moveTo(clickX[i-1], clickY[i-1]);
            } else {
                context.moveTo(clickX[i]-1, clickY[i]);
            }
            context.lineTo(clickX[i], clickY[i]);
        }
        context.closePath();
        context.stroke();
    }


    function startdrawing(){

        $('<div id="canvasDiv"></div>').insertBefore('#canvas');
        $('#canvas').remove();

        var canvasDiv = document.getElementById('canvasDiv');
        var canvas = document.createElement('canvas');
        canvas.setAttribute('width', $(document).width());
        canvas.setAttribute('height', $(document).height());
        canvas.setAttribute('id', 'canvas');
        canvasDiv.appendChild(canvas);

        if (typeof G_vmlCanvasManager != 'undefined') {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }

        return canvas;
    }

    $('.send').on('touchstart', function(){
        var canvas = document.getElementById('canvas');

        // save doodle
        var image_url = canvas.toDataURL();

        $.ajax({
            type: 'POST',
            url: 'http://cockadoodle.in/api/save_hiding',
            data: {
                data_uri: image_url,
                hidden_doodle_id: {{ $cockid }},
                drawer_id: getUrlVars()["sess_id"],
                receiver_id: getUrlVars()["user_id"],
                game_id: getUrlVars()["game_id"]
            },
            cache: false,
            dataType: 'html'
        });

        // send doodle, maybe that's done when sending to the game table?

        // display message that confirm it is sent
        $('.doneDiv .text').text('Doodle sent back to your friend.');

        setTimeout(function(){
            document.location.href = '/friends';
        },4000);

        $('.doneDiv').slideDown();
        canvas.remove();
    });

    $('.redo').on('touchstart', function(){
        var canvas = document.getElementById('canvas');
        context = canvas.getContext("2d");
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
    });

    $('.send').animate({'right':0}, 250);
    $('.redo').animate({'left':0}, 250);

    function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }


</script>

@stop