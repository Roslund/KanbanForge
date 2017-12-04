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

      	//check if admin
        $admins = Admin::all();
        foreach ($admins as $admin) {

          if($admin->username == $request->username) {
            $this->middleware('auth:admin');
            //$this->middleware('guest:admin');

            if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
              return redirect('admin/categories');
            }

            //wrong password redirect
            return redirect()->back()->withInput($request->only('username', 'remember'));
          }
         
        }     	


        //check if user
        $users = User::all();
        foreach ($users as $user) {
          if($user->username == $request->username) {
            $this->middleware('auth:web');
            //$this->middleware('guest:web');

            if(Auth::guard('web')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
              return redirect('welcome');
            }

            //wrong password redirect
            return redirect()->back()->withInput($request->only('username', 'remember'));
          }
         
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