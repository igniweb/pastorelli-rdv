<?php namespace App\Http\Controllers;

class AuthController extends Controller {

	public function signIn()
	{
		$this->middleware('guest');

		return view('auth.sign_in');
	}

}
