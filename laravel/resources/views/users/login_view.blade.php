@extends('layouts.app')

@section('title', 'Log in')

@section('sidebar')
    @parent

   
@endsection

@section('content')
    <div id="divLogin">
			{!! Form::open(array('route' => 'login', 'class' => 'form')) !!}
			
			<h3>Email </h3>
			<input name="email" class="inputLogin" type="email" placeholder="Please Enter your Email" required>
			<h3>Password </h3>
			<input name="password" class="inputLogin" type="password" required>
			<br/>
			<br/>
			<center>
				<input id="submitLogin"value="Login" type="submit" >
			</center>
			<br>
			</form>
			{!! Form::open(array('route' => 'register_view', 'class' => 'form')) !!}
			
			<center>
				<input id="submitLogin"value="Sign Up" type="submit" >
			</center>
			</form>
			<h4><u>
			
			</u></h4>
		</div>
@endsection