<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="Questly | How to clean your car?" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Questly | How to clean your car?</title>
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/question.css') }}">
	<script type="text/javascript" src="{{ URL::asset('js/script.js') }}"></script>
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

	<div class="container">
		<div class="question">
			<div class="q-header">
				<h1>{{ $question->title }}</h1>
			</div>
			<hr>
			<div class="vote-holder">
				<a href="{{ route('questionUpvote', $question->qid) }}" class="vote">&#x25B2;</a>
				<div class="rating"><span>{{ $question->votes }}</span></div>
				<a href="{{ route('questionDownvote', $question->qid) }}" class="vote">&#x25BC;</a>
			</div>
			<div class="text">
				<p>{!! $question->content !!}</p>
			</div>
			<div class="q-author">by {{ $username }} {{ $question->timestamp->diffForHumans() }}</div>
			<hr>
			<div class="comments">
				@foreach($question->comments as $comment)
					<div class="comment">
						<p>{{ $comment->content }} &mdash; <strong>{{ ($comment->user) ? $comment->user->username : 'Anonymous' }}</strong></p>
					</div>
				@endforeach
				<a href="#" id="question-{{ $question->qid }}" class="add-comment">add a comment</a>
				<form action="{{ route('createNewComment') }}" method="POST" id="questionComment{{ $question->qid }}" class="commentForm">
					<input type="text" name="comment"/>
					<input id="submitComment" type="submit" value="Comment"/>
					<input type="hidden" name="qid" value="{{ $question->qid }}"/>
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
				</form>
			</div>
		</div>

		<div class="answers">
			<div class="q-header">
				<h2>{{ count($answers) }} Answer{{ count($answers) > 1 ? 's' : '' }}</h2>
			</div>
			<hr>
			
			@foreach($answers as $answer)
			<!-- START: Answer -->
			<div class="answer">
				<div class="vote-holder">
					<a href="{{ route('answerUpvote', $answer->aid) }}" class="vote">&#x25B2;</a>
					<div class="rating"><span>{{ $answer->votes }}</span></div>
					<a href="{{ route('answerDownvote', $answer->aid) }}" class="vote">&#x25BC;</a>
					<!--<p class="accepted">&#10004;</p>-->
				</div>
				<div class="text">
					<p>{!! $answer->content !!}</p>
				</div>
				<div class="q-author">by {{ $answer->username }} {{ $answer->timestamp->diffForHumans() }}</div>
				<hr>
				
				<div class="comments">
					@foreach($answer->comments as $comment)
						<div class="comment">
							<p>{{ $comment->content }} &mdash; <strong>{{ ($comment->user) ? $comment->user->username : 'Anonymous' }}</strong></p>
						</div>
					@endforeach
					<a href="#" id="answer-{{ $answer->aid }}" class="add-comment">add a comment</a>
					<form action="{{ route('createNewComment') }}" method="POST" id="answerComment{{ $answer->aid }}" class="commentForm">
						<input type="text" name="comment"/>
						<input id="submitComment" type="submit" value="Comment"/>
						<input type="hidden" name="aid" value="{{ $answer->aid }}"/>
						<input type="hidden" name="_token" value="{{ Session::token() }}"/>
					</form>
				</div>
				<hr class="hr">
			</div>
			<!-- END: Answer -->
			@endforeach
			
		</div>

		<div class="reply">
			<div class="q-header">
				<h2>Your answer</h2>
				<form action="{{ route('createNewAnswer') }}" method="POST">
					<div class="addons">
						<span id="link">link</span>
						<span id="code">code</span>
					</div>
					<textarea id="area" name="content" required></textarea>
					<input type="submit" value="Post your reply">
					<input type="hidden" name="_token" value="{{ Session::token() }}"/>
					<input type="hidden" name="qid" value="{{ $question->qid }}"/>
				</form>
				<h2 id="q-preview">Question Preview</h2>
				<hr>
				<div id="preview">

				</div>
			</div>
		</div>
	</div>
	<footer>
		<strong>Questly</strong> | Response and Reply
	</footer>
	
</body>
</html>