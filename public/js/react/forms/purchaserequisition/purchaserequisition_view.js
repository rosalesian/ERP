window.PrimaryComponent = React.createClass({
	callBackCustomForm : function (event) {
		alert(event.value);
	},
	render : function () {
		return(
			<Wrapper>
            	<FieldContainer>
            		<InputTag attributes={{type:"select",id:"customform",name:"customform", label:"CUSTOM FORM",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"disabled", label:"PR#", placeholder:"To be generated"}}/>
        			<InputTag attributes={{type:"select",id:"requestingdepartment",name:"requestingdepartment", label:"REQUESTING DEPARTMENT",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"textarea",id:"remarks",name:"remarks", label:"Remarks",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>

            	<FieldContainer>
        			<InputTag attributes={{type:"select",id:"type",name:"type", label:"TYPE",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"date", id:"date", name:"date", label:"PR#"}}/>
        			<InputTag attributes={{type:"text",id:"deliveredto",name:"deliveredto", label:"DELIVERED TO"}}/>
        			<InputTag attributes={{type:"text",id:"totalamount",name:"totalamount", label:"TOTAL AMOUNT"}}/>
            	</FieldContainer>

            	<FieldContainer>
        			<InputTag attributes={{type:"select",id:"location",name:"location", label:"LOCATION",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
        			<InputTag attributes={{type:"label", label:"PLATE NO.", id:"plateno"}}/>
        			<InputTag attributes={{type:"label", label:"NEXT APPROVER ROLE", id:"nextapproverrole"}}/>   
            	</FieldContainer>
	        </Wrapper>
		);
	}
});

window.ClassificationComponent = React.createClass({
	render : function () {
		return(
			<Wrapper>
            	<FieldContainer>
		          	<InputTag attributes={{type:"select",id:"principal",name:"principal", label:"PRINCIPAL",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
            	
            	<FieldContainer>
		          	<InputTag attributes={{type:"disabled", label:"PO DATE"}}/>
            	</FieldContainer>

            	<FieldContainer>
		          	<InputTag attributes={{type:"select",id:"nameofrequester",name:"nameofrequester", label:"NAME OF REQUESTER",options:[{value:'data1',label:'Data 1'},{value:'data2',label:'Data 2'}]}}/>
            	</FieldContainer>
	        </Wrapper> 
		);
	}
});
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
// var TABLE = {
// 	storage:"item_storage",
// 	columns: [
// 		{name: "item", displayName: "Item", className: "react-select-input-lineitem", fieldType: "select", data:items},
// 		{name: "description", displayName: "Description", fieldType: "text", className: "form-control"},
// 		{name: "uom", displayName: "Unit", className: "react-select-input-lineitem", fieldType: "select", data:items},
// 		{name: "quantity", displayName: "Quantity", fieldType: "text", className: "form-control"},
// 		{name: "rate", displayName: "Rate", fieldType: "text", className: "form-control"},
// 		{name: "amount", displayName: "Amount", fieldType: "text", className: "form-control"},
// 		{name: "vatamount", displayName: "VAT Amount", fieldType: "text", className: "form-control"},
// 		{name: "grossamount", displayName: "Gross Amount", fieldType: "text", className: "form-control"}
// 	]
// };

// ReactDOM.render(<LineItems table={TABLE}/>, document.getElementById("line-items"));
ReactDOM.render(<PrimaryComponent />, document.getElementById("pr_primary_form"));
ReactDOM.render(<ClassificationComponent />, document.getElementById("pr_classification_form"));

ReactDOM.render(<TableComponent table={TABLE}/>, document.getElementById("sublist-items"));