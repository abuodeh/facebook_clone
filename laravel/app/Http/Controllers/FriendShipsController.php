<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\friendShips;

use App\User;

use Auth ;

use Illuminate\Support\Facades\DB;

use App\post;


class FriendShipsController extends Controller
{
   public function getFriendInfo($friend_id)
   {
	    $user = User::where('id', $friend_id)->select('name', 'email','id')->first(); // user information
		$friend_ship = "";
	    if( Auth::check())
		{
			$user_id = Auth::user()->id;
			if ($user_id != $friend_id)
			{
				$isFriend = friendShips::where([['user_id', '=', $user_id],['friend_id', '=', $friend_id],	])
										->value('is_friend');
				if($isFriend == 1)
				{
					$posts = post::where('user_id', $friend_id)->get();
					$friend_ship = "Unfriend";
				}
				else{
					//check if there friend request or not 
					$isFriend = friendShips::where([['user_id', '=', $user_id],['friend_id', '=', $friend_id],
													['is_friend', '=', 0],	])->count();
					if($isFriend == 0){
						$friend_ship = "Add Friend";
					}
					else{
						$friend_ship = "Cancel";
					}
					$isFriend = friendShips::where([['user_id', '=', $friend_id],['friend_id', '=', $user_id],
					['is_friend', '=', 0],	])->count();
					if($isFriend == 1){
						$friend_ship = "Confirm";
					}
					$posts = post::where([['user_id', '=', $friend_id],['privacy', '=', '1'],	])->get();
				}
			}
			else{
				$posts = post::where('user_id', $friend_id)->get();
			}
		}
		else
		{
			$posts = post::where([['user_id', '=', $friend_id],['privacy', '=', '1'],	])->get();
		}
		return view('users.user_page', ['user' => $user ,'posts' => $posts ,'friend_ship' => $friend_ship , ]);
   }
   
   public function getUpdateFriendRequiest($friend_id)
   {
	    if( Auth::check())
		{
		   $user_id = Auth::user()->id;
		   $check_cancel = friendShips::Where([['user_id', '=', $user_id],['friend_id', '=', $friend_id]
												,['is_friend', '=', 0],	])->count();
		   $check_confirm = friendShips::Where([['user_id', '=', $friend_id],['friend_id', '=', $user_id]	
												,['is_friend', '=', 0],	])->count();
		   $check_unfriend = friendShips::Where([['user_id', '=', $friend_id],['friend_id', '=', $user_id]	
												,['is_friend', '=', 1],	])->count();
			
		    if($check_cancel == 1){
					friendShips::where([['user_id', '=', $user_id],['friend_id', '=', $friend_id],	])->delete();
			}	
			else if($check_confirm == 1){
					friendShips::insert(['user_id' => $user_id, 'friend_id' => $friend_id, 'is_friend' => 1]);
					friendShips::where([['user_id', '=', $friend_id],['friend_id', '=', $user_id],	])->update(['is_friend' => 1]);
			}
			else if($check_unfriend == 1){
					friendShips::where([['user_id', '=', $user_id],['friend_id', '=', $friend_id],	])->delete();
					friendShips::where([['user_id', '=', $friend_id],['friend_id', '=', $user_id],	])->delete();
			}
			else{
				friendShips::insert(['user_id' => $user_id, 'friend_id' => $friend_id, 'is_friend' => 0]);
			}		
		}
	   return redirect('/page/'.$friend_id);
		   
   }
   

   public function getUserFriendRequiest(){
	   $user_id = Auth::user()->id;
	   $friends = DB::select('SELECT users.name,users.email,users.id
									FROM users
									INNER JOIN friend_ships
									ON users.id=friend_ships.user_id 
									and friend_ships.is_friend = 0
									and friend_ships.friend_id  = ?',[$user_id]);
			
			return view('users.friend_request',['friends' =>$friends]);
   }
   
}
