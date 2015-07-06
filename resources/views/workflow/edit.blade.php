{{-- extend form layout --}}
@extends('layouts.form', [
	'form_params' => ['route'=> ['workflow.update', 
	$workflow->id], 'method'=>'PUT']
])

{{-- additional styles --}}	
@section('style-list')
@stop

{{-- buttons --}}
@section('buttons')
	{!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
	{!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) !!}
@stop

{{-- form title --}}
@section('form-title')
	Edit workflow {{$workflow->name}}
@stop

{{-- main line content --}}
@section('main')
{{-- 1st column --}}
<div class="col-xs-4">
	<div class="form-group">
		{!! Form::label('name', 'NAME') !!}
		{!! Form::text('name', $workflow->name, ['class'=>'form-control input-sm']) !!}		
	</div>
	<div class="form-group">
		{!! Form::label('description', 'descriptionTION') !!}
		{!! Form::textarea('description',$workflow->description, ['class'=>'form-control input-sm']) !!}	
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-4">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE') !!}
		{!! Form::select('recordtype_id', $recordtypes, $workflow->recordtype_id, ['class'=>'form-control input-sm']) !!}	
	</div>
	<div class="form-group">
		{!! Form::label('condition', 'CONDITION') !!}
		{!! Form::textarea('condition',$workflow->condition, ['class'=>'form-control input-sm']) !!}	
	</div>	
</div>

{{-- 3rd column --}}
<div class="col-xs-4">
</div>

@stop

{{-- line item tabs --}}
@section('tabs')
	@include('workflow.tabs.state.create')
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop