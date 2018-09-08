<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Route;
class ClientLoginController extends Controller
{

	public function __construct(){
		$this->middleware('guest:client', ['except' => ['logout']]);
	}
	public function showLoginForm(){

		return view('layouts.auth');

	}
	public function login(Request $request){
		//dd(1);
		$this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      
      // Attempt to log the user in
      if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
		//dd($request->all());
	 }
	  public function logout()
    {
        Auth::guard('client')->logout();
        Auth::guard('web')->logout();

        return redirect('/');
    }

}
?>