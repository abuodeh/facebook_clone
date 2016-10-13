@extends('layouts.app')

@section('title', 'User Account')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <!--div information and text area field -->
		<div id="top_div" class="div">
			<h3>User name :
				 <a href="{{url('/page/'.Auth::user()->id)}}">
					{{Auth::user()->name}} 
				</a>
			</h3>
			<h3>Email : {{Auth::user()->email}}</h3>
			
			<hr style="width:50%;">
		</div>
		<div class="div">
			<ul>
				@foreach ($friends as $friend)
					<li> <a href="{{url('/page/'.$friend->id)}}"><h3> {{$friend->name}}</h3> </a> </li>
				@endforeach
			</ul>
		</div>
@endsection