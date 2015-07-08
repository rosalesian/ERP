{{-- extend form layout --}}
@extends('layouts.form', [
	'form_params' => ['route'=> 'workflow.store', 'method'=>'POST']
])

{{-- additional styles --}}	
@section('style-list')
<style type="text/css">

.state {
	width: 100px;
	height: 50px;
}

.modal-dialog{
	width: 900px;
}
</style>
@stop

{{-- buttons --}}
@section('buttons')
	{!! link_to(URL::current() . '/edit', 'Edit', ['class' => 'btn btn-primary']) !!}
	{!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default']) !!}
@stop

{{-- form title --}}
@section('form-title')
	Workflow: {{$workflow->name}}
@stop

{{-- main line content --}}
@section('main')
{{-- 1st column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('name', 'NAME', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<p class="form-control-static">{{$workflow->name}}</p>
		</div>		
	</div>
	<div class="form-group">
		{!! Form::label('description', 'DESCRIPTION', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<p class="form-control-static">{{$workflow->description}}</p>
		</div>
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<p class="form-control-static">{{$workflow->recordType->name}}</p>
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('condition', 'CONDITION', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			{!! Form::text('condition',"First,Second,Third", ['class'=>'tagsinput', 'disabled']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('inactive', 'INACTIVE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<label class="check">
				{!! Form::checkbox('inactive', false, true, ['class'=>'icheckbox', 'disabled']) !!}
			</label>
		</div>
	</div>
</div>
@stop

{{-- line item tabs --}}
@section('line-item')
<div>
	<h4 style="margin-bottom: 0px; padding-bottom: 0px;">Workspace</h4>
	<hr>	
</div>
<div id="workflow-container" style="border: 1px solid black; height: 600px; padding: 10px 10px;">
	<span><button id="state-button" type="button" class="btn btn-success" data-toggle="modal" data-target="#state-form"><li class="fa fa-plus"></li>New State</button></span>
</div>

{{-- modal dialog --}}
<div id="state-form" class = "modal" data-keyboard="false" data-backdrop="static">
	<div class = "modal-dialog modal-lg">
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
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::hidden("workflow_id", $workflow->id) !!}
							{!! Form::label("name","NAME", ['class'=>'col-xs-3 control-label'])!!}
							<div class="col-xs-9">
								{!! Form::text("name", null, array('class'=>'form-control')) !!}
								<span class="help-block">Type the name of the state</span>
							</div>
						</div>
						<div class="form-group">
							{!! Form::label("exitworkflow","EXIT WORKFLOW", ['class'=>'col-xs-3 control-label'])!!}
							<div class="col-xs-9">
								<label class="check">
									{!! Form::checkbox('exitworkflow', false, false, ['class'=>'icheckbox']) !!}
								</label>
								<span class="help-block">Set if you want the workflow to exit this state</span>
							</div>														
						</div>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							{!! Form::label("description","DESCRIPTION", ['class'=>'col-xs-3 control-label'])!!}
							<div class="col-xs-9">
								{!! Form::textarea("description", null, array('class'=>'form-control', 'rows'=>'3')) !!}
								<span class="help-block">Type the description of the state</span>
							</div>
							
						</div>
					</div>
				</div>					
				{{-- /row --}}
			</div>

			<div class="modal-body">
				{{-- tabs --}}
				<div class="row">
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
@stop

{{-- attached javascript files here --}}
@section('script-list')
	{{-- jsPlumb core --}}
	{!! HTML::script('js/plugins/jsplumb/jquery.jsPlumb-1.7.5-min.js') !!}

	<script type="text/javascript">

	jsPlumb.ready(function () {
		    var instance = jsPlumb.getInstance({
		        // default drag options
		        DragOptions: { cursor: 'pointer', zIndex: 2000 },
		        // the overlays to decorate each connection with.  note that the label overlay uses a function to generate the label text; in this
		        // case it returns the 'labelText' member that we set on each connection in the 'init' method below.
		        ConnectionOverlays: [
		            [ "Arrow", { location: 1 } ],
		            [ "Label", {
		                location: 0.1,
		                id: "label",
		                cssClass: "aLabel"
		            }]
		        ],
		        Container: "workflow-container"
		    });

		    instance.draggable(jsPlumb.getSelector("#workflow-container .state"), { grid: [20, 20] });
	});

	var State = (function(jq){
		var form = jq(this);
		jq.ajaxSetup({
			headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
		});

		return {
			create: function(data){
				var state = document.createElement("div");
				state.id = "state" + data.id;
				state.className = "state";
				state.innerHTML = data.name;				
				jq("#workflow-container").appendChild(state);
			},

			post : function(payload){
				var method = form.find('input[name="_method"]').val() || 'POST';
				
				jq.ajax({
					url: 'state',
					type: method,
					data: jq(this).serialize()
				})
				.done(function(response){
					console.log(response);

					if(response.status == "failed"){
						alert("error");
					}
					else{
						alert("success");
					}
				})
				.error(function(response){
					var errors = response.responseJSON;
					console.log("server errors", errors);
				});
			},

			get: function(id){

			},

			update: function(id){

			}
		};
	})(jQuery);
	
	$("#state-form").draggable({
		handle: ".modal-header"
	});
	</script>
@stop