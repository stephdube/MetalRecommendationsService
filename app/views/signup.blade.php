@extends('_master')

@section('content')

<h1>Sign up</h1>

	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach

{{ Form::open(array('url' => '/signup')) }}

    Username<br>
    {{ Form::text('username') }}<br><br>
    
    Email<br>
    {{ Form::text('email') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

<p>Already a member? <a href="login">Sign in here</a></p>

@stop