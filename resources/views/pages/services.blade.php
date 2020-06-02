@extends('layouts.app')

@section('content')
  <h1>Services Page</h1>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
  quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
  cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
  proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  @if(count($services) > 0)
  	<ul class="list-group">
	  	@foreach($services as $service)
	  		<li class="list-group-item">{{$service}}</li>
	  	@endforeach
  	</ul>
  @endif
@endsection