<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Http\Requests;

use Auth ;

use Config ;

use Hash;

use App\User;

use App\friendShips;

class UserController extends Controller
{
  /**
   * Responds to requests to GET /login
   */
	  public function getIndex(Request $request){
		 if( Auth::check())
		 {
			$user_id = Auth::user()->id;										
			$friends = DB::select('SELECT users.name,users.email,users.id
									FROM users
									INNER JOIN friend_ships
									ON users.id=friend_ships.friend_id 
									and friend_ships.user_id = ?
									and friend_ships.is_friend = 1', [ Auth::user()->id]);
			
			return view('users.user_account',['friends' =>$friends]);
		 }
		 else
		 {
	    	return view('users.login_view');
		 }
   }
   
   /**
   * Responds to requests to POST /login/login
   */
	  public function postLogin(Request $request){
		$email = $request->input('email');
		$password = $request->input('password');
		if (Auth::attempt(['email' => $email, 'password' => $password]))
		{
			return redirect('/');
		}
		else
		{
			return redirect('/');
		}
		
   }
    /**
   * Responds to requests to POST /login/registerView
   */
	  public function getRegisterView(){
		  return view('users.register_view');
   }

   /**
   * Responds to requests to POST /login/register
   */
	  public function postRegister(Request $request){
		   $name = $request->input('name');
		   $email = $request->input('email');
		   $password = $request->input('password');
		   $password = Hash::make($password);
		   User::insert(
				['email' => $email,'name' => $name,'password' => $password ,'created_at' => Config::get('app.timezone')]
			);
		  return redirect('/');
   }
   
   /**
   * Responds to requests to POST /login/logout
   */
	  public function logout(Request $request){
		  Auth::logout();
		  return redirect('/');
   }
   
   
   
}
