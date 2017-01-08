<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | New Response and Reply</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/new.css') }}">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
	<header>
		<a href="{{ route('index') }}" class="title"><span>Questly | <span class="blue">Response and Reply</span></span></a>
		<nav>
			<ul>
				@if(!Auth::check())
				<li><a href="{{ route('login') }}" class="link"><span>Log in</span></a></li>
				<li><a href="{{ route('register') }}" class="link"><span>Sign up</span></a></li>
				@else
				<li><a href="{{ route('user', Auth::user()->uid) }}" class="link"><span>Welcome, {{ Auth::user()->username }}</span></a></li>
				<li><a href="{{ route('logout') }}" class="link"><span>Log out</span></a></li>
				@endif
			</ul>
		</nav>
	</header>
	<header class="mobile-header">
		@if(!Auth::check())
		<a href="{{ route('login') }}" class="link"><span>Login</span></a>
		<a href="{{ route('register') }}" class="link"><span>Sign up</span></a>
		@else
		<a href="{{ route('user', Auth::user()->uid) }}" class="link"><span>Welcome, {{ Auth::user()->username }}</span></a>
		<a href="{{ route('logout') }}" class="link"><span>Log out</span></a>
		@endif
	</header>

	<div class="container">
		<div class="new-question">
			<h2>New Question</h2>
			<hr>
			<form action="{{ route('createNewQuestion') }}" method="POST">
				<label>Title: <input type="text" name="title" placeholder="What's your question?. Be specific." autocomplete="off" maxlength="200" required></label>
				<div class="addons">
					<span id="link">link</span>
					<span id="code">code</span>
				</div>
				<textarea id="area" name="question" required></textarea>
				<input type="submit" value="Post your question">
				<input type="hidden" name="_token" value="{{ Session::token() }}"/>
			</form>
			<h2>Question Preview</h2>
			<hr>
			<div id="preview">

			</div>
		</div>
	</div>

	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>