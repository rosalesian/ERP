window.PrimaryComponent = React.createClass({
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
var TABLE = {
	storage:"item_storage",
	columns: [
		{name: "item", displayName: "Item", className: "react-select-input-lineitem", fieldType: "select", data:[{value:"data1", label:"4000318 CDM FRUIT & NUT 6X24X65G", description:"this is data1", rate:"100"},{value:"data2", label:"4005793 CDM ROAST ALMOND 6X24X65G (CS)", description:"this is data2", rate:"250"},{value:"data3", label:"4000304 30G CDM FRUIT & NUT (1X12X24) 4000304 30G CDM FRUIT & NUT (1X12X24)", description:"this is data3", rate:"350"}]},
		{name: "description", displayName: "Description", fieldType: "text", className: "form-control"},
		{name: "uom", displayName: "Unit", className: "react-select-input-lineitem", fieldType: "select", data:[{value:"data1", label:"Data1"},{value:"data2", label:"Data2"}]},
		{name: "quantity", displayName: "Quantity", fieldType: "text", className: "form-control"},
		{name: "rate", displayName: "Rate", fieldType: "text", className: "form-control"},
		{name: "amount", displayName: "Amount", fieldType: "text", className: "form-control"}
	]
};
var initialData = [
	{item:"data1",description:"sample1",uom:"data1",quantity:"12",rate:"100",amount:"12000"},
	{item:"data2",description:"sample2",uom:"data1",quantity:"13",rate:"101",amount:"12000"},
	{item:"data1",description:"sample3",uom:"data1",quantity:"14",rate:"102",amount:"12000"},
	{item:"data2",description:"sample4",uom:"data1",quantity:"15",rate:"103",amount:"12000"},
	{item:"data2",description:"sample5",uom:"data1",quantity:"16",rate:"104",amount:"12000"},
	{item:"data1",description:"sample6",uom:"data1",quantity:"17",rate:"105",amount:"12000"},
	{item:"data2",description:"sample7",uom:"data1",quantity:"18",rate:"106",amount:"12000"},
	{item:"data1",description:"sample8",uom:"data1",quantity:"19",rate:"107",amount:"12000"}
];

ReactDOM.render(<LineItems table={TABLE}/>, document.getElementById("sublist-items"));
ReactDOM.render(<PrimaryComponent />, document.getElementById("pr_primary_form"));
ReactDOM.render(<ClassificationComponent />, document.getElementById("pr_classification_form"));


// ReactDOM.render(<TableComponent table={TABLE}/>, document.getElementById("line-items"));