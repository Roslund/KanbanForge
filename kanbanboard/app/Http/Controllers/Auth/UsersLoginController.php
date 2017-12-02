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
        	'email'   => 'required|email',
        	'password' => 'required|min:6'
      	]);

      	//check if admin
        $admins = Admin::all();
        foreach ($admins as $admin) {

          if($admin->email == $request->email) {
            $this->middleware('auth:admin');
            //$this->middleware('guest:admin');

            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
              return redirect('admin/categories');
            }

            //wrong password redirect
            return redirect()->back()->withInput($request->only('email', 'remember'));
          }
         
        }     	


        //check if user
        $users = User::all();
        foreach ($users as $user) {
          if($user->email == $request->email) {
            $this->middleware('auth:web');
            //$this->middleware('guest:web');

            if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
              return redirect('welcome');
            }

            //wrong password redirect
            return redirect()->back()->withInput($request->only('email', 'remember'));
          }
         
        }
      	// unsuccessful
      	return redirect()->back()->withInput($request->only('email', 'remember'));
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