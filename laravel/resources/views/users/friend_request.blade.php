@extends('layouts.app')

@section('title', 'Friend request')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <div class="div">
		@if($friends != null)
			<ul>
				@foreach ($friends as $friend)
					<li> <a href="{{url('/page/'.$friend->id)}}"><h3> {{$friend->name}}</h3> </a> </li>
				@endforeach
			</ul>
		@else
			<h3>No friend request found</h3>
		@endif
		</div>
@endsection