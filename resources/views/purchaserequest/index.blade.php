{{-- extend form layout --}}
@extends('layouts.list')

{{-- additional styles --}}	
@section('style-list')
@stop

{{-- form title --}}
@section('form-title')
	<strong>Purchase Requests</strong>
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
	@foreach( $purchaserequests as $purchaserequest)
		<tr>
			<td width="80px">
				<a href={{URL::route("purchaserequest.edit", $purchaserequest->id)}}>Edit</a> |
				<a href={{URL::route("purchaserequest.show", $purchaserequest->id)}}>View</a>
			</td>
			<td>{{{$purchaserequest->id}}}</td>
			<td>{{{$purchaserequest->name}}}</td>
			<td>{{{$purchaserequest->description}}}</td>
			<td>{{{$purchaserequest->inactive}}}</td>
		</tr>	
	@endforeach
	</tbody>
</table>
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{--additional javascripts --}}
@stop