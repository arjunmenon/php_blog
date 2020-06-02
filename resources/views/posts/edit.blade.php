@extends('layouts.app')

@section('content')
	<h1 class="display-4">Edit post with ID#{{$post->id}}</h1>
	<blockquote class="blockquote">
	  	<footer class="">
	  		Last Updated On <cite title="Source Title">{{$post->updated_at}}</cite>
	  	</footer>
	  	<footer class="">
	  		&larr; <a href="/posts/{{$post->id}}" class="">Return to show page</a>
	  	</footer>
	</blockquote>

	<hr>

	{!! Form::open(['action' => ['PostsController@update', $post->id], 
																	'method' => 'POST']) !!}

	    @include('partials.form')

	    {{Form::hidden('_method', 'PATCH')}}
	    {{Form::submit('Submit', ['class' => 'btn btn-primary btn-lg btn-block'])}}
	{!! Form::close() !!}

	<hr>

	@if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
			{!! Form::open(['action' => ['PostsController@destroy', $post->id], 
																			'method' => 'POST']) !!}
				{{ Form::hidden('_method', 'DELETE')}}
				{{ Form::submit('Delete', ['class' => 'btn btn-outline-danger btn-lg'])}}
			{!! Form::close() !!}
		@endif
	@endif
@endsection