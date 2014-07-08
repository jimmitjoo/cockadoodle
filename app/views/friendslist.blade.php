@extends('master/master')

@section('title', 'Friendslist of Cock-A-Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('content')

    <h1>Your awesome friends</h1>

    <ul class="friends_list">
    @foreach ($friends as $f)
    <li> {{ $f['email'] }} </li>
    @endforeach
    <li>
        <input type="text" name="username" class="username_search" placeholder="Search for friends">
    </li>
    <li class="result"></li>
    </ul>


    <br /><br /> <a href="/logout">Yeah, or logout here, or whatever you prefer...</a>

@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.username_search').on('keyup', function(){
            $.ajax({
                type: 'GET',
                url: '/api/search',
                data: { username: $('.username_search').val() },
                dataType: 'html',
                success: function(data){
                    $('.result').replaceWith(data);
                },
                error: function(data) {
                    alert('error');
                }
            });
        });
    });
</script>
@stop