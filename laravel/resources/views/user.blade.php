<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | Response and Reply" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | Response and Reply</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/user.css') }}">
</head>
<body>
	<header>
		<a href="{{ route('index') }}" class="title"><span>Questly | <span class="blue">Response and Reply</span></span></a>
		<nav>
			<ul>
				@if(Auth::check())
					<li><a href="{{ route('logout') }}" class="link"><span>Log out</span></a></li>
				@endif
				<li><a href="{{ route('new') }}" class="link"><span>Ask a question</span></a></li>
			</ul>
		</nav>
	</header>
	<header class="mobile-header">
		<ul>
			@if(Auth::check())
				<a href="{{ route('logout') }}" class="link"><span>Log out</span></a>
			@endif
			<li><a href="{{ route('new') }}" class="link"><span>Ask a question</span></a></li>
		</ul>
	</header>

	<div class="container">
		<section class="card">
			<img class="avatar" alt="avatar" src="{{ URL::asset('img/avatar.png') }}" width="128" height="128">
			<h1 class="name">{{ $user->username }}</h1>
			<h3 class="skill">{{ ucfirst($user->role) }}</h3>			
		</section>

		<section class="my-questions">
			<h2>My questions</h2>
			<hr>
			@foreach($questions as $question)
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
			<!-- END: Question -->
			@endforeach
		</section>

		<section class="my-questions">
			<h2>My answers</h2>
			<hr>
			@foreach($answered as $question)
			<!-- START: Answer -->
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
			<!-- END: Answer -->
			@endforeach
		</section>
	</div>
	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
</body>
</html>