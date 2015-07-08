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
	<strong>Workflow</strong>
	<span>New</span>
@stop

{{-- main line content --}}
@section('main')
{{-- 1st column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('name', 'NAME', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::text('name', null, ['class'=>'form-control']) !!}
			<span class="help-block">Type the workflow name</span>	
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('description', 'DESCRIPTION', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::textarea('description',null, ['class'=>'form-control', 'rows'=>'4']) !!}
			<span class="help-block">Type the workflow description</span>
		</div>
			
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::select('recordtype_id', $recordtypes, null, ['class'=>'form-control select']) !!}
			<span class="help-block">Select the workflow type</span>
		</div>

	</div>
	<div class="form-group">
		{!! Form::label('condition', 'CONDITION', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::text('condition',"First,Second,Third", ['class'=>'tagsinput']) !!}
			<span class="help-block">Set the workflow condition</span>
		</div>	
	</div>
	<div class="form-group">
		{!! Form::label('inactive', 'INACTIVE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<label class="check">
				{!! Form::checkbox('inactive', false, false, ['class'=>'icheckbox']) !!}
			</label>
			
			<span class="help-block">Set if workflow is inactive or not</span>
		</div>	
	</div>	
</div>
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop