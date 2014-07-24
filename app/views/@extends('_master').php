@extends('_master')

@section('content')


<form method="POST" action="/search">
Title: <input type="text" name="album_name">
<input type="checkbox" name="exact_album_title">Exact match?<br>
Band: <input type="text" name="band_name">
<input type="checkbox" name="exact_band_name">Exact match?<br>
Genre: <input type="text" name="genre">
<input type="checkbox" name="exact_genre">Exact match?<br>
Label: <input type="text" name="label">
<input type="checkbox" name="no_label">None<br>

<select name="lab">
	<option value="freeform"></option>
	<option value="indie">N/A</option>
</select>


Order results by: <ul>
	<li>Average rating <input type="radio" name="order_by" value="avg_rating"></li>
	<li>Number of ratings<input type="radio" name="order_by" value="review_count"></li>
	<li>Alphabetically by album title <input type="radio" name="order_by" value="album_title"></li>
	<li>Alphabetically by band name <input type="radio" name="order_by" value="band_name"></li>
	<br>
<input type="submit" value="Search"></br>
</form>


@stop