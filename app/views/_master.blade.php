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

<div id="container">
	<div class="header">
		<h1>Metal Ratings & Recommendations</h1>
		<div class="menu">
			<a href="/about">About</a> |
			<a href="/search">Search for an album</a> |
			<a href="/album?id=random">Random album</a> | 
			@if(Auth::check())
				<a href="/"><?=Auth::user()->username?></a>
			@endif
		</div>
	</div>

	<div id="content">
		@yield('content')
	</div>
</div><!--end container-->

<div class='loginout'>
	@include('login_prompter')
</div>

</body>
<footer></footer>
</html>