{{-- extend form layout --}}
@extends('layouts.form', [
	'parameter' => ['route'=> 'purchaserequest.store', 'method'=>'POST']
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
	<strong>Purchase Request</strong>
	<span>New</span>
@stop

{{-- main line content --}}
@section('main')
{{-- 1st column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('name', 'REQUESTING BRANCH', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::select('branch_id', [], null, ['class'=>'form-control select']) !!}
			<span class="help-block">Select the requester's name</span>	
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('description', 'REQUESTING DIVISION', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::select('division_id', [], null, ['class'=>'form-control select']) !!}
			<span class="help-block">Select the requester's division</span>
		</div>			
	</div>
	<div class="form-group">
		{!! Form::label('description', 'REQUESTING DEPARTMENT', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::select('department_id', [], null, ['class'=>'form-control select']) !!}
			<span class="help-block">Select the requester's </span>
		</div>			
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::select('recordtype_id', [], null, ['class'=>'form-control select']) !!}
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

@section('line-item')
	<table id="test" class="table table-striped"></table>
@stop
{{-- attached javascript files here --}}
@section('script-list')
 {!! HTML::script("js/plugins/custom/itemgrid.js") !!}   
	{{--additional javascripts --}}
<script type="text/javascript">
ItemGrid.create("test", {
	columns: [
		{name: "Item", type: "select", data: [], attr: {}},
		{name: "Vendor", type: "select", data: [], attr: {}},
		{name: "Description", type: "text", data: [], attr: {}}
	]
});
</script>
@stop