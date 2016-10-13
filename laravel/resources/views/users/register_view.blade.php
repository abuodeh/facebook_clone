@extends('layouts.app')

@section('title', 'Log in')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <div id="divReqister">
		
			{!! Form::open(array('route' => 'register', 'class' => 'form')) !!}
			<h3>User Name </h3>
			<input name="name" class="inputRegister" type="text" placeholder="Please Enter your name" required>
			<h3>Email </h3>
			<input name="email" class="inputRegister" type="email" placeholder="Please Enter your Email" required>
			<h3>Password </h3>
			<input name="password" class="inputRegister" type="password"  required>
			<br/>
			<br/>
			<center>
			<input id="submitRegister"value="Register" type="submit" >
			</center>
			</form>
			
			<h4><u>
			
			</u></h4>
		</div>
@endsection