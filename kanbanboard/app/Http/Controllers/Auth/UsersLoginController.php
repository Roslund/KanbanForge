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

            //Check if credentials match teamforge credentials
      $url = 'https://teamforge.srv247.se/oauth/auth/token';
      $data = array(
        'grant_type' => 'password',
        'client_id' => 'api-client',
        'scope' => 'urn:ctf:services:ctf',
        'username' => $request->username,
        'password' => $request->password
      );

      $options = array(
          'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data),
          ),
          'ssl' => array(
              'verify_peer' => false,
              'verify_peer_name'=>false,
          )
      );
      $context  = stream_context_create($options);
      try {
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) { 
          \Log::warning('Authentication with teamforge failed Failed');
        }
        else
        {
          \Log::info('TeamForge Credentials are vaild');

          //Check the user is an admin
          $admins = Admin::all();
          foreach ($admins as $admin) {
            if($admin->username == $request->username) {
              Auth::guard('admin')->loginUsingId($admin->id, true);
              return redirect('admin/categories');
            }
          }

          //Check if the user is a user
          $users = User::all();
          foreach ($users as $user) {
            if($user->username == $request->username) {
              Auth::guard('web')->loginUsingId($user->id, true);
            }
          }

          // If we have no username match in our local database we are just going to login as the first user in the ursers table
          Auth::guard('web')->loginUsingId(1, true);
          return redirect('welcome');
        }
      } catch (\Exception $e) {
        \Log::error('Caught an exception... probbably 400 because invalid teamforge credentials');// + $e->getMessage());
      }

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