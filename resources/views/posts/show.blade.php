@extends('layouts.default')

@section('content')
	<h1 class="display-4">{{$post->title}}</h1>
	<blockquote class="blockquote">
 		<footer class="blockquote-footer">
 			Written On <cite title="Source Title">{{$post->created_at}}</cite>
 		</footer>
 		@auth
		  	<footer class="blockquote-footer">
		  		<a href="/posts/{{$post->id}}/edit">Edit</a>
		  	</footer>
		@endauth
	</blockquote>
	<hr>
	<p class="lead">{{$post->body}}</p>
@endsection