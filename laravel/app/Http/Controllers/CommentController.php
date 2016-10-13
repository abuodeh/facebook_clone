<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\Comment;
use App\Post;
use App\Http\Controllers\PostController;
use App\friendShips;
use Auth ;

class CommentController extends Controller
{
    public function getAddComment(Request $request )
	{
		if( Auth::check())
		 {
			 $comment = $request->input('comment');
			 $post_id = $request->input('post_id');
			 $id = Auth::user()->id;
			 $user_id = Post::where('id',$post_id)->value('user_id');
			 $privacy = Post::where('id',$post_id)->value('privacy');
			 $friendShip = friendShips::Where([['user_id', '=', $user_id],['friend_id', '=', $id]
												,['is_friend', '=', 1],	])->count();
			 if($user_id == $id || $privacy == 1 || $friendShip == 1){
				 Comment::insert(['comment' => $comment,  'user_id'=>$id,  'post_id'=>$post_id]);
			 }
		 }
		 return redirect('/home');
	}
	
	
}
