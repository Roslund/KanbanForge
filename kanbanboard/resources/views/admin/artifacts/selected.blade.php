@extends('layouts.app')
@section('content')

<div class="col-md-12" style="padding-bottom:15px;">
	@foreach($ids as $id)
						
    <tr>
    	<td>{{ $id}}</td>	
  	</tr>
  	<br>
  					
    @endforeach
</div>
@endsection