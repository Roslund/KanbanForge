
@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Swimlanes
	<a href="{{ url('/admin/swimlanes/create') }}" class="btn btn-primary btn-xs" title="Add New Swimlane"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
	
	
	<div class="table">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th> No. </th>
					<th> Name </th>
					<th> Limit </th>
					<th> Actions </th>
				</tr>
			</thead>
			<tbody>

				@if (empty($swimlanes))
					<p>There are no swimlanes</p>
				@else

					@foreach($swimlanes as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->sortnumber }}</td>
						
						<td>
							<a href="{{ url('/admin/swimlanes/' . $item->id) }}" class="btn btn-success btn-xs" title="View Swimlane">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
							<a href="{{ url('/admin/swimlanes/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Swimlane">

							<span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
							{!! Form::open([
							'method'=>'DELETE',
							'url' => ['/admin/swimlanes', $item->id],
							'style' => 'display:inline'
							]) !!}
							{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Swimlane" />', array(
								'type' => 'submit',
								'class' => 'btn btn-danger btn-xs',
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