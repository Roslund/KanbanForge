@extends('layouts.app')

@section('head')
<title>Categories</title>
@endsection

@section('content')
<h1><a href="/" class="text-muted no-underline">Home</a> \ Categories</h1>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" title="Add Category">Add</button>

<div class="table">
	<table class="table table-bordered table-striped table-hover table-fixed">
		<thead>
			<tr>
			<th> Name </th>
			<th> Limit </th>
			<th> Actions </th>
			</tr>
		</thead>
		<tbody>
			@if (empty($categories))
				<p>There are no categories</p>
			@else

			@foreach($categories as $item)
			<tr>
				<td>{{ $item->name }}</td>
				<td>{{ $item->limit }}</td>

				<td>
				<a href="#up" class="btn btn-info btn-sm" title="Up">
				<span class="glyphicon glyphicon-arrow-up" aria-hidden="true"/></a>

				<a href="#down" class="btn btn-info btn-sm" title="Down">
				<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"/></a>

				<!--
				<a href="{{ url('/admin/categories/' . $item->id) }}" class="btn btn-success btn-xs" title="View Category">
				<span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
				-->

				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" title="Edit Category">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
				</button>

				{!! Form::open([
				'method'=>'DELETE',
				'url' => ['/admin/categories', $item->id],
				'style' => 'display:inline'
				]) !!}
				{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Category" />', array(
				'type' => 'submit',
				'class' => 'btn btn-danger btn-sm',
				'title' => 'Delete',
				'onclick'=>'return confirm("Confirm delete?")'
				)) !!}
				{!! Form::close() !!}
				</td>
			</tr>
			@endforeach
			@endif
		</tbody>
	</table>
	<div class="pagination-wrapper"> {!! $categories->render() !!} </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">Edit {{ $item->name }}</h2>
			</div>
			<div class="modal-body" style="margin-top: 0; padding-top: 0;">
				{!! Form::model($item, [
				'method' => 'PATCH',
				'url' => ['/admin/categories', $item->id],
				'class' => 'form-horizontal',
				'files' => true
				]) !!}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('name', 'Name:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}

					<div class="col-sm-12">
						{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
						{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
					</div>
				</div>

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('limit', 'Limit:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
					<div class="col-sm-12">
						{!! Form::text('limit', null, ['class' => 'form-control', 'required' => 'required']) !!}
						{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
					</div>
				</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
			</div>

			{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">Create Category</h2>
			</div>

			<div class="modal-body" style="margin-top: 0; padding-top: 0;">
				 {!! Form::open(['url' => '/admin/categories', 'class' => 'form-horizontal', 'files' => true]) !!}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('name', 'Name:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}

					<div class="col-sm-12">
						{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
						{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
					</div>
				</div>

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('limit', 'Limit:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
					<div class="col-sm-12">
						{!! Form::text('limit', null, ['class' => 'form-control', 'required' => 'required']) !!}
						{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
					</div>
				</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::button('Save', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
			</div>

			{!! Form::close() !!}

			</div>
		</div>
	</div>
</div>

@endsection
