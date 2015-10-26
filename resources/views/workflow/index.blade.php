{{-- extend form layout --}}
@extends('layouts.list')

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
	<span>list</span>
@stop

{{-- main line content --}}
@section('main')
<table class="table">
	<thead>
		<tr>
			<th></th>
			<th>Id</th>
			<th>Name</th>
			<th>Description</th>
			<th>Inactive</th>
		</tr>
	</thead>
	<tbody>	
	@foreach( $workflows as $workflow)
		<tr>
			<td width="80px">
				<a href={{URL::route("workflow.edit", $workflow->id)}}>Edit</a> |
				<a href={{URL::route("workflow.show", $workflow->id)}}>View</a>
			</td>
			<td>{{{$workflow->id}}}</td>
			<td>{{{$workflow->name}}}</td>
			<td>{{{$workflow->description}}}</td>
			<td>{{{$workflow->inactive}}}</td>
		</tr>	
	@endforeach
	</tbody>
</table>
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop