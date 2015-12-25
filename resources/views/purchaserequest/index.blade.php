@extends('layout.list',[
	'page_header'=>'List of Purchase Requests'
])

@section('list')
<div>
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Date</th>
				<th>Branch</th>
				<th>Department</th>
				<th>Principal</th>
			</tr>
		</thead>
		<tbody>
		@if( isset($purchaserequests))
			<tr>
				<td colspan=6 align="center">No data</td>
			</tr>
		@else
			@foreach( $purchaserequests as $pr)
				<tr>
					<td>{{ $pr->requestedby }}</td>
					<td>{{ $pr->requesteddate }}</td>
					<td>{{ $pr->branch }}</td>
					<td>{{ $pr->department }}</td>
					<td>{{ $pr->principal }}</td>
				</tr>
			@endforeach
		@endif
		</tbody>
	</table>
</div>
@stop