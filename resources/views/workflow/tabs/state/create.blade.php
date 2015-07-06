{{-- state/show --}}
<div role="tabpanel" class="tab-pane active" id="states">
	{{-- content here --}}

	<div style="width:100%; top:100px">
		{!! Form::button("New State", array('class' => 'btn btn-default', 'data-backdrop'=>'false', 'data-toggle'=>'modal', 'data-target'=>'#state-form')) !!}
	</div>
	<div id="workflow-container">
	</div>

	{{-- modal dialog --}}
	<div id="state-form" class = "modal" tabindex ="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
		<div class = "modal-dialog" role="document">
			<div class = "modal-content">
				{{-- head --}}
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">New State</h4>					
				</div>
				{{-- form-open --}}
				{!! Form::open(['workflow-state', 'method' => 'POST', 'route'=> 'workflow.state.store']) !!}

				{{-- body --}}
				<div class="modal-body">
					<div class="row">						
						<div class="col-xs-4">
							<div class="form-group">
								{!! Form::hidden("workflow_id", $workflow->id) !!}
								{!! Form::label("NAME")!!}
								{!! Form::text("name", null, array('class'=>'form-control input-sm')) !!}		
							</div>
						</div>
						<div class="col-xs-4">
							<div class="form-group">
								{!! Form::label("DESCRIPTION")!!}
								{!! Form::textarea("description", null, array('class'=>'form-control input-sm', 'rows'=>'3')) !!}
							</div>
						</div>	
						<div>
							<div class="form-group">
								{!! Form::label("EXIT WORKFLOW")!!}	<br>						
								{!! Form::checkbox('exitworkflow', "Exit Workflow", false) !!}								
							</div>	
						</div>

						{{-- tabs --}}
						<div class="col-xs-12">
							<div class="form-group">
								<div role="tab-panel">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active">
											<a href="#state" aria-controls="state" role="tab" data-toggle="tab">Transition</a>
										</li>
									</ul>

									<div class="tab-content">
										@include('workflow.tabs.state.transition.create')
									</div>
								</div>
							</div>
						</div>

					</div>					
					{{-- /row --}}
				</div>

				{{-- footer --}}
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" onclick="return State.post()">Save</button>
				</div>

				{!! Form::close() !!}
				{{-- ./form-close --}}
			</div>
		</div>
	</div>
</div>	