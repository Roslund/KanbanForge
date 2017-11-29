@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h1><a href="/" class="text-muted no-underline">Home</a> \ <a href="/admin/swimlanes" class="text-muted no-underline">Swimlanes</a> \ {{ $swimlane->name }}</h1>
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-md-4 any-block col-sm-6 any-block offset-md-4">
        {!! Form::model($swimlane, [
        'method' => 'PATCH',
        'url' => ['/admin/swimlanes', $swimlane->id],
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
            {!! Form::text('sortnumber', null, ['class' => 'form-control', 'required' => 'required']) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-9 col-sm-3">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
          </div>
        </div>

        {!! Form::close() !!}
        @if ($errors->any())
        <ul class="alert alert-danger">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
        @endif
      </div>
      <div class="col-md-4">
        
      </div>
  </div>
</div>
@endsection
