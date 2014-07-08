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
        {{ Form::open() }}
        {{ Form::text('username', '', ['placeholder' => 'Search for friends', 'class' => 'username_search']) }}
        {{ Form::close() }}
    </li>
    </ul>


    <br /><br /> <a href="/logout">Yeah, or logout here, or whatever you prefer...</a>

@stop

@section('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.username_search').on('submit', function(){
            $.ajax({
                type: 'POST',
                url: '/api/search',
                data: { user: $('.username_search').val() }
            }).done(function(data){
                alert('searching...');
            });
            //alert('key pressed!');
        });
    });
</script>
@stop