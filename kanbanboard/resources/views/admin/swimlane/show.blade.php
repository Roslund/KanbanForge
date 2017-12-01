@extends('layouts.app')

@section('head')
<title>Swimlane</title>
@endsection

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1><a href="/" class="text-muted no-underline">Home</a> \ <a href="/admin/swimlanes" class="text-muted no-underline">Swimlanes</a> \ {{ $swimlane->name }}</h1>
	</div>
</div>
<hr>
<!--
<div class="row swimlane-row">
	<div class="col-sm-3">
		<div class="card swimlane-container-card">
			<h3 style="margin-top: 0;">Card title</h3>
			<h4>Category name</h4>
			<small>Assigned users?</small>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="card swimlane-container-card">
			<h3 style="margin-top: 0;">Card title</h3>
			<h4>Category name</h4>
			<small>Assigned users?</small>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="card swimlane-container-card">
			<h3 style="margin-top: 0;">Card title</h3>
			<h4>Category name</h4>
			<small>Assigned users?</small>
		</div>
	</div>

	<div class="col-sm-3">
		<div class="card swimlane-container-card">
			<h3 style="margin-top: 0;">Card title</h3>
			<h4>Category name</h4>
			<small>Assigned users?</small>
		</div>
	</div>
</div>
<div class="row swimlane-row">
	<div class="col-sm-3">
		<div class="card swimlane-container-card">
			<h3 class="swimlane-card-title" ">Card title</h3>
			<h4>Category name</h4>
			<small>Assigned users?</small>
		</div>
	</div>
</div>
-->
@endsection