<div class='loginout'>
	@if(Auth::check())
		<div class="logout">
			<a href='/logout'><button>Log out {{ Auth::user()->username; }}</button></a>
	    </div>
	@else 
		<div class="login_prompt">
			<a href='/login'><button>Log in</button></a>
			<i>Don't have an account?
				<a href='/signup'>Sign up</a>
			</i>
		</div>
	@endif
</div><!--end login/logout-->