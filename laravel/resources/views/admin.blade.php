<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Response and Reply</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/search.css">
</head>
<body>
	<header>
		<a href="{{ route('index') }}" class="title"><span>Questly | <span class="blue">Response and Reply</span></span></a>
		<nav>
			<ul>
				@if(Auth::check())
				<li><a href="{{ route('user', Auth::user()->uid) }}" class="link"><span>Welcome, {{ Auth::user()->username }}</span></a></li>
				<li><a href="{{ route('logout') }}" class="link"><span>Log out</span></a></li>
				@endif
			</ul>
		</nav>
	</header>

	<header class="mobile-header">
		@if(Auth::check())
		<a href="{{ route('user', Auth::user()->uid) }}" class="link"><span>Welcome, {{ Auth::user()->username }}</span></a>
		<a href="{{ route('logout') }}" class="link"><span>Log out</span></a>
		@endif
	</header>

	<div class="container">
		<div class="results">
			
			<h2>Manage questions</h2>
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
							<div>{{ $question->timestamp->diffForHumans() }}</div>
							<form action="{{ route('deleteQuestion', $question->qid) }}" method="GET">
								<input type="submit" value="Delete - {{ mb_strimwidth($question->title, 0, 10, '...') }}"/>
								<input type="hidden" name="qid" value="{{ $question->qid }}"/>
								<input type="hidden" name="_token" value="{{ Session::token() }}"/>
							</form>
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