
@extends('layouts.app')
@section('content')

<div class="container">
	<h1>Categories
	<a href="{{ url('/admin/categories/create') }}" class="btn btn-primary btn-xs" title="Add New Category"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
	
	
	<div class="table">
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th> No. </th>
					<th> Limit </th>
				</tr>
			</thead>
			<tbody>

				@if (empty($categories))
					<p>There are no categories</p>
				@else

					@foreach($categories as $item)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->limit }}</td>
						
						<td>
							<a href="{{ url('/admin/categories/' . $item->id) }}" class="btn btn-success btn-xs" title="View Category">
							<span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
							<a href="{{ url('/admin/categories/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Category">

							<span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
							{!! Form::open([
							'method'=>'DELETE',
							'url' => ['/admin/categories', $item->id],
							'style' => 'display:inline'
							]) !!}
							{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Category" />', array(
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
			<div class="pagination-wrapper"> {!! $categories->render() !!} </div>
		</div>
	</div>
</div>
</div>
@endsection