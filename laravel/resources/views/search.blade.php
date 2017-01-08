<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Response and Reply</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/search.css') }}">
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
				<li><a href="{{ route('new') }}" class="link"><span>Ask a question</span></a></li>
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
		<a href="{{ route('new') }}" class="link"><span>Ask a question</span></a>
	</header>

	<!-- START: Search -->
	<div class="search-header">
		<div class="query-box">
			<form action="{{ route('search') }}" method="GET">
				<input class="search-input" type="text" name="query" placeholder="Search..." autocomplete="off" maxlength="200" required>
				<button type="submit" class="search-submit">Search</button>
			</form>
		</div>
	</div>
	<!-- END: Search -->

	<div class="container">
		<div class="results">
			@if(count($questions) > 0)
			<h2>Results for: <em>{{ $query }}</em></h2>
			@else
			<h2>No results for: <em>{{ $query }}</em></h2>
			@endif
			<hr>
			@foreach($questions as $question)
			<div class="question">
				<div class=counters>
					<div class="sub-counter">
						<div class="number">
							<span>{{ $question->votes }}</span>
							<div>votes</div>
						</div>
					</div>
					<div class="sub-counter">
						<div class="number">
							<span>{{ $question->replies }}</span>
							<div>replies</div>
						</div>
					</div>
					<div class="sub-counter">
						<div class="number">
							<span>{{ $question->views }}</span>
							<div>views</div>
						</div>
					</div>								
				</div>
				<div class="q-about">
					<div class="score {{ $question->votes > 0 ? 'green' : '' }}">{{ $question->votes }}</div>
					<div class="q-details">
						<a href="{{ route('question', $question->qid) }}" class="q-link">{{ $question->title }}</a>
						<div class="q-author">
							{{ $question->timestamp->diffForHumans() }}
						</div>
					</div>
				</div>							
			</div>
			@endforeach
		</div>
	</div>

	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>