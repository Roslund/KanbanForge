
<!--<div class="col-md-12">
		{!! Form::open(['url' => '/filter', 'class' => 'form-horizontal form', 'files' => true]) !!}
		<div class="table">
				<table class="table table-bordered table-striped table-hover table-fixed">
						<thead>
								<tr>
										<th> Select </th>
										<th> Title </th>
								</tr>
						</thead>
						<tbody>
								@if (empty($artifacts))
								<p>There are no available artifacts</p>
								@else
								@foreach($artifacts as $item)
								<tr>
										<td>
												{{ Form::hidden('selected', '0', false) }}
												{!! Form::checkbox('selected', '1' , true) !!}
										</td>
										<td>{{ $item->title }}</td>
								</tr>
								@endforeach
								@endif
						</tbody>
				</table>
				
		</div>
		{!! Form::submit('Submit', ['class' => 'btn btn-primary form-control', 'style' => 'background-color: #66BE56;line-height:38px;height:50px;']) !!}
		{!! Form::close() !!}
</div>
-->