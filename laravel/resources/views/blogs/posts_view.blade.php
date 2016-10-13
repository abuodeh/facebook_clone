@extends('layouts.app')

@section('title', 'Home Page')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <!--div  text area field -->
	
		<div id="top_div" class="div">
			{!! Form::open(array('route' => 'add_post', 'class' => 'form','files' => true,
			'onsubmit'=>'return validateForm()','name'=>'myForm')) !!}
				<h3>Enter your post :</h3>
				<textarea class= "textarea" rows="4" name="post"  ></textarea>
				<br/>
				<br/>
				<input class = "input1" type="radio" name="privacy" value="0" checked><span class = "span"> Friend </span>&nbsp; &nbsp; 
				<input class = "input1" type="radio" name="privacy" value="1"> <span class = "span">Public</span>
				<br>
				<br>
				<label class="custom-file-upload">
					<input class = "input1" id="input" type="file" name="image" />
					Choose Image ...
				</label>
				<input class="submit input1" value="Enter post" type="submit" >
			</form>
			<!--validation_errors -->
			<h4 id='error'><u>
			</u></h4>
		</div>
		<hr style="width:70%;">
		@foreach ($posts as $data_item)
			<div class="div">
				<!--post data -->
				<!--delete button -->
				@if($data_item->user_id ==  Auth::user()->id)
					
					<a class = "a" href="{{url('/deletePost/'.$data_item->id)}}">
						<h2 class="delete_button "> Delete </h2>
					</a>
					<br>
					<br>
					<br>
				@endif
				<!--/delete button -->
				<h5 class="text  time">{{$data_item->created_at}}</h5>
			    <a class = "a a1" href="{{url('/page/'.$data_item->user_id)}}">
					<h3 class="text">{{$data_item->name}}:</h3>
				</a>  
				<br><br>
				<h4 class="text">"{{$data_item->post}}"</h4>
				<br><br>
				@if($data_item->check_image == 1)
					<center>
							<img border="0" src="{{URL::asset('/images/'.$data_item->image)}}"
							style="width: 400px;height: 300px;margin-bottom: 10px;">
						</center>
				@endif
				<!--comments div -->
				<div>
					{!! Form::open(array('route' => 'add_comment', 'class' => 'form')) !!}
						<input name="comment" class="input" required type="text" >
						<input class = "input1" name="post_id" value="{{$data_item->id}}" required type="hidden" >
						<input id="comment" class="submit input1" value="Add Comment" type="submit" >
					</form>
					<br>
					<center>
					<!-- Form::open(array('route' => 'GetComments', 'class' => 'form')) !!}-->
					<!--<input name="post_id" value="{{$data_item->id}}" required type="hidden" >
					<input type="submit"  id="comment" style="padding-right:20px;padding-left:20px;margin-top:5px;width:200px" 
					class="submit"  onclick="document.getElementById('id01').style.display='block'" value="Get Comment">
					-->
					<a  href="#" postId="{{$data_item->id}}" class="getComment a" > Get Comments </a>
					<!--</form>-->
					<center>
					
				</div>	
			</div>
						
		@endforeach
    <div class="modal fade container" data-backdrop="static" data-keyboard="false" id="assignedToModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="form-group" id="comments">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="remove()"; class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
		
@endsection
