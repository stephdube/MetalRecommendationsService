<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Metal Recommendations')</title>
	<link rel="stylesheet" href="metal_style.css" type="text/css">
</head>

<body>
@if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}</div>
@endif

<div class="menu">
	<a href="/">Home</a> |
	<a href="/search">Search for an album</a> |
<?php
	$albums = DB::table('albums')
		->select('album_id')->get();
?>
	<a href="/album?id=<?=$albums[rand(1, sizeof($albums)-1)]->album_id
	;?>">Random album</a>
</div>

<div id="container">

	@yield('content')


</div><!--end container-->

@yield('script')

</body>
<footer></footer>
</html>