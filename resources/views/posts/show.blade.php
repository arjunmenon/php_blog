@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-4">
			<blockquote class="blockquote">
		 		<footer class="">
		 			Written On <cite title="Source Title">{{$post->created_at->formatLocalized('%B %d, %Y')}}</cite>
		 		</footer>

		 		<footer class="">
		 			&larr; <a href="/posts">Go back</a>
		 		</footer>
		 		<hr>
		 		@if(!Auth::guest())
	        		@if(Auth::user()->id == $post->user_id)
					  	<footer class="blockquote-footer">
					  		<a href="/posts/{{$post->id}}/edit">Edit</a>
					  	</footer>
					@endif
				@endif
			</blockquote>
		</div>
		<div class="col-8">
			<h1 class="display-4" style="font-size: 80px;text-transform: capitalize;width: 80%;">{{$post->title}}</h1>
			<hr>
			<p class="lead">{{$post->body}}</p>
		</div>
	</div>
@endsection