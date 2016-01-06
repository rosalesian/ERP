@extends('layout.create',[
	'page_header'=>'New Purchase Request',
	'route_name'=>'purchaserequest.create'
])

@section('form-content')

{{-- 1st row --}}
<div class="row">
	<div class="col-xs-4">
		<div class="form-group">
		{!! Form::label('requestedby', 'REQUESTED BY') !!}
		{!! Form::select('requestedby', [], null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-xs-4">
		<div class="form-group">
		{!! Form::label('date', 'DATE') !!}
		{!! Form::text('date', null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-xs-4">
		<div>
		{!! Form::label('branch', 'BRANCH') !!}
		{!! Form::select('branch', [], null, ['class'=>'form-control']) !!}
		</div>
	</div>	
</div>

{{-- 2nd row --}}
<div class="row">
	<div class="col-xs-4">
		<div class="form-group">
		{!! Form::label('department', 'DEPARTMENT') !!}
		{!! Form::select('department', [], null, ['class'=>'form-control']) !!}
		</div>
	</div>

	<div class="col-xs-4">
		<div class="form-group">
		{!! Form::label('principal', 'PRINCIPAL') !!}
		{!! Form::select('principal', [], null, ['class'=>'form-control']) !!}
		</div>
	</div>
</div>

@stop

@section('line-items')

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#items">Items</a></li>
</ul>

<div class="tab-content">
	<div class="tab-pane active" id="items">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Item</th>
					<th>Description</th>
					<th>Quantity</th>
					<th>Units</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td width="200">
						{!! Form::text('item', null, ['class'=>'form-control']) !!}
					</td>
					<td></td>
					<td width="100">
						{!! Form::text('quantity', null, ['class'=>'form-control']) !!}
					</td>
					<td width="100">
						{!! Form::select('units', [], null, ['class'=>'form-control']) !!}
					</td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div id="line-items"></div>
@stop

@section("scripts")
<script type="text/babel" src="{{ asset('js/react/components/line-items.js') }}"></script>
@stop