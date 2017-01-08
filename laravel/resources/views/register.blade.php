<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Register</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/loginsignup.css') }}">
	<script type="text/javascript" src="js/validate.js"></script>
</head>
<body>
	<header>
		<a href="{{ route('index') }}" class="title"><span>Questly | <span class="blue">Response and Reply</span></span></a>
		<nav>
			<ul>
				<li><a href="{{ route('new') }}" class="link"><span>Ask a question</span></a></li>
			</ul>
		</nav>
	</header>
	<header class="mobile-header">
		<ul>
			<li><a href="{{ route('new') }}" class="link"><span>Ask a question</span></a></li>
		</ul>
	</header>

	<div class="container">
		@if(count($errors) > 0)
		<div>
			<ul>
				@foreach($errors->all as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="signup">
			<h2>Create your Questly account.</h2>
			<hr>
			<form action="{{ route('postSignup') }}" method="POST" id="register">
				<label>Username: <input type="text" name="username" placeholder="Username" autocomplete="off" value="{{ Request::old('username') }}" required></label>
				<label>Email: <input type="email" name="email" placeholder="Email" autocomplete="off" value="{{ Request::old('email') }}" required></label>
				<!-- Pattern copied from http://stackoverflow.com/questions/27976446/html-password-regular-expression-validation -->
				<label>Password: <input id="password1" type="password" name="password1" title="Password must be at least 8 characters long and contain 1 uppercase, 1 number and a special symbol !@#$%^&amp;*_=+-" placeholder="Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,}$"></label>

				<p id="constraints">Password must be at least 8 characters long and contain 1 uppercase, 1 number and a special symbol !@#$%^&amp;*_=+-</p>

				<label><span id="status"></span>Password: <input id="password2" type="password" name="password2" placeholder="Retype password" required></label>

				<input type="submit" value="Sign up">
				<input type="hidden" name="_token" value="{{ Session::token() }}"/>
			</form>
			<p class="no-account">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
		</div>
	</div>

	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>