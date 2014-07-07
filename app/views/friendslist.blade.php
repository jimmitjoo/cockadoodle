@extends('master/master')

@section('title', 'Cock A Doodle')
@section('meta')
<!--<meta http-equiv="refresh" content="2;URL=/login">-->
@stop

@section('content')

    <h1>Your awesome friends</h1>

    <ul class="friends_list">
    @foreach ($friends as $f) :
    <li> {{ $f['email'] }} </li>
    @endforeach
    </ul>

    <br /><br /> <a href="/logout">Yeah, or logout here, or whatever you prefer...</a>

@stop

@section('scripts')
@stop