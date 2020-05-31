@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
	  		<div class="col-4">
				<!-- List group -->
				<div class="list-group" id="myList" role="tablist">
				  <a class="list-group-item list-group-item-action active" data-toggle="list" href="#home" role="tab">Home</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#profile" role="tab">Payment</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#messages" role="tab">Messages</a>
				  <a class="list-group-item list-group-item-action" data-toggle="list" href="#settings" role="tab">Settings</a>
				</div>
			</div>

			<div class="col-8">
				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane active" id="home" role="tabpanel">a</div>
				  <div class="tab-pane" id="profile" role="tabpanel">
				  	@include('partials.payment')
				  </div>
				  <div class="tab-pane" id="messages" role="tabpanel">c</div>
				  <div class="tab-pane" id="settings" role="tabpanel">d</div>
				</div>
			</div>
		</div>
	</div>

@endsection