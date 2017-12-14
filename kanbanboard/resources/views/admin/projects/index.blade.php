
@extends('layouts.app')

@section('head')
<title>projects</title>
@endsection

@section('content')

<h1><a href="/" class="text-muted no-underline">Home</a> \ projects</h1>
<hr>

<form class="projects" action="change" method="Post">
      {{ csrf_field() }}


      <div class="table">
      	<table class="table table-bordered table-striped table-hover table-fixed">
      		<thead>
      			<tr>
      				<th> Title </th>
      				<th> Actions </th>
      			</tr>
      		</thead>
        	<tbody>
            	@if (empty($project))
            		<p>There are no projects</p>
            	@else

            	@foreach($project as $item)
            		<tr>
            			<td>{{ $item->title }}</td>

            			<td>
                    <div class="checkbox">
                      <label><input type="hidden" name="all_checkboxes[]" value="{{$item->project_id}}"></label>
                      <label><input type="checkbox" name="checkbox[]" value="{{$item->project_id}}" @if ($item->artifact_fetch ==1) checked @endif>To import</label>
                    </div>
            			</td>

            		</tr>
            	@endforeach
            	@endif
          </tbody>
            	</table>

          <button type="button submit" class="btn btn-primary" >Import Or save</button>
</form>
      <a href="{{ action('ProjectController@refresh')}}" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i> Update</a>
@endsection
