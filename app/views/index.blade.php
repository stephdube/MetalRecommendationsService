@extends('_master')

@section('content')
<div><a href="/search">Search for an album</a><br><br></div>

<div class='loginout'>
@if(Auth::check())
    <a href='/logout'><button>Log out {{ Auth::user()->username; }}</button></a>
@else 
    <a href='/login'><button>Log in</button></a><br>
	<i>Don't have an account? <a href='/signup'>Sign up</a>
@endif

@stop