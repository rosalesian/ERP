window.PrimaryComponent = React.createClass({
	callBackCustomForm : function (event) {
		alert(event.value);
	},
	render : function () {
		return(
			<Wrapper>
            	<FieldContainer>
        			<InputTag attributes={{type:"date", id:"date", name:"date", label:"DATE"}}/>
        			<InputTag attributes={{type:"select",id:"assetname",name:"assetname", label:"ASSET NAME",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"select",id:"request_department",name:"request_department", label:"REQUEST DEPARTMENT",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>

            	<FieldContainer>
        			<InputTag attributes={{type:"select",id:"approval",name:"approval", label:"APPROVAL STATUS",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"select",id:"preparedby",name:"preparedby", label:"PREPARED BY",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"select",id:"type_maintenamce",name:"type_maintenamce", label:"TYPE OF MAINTENANCE",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>

            	<FieldContainer>
		          	<InputTag attributes={{type:"textarea",id:"remarks",name:"remarks", label:"PURPOSE",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
            	
	        </Wrapper>
		);
	}
});

window.ClassPurchaseRequisition = React.createClass({
	render : function () {
		return (
			<Wrapper>
				<FieldContainer>
		          
		          	<InputTag attributes={{type:"select",id:"type",name:"type", label:"TYPE",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
		          	<InputTag attributes={{type:"select",id:"pricipal",name:"pricipal", label:"PRINCIPAL",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
			
				<FieldContainer>
		          	<InputTag attributes={{type:"textarea",id:"remarks",name:"remarks", label:"PURPOSE",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
			
				<FieldContainer>
		          	<InputTag attributes={{type:"select",id:"request_department",name:"request_department", label:"NAME OF REQUESTER",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
			</Wrapper>
		);
	}
});

var TABLE_DESCCRIPTION = {
	storage:"item_storage",
	columns: [
		{name: "description", displayName: "Description", fieldType: "text", className: "form-control"}
	]
};


var items = [
	{value:"data1", label:"4000318 CDM FRUIT & NUT 6X24X65G", description:"This is Data 1"},
	{value:"data2", label:"4005793 CDM ROAST ALMOND 6X24X65G (CS)", description:"This is Data 2"},
	{value:"data3", label:"4000304 30G CDM FRUIT & NUT (1X12X24)", description:"This is Data 3"}
];

var TABLE = {
	storage:"item_storage",
	columns: [
		{name: "item", displayName: "Item", className: "react-select-input-lineitem", fieldType: "select", data:items},
		{name: "description", displayName: "Description", fieldType: "disabled", className: "form-control"},
		{name: "uom", displayName: "Unit", className: "react-select-input-lineitem", fieldType: "select"},
		{name: "quantity", displayName: "Quantity", fieldType: "text", className: "form-control"},
		{name: "rate", displayName: "Rate", fieldType: "disabled", className: "form-control"},
		{name: "amount", displayName: "Amount", fieldType: "disabled", className: "form-control"},
		{name: "vatamount", displayName: "VAT Amount", fieldType: "disabled", className: "form-control"},
		{name: "grossamount", displayName: "Gross Amount", fieldType: "disabled", className: "form-control"},
		{name: "canvass", displayName: "Canvass", fieldType: "link"}
	]
};

ReactDOM.render(<PrimaryComponent />, document.getElementById("joborder_primaryform"));
ReactDOM.render(<TableComponent table={TABLE_DESCCRIPTION}/>, document.getElementById("description"));
ReactDOM.render(<ClassPurchaseRequisition />, document.getElementById("purchase_request"));
ReactDOM.render(<TableComponent table={TABLE}/>, document.getElementById("sublist-items"));