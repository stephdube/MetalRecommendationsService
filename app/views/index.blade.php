@extends('_master')

@section('content')
<div><a href="/search">Search for an album</a><br><br></div>

	@if(Auth::check())
		@include('bookmarklist')
	@endif

@stop