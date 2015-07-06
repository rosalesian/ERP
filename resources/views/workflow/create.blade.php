{{-- extend form layout --}}
@extends('layouts.form', [
	'form_params' => ['route'=> 'workflow.store', 'method'=>'POST']
])

{{-- additional styles --}}	
@section('style-list')
@stop

{{-- buttons --}}
@section('buttons')
	{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
	{!! Form::button('Cancel', ['class'=>'btn btn-default']) !!}
@stop

{{-- form title --}}
@section('form-title')
	Create New Workflow
@stop

{{-- main line content --}}
@section('main')
{{-- 1st column --}}
<div class="col-xs-4">
	<div class="form-group">
		{!! Form::label('name', 'NAME') !!}
		{!! Form::text('name', null, ['class'=>'form-control input-sm']) !!}		
	</div>
	<div class="form-group">
		{!! Form::label('description', 'DESCRIPTION') !!}
		{!! Form::textarea('description',null, ['class'=>'form-control input-sm']) !!}	
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-4">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE') !!}
		{!! Form::select('recordtype_id', $recordtypes, null, ['class'=>'form-control input-sm']) !!}	
	</div>
	<div class="form-group">
		{!! Form::label('condition', 'CONDITION') !!}
		{!! Form::textarea('condition',null, ['class'=>'form-control input-sm']) !!}	
	</div>	
</div>

{{-- 3rd column --}}
<div class="col-xs-4">
</div>

@stop

{{-- line item tabs --}}
@section('tabs')	
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop