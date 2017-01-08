<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Response and Reply</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
		<a href="#" class="title"><span>Questly | <span class="blue">Response and Reply</span></span></a>
		<nav>
			<ul>
				@if(!Auth::check())
				<li><a href="{{ route('login') }}" class="link"><span>Log in</span></a></li>
				<li><a href="{{ route('register') }}" class="link"><span>Sign up</span></a></li>
				@else
				<li><a href="{{ route('user', Auth::user()->uid) }}" class="link"><span>Welcome, {{ Auth::user()->username }}</span></a></li>
				<li><a href="{{ route('logout') }}" class="link"><span>Log out</span></a></li>
				@if(Auth::user()->role == 'admin')
				<li><a href="{{ route('admin') }}" class="link"><span>Admin panel</span></a></li>
				@endif
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
			@if(Auth::user()->role == 'admin')
			<a href="{{ route('admin') }}" class="link"><span>Admin panel</span></a>
			@endif
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
		<!-- START: Top Questions -->
		<section class="top-questions">
			<h2>Top questions</h2>
			@foreach($top as $question)
			<!-- START: Question -->
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
			<hr>
			<!-- END: Question -->
			@endforeach
		</section>
		<!-- END: Top Questions -->

		<!-- START: New Questions -->
		<div class="sidebar-h">
			<div class="sidebar">
				<h2 class="new-questions">Newest questions</h2>
				@foreach($new as $question)
				<!-- START: New Question -->
				<div class="new-question">
					<a href="#"><div class="rating {{ $question->votes > 0 ? 'green' : 'darkgrey' }}">{{ $question->votes }}</div></a>
					<div class="nq-link-holder">
						<a href="{{ route('question', $question->qid) }}" class="nq-link">{{ $question->title }}</a>
					</div>	
				</div>
				<!-- END: New Question -->
				@endforeach
			</div>
			<!-- END: New Questions -->
		</div>		
	</div>
	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>