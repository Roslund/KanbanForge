@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    
    <div class="part-breaker" style="height:auto;background:#1F262D;color:#fefefe;padding:15px;">Categories</div>
    
    <a href="{{ url('admin/categories') }}" class="item"> <i class="fa fa-commenting-o" aria-hidden="true"></i> Category</a>
    {!! Form::open(['url' => '/admin/categories', 'class' => 'form-horizontal', 'files' => true]) !!}
    
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
      {!! Form::label('name', 'NAME:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
      
      <div class="col-sm-12">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
      </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
      {!! Form::label('limit', 'Card limit:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
      <div class="col-sm-12">
        {!! Form::text('limit', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
      </div>
    </div>
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
      {!! Form::label('sortnumber', 'Sort number in the bord:', ['class' => 'control-label', 'style' => 'margin-left:15px;color:#000000;margin-bottom:10px;']) !!}
      <div class="col-sm-12">
        {!! Form::text('sortnumber', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
      </div>
    </div>
    
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
      {!! Form::label('parentcategory', 'Parent Category') !!}
      <div>
        {{ Form::select('parentcategory', $parent_categories, null, ['class' => 'form-control']) }}
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-sm-offset-9 col-sm-3">
        {!! Form::submit('Save', ['class' => 'btn btn-primary form-control', 'id' => 'save']) !!}
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
</div>
@endsection