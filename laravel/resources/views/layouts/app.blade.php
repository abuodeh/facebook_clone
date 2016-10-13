<html>
    <head>
        <title>Facebook</title>
		
		
		
		<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/posts.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/login.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/register.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/menu.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('/css/commentPopUp.css') }}">
		
		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="{!! asset('js/js.js') !!}"></script>
	</head>
	
    <body>
        @section('sidebar')
			@if(Auth::check())
			   <ul id = "ul" >
				  <li class="li"><a  href="{{ url('/home') }}">Home page</a></li>
				  <li class="li"><a href="{{ url('/userAccount') }}">User Account</a></li>
				  <li class="li"><a href="{{ url('/friendRequest') }}">Friend request</a></li>
				  <li class="li" ><a href="#about">About</a></li>
				  <li class="li" style="float:right"><a href="{{ url('/logout') }}">Log out</a></li>
			  </ul>
			  <br>
			  <br>
			  <br>
			@endif
        @show

        <div >
            @yield('content')
        </div>
		
		<footer >
		<br>
		<br>
			<center>
				<h4>© all rights reserved to ...</h4>
			</center>
		</footer>
    </body>
</html>