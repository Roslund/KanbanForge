
@extends('layouts.app')

@section('head')
<title>Swimlanes</title>
@endsection

@section('content')

<div class="container">
	<h1><a href="/" class="text-muted no-underline">Home</a> \ Swimlanes</h1>
	<hr>
	<a href="{{ url('/admin/swimlanes/create') }}" class="btn btn-primary" title="Add New Swimlane">Add</a>
	<div class="table">
		<table class="table table-bordered table-striped table-hover" style="table-layout: fixed;">
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
							<a href="#up" class="btn btn-info btn-sm" title="Up">
							<span class="glyphicon glyphicon-arrow-up" aria-hidden="true"/></a>

							<a href="#down" class="btn btn-info btn-sm" title="Down">
							<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"/></a>

							<!--
							<a href="{{ url('/admin/swimlanes/' . $item->id) }}" class="btn btn-success btn-sm" title="View Swimlane">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
							-->

							<a href="{{ url('/admin/swimlanes/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit Swimlane">

							<span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
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
	</div>
</div>
</div>
@endsection