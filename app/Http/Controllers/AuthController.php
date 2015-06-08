<?php namespace App\Http\Controllers;

use Auth;

class AuthController extends Controller {

	public function signIn()
	{
		return view('auth.sign_in');
	}

	public function signOut()
	{
		$this->middleware('auth');

		Auth::logout();

		return redirect()->route('auth.sign_in');
	}

}
