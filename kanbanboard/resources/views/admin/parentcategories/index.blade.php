
@extends('layouts.app')

@section('head')
<title>ParentCategory</title>
@endsection

@section('content')

<h1><a href="/" class="text-muted no-underline">Home</a> \ ParentCategory</h1>
<hr>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal" title="Add Parent Category">Add</button>

<div class="table">
	<table class="table table-bordered table-striped table-hover table-fixed">
		<thead>
			<tr>
				<th> Name </th>
				<th> Actions </th>
			</tr>
		</thead>
	<tbody>

	@if (empty($pcategories))
		<p>There are no ParentCategories</p>
	@else

	@foreach($pcategories as $item)
		<tr>
			<td>{{ $item->name }}</td>

			<td>

				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}" title="Edit Parent Category">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"/>
				</button>

				{!! Form::open([
				'method'=>'DELETE',
				'url' => ['/admin/parentcategories', $item->id],
				'style' => 'display:inline'
				]) !!}
				{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete ParentCategory" />', array(
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
	<div class="pagination-wrapper"> {!! $pcategories->render() !!} </div>
</div>

@foreach($pcategories as $item)
		<!-- Edit Modal -->
		<div class="modal fade" id="editModal-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title" id="exampleModalLongTitle">Edit {{ $item->name }}</h2>
					</div>
					<div class="modal-body">
						{!! Form::model($item, [
						'method' => 'PATCH',
						'url' => ['/admin/parentcategories', $item->id],
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
				<h2 class="modal-title" id="exampleModalLongTitle">Create Parent Category</h2>
			</div>

			<div class="modal-body">
				 {!! Form::open(['url' => '/admin/parentcategories', 'class' => 'form-horizontal', 'files' => true]) !!}

				<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
					{!! Form::label('name', 'Name:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}

					<div class="col-sm-12">
						{!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
