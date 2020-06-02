@extends('layouts.app')

@section('content')
	{{-- <div class="container"> --}}
			<h1 class="display-4" >Edit your<br />preferences</h1>
		<div class="row">
	  		<div class="col-4">
				<!-- List group -->
				<div class="list-group" id="myList" role="tablist">
				  <a class="list-group-item list-group-item-action active" data-toggle="list" href="#payment" role="tab">Payment</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab">Profile</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#messages" role="tab">Messages</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#settings" role="tab">Settings</a>
				</div>
			</div>

			<div class="col-8">
				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="payment" role="tabpanel">
				  	@include('partials.payment')
				  </div>
				  <div class="tab-pane" id="profile" role="tabpanel"><p>Settings for Profile</p></div>
				  <div class="tab-pane" id="messages" role="tabpanel"><p>Settings for Messages</p></div>
				  <div class="tab-pane" id="settings" role="tabpanel"><p>Settings for Settings</p></div>
				</div>
			</div>
		</div>
	{{-- </div> --}}

@endsection