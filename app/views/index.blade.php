@extends('_master')

@section('content')

	@if(Auth::check())
		@include('bookmarklist')
		@include('ratinglist')
		{{-- if there are 'suggestions', they come next --}}
	@endif

@stop