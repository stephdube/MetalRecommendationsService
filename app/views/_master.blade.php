<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Metal Recommendations')</title>
	<link rel="stylesheet" href="p4style.css" type="text/css">
</head>

<body>
@if(Session::get('flash_message'))
        <div class='flash-message'>{{ Session::get('flash_message') }}, {{ Auth::user()->username; }}!</div>
@endif

<div id="container">
	@yield('content')
</div>

	@yield('script')


</div>

</body>
<footer></footer>
</html>