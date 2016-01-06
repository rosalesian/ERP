var workflow = (function($, plumb){
	//worklfow container
	var container = $("#workflow"),
		btnNewState = container.find("#new-state"),
		wfData;

	//dialog window
	var dialogBox = $("#workflow-state"),
		btnSave = dialogBox.find("#save-btn"),
		btnCancel = dialogBox.find("#cancel-btn");
	
	init();

	function init(){
		btnNewState.on("click" ,stateEntryForm );
		dialogBox.on("data.saved", renderState);
		dialogBox.on("hide.bs.modal", closeModal);
	}
	
	function loadStates(){
		//var states = getState("1/state");
		console.log(wfData);
		$.getJSON("1/state")
			.done(function(data){
				$.each( data, function(i, state){
					addNode(state.id, state.name);
				});
			})
			.fail(function(jqxhr, status, error){
				var err = status + " " + error;
				console.log("Failed: "+ err);
			});			
	}

	function createState(){
		console.log("create state");				
	}
	//render Modal
	function stateEntryForm(data){
		dialogBox.modal("show");

		btnSave.on("click", function(){
			var data = dialogBox.find("form").serializeArray();

			for(var i=0; i < data.length ; i++){
				var chkboxValue = dialogBox.find("#exitworkflow").prop("checked") ? "1" : "0";

				if(data[i].name == "exitworkflow"){
					data[i].value = chkboxValue;
				}
			}
			
			saveState($.param(data));

			dialogBox.modal("hide");
				
		});		
	}
	
	function renderState(e, data){
		console.log("render state");
 		addNode(data.id, data.name);
	}

	function saveState(data){
		postState("1/state", data);
	}

	function closeModal(){
		btnSave.off("click");
	}

	function getState(url, data){
		return $.ajax({
			url: url,
			type: "GET",
			data: {
				format: "json"
			},
			dataType: "jsonp",
			success: function(data){
				console.log("success")
				console.log(data);
			},
			error: function(e){
				console.log("fail");
				console.log(e);
			}
		});
	}

	function postState(url, data){
		$.ajax({
			url: url,
			type: "POST",
			data: data,
			success: function(data){
				dialogBox.trigger("data.saved", data);				
			}
		});
	}

	function updateState(){
		console.log("hello from updateState method");
	}

	function getStatePosition(){

	}

	function updateStatePosition(){
		var stateData = {
			name: "Testing State",
			description: "This is just a test",
			exitworkflow: true
		};

	}

	function destroyModal(modal){

	}

	function addNode(id, name){
		var workflowContainer = document.getElementById("workflow");		
		var nodeDiv = document.createElement('div');
		nodeDiv.id = "state-"+id;
		nodeDiv.innerHTML = name;
		nodeDiv.className = "state";
		nodeDiv.setAttribute("data-toggle","modal");
		nodeDiv.setAttribute("data-target","#state-form");
		var strong = document.createElement('strong');
		strong.appendChild(nodeDiv);
		workflowContainer.appendChild(strong);

		nodeDiv.ondrag = function(event){
			//update position table
			$.post("");
		}

		var plumb = jsPlumb.getInstance({
			  PaintStyle : {
			    lineWidth:13,
			    strokeStyle: 'rgba(200,0,0,100)'
			  },
			  DragOptions : { cursor: "crosshair" },
			  Endpoints : [ [ "Dot", { radius:7 } ], [ "Dot", { radius:11 } ] ],
			  EndpointStyles : [
			    { fillStyle:"#225588" }, 
			    { fillStyle:"#558822" }
			  ],
			  Connector: "Straight",
			  Container: "workflow"
		});

		plumb.draggable("state-"+id, {
			containment: false
		});

	}

	function setData(data){
		wfData = data;
		for(var i=0; i < wfData.length; i++){
		
	}

	function setContainer(el){
		container = el;
	}

	return {
		data: setData,

		container: setContainer
	};
}(jQuery, jsPlumb));