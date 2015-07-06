{{-- state/show --}}
<div role="tabpanel" class="tab-pane active" id="states">
	<div class="col-xs-12">
		<table class="table">
			<thead>
				<tr>
					<td>To State</td>
					<td>Trigger</td>
					<td>Description</td>
					<td>In Active</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>{!! Form::select("state") !!}</td>
					<td>{!! Form::text("trigger") !!}</td>
					<td>{!! Form::textarea("description") !!}</td>
					<td>{!! Form::checkbox("inactive") !!}</td>
				</tr>
				<tr>
					<td colspan="3">
						<table>
						<tbody>
							<tr>
								<td>
									<div class="form-group">
										{!! Form::button("Add", ["class"=>"btn btn-primary"]) !!}
										{!! Form::button("Edit", ["class"=>"btn btn-default"]) !!}
										{!! Form::button("Delete", ["class"=>"btn btn-default"]) !!}
										{!! Form::button("Remove", ["class"=>"btn btn-default"]) !!}
									</div>									
								</td>
							</tr>						
						</tbody>
						</table>
					</td>
				</tr>

			</tbody>
		</table>
	</div>
</div>