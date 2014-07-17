@extends('master/master')

@section('title', 'Friendslist of Cock-A-Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('content')

<div class="background_text">Draw<br/>Cock <br/>Here</div>

<div class="sticky_headline">
    Username
</div>

<div id="canvasDiv"></div>

<ul class="menu">
    <li class="redo">Redo</li>
    <li class="send">Send</li>
</ul>

<ul class="friends_list">
    <li class="add_friends">
        <span class="original">Friends..</span>
        <div class="open">
            <input class="searchfield" placeholder="search" type="text"/>
            <button>
                Contacts
                        <span class="box">
                            <span class="fa fa-user"></span>
                        </span>
            </button>
            <button class="facebook">
                Friends
                        <span class="box">
                            <span class="fa fa-facebook"></span>
                        </span>
            </button>
        </div>

    </li>
    <li class="results" style="display: none"></li>
    <li class="play_random"><span>Random..</span></li>
    <!--
    <li class="cock_hidden_need_grade"><span>Friend 1</span></li>
    <li class="cock_graded"><span>Friend 2</span></li>
    <li class="cock_received"><span>Friend 3</span></li>
    <li class="cock_sent"><span>Friend 4</span></li>
    <li class="cock_received"><span>Friend 5</span></li>
    <li class="cock_hidden_need_grade"><span>Friend 1</span></li>
    <li class="cock_graded"><span>Friend 2</span></li>
    <li class="cock_received"><span>Friend 3</span></li>
    <li class="cock_sent"><span>Friend 4</span></li>
    <li class="cock_received"><span>Friend 5</span></li>
    -->
</ul>


<script src="cordova.js"></script>


@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/touchswipe.js"></script>
<script src="js/cockadoodle.js"></script>
<script src="js/index.js"></script>

<script>
$(function(){

    $('.original').on('touchstart', function(e){
        $that = $('.add_friends')
        $this = $(this);

        if ($that.height() < 250) {
            $that.animate({height: '280px'}, 250);
            $('.open').show();
        } else {
            $that.animate({height: '70px'}, 250);
            setTimeout(function(){
                $('.open').hide();
            },225);
        }
    });

    var addSwipeToList = function(){

        var user_id = false;
        var sess_id = false;

        $('.friends_list').trigger('click');

        $('.friends_list [class^="cock_"], .res-item').swipe({
            tap: function(){
                user_id = $(this).data('userid');
                sess_id = $(this).data('sessid');
                $('.friends_list [class^="cock_"], .res-item').removeClass('active');
                $(this).addClass('active');
            },
            swipeLeft: function(e, dir, dis, dur, fc) {

                alert('Ask for cock');

                /*if ((!$(this).hasClass('cock_sent') && !$(this).hasClass('cock_hidden_need_grade')) && $(this).hasClass('active')) {
                 $(this).animate({'left': '-100%'}, 250);
                 $(this).siblings('li').animate({'right': '-100%'}, 500);
                 $('.sticky_headline').animate({'top': '-70px'}, 500);

                 setTimeout(function(){
                 $('.send').animate({'right':0}, 250);
                 $('.redo').animate({'left':0}, 250);
                 }, 550);
                 }*/

            },
            swipeRight: function(e, dir, dis, dur, fc) {
                if ((!$(this).hasClass('cock_sent') && !$(this).hasClass('cock_hidden_need_grade')) && $(this).hasClass('active')) {

                    $(this).animate({'right': '-100%'}, 250);
                    $(this).siblings('li').animate({'left': '-100%'}, 500);
                    $('.sticky_headline').animate({'top': '-70px'}, 500);

                    user_id = $(this).data('userid');
                    sess_id = $(this).data('sessid');

                    $.ajax({

                        type: 'GET',
                        url: 'http://cockadoodle.in/api/create_game',
                        data: { user_id: user_id, sess_id: sess_id },
                        cache: false,
                        dataType: 'json'

                    }).success(function(data){
                        alert('game id: ' + data.id);
                    }).error(function(){
                        alert('game not created');
                    });

                    setTimeout(function(){
                        $('.send').animate({'right':0}, 250);
                        $('.redo').animate({'left':0}, 250);
                    }, 550);

                }
            }
        });
    }



    $('.searchfield').on('focus', function(){
        $('.add_friends').animate({height: '140px'}, 300);
        $('.add_friends button').hide();
    }).on('focusout', function(){
        $('.add_friends').animate({height: '281px'}, 300);
        $('.add_friends button').show();
    });


    $('.searchfield').on('keyup', function(e){

        $('.res-item').remove();
        var query = $(this).val();

        if (query.length > 1) {
            $.ajax({

                type: 'GET',
                url: 'http://cockadoodle.in/api/search',
                data: {query: query},
                cache: false,
                dataType: 'html'

            }).success(function(data){

                $('.res-item').remove();
                setTimeout(function(){
                    $( data ).insertBefore( ".results" );
                    setTimeout(addSwipeToList, 200);
                },200);

            }).error(function(data){
                alert(data.length);
            });
        }

    });


    var bodyHeight = ($('body').height() - 250) / 2;
    $('.background_text').css({'margin-top': (bodyHeight - 25) + 'px'});


    var canvas = startdrawing();

    var context = canvas.getContext("2d");
    context.strokeStyle = "#777777";
    context.lineJoin = "round";
    context.lineWidth = 3;

    var startedDrawing = false;
    $('#canvas').on('touchstart', function(e){
        $('.background_text').fadeOut();

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
        if(typeof G_vmlCanvasManager != 'undefined') {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }

        return canvas;

    }


    $('.play_random').on('touchstart', function(){
        alert('4 - Number picked by JAM, guaranteed to be random.');
    });

    $('.redo').on('touchstart', function(){
        var canvas = document.getElementById('canvas');
        context = canvas.getContext("2d");
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();
    });

});
</script>

@stop