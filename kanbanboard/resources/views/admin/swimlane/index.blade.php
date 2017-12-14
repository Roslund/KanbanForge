
@extends('layouts.app')

@section('head')
<title>Swimlanes</title>
@endsection

@section('content')

<h1><a href="/" class="text-muted no-underline">Home</a> \ Swimlanes</h1>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" title="Edit Swimlane">Add</button>

<div class="table">
	<table class="table table-bordered table-striped table-hover table-fixed">
		<thead>
			<tr>
				<th> Sort No. </th>
				<th> Name </th>
				<th> Actions </th>
			</tr>
		</thead>
	<tbody>

	@if (empty($swimlanes))
		<p>There are no swimlanes</p>
	@else

	@foreach($swimlanes as $item)
		<tr>
			<td>{{ $item->sortnumber }}</td>
			<td>{{ $item->name }}</td>

			<td>

				{{Form::button('<span class="glyphicon glyphicon-arrow-up" aria-hidden="true" title="Up">', array(
					'class' => 'btn btn-info btn-sm',
					'title' => 'Up',
				))}}

				<!--
				<a href="{{ url('/admin/swimlanes/' . $item->id) }}" class="btn btn-success btn-sm" title="View Swimlane">
				<span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
				-->

				<a href="{{action('SwimlaneController@updateKevinVersion')}}">Add task template</a>

				<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}" title="Down">
				<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"/>
				</button>

				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}" title="Edit Swimlane">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
				</button>

				{!! Form::open([
				'method'=>'DELETE',
				'url' => ['/admin/swimlanes', $item->id],
				'style' => 'display:inline'
				]) !!}
				{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Swimlane" />', array(
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
	<div class="pagination-wrapper"> {!! $swimlanes->render() !!} </div>
</div>

@foreach($swimlanes as $item)
<!-- Edit Modal -->
<div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">Edit {{ $item->name }}</h2>
			</div>
			<div class="modal-body" style="margin-top: 0; padding-top: 0;">
				{!! Form::model($item, [
				'method' => 'PATCH',
				'url' => ['/admin/swimlanes', $item->id],
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
					{!! Form::label('sortnumber', 'Sort number:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
					<div class="col-sm-12">
						{!! Form::number('sortnumber', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
@endforeach

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="Create" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLongTitle">Create Swimlane</h2>
			</div>

			<div class="modal-body" style="margin-top: 0; padding-top: 0;">
				 {!! Form::open(['url' => '/admin/swimlanes', 'class' => 'form-horizontal', 'files' => true]) !!}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('name', 'Name:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}

					<div class="col-sm-12">
						{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
						{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
					</div>
				</div>

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('sortnumber', 'Sort number:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
					<div class="col-sm-12">
						{!! Form::number('sortnumber', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
