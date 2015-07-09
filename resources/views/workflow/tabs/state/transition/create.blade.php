{{-- state/show --}}
<div role="tabpanel" class="tab-pane active" id="transition">

	<div class="col-xs-12">
		<div class="form-group">
			{!! Form::button("Add", ["class"=>"btn btn-primary", "id"=>"add-row"]) !!}
			{!! Form::button("Edit", ["class"=>"btn btn-default", "id"=>"edit-row"]) !!}
			{!! Form::button("Remove", ["class"=>"btn btn-default", "id"=>"del-row"]) !!}
		</div>

		<table id="line-table" class="table table-striped table-hover">
			<thead>
				<tr>
					<td>State</td>
					<td>Condition</td>
					<td>Active</td>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>