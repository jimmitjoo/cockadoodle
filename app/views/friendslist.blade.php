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

<div class="doneDiv">
    <span class="text"></span>
</div>

<ul class="friends_list">
    <li class="add_friends">
        <span class="original">Friends..</span>
        <div class="open">
            <input class="searchfield" placeholder="search" type="text"/>
            <!--<button>
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
            </button>-->
        </div>

    </li>
    <li class="results" style="display: none"></li>
    <li class="play_random"><span>Random..</span></li>

    @foreach ($mygames as $g)

        <?php
        if ($g->game->status == 1 && $g->drawer->id == Auth::id()) :
            $cock_class = 'cock_sent';
            $username = $g->receiver->username;

        elseif ($g->game->status == 2 && $g->drawer->id == Auth::id()) :
            $cock_class = 'cock_hidden_need_grade';
            $username = $g->receiver->username;

        elseif ($g->game->status == 3 && $g->drawer->id == Auth::id()) :
            $cock_class = 'cock_grade_sent_wait_for_new';
            $username = $g->receiver->username;

        elseif ($g->game->status == 1 && $g->receiver->id == Auth::id()) :
            $cock_class = 'cock_received';
            $username = $g->drawer->username;

        elseif ($g->game->status == 2 && $g->receiver->id == Auth::id()) :
            $cock_class = 'cock_waiting_for_grade';
            $username = $g->drawer->username;

        elseif ($g->game->status == 3 && $g->receiver->id == Auth::id()) :
            $cock_class = 'cock_graded';
            $username = $g->drawer->username;

        else :
            echo $g->game->status;
            $cock_class = 'cock_base';
        endif;
        ?>

        <li class="{{ $cock_class }}" data-sessid="{{ Auth::id() }}" data-userid="{{ $g->drawer->id }}" data-gameid="{{ $g->game_id }}"><span>{{ $username }}</span></li>
    @endforeach
</ul>


@stop

@section('scripts')

<script src="/js/jquery.js"></script>
<script src="/js/touchswipe.js"></script>

<script>
$(function(){


    $('.original').on('touchstart', function(e){
        $that = $('.add_friends');
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

    var user_id = false;
    var sess_id = false;
    var game_id = false;

    function animate_friendslist(t) {
        t.animate({'right': '-100%'}, 250);
        t.siblings('li').animate({'left': '-100%'}, 500);
        $('.sticky_headline').animate({'top': '-70px'}, 500);

        user_id = t.data('userid');
        sess_id = t.data('sessid');
    }

    var addSwipeToList = function(){

        $('.friends_list').trigger('click');

        $('.friends_list .cock_received').swipe({
            tap: function(){
                user_id = $(this).data('userid');
                sess_id = $(this).data('sessid');
                game_id = $(this).data('gameid');
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            },
            swipeRight: function() {
                var t = $(this);
                if (t.hasClass('active')) {
                    animate_friendslist(t);

                    document.location.href = '/hidingboard?user_id=' + user_id + '&sess_id=' + sess_id + '&game_id=' + game_id;

                    setTimeout(function(){
                        $('.menu li').css({'z-index': 11});
                        $('.send').animate({'right':0}, 250);
                        $('.redo').animate({'left':0}, 250);
                    }, 550);
                }
            }
        })

        $('.friends_list .cock_base, .res-item').swipe({
            tap: function(){
                user_id = $(this).data('userid');
                sess_id = $(this).data('sessid');
                $(this).siblings().removeClass('active');
                $(this).addClass('active');
            },
            swipeRight: function(e, dir, dis, dur, fc) {

                var t = $(this);
                if (t.hasClass('active')) {

                    animate_friendslist(t);

                    $.ajax({

                        type: 'GET',
                        url: 'http://cockadoodle.in/api/create_game',
                        data: { user_id: user_id, sess_id: sess_id },
                        cache: false,
                        dataType: 'json'

                    }).success(function(data){

                        game_id = data.id;
                        document.location.href = '/drawingboard?user_id=' + user_id + '&sess_id=' + sess_id + '&game_id=' + game_id;

                        $('#canvas').css({'z-index': 10});
                        setTimeout(function(){
                            $('.friends_list').hide();
                        }, 500);
                    }).error(function(){
                        alert('game not created');
                    });

                    setTimeout(function(){
                        $('.menu li').css({'z-index': 11});
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


    $('.play_random').on('touchstart', function(){
        alert('4 - Number picked by JAM, guaranteed to be random.');
    });

    addSwipeToList();

});

</script>

@stop