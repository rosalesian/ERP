{{-- extend form layout --}}
@extends('layouts.form', [
	'parameter' => ['route'=> 'workflow.store', 'method'=>'GET']
])

{{-- additional styles --}}	
@section('style-list')
@stop
