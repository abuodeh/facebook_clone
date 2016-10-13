<html>
	<head>
		<style>
			#ul {
				list-style-type: none;
				margin: 0;
				padding: 0;
				overflow: hidden;
				background-color: #333;
			}

			.li {
				float: left;
				margin-right:5px;
				margin-left:5px;
			}

			.li a {
				display: block;
				color: white;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
			}

			.li a:hover:not(.active) {
				background-color: #969edc;
				border-radius:10px 10px;
			}

			.active {
				background-color: #969edc;
				border-radius:10px 10px;
			}
			#ul{
				border-radius:0px 20px;
				border: 3px solid rgb(179, 176, 230);
				border-left-width: 0px;
				border-top-width: 0px;
			}
		</style>
	</head>
	<body>

		<ul id = "ul">
			  <li class="li"><a  href="{{ url('/home') }}">Home page</a></li>
			  <li class="li"><a href="{{ url('/userAccount') }}">User Account</a></li>
			  <li class="li"><a href="{{ url('/friendRequest') }}">Friend request</a></li>
			  <li class="li" ><a href="#about">About</a></li>
			  <li class="li" style="float:right"><a href="{{ url('/logout') }}">Log out</a></li>
			  
		</ul>

	</body>
</html>

