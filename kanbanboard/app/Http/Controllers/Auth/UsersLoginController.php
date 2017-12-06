<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\User;

class UsersLoginController extends Controller
{
    public function showLoginForm()
    {
      return view('login');
    }

    public function login(Request $request)
    {
      
    	$this->validate($request, [
        	'username'   => 'required',
        	'password' => 'required|min:5'
      	]);

      
      if(Auth::guard('teamforge')->attempt([$request], false, true)){
        return redirect('welcome');
      }
   	
      if(Auth::guard('web')->attempt([$request], $request->remember)) {
        return redirect('welcome');
      }

    	// unsuccessful
    	return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout(){
        Auth::guard('teamforge')->logout();
        Auth::logout();
        return redirect('login');
    }
}