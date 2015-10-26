{{-- extend form layout --}}
@extends('layouts.form', [
	'parameter' => ['route'=> 'workflow.store', 'method'=>'POST']
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

@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop