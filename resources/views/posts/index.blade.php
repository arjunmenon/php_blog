@extends('layouts.app')

@section('content')
	{{-- <h1>{{ dd(substr(Route::currentRouteAction(), (strpos(Route::currentRouteAction(), '@') + 1) )) }}</h1> --}}
	{{-- <h1>{{ Route::current()->getName() === 'all_posts' }}</h1> --}}
	<h1 class="display-4" >{!! Route::current()->getName() === 'all_posts' ? "Posts from<br />the network" : "Posts from<br />my blog" !!}</h1>
	@if(count($posts) > 0)
		<table class="table table-hover">
			{{-- @auth
				<caption class="h4 text-success">
					<a href="/posts/create">&plus; Create a new post</a>
				</caption>
			@endauth --}}
			{{-- <thead class="thead">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Title</th>
					<th scope="col">Body</th>
				</tr>
			</thead> --}}
			<tbody>
				@foreach($posts as $index=>$post)
					<tr class="table-row"
						onclick="window.location='posts/{{$post->id}}';">
						<th scope="row">{{$index + 1}}</th>
						<td class="col-4">
							<p style="margin-bottom: -5px;">{{$post->created_at->formatLocalized('%B %d, %Y')}}</p>
							<p>{{$post->user->name}}</p>
						</td>
						<td class="td-title">
							<h4 class="title" style="white-space: pre-wrap;width: 50%;line-height: 1.0;;font-size: 30px;">{{$post->title}}</h4>
						</td>
						{{-- <td>{{$post->body}}</td> --}}
					</tr>
				@endforeach
			</tbody>
		</table>
		{{$posts->links()}}
	@else
		<p>No posts created. Create one!</p>
	@endif
@endsection