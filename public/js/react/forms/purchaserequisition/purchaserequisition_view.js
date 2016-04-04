window.PRMainComponent = React.createClass({
	getDefaultProps : function () {
		return { 
			data:{},
			context:''
		};
	},
	getInitialState : function () {
		return {
			data : {},
			pr_id: (typeof this.props.data.id=='undefined') ? '' : this.props.data.id,
			type_id : (typeof this.props.data.type_id=='undefined') ? '' : this.props.data.type_id,
			date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
			deliver_to : (typeof this.props.data.deliver_to=='undefined') ? '' : this.props.data.deliver_to,
			remarks : (typeof this.props.data.remarks=='undefined') ? '' : this.props.data.remarks,
			total_amount : (typeof this.props.data.total_amount=='undefined') ? '' : this.props.data.total_amount,
			requester : (typeof this.props.data.requester=='undefined') ? '' : this.props.data.requester
		};
	},
	handleChangeCallBack : function (obj) {
		this.setState(obj);
	},
	handleCallBackLine : function (data) {
		var total = 0;
		for(var i in data) {
			total+=parseInt(data[i].quantity);
		}
		this.setState({totalamount:total});
	},
	render : function () {
		return (
			<div>
				<div className="box box-primary">
			    	<div className="box-header with-border">
			            <h3 className="box-title">Primary Information</h3>
			    	</div>
			       
			       <PrimaryComponent context={this.props.context} defaultValues={this.state} callBackParent={this.handleChangeCallBack} />
			    </div>

		        <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
					    <li><a href="#tab_2" data-toggle="tab">File</a></li>
					    <li><a href="#tab_3" data-toggle="tab">Notes</a></li>
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            
				            <PRTable callBackParent={this.handleCallBackLine}
				            data={this.props.items}
				            pr_id={this.state.pr_id}
				            context={this.props.context} />

				        </div>
				        <div className="tab-pane" id="tab_2"> </div>
				        <div className="tab-pane" id="tab_3"> </div>
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
		return { 
			defaultValues:{},
			context:''
		}
	},
	render : function () {
		return (
			<Wrapper>
            	<FieldContainer>
            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.type_id}
    				attributes={{name:"type_id", label:"TYPE"}} />

        			<DateMainComponent callBackParent={this.handleChangeCallBack}
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.date} 
        				attributes={{name:"date", label:"DATE"}} />	
        		</FieldContainer>

				<FieldContainer> 
    				<TextMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.deliver_to} 
    				attributes={{name:"deliver_to", label:"DELIVERED TO"}} />

        			<TextAreaMainComponent callBackParent={this.handleChangeCallBack} 
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.remarks}
        				attributes={{name:"remarks", label:"REMARKS"}} />
        		</FieldContainer>

            	<FieldContainer>
            		<TextMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.total_amount}
    				attributes={{name:"total_amount", label:"TOTAL AMOUNT"}} />

            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.requester}
    				attributes={{name:"requester", label:"NAME OF REQUESTER"}} />
            	</FieldContainer>
	        </Wrapper>
		);
	}
});

/*******************************************************************
********************************************************************
********************************************************************
********************************************************************
********************************************************************
*******************************************************************/

window.PRTable = React.createClass({
	getDefaultProps : function () {
		return {
			editLineItem:false,
			data:[],
			pr_id:''
		};
	},
	getInitialState : function () {
		var dataStorage = [];
		var rows=[];
		if(this.props.data.length!=0) {
			dataStorage = this.props.data;
			rows=[];
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							pr_id={this.props.pr_id}
							context={this.props.context}
							handleCallBackParentClick={this.handleCallBackClick} />
			}
		}
		return {
			editLineItem:this.props.editLineItem,
			dataStorage:dataStorage,
			rows:rows,
			item_id:'',
			unit_id:'',
			description:'',
			item_label:'',
			uom_label:'',
			quantity:'',
			pr_id:this.props.pr_id
		};
	},
	_initial_data : function () {
		var state = {};
			state.item_id = '';
			state.item_label='';
			state.description='';
			state.uom_label='';
			state.unit_id = ''
			state.quantity='';
		return state;
	},
	render : function () {
		if(this.props.context=='view') {
			return (
				<div className="tableWrapper">
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Item</th>
							<th>Description</th>
							<th>Units</th>
							<th>Quantity</th>
							<th>Canvass</th>
						</tr>
					</thead>
					<tbody>
						{this.state.rows.map(function (row){
							return row
						})}
					</tbody>
					</table>
				</div>
			);
		} else {
			var that = this;
			return (
				<div className="tableWrapper">
					<DataStorage data={this.state.dataStorage} name="items" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Item</th>
							<th>Description</th>
							<th>Units</th>
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody>
						{this.state.rows.map(function (row){
							return row
						})}
						
						{!this.state.editLineItem && (
							<TableRow callBackParent={this.handleCallBack}
							create={true}
							id={this.state.rows.length}
							defaultValues={this.state} />
						)}
						
						<tr>
							<td colSpan='4'>
								{!this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add"} className={"btn btn-primary btn-flat"} onClick={that.handleAdd} /> )}
								{!this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} value={"Cancel"} className={"btn btn-default btn-flat"} onClick={that.handleCancel} /> )}
								{this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add New"} className={"btn btn-info btn-flat"} onClick={that.handleCancel} /> )}
							</td>
						</tr>
					</tbody>
					</table>
				</div>
			);
		}
	},
	handleCallBack : function (obj) {
		if(obj.context=='create') {
			this.setState(obj);
		} else {
			var rows = this.state.rows;
			var state = this.state;
			
			switch(obj.name) {
				case "item_id":
						state.item_id = obj.item_id;
						state.description = obj.description;
						state.item_label = obj.item_label;
					break;
				case "unit_id":
						state.unit_id = obj.unit_id;
						state.uom_label = obj.uom_label;
					break;
				case "quantity":
						state.quantity=obj.quantity;
					break;	
			}
			rows[obj.id] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={state}
							edit={true}
							id={obj.id}
							handleCallBackParentClick={this.handleCallBackClick} />
			this.setState(state);
			this.setState({rows:rows});
		}

	},
	handleAdd : function () {// ADD FUNCTION
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.push( <TableRow callBackParent={this.handleCallBack}
					defaultValues={this.state} id={rows.length} key={rows.length} handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj = {
			id:'',
			item_id:this.state.item_id,
			item_label:this.state.item_label,
			description: this.state.description,
			unit_id:this.state.unit_id,
			uom_label:this.state.uom_label,
			quantity:this.state.quantity
		};
		dataStorage.push(obj);
		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage});
		this.props.callBackParent(dataStorage);
	},
	handleCallBackClick : function (id) {
		if(this.props.context!='view'){
		var elemArr = id.split('-');
		var rowid = parseInt(elemArr[1]-1);
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.length=0;

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(i==rowid) {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							edit={true}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			}
		}
		rows.splice(elemArr[1], 0, (<UpdateButtons
									dataIndex={rowid}
									callbackUpdate={this.handleUpdate}
									callbackCancel={this.handleCancel}
									callbackRemove={this.handleRemove}/>));
		var state = this.state;
		state.item_id = dataStorage[rowid].item_id;
		state.item_label = dataStorage[rowid].item_label;
		state.unit_id = dataStorage[rowid].unit_id;
		state.uom_label = dataStorage[rowid].uom_label;
		state.description = dataStorage[rowid].description;
		state.quantity = dataStorage[rowid].quantity;
		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {// UPDATE FUNCTION
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;
		dataStorage[id].item_id = this.state.item_id;
		dataStorage[id].item_label = this.state.item_label;
		dataStorage[id].description = this.state.description;
		dataStorage[id].unit_id = this.state.unit_id;
		dataStorage[id].uom_label = this.state.uom_label;
		dataStorage[id].quantity = this.state.quantity;


		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
		}
		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
		this.props.callBackParent(dataStorage);
	},
	handleRemove : function (id) {// REMOVE FUNCTION
		var dataStorage = this.state.dataStorage;
		dataStorage.splice(id,1);
		var rows = this.state.rows;
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
		}

		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
	},
	handleCancel : function () {// CANCEL FUNCTION
		if(this.state.editLineItem) {
			var rows = this.state.rows;
			var dataStorage = this.state.dataStorage;
			rows.length=0;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
								defaultValues={dataStorage[i]}
								id={i}
								key={i}
								handleCallBackParentClick={this.handleCallBackClick} />
			}
			this.setState(this._initial_data()); //empty state values
			this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
		} else {
			this.setState(this._initial_data()); //empty state values
		}
	}
});

window.UpdateButtons = React.createClass({
	handleUpdate : function () {
		this.props.callbackUpdate(this.props.dataIndex);
	},
	handleCancel : function () {
		this.props.callbackCancel();
	},
	handleRemove : function () {
		this.props.callbackRemove(this.props.dataIndex);
	},
	render : function () {
		return (
				<tr colSpan="4"><td colSpan="4">
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleUpdate} value={"OK"} className={"btn btn-primary btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleCancel} value={"Cancel"} className={"btn btn-default btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleRemove} value={"Remove"} className={"btn btn-default btn-flat"}/>
				</td></tr>
		);
	}
});

window.TableRow = React.createClass({
	getDefaultProps : function () {
		return {
			create:false,
			edit:false,
			id:'',
			pr_id:'',
			context:''
		}
	},
	render : function () {
		if(this.props.context=='view') {
			return (
				<tr>
					<td>{this.props.defaultValues.item_label}</td>
					<td>{this.props.defaultValues.description}</td>
					<td>{this.props.defaultValues.uom_label}</td>
					<td>{this.props.defaultValues.quantity}</td>
					<td><a href={"#"} data-toggle={"modal"} data-target={"#myModal"} onClick={this.displayModal.bind(this,this.props.defaultValues)}><i className="fa fa-toggle-up" style={{fontSize:"25px",marginLeft:"30%"}}></i></a></td>
				</tr>
			);
		} else {
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<Item callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.item_id} />

						<Description callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.description} />

						<UOM callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getUOM/'+this.props.defaultValues.item_id}
						defaultValue={this.props.defaultValues.unit_id} />

						<Quantity callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity"}} />
					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<Item callBackParent={this.handleCallBack}
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.item_id}  />

						<Description callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.description} />

						<UOM callBackParent={this.handleCallBack}
						source={base_url+'/ajax/getUOM/'+this.props.defaultValues.item_id}
						defaultValue={this.props.defaultValues.unit_id} />

						<Quantity callBackParent={this.handleCallBack}
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity"}} />
					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.item_label}</td>
							<td>{this.props.defaultValues.description}</td>
							<td>{this.props.defaultValues.uom_label}</td>
							<td>{this.props.defaultValues.quantity}</td>
						</tr>
					);
				}
			}
		}
	},
	displayModal : function (defaultValues, evt) {
		$.ajax({
		url:base_url+'/api/1.0/pritem/'+this.props.defaultValues.id+'/canvass',
		type:'GET',
		success : function (response) {
			var data = JSON.parse(response.canvasses);
			var canvasses=[];
			for(var i in data) {
				canvasses.push({
					vendor_id:data[i].vendor_id,
					vendor_label:data[i].vendor_id,
					terms_id:data[i].terms_id,
					terms_label:data[i].terms_id,
					cost:data[i].cost
				});
			}
			
			ReactDOM.render(<CanvassComponent defaultValues={defaultValues}
							data={canvasses}
				            context='create' />, document.getElementById('myModal'));
		}.bind(this)
		});
	},
	handleClick : function (evt) {
		this.props.handleCallBackParentClick(evt.currentTarget.id);
	},
	handleCallBack : function (obj) {
		if(this.props.create){
			obj.context = 'create';
		} else {
			obj.context = 'edit';
			obj.id = this.props.id;
		}
		this.props.callBackParent(obj);
	}
});



// var items = [
// 	{value:"data1", label:"4000318 CDM FRUIT & NUT 6X24X65G", description:"This is Data 1"},
// 	{value:"data2", label:"4005793 CDM ROAST ALMOND 6X24X65G (CS)", description:"This is Data 2"},
// 	{value:"data3", label:"4000304 30G CDM FRUIT & NUT (1X12X24)", description:"This is Data 3"}
// ];

// var TABLE = {
// 	storage:"items",
// 	columns: [
// 		{name: "item", displayName: "ITEM", className: "react-select-input-lineitem", fieldType: "select"},
// 		{name: "description", displayName: "DESCRIPTION", fieldType: "disabled", className: "form-control"},
// 		{name: "uom", displayName: "UNIT", className: "react-select-input-lineitem", fieldType: "select"},
// 		{name: "quantity", displayName: "QUANTITY", fieldType: "text", className: "form-control"},
// 		{name: "rate", displayName: "RATE", fieldType: "disabled", className: "form-control"},
// 		{name: "amount", displayName: "AMOUNT", fieldType: "disabled", className: "form-control"},
// 		{name: "vatamount", displayName: "VAT AMOUNT", fieldType: "disabled", className: "form-control"},
// 		{name: "grossamount", displayName: "GROSS AMOUNT", fieldType: "disabled", className: "form-control"},
// 		{name: "canvass", displayName: "CANVASS", fieldType: "link"}
// 	]
// };
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

// ReactDOM.render(<PrimaryComponent />, document.getElementById("pr_primary_form"));
// ReactDOM.render(<ClassificationComponent />, document.getElementById("pr_classification_form"));

// ReactDOM.render(<TableComponent table={TABLE}/>, document.getElementById("sublist-items"));