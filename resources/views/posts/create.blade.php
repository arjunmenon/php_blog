@extends('layouts.app')

@section('content')
	<h1 class="display-4">Create a new post</h1>

	<hr>

	{!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}

	    @include('partials.form')

	    {{Form::submit('Submit', ['class' => 'btn btn-primary btn-lg btn-block'])}}
	{!! Form::close() !!}
@endsection