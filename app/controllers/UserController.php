<?php

class UserController extends BaseController {

	public function __construct() {
        $this->beforeFilter('guest', 
        	array('only' => array('getLogin','getSignup')));	
    }

	public function getSignup() {

		return View::make('signup');

	}

	public function postSignup() {

		# Step 1) Define the rules			
		$rules = array(
			'username' => 'required|alpha_num|unique:users,username',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:7|alpha_num'	
		);			

		# Step 2) 		
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

		$user = new User;
		$user->username = Input::get('username');
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));

		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}

		# Log in
		Auth::login($user);

		return Redirect::to('/')->with('flash_message', 'Welcome!');

	}

	public function getLogin() {

		return View::make('login');

	}

	public function postLogin() {

		$credentials = Input::only('username', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome back, '.Input::get('username') . '!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
	}

	public function getLogout() {

		# Log out
		Auth::logout();

		# Send them to the homepage
		return Redirect::to('/');

	}

}
