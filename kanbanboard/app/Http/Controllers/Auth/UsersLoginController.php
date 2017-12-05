<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\User;
use App\Admin;

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
        return redirect('admin/swimlanes');
      }

      if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        return redirect('admin/categories');
      }
   	
      if(Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        return redirect('welcome');
      }

    	// unsuccessful
    	return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('login');
    }
    public function logoutUser()
    {
        Auth::guard('web')->logout();
        return redirect('login');
    }
}