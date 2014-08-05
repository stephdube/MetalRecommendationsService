@extends('_master')

@section('content')

	@include('login_prompter')

	@if(Auth::check())
		@include('bookmarklist')
		@include('ratinglist')
	@endif

@stop