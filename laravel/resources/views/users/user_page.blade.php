@extends('layouts.app')

@section('title', 'User page')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <!--div information and text area field -->
		<div id="top_div" class="div">
			<h3>User name : {{$user->name}} </h3>
			<h3>Email : {{$user->email}}</h3>
			@if($friend_ship != "")
			  <a href="{{url('/friend_ship/'.$user->id)}}"><h3 style="color:white;"> {{$friend_ship}}</h3> </a> 
			@endif
		</div>
		<hr style="width:70%;">
		@foreach ($posts as $data_item)
			<div class="div">
				<!--post data -->
				<h5 class="text  time">{{$data_item->created_at}}</h5>
				<h2 class="text "> {{$user->name}}  :</h2>
				<br><br>
				<h4 class="text">"{{$data_item->post}}"</h4>
				<br><br>
				@if($data_item->check_image == 1)
					<center>
							<img border="0" src="{{URL::asset('/images/'.$data_item->image)}}"
							style="width: 400px;height: 300px;margin-bottom: 10px;">
						</center>
				@endif
				
			</div>
		@endforeach
@endsection