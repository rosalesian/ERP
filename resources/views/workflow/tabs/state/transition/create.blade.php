{{-- state/show --}}
<div role="tabpanel" class="tab-pane active" id="transition">
	<div class="form-group">
		{!! Form::button("Add", ["class"=>"btn btn-primary", "id"=>"add-row"]) !!}
		{!! Form::button("Edit", ["class"=>"btn btn-default"]) !!}
		{!! Form::button("Remove", ["class"=>"btn btn-default", "id"=>"del-row"]) !!}
	</div>	
	<div class="col-xs-12">
		<table id="transition-table" class="table table-striped table-hover">
			<thead>
				<tr>
					<td>To State</td>
					<td>Trigger</td>
					<td>Description</td>
					<td>In Active</td>
					<td></td>
				</tr>
			</thead>
		</table>
	</div>
</div>