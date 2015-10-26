{{-- extend form layout --}}
@extends('layouts.formstatic', [
	'form_params' => ['route'=> 'workflow.store', 'method'=>'POST']
])

{{-- additional styles --}}	
@section('style-list')
<style type="text/css">

.state {
	width: 100px;
	height: 50px;
	border: 2px solid #89AD4D;
	margin: 2px 2px 2px 2px;
	text-align: center;
	position: absolute;
}
.modal-dialog{
	width: 900px;
}
.selected {
    background-color: #B0BED9;
}
#workflow {
	postion: relative;
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
			{!! Form::text('condition',$workflow->condition, ['class'=>'tagsinput']) !!}
		</div>
	</div>
	<div class="form-group">
		{!! Form::label('inactive', 'INACTIVE', ['class'=>'col-xs-3 control-label']) !!}
		<div class="col-xs-9">
			<label class="check">
				{!! Form::checkbox('inactive', false, $workflow->inactive, ['class'=>'icheckbox', 'disabled']) !!}
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
<div id="workflow" class="dropTarget" style="border: 1px solid black; height: 600px; padding: 10px 10px;">
	<span><button id="new-state" type="button" class="btn btn-success"><li class="fa fa-plus"></li>New State</button></span>

</div>

{{-- modal dialog --}}
<div id="workflow-state" class = "modal" data-keyboard="false" data-backdrop="static">
	<div class = "modal-dialog modal-lg">
		<div class = "modal-content">
			{{-- head --}}
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">New State</h4>					
			</div>
			{{-- form-open --}}
			{!! Form::open(['state-form', 'method' => 'POST', 'route'=> 'workflow.state.store']) !!}

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
								{!! Form::textarea("description", null, array('class'=>'form-control', 'rows'=>'2')) !!}
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
					<div class="panel panel-default tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="active">
									<a href="#state" role="tab" data-toggle="tab">Action</a>
								</li>
								<li>
									<a href="#state" role="tab" data-toggle="tab">Transition</a>
								</li>
							</ul>
						<div class="panel-body tab-content table">
								@include('workflow.tabs.state.transition.create')					
						</div>
					</div>
				</div>			
			</div>

			{{-- footer --}}
			<div class="modal-footer">
				<button id="cancel-btn" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button id="save-btn" type="button" class="btn btn-primary save-btn">Save</button>
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
{!! HTML::script('js/plugins/custom/plugin.js') !!}
{!! HTML::script('js/workflow.js') !!}
{!! HTML::script('js/cust-table.js') !!}

<script>
workflow.data({!! $workflow->states !!})

// $(document).ready(function(){
// 	$.ajax({
// 		url: "1/state",
// 		type: "get",
// 		success: function(states){
// 			for(var i in states){
// 				//console.log(states[i]);
// 				addNode(states[i].name, states[i].name);
// 			}
// 		}
// 	});

// 	$(".save-btn").click( function(){
// 		$.ajax({
// 			url: "1/state",
// 			type: "post",
// 			data: {
// 				"name": $("input[name=name]").val(),
// 				"_token": $("input[name=_token]").val(),
// 				"description": $("#description").val(),
// 				"workflow_id": 1,
// 				"exitworkflow": $("#exitworkflow").prop("checked") ? 1 : 0
// 			},
// 			success: function(data){
// 				console.log(data)
// 				addNode(data.name, data.name);
// 			}
// 		});
// 	});


// 	//table initialization	
// 	$("#line-item").itemTable({
// 		columns:[
// 			{
// 				name: "Name",
// 				field : {
// 					name: "action-name",
// 					type: "select",
// 					value: [
// 								{value:'addButton',display:'Add Approval Button'},
// 								{value:'setFieldValue',display:'Set Field Value'}
// 						   ],

// 					attr: {
// 						class: "form-control select"
// 					}
// 				}
// 			},
// 			{
// 				name: "Description",
// 				field : {
// 					name: "action-desc",
// 					type: "textarea",
// 					attr: {
// 						class: "form-control",
// 						rows: 2,
// 						cols:2
// 					}
// 				}
// 			}
// 		]
// 	});	

// 	$('#state-form').on('show.bs.modal', function (e) {
//   		console.log("modal shown");
// 	});	
// });

// function addNode(id, name){
// 	var workflowContainer = document.getElementById("workflow");
// 	var nodeDiv = document.createElement('div');
// 	nodeDiv.id = id;
// 	nodeDiv.innerHTML = name;
// 	nodeDiv.className = "state";
// 	nodeDiv.setAttribute("data-toggle","modal") 
// 	nodeDiv.setAttribute("data-target","#state-form")
// 	var strong = document.createElement('strong')
// 	strong.appendChild(nodeDiv);
// 	workflowContainer.appendChild(strong);

// 	var plumb = jsPlumb.getInstance({
// 		  PaintStyle : {
// 		    lineWidth:13,
// 		    strokeStyle: 'rgba(200,0,0,100)'
// 		  },
// 		  DragOptions : { cursor: "crosshair" },
// 		  Endpoints : [ [ "Dot", { radius:7 } ], [ "Dot", { radius:11 } ] ],
// 		  EndpointStyles : [
// 		    { fillStyle:"#225588" }, 
// 		    { fillStyle:"#558822" }
// 		  ],
// 		  Connector: "Straight",
// 		  Container: "workflow"
// 	});

// 	plumb.draggable(id);
// }

// function postState(data){
// 	$.ajax({
// 		method: "POST",
// 		url: "workflow/state",
// 		data: data
// 	})
// 	.done(function(msg){
// 		console.log("posting success " + msg);
// 	});
// }
</script>
@stop