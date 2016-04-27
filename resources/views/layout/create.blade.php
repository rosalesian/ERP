@extends('default',[
	'page_header'=>$page_header
])

@section('content')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
  <h1 class="page-header">{{ $page_header or 'Create'}}</h1>

  {!! Form::open(['route'=>$route_name, 'method'=>'POST']) !!}
  <div class="form-group">
  	{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
  	{!! Form::button('Cancel', ['class'=>'btn btn-default']) !!}
  	{!! Form::button('Reset', ['class'=>'btn btn-default']) !!}  	
  </div>

  	<div class="row">@yield('form-content')</div>  

    <div class="row">@yield('line-items')</div>
  		
  <div>
  	{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
  	{!! Form::button('Cancel', ['class'=>'btn btn-default']) !!}
  	{!! Form::button('Reset', ['class'=>'btn btn-default']) !!}
  </div>
  {!! Form::close() !!}  	


</div>
@stop