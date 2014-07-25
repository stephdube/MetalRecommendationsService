@extends('_master')

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}

    Username<br>
    {{ Form::text('username') }}<br><br>

    Password:<br>
    {{ Form::password('password') }}<br><br>

    {{ Form::submit('Submit') }}

{{ Form::close() }}

<p>Don't have an account yet? <a href="signup">Create one here</a></p>

@stop