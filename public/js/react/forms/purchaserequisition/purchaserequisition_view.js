window.PRMainComponent = React.createClass({
	getInitialState : function () {
		return {
			data:{},
			type:'',
			date:'',
			deliveredto:'',
			remarks:'',
			totalamount:'',
			nameofrequester:''
		};
	},
	handleChangeCallBack : function (obj) {
		this.setState(obj);
	},
	render : function () {
		return (
			<div>
				<div className="box box-primary">
			    	<div className="box-header with-border">
			            <h3 className="box-title">Primary Information</h3>
			    	</div>
			       
			       <PrimaryComponent defaultValues={this.state} callBackParent={this.handleChangeCallBack} />
			    </div>

		        <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
					    <li><a href="#tab_2" data-toggle="tab">File</a></li>
					    <li><a href="#tab_3" data-toggle="tab">Notes</a></li>
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            <TableComponent table={TABLE} />
				        </div>
				        <div className="tab-pane" id="tab_2">
				        	
				        </div>
				        <div className="tab-pane" id="tab_3"></div>
				    </div>
	      		</div>
			</div>    
		);
	}
});

window.Wrapper = React.createClass({
	render : function () {
		return(
			 <div className="row">
				<div className="col-md-12"> 
					{ this.props.children }
				</div>
			</div>
		);
	}
});

window.FieldContainer = React.createClass({
	render : function () {
		return( <div className="col-md-4 col-sm-6 col-xs-12"> {this.props.children} </div> );
	}
});

window.PrimaryComponent = React.createClass({
	handleChangeCallBack : function (obj) {
		this.props.callBackParent(obj);
	},
	getDefaultProps : function () {
		return { defaultValues:{} }
	},
	getInitialState : function () {
		return {
			data:{}
		};
	},
	componentDidMount : function () {
		this.request = $.get(base_url+'/pr/request', function (response) {
			this.setState({data:JSON.parse(response)});
		}.bind(this));
	},
	componentWillUnmount : function () {
		this.request.abort();
	},
	render : function () {
		return (
			<Wrapper>
            	<FieldContainer>
        			<Type callBackParent={this.handleChangeCallBack}
        				defaultValue={this.props.defaultValues.type}
        				attributes={{name:"type", label:"TYPE",options:this.state.data.typelist}} />

        			<Date callBackParent={this.handleChangeCallBack} 
        				defaultValue={this.props.defaultValues.date} 
        				attributes={{name:"date", label:"DATE"}} />
        		</FieldContainer>

				<FieldContainer> 
        			<DeliveredTo callBackParent={this.handleChangeCallBack} 
        				defaultValue={this.props.defaultValues.deliver_to} 
        				attributes={{name:"deliver_to", label:"DELIVERED TO"}} />

        			<Remarks callBackParent={this.handleChangeCallBack} 
        				defaultValue={this.props.defaultValues.remarks} 
        				attributes={{name:"remarks", label:"REMARKS"}} />
        		</FieldContainer>

            	<FieldContainer>
            		<TotalAmount callBackParent={this.handleChangeCallBack} 
            			defaultValue={this.props.defaultValues.totalamount} 
            			attributes={{name:"totalamount", label:"TOTAL AMOUNT"}} />
            			
		          	<Requester callBackParent={this.handleChangeCallBack} 
		          		defaultValue={this.props.defaultValues.requester} 
		          		attributes={{name:"requester", label:"NAME OF REQUESTER",options:this.state.data.requesterlist}} />		
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
	storage:"items",
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
ReactDOM.render(<PRMainComponent />, document.getElementById("mainPR-container"));
// ReactDOM.render(<PrimaryComponent />, document.getElementById("pr_primary_form"));
// ReactDOM.render(<ClassificationComponent />, document.getElementById("pr_classification_form"));

// ReactDOM.render(<TableComponent table={TABLE}/>, document.getElementById("sublist-items"));