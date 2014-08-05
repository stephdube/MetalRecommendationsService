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
	<a href="/random">Random album</a>
</div>

<div id="container">

	@yield('content')


</div><!--end container-->

@yield('script')

</body>
<footer></footer>
</html>