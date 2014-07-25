@extends('_master')

@section('content')

<h1>Sign up</h1>

{{ Form::open(array('url' => '/signup')) }}

    Username<br>
    {{ Form::text('username') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

<p>Already a member? <a href="login">Sign in here</a></p>

@stop