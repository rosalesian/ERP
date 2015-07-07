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
		{!! Form::label('name', 'NAME', ['class'=>'col-xs-3 text-right']) !!}
		{!! Form::label('name', $workflow->name, ['class'=>'col-xs-9']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('description', 'DESCRIPTION', ['class'=>'col-xs-3 text-right']) !!}
		{!! Form::label('name', $workflow->description, ['class'=>'col-xs-9']) !!}
	</div>	
</div>

{{-- 2nd column --}}
<div class="col-xs-6">
	<div class="form-group">
		{!! Form::label('recordtype', 'RECORD TYPE', ['class'=>'col-xs-3 text-right']) !!}
		{!! Form::label('name', $workflow->recordType->name, ['class'=>'col-xs-9']) !!}	
	</div>
	<div class="form-group">
		{!! Form::label('condition', 'CONDITION', ['class'=>'col-xs-3 text-right']) !!}
		{!! Form::label('name', $workflow->condition, ['class'=>'col-xs-9']) !!}
	</div>	
</div>
@stop

{{-- line item tabs --}}
@section('line-item')
<div>
	<h4 style="margin-bottom: 0px; padding-bottom: 0px;">Workspace</h4>
	<hr>	
</div>
<div style="border: 1px solid black; height: 600px; padding: 10px 10px;">
	<span><button type="button" class="btn btn-default"><li class="fa fa-plus"></li>New State</button></span>
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