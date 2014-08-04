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

<div class='loginout'>
	@if(Auth::check())
	    <a href='/logout'><button>Log out {{ Auth::user()->username; }}</button></a>
	@else 
	    <a href='/login'><button>Log in</button></a>
		<i>Don't have an account? <a href='/signup'>Sign up</a></i>
	@endif
</div><!--end login/logout-->

<div class="home">
	<a href="/">Home</a>
</div>

<div id="container">

	@yield('content')


</div><!--end container-->

@yield('script')

</body>
<footer></footer>
</html>