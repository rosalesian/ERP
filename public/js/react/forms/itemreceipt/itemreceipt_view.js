window.IRMainComponent = React.createClass({
	getDefaultProps : function () {
		return { 
			data:[],
			context:''
		};
	},
	getInitialState : function () {
		if(this.props.context=='create') {
			return {
				data : {},
				purchaseorder_id: (typeof this.props.purchaseorder.id=='undefined') ? '' : this.props.purchaseorder.id,
				type_id : (typeof this.props.data.type_id=='undefined') ? '' : this.props.data.type_id,
				vendor_id : (typeof this.props.data.vendor_id=='undefined') ? '' : this.props.data.vendor_id,
				paymenttype_id : (typeof this.props.data.paymenttype_id=='undefined') ? '' : this.props.data.paymenttype_id,
				terms_id : (typeof this.props.data.terms_id=='undefined') ? '' : this.props.data.terms_id,
				date : (typeof this.props.purchaseorder.date=='undefined') ? '' : this.props.purchaseorder.date,
				delivered_to : (typeof this.props.purchaseorder.delivered_to=='undefined') ? '' : this.props.purchaseorder.delivered_to,
				remarks : (typeof this.props.purchaseorder.memo=='undefined') ? '' : this.props.purchaseorder.memo,
				requested_by : (typeof this.props.data.requested_by=='undefined') ? '' : this.props.data.requested_by,
				items:(typeof this.props.data.items=='undefined') ? [] : this.props.data.items,
				total:''
			};
		} else if (this.props.context=='view'){
			return {
				data : {},
				purchaseorder_id: (typeof this.props.data.purchaseorder_id=='undefined') ? '' : this.props.data.purchaseorder_id,
				date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
				delivered_to : (typeof this.props.data.created_by=='undefined') ? '' : this.props.data.created_by,
				remarks : (typeof this.props.data.remarks=='undefined') ? '' : this.props.data.remarks,
				items:(typeof this.props.data.items=='undefined') ? [] : this.props.data.items,
				total:''
			};
		} else {
			return {
				data : {},
				purchaseorder_id: (typeof this.props.data.purchaseorder_id=='undefined') ? '' : this.props.data.purchaseorder_id,
				date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
				delivered_to : (typeof this.props.data.created_by=='undefined') ? '' : this.props.data.created_by,
				remarks : (typeof this.props.data.remarks=='undefined') ? '' : this.props.data.remarks,
				items:(typeof this.props.data.items=='undefined') ? [] : this.props.data.items,
				total:''
			};
		}
	},
	handleChangeCallBack : function (obj) {
		this.setState(obj);
	},
	handleCallBackLine : function (data) {
		var total = 0;
		for(var i in data) {
			total+=parseInt(data[i].quantity);
		}
		this.setState({total:total});
	},
	render : function () {
		return (
			<div>
				<div className="box box-primary">
			    	<div className="box-header with-border">
			            <h3 className="box-title">Primary Information</h3>
			    	</div>
			       
			       <IRPrimaryComponent
			       context={this.props.context}
			       defaultValues={this.state}
			       lists={this.props.lists}
			       callBackParent={this.handleChangeCallBack} />
			    </div>

		        <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
					    <li><a href="#tab_2" data-toggle="tab">File</a></li>
					    <li><a href="#tab_3" data-toggle="tab">Notes</a></li>
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            
				            <IRTable callBackParent={this.handleCallBackLine}
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

window.IRWrapper = React.createClass({
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

window.IRFieldContainer = React.createClass({
	render : function () {
		return( <div className="col-md-4 col-sm-6 col-xs-12"> {this.props.children} </div> );
	}
});

window.IRPrimaryComponent = React.createClass({
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
			<IRWrapper>
            	<IRFieldContainer>
            		<TextMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.purchaseorder_id} 
    				attributes={{name:"purchaseorder_id", label:"PO#"}} />

            		<TextMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.delivered_to} 
    				attributes={{name:"delivered_to", label:"DELIVERED TO"}} />
        		</IRFieldContainer>

				<IRFieldContainer> 
        			<DateMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.date} 
    				attributes={{name:"date", label:"DATE"}} />
        		</IRFieldContainer>

            	<IRFieldContainer>
            		<TextAreaMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.remarks}
    				attributes={{name:"remarks", label:"MEMO"}} />	
            	</IRFieldContainer>
	        </IRWrapper>
		);
	}
});

/*******************************************************************
********************************************************************
*******************************************************************/
window.DataStorageIR = React.createClass ({
	render : function () {
		var data = [];
		for(var i=0, counter=this.props.data.length; i<counter; i++) {
			if(this.props.data[i].isReceived) {
				data.push(this.props.data[i]);
			}
		}
		return( <input type="hidden" name={this.props.name} value={JSON.stringify(data)}/> )
	}
});

window.IRTable = React.createClass({
	getDefaultProps : function () {
		return { data:[], context:'' };
	},
	getInitialState : function () {
		var rows=[], dataStorage=[];
		if(this.props.data.length!=0) {
			dataStorage = this.props.data;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				dataStorage[i].isReceived=true;
				dataStorage[i].remaining = dataStorage[i].quantity_received;
				rows[i] = <IRRow callBackParent={this.handleChange}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							context={this.props.context}
							callBackReceiveIR={this.callBackReceiveIR} />;
			}
		}

		return {
			rows:rows,
			dataStorage:dataStorage
		};
	},
	handleChange : function (obj) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		dataStorage[obj.index][obj.name] = obj[obj.name];
		rows[obj.index] = <IRRow callBackParent={this.handleChange} 
							defaultValues={dataStorage[obj.index]}
							id={obj.index}
							key={obj.index}
							callBackReceiveIR={this.callBackReceiveIR} />;

		this.setState({dataStorage:dataStorage, rows:rows});						
	},
	callBackReceiveIR: function (obj) {
		if(obj.isReceived) {
			var dataStorage = this.state.dataStorage;
			dataStorage[obj.index]['isReceived'] = obj.isReceived;
			dataStorage[obj.index]['quantity_received'] = dataStorage[obj.index]['remaining']; 
			var rows = this.state.rows;
			rows[obj.index] = <IRRow callBackParent={this.handleChange} 
								defaultValues={dataStorage[obj.index]}
								id={obj.index}
								key={obj.index}
								callBackReceiveIR={this.callBackReceiveIR} />;	
		} else {
			var dataStorage = this.state.dataStorage;
			dataStorage[obj.index]['isReceived'] = obj.isReceived;
			var rows = this.state.rows;
			rows[obj.index] = <IRRow callBackParent={this.handleChange} 
								defaultValues={dataStorage[obj.index]}
								id={obj.index}
								key={obj.index}
								callBackReceiveIR={this.callBackReceiveIR} />;
		}

		this.setState({dataStorage:dataStorage, rows:rows});
	},
	render : function () {
		if(this.props.context=='view') {
			return (
				<div className="tablePOWrapper">
					<DataStorageIR data={this.state.dataStorage} name="items" />
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
					</tbody>
					</table>
				</div>
			);
		} else {
			return (
				<div className="tablePOWrapper">
					<DataStorageIR data={this.state.dataStorage} name="items" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Receive</th>
							<th>Item</th>
							<th>Description</th>
							<th>Units</th>
							<th>Remaining</th>
							<th>Quantity</th>
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
		}
	}
});

window.ReceiveIRCheckBox = React.createClass({
	getInitialState : function () {
		return { defaultChecked:this.props.defaultChecked };
	},
	handleChange : function (evt) {
		this.setState({defaultChecked:evt.target.checked});
		this.props.callBackReceiveIR({index:this.props.index, isReceived:evt.target.checked});
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="checkbox"
            	checked={this.state.defaultChecked ? 'checked': null}
            	name={this.props.name}
            	id={this.props.name} />
			</td> 
		);
	}
});

window.IRRow = React.createClass({
	getDefaultProps: function () {
		return { defaultValues:{} };
	},
	render: function() {
		if(this.props.context=='view') {
			return(
				<tr>
					<td>{this.props.defaultValues.purchaseorderitem_label}</td>
					<td>{this.props.defaultValues.description}</td>
					<td>{this.props.defaultValues.uom_label}</td>
					<td>{this.props.defaultValues.quantity_received}</td>

				</tr>
				);
		} else {
			return(
				<tr id={"item-"+parseInt(this.props.id+1)}>
					<ReceiveIRCheckBox name="receive"
					defaultChecked={this.props.defaultValues.isReceived}
					index={this.props.id}
					callBackReceiveIR={this.props.callBackReceiveIR}/>

					<DisplayLineComponent defaultValue={this.props.defaultValues.purchaseorderitem_label} />
					<DisplayLineComponent defaultValue={this.props.defaultValues.description} />
					<DisplayLineComponent defaultValue={this.props.defaultValues.uom_label} />
					<DisplayLineComponent defaultValue={this.props.defaultValues.remaining} />
					
					<TextLineComponent callBackParent={this.handleCallBack}
					name="quantity_received"
					defaultValue={this.props.defaultValues.quantity_received}
					isReceived={this.props.defaultValues.isReceived}/>
				</tr>
			);
		}
	},
	handleCallBack : function (obj) {
		obj.index = this.props.id;
		this.props.callBackParent(obj);
	}
});

