<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\Post;
use App\friendShips;

use Auth ;


class PostController extends Controller
{
    /**
   * Responds to requests to GET /
   */
	  public function getIndex(Request $request){
		 if( Auth::check())
		 {
			$posts = $this->getPosts();
			$comments = null;
			return view('blogs.posts_view',['posts' =>$posts,'comments' =>$comments]);
		 }
		 else
		 {
	    	return view('users.login_view');
		 }
   }
   
   /**
   * Responds to requests to POST /home
   */
	  public function postAddPost(Request $request){
		   $post = $request->input('post');
		   $privacy = $request->input('privacy');
		   $image = $request->file('image');
		   $check = $image;
		   if ($check == '')
		   {
			   $check_image = 0;
			   $image_name = '';
		   }
		   else
		   {
				$check_image = 1;
				$image_name = time()."-".$image->getClientOriginalName();
				$image->move('images', $image_name);			   
		   }
		   $id = Auth::user()->id;
		   Post::insert(
				['post' => $post, 'privacy' => $privacy, 'image' => $image_name,'check_image'=>$check_image, 'user_id'=>$id]
			);
		  return redirect('/home');
   }
   
   public function  getPosts(){
	    if( Auth::check())
		 {
			 $user_id = Auth::user()->id;
			 $posts = DB::select('SELECT posts.post,posts.check_image,posts.image,posts.id,posts.created_at,posts.privacy,users.name , posts.user_id
								FROM users INNER JOIN posts ON posts.user_id = users.id INNER JOIN friend_ships
								ON friend_ships.friend_id = posts.user_id
								where
								((posts.privacy = 1 and posts.user_id != ?)
								  or
								 (posts.privacy = 0 and friend_ships.friend_id = posts.user_id    AND friend_ships.user_id = ? 
								 AND is_friend = 1)
								)
							 UNION
								 SELECT posts.post,posts.check_image,posts.image,posts.id,posts.created_at,posts.privacy,users.name , posts.user_id
								FROM users INNER JOIN posts ON posts.user_id = users.id where posts.user_id = ?
								ORDER BY `created_at` DESC',[$user_id,$user_id,$user_id]);
			return $posts;
		 }
   }
   
   public function getComments($post_id)
	{
		$comments = null;
		if( Auth::check())
		{
			 $id = Auth::user()->id;
			 $user_id = Post::where('id',$post_id)->value('user_id');
			 $friendShip = friendShips::Where([['user_id', '=', $user_id],['friend_id', '=', $id]
			 								,['is_friend', '=', 1],	])->count();
			 $privacy = Post::where('id',$post_id)->value('privacy');	
			 if($user_id == $id || $privacy == 1 || $friendShip == 1){
				$comments = DB::select('SELECT comments.comment,comments.created_at,users.name 
										FROM users INNER JOIN comments 
										ON comments.user_id = users.id 
										where comments.post_id = ?',[$post_id]);
			 }
		}
		else {
			$privacy = Post::where('id',$post_id)->value('privacy');
			if($privacy == 1)
			{
				$comments = DB::select('SELECT comments.comment,comments.created_at,users.name 
										FROM users INNER JOIN comments 
										ON comments.user_id = users.id 
										where comments.post_id = ?',[$post_id]);
			}
		}
		
		//return view('blogs.posts_view',['posts' =>$posts],['comments',$comments]);
		
		$allComments = array();
		$commentInfo = array();
		$count = 0;
		$response["allComments"] = array();
		$commentInfo = array();
		if($comments != null){
			
			foreach ($comments as $row) {
				$commentInfo = array();
				$name = $row->name;
				$created_at = $row->created_at;
				$comment = $row->comment;
				$commentInfo['comment'] = $comment;
				$commentInfo['name'] = $name;
				$commentInfo['created_at'] = $created_at;
				$allComments[$count++] = $commentInfo;
				array_push($response["allComments"], $commentInfo);
			}
		}
		echo json_encode($response);
		return;
	}
   
   public function getDeletePost($id)
   {
	   $UserId = Post::Where('id',$id)->value('user_id');
	   if($UserId ==  Auth::user()->id)
	   {
		   Post::where('id',$id)->delete();
	   }
	   return redirect('/home');
   }
   
}
