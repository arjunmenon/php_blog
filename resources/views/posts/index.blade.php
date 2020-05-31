@extends('layouts.default')

@section('content')
	<h1 class="display-4">Listing all posts</h1>
	@if(count($posts) > 0)
		<table class="table table-striped table-hover">
			@auth
				<caption class="h4 text-success">
					<a href="/posts/create">&plus; Create a new post</a>
				</caption>
			@endauth
			<thead class="thead">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Body</th>
				</tr>
			</thead>
			<tbody>
				@foreach($posts as $index=>$post)
					<tr class="table-row"
						onclick="window.location='posts/{{$post->id}}';">
						<th scope="row">{{$index + 1}}</th>
						<td>{{$post->title}}</td>
						<td>{{$post->body}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$posts->links()}}
	@else
		<p>No posts created. Create one!</p>
	@endif
@endsection