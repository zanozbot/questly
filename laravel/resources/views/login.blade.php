<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Login</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/loginsignup.css') }}">
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
		<div class="login">
			<h2>Log in to Questly</h2>
			<hr>
			<form action="{{ route('postLogin') }}" method="POST">
				<label>Email: <input type="email" name="email" placeholder="Email" value="{{ Request::old('email') }}" required></label>
				<label>Password: <input type="password" name="password" placeholder="Password" required></label>
				<input type="submit" value="Log in">
				<input type="hidden" name="_token" value="{{ Session::token() }}"/>
				@if(count($errors) > 0)
					@foreach($errors->all() as $error)
					<p id="constraints">{{ $error }}</p>
					@endforeach
				@endif
			</form>
			<p class="no-account">Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
		</div>
	</div>

	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>