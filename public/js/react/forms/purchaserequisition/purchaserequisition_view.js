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
			       
			       <PrimaryComponent lists={ this.props.lists }
		       		context={this.props.context}
		       		defaultValues={this.state}
		       		callBackParent={this.handleChangeCallBack} />
			    
			    </div>

		        <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
					    <li><a href="#tab_2" data-toggle="tab">Notes</a></li>
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            
				            <PRTable callBackParent={this.handleCallBackLine}
				            data={this.props.items}
				            pr_id={this.state.pr_id}
				            context={this.props.context} />

				        </div>
				        <div className="tab-pane" id="tab_2"> </div>
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
		if(this.props.context=='create' || this.props.context=='edit'){
			return (
				<Wrapper>
	            	<FieldContainer>
	            		<InputMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.requester}
	    				attributes={{name:"requester", type:"select", label:"NAME OF REQUESTER"}} />

	    				<InputMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.type_id}
	    				attributes={{name:"type_id", type:"select", label:"TYPE"}} />

	    				<InputMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.date}
	    				attributes={{name:"date", type:"date", label:"DATE"}} />	
	        		</FieldContainer>

					<FieldContainer>
	    				<InputMainComponent callBackParent={this.handleChangeCallBack} 
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.deliver_to} 
	    				attributes={{name:"deliver_to", type:"text", label:"DELIVER TO"}} />

	        			<InputMainComponent callBackParent={this.handleChangeCallBack} 
	        				context={this.props.context}
	        				defaultValue={this.props.defaultValues.remarks}
	        				attributes={{name:"remarks", type:"textarea", label:"REMARKS"}} />
	        		</FieldContainer>

	            	<FieldContainer>
	            		<SummaryComponent defaultValue={'1000'}/>
	            	</FieldContainer>
		        </Wrapper>
			);
		} else {
			return (
				<Wrapper>
	            	<FieldContainer>
	            		<InputMainComponent context={this.props.context}
	    				defaultValue={this.props.defaultValues.requester}
	    				attributes={{name:"requester", label:"NAME OF REQUESTER"}} />

	    				<InputMainComponent context={this.props.context}
	    				defaultValue={this.props.defaultValues.type_id}
	    				attributes={{name:"type_id", label:"TYPE"}} />

	    				<InputMainComponent context={this.props.context}
	    				defaultValue={this.props.defaultValues.date}
	    				attributes={{name:"date", label:"DATE"}} />	
	        		</FieldContainer>

					<FieldContainer>
	    				<InputMainComponent context={this.props.context}
	    				defaultValue={this.props.defaultValues.deliver_to} 
	    				attributes={{name:"deliver_to", label:"DELIVER TO"}} />

	        			<InputMainComponent context={this.props.context}
        				defaultValue={this.props.defaultValues.remarks}
        				attributes={{name:"remarks", label:"REMARKS"}} />      				
	        		</FieldContainer>

	            	<FieldContainer>
	            		<SummaryComponent defaultValue={'1000'}/>
	            	</FieldContainer>
		        </Wrapper>
			);
		}
		
	}
});

/*******************************************************************
********************************************************************
********************************************************************
********************************************************************
********************************************************************
*******************************************************************/
window.DataStorage = React.createClass ({
	render : function () {
		return( <input type="hidden" name={this.props.name} value={JSON.stringify(this.props.data)}/> )
	}
});

window.PRTable = React.createClass({
	getDefaultProps : function () {
		return {
			editLineItem:false,
			data:[],
			pr_id:'',
			items:[]
		};
	},
	getInitialState : function () {
		var dataStorage = [];
		var rows=[];
		if(this.props.context=='view' && this.props.data.length!=0) {
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
			quantity:'',
			pr_id:this.props.pr_id,
			lists:[]
		};
	},
	componentDidMount : function () {
		if(this.props.context=='create' || this.props.context=='edit') {
			this._ajaxRequest(base_url+'/api/items');
		}
	},
	_ajaxRequest : function (source) {
		return $.ajax({
			url:source,
			dataType: 'json',
			type:'GET',
			success : function (response) {
				var dataStorage = this.state.dataStorage;
				var rows=this.state.rows;
				if(this.props.data.length!=0) {
					dataStorage = this.props.data;
					rows=[];
					for(var i=0, counter=dataStorage.length; i<counter; i++) {
						rows[i] = <TableRow callBackParent={this.handleCallBack}
									defaultValues={dataStorage[i]}
									id={i}
									key={i}
									lists={response}
									pr_id={this.props.pr_id}
									context={this.props.context}
									handleCallBackParentClick={this.handleCallBackClick} />
					}
				}
				this.setState({
					lists : response,
					rows : rows,
					dataStorage : dataStorage
				});
			}.bind(this)
		});
	},
	_initial_data : function () {
		var state = {};
			state.item_id = '';
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
							<th>Action</th>
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
			var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
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
							lists={lists}
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
			var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
			var state = this.state;
			switch(obj.name) {
				case "item_id":
						state.item_id = obj.item_id;
					break;
				case "unit_id":
						state.unit_id = obj.unit_id;
					break;
				case "quantity":
						state.quantity=obj.quantity;
					break;	
			}
			rows[obj.id] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={state}
							edit={true}
							lists={lists}
							id={obj.id}
							handleCallBackParentClick={this.handleCallBackClick} />
			this.setState(state);
			this.setState({rows:rows});
		}

	},
	handleAdd : function () {// ADD FUNCTION
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];

		rows.push( <TableRow
					callBackParent={this.handleCallBack}
					lists={lists}
					defaultValues={this.state} id={rows.length} key={rows.length}
					handleCallBackParentClick={this.handleCallBackClick} /> );
		var obj = {
			id:'',
			item_id:this.state.item_id,
			unit_id:this.state.unit_id,
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
			var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];

			rows.length=0;

			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				if(i==rowid) {
					rows[i] = <TableRow callBackParent={this.handleCallBack}
								defaultValues={dataStorage[i]}
								edit={true}
								id={i}
								lists={lists}
								key={i}
								handleCallBackParentClick={this.handleCallBackClick} />
				} else {
					rows[i] = <TableRow callBackParent={this.handleCallBack}
								defaultValues={dataStorage[i]}
								lists={lists}
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
			state.unit_id = dataStorage[rowid].unit_id;
			state.quantity = dataStorage[rowid].quantity;
			this.setState(state);

			this.setState({rows:rows, editLineItem:true});
		}
	},
	handleUpdate : function (id) {// UPDATE FUNCTION
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.length=0;
		dataStorage[id].item_id = this.state.item_id;
		dataStorage[id].unit_id = this.state.unit_id;
		dataStorage[id].quantity = this.state.quantity;


		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							lists={lists}
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
		var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							lists={lists}
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
			var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
			rows.length=0;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
								defaultValues={dataStorage[i]}
								lists={lists}
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
			context:'',
			lists:[],
			defaultValues:{}
		}
	},
	getInitialState : function () {
		//THIS INITIAL STATE IS USE FOR VIEW ONLY TO UPDATE LINE ITEM DATA AFTER UPDATING CANVASS DATA
		return {
			defaultValues:this.props.defaultValues
		}
	},
	_getUOM : function (arraylists, itemid) {
		for(var i=0, linecount=arraylists.length; i<linecount; i++) {
			if(arraylists[i].value==itemid) {
				return arraylists[i].units;
			}
		}
	},
	_getDescription : function(arraylists, itemid) {
		for(var i=0, linecount=arraylists.length; i<linecount; i++) {
			if(arraylists[i].value==itemid) {
				return arraylists[i].description;
			}
		}
	},
	_getLabel : function(arraylists, id) {
		for(var i=0, count=arraylists.length; i<count; i++) {
			if(arraylists[i].value==id) {
				return arraylists[i].label;
			}
		}
	},
	render : function () {
		if(this.props.context=='view') {
			return (
				<tr>
					<td>{this.state.defaultValues.item_label}</td>
					<td>{this.state.defaultValues.description}</td>
					<td>{this.state.defaultValues.uom_label}</td>
					<td>{this.state.defaultValues.quantity}</td>
					<td><a href={"#"} data-toggle={"modal"} data-target={"#myModal"} onClick={this.displayModal}>Add Canvass</a></td>
				</tr>
			);
		} else {
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>	
						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists}
						defaultValue={this.props.defaultValues.item_id}
						attributes={{name:"item_id", type:"select", placeholder:"CHOOSE ITEM"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this._getDescription(this.props.lists, this.props.defaultValues.item_id)}
						attributes={{type:"display"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this._getUOM(this.props.lists, this.props.defaultValues.item_id)}
						defaultValue={this.props.defaultValues.unit_id}
						attributes={{name:"unit_id", type:"select", placeholder:"CHOOSE UOM"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity", type:"text"}} />
					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists}
						defaultValue={this.props.defaultValues.item_id}
						attributes={{name:"item_id", type:"select", placeholder:"CHOOSE ITEM"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this._getDescription(this.props.lists, this.props.defaultValues.item_id)}
						attributes={{type:"display"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this._getUOM(this.props.lists, this.props.defaultValues.item_id)}
						defaultValue={this.props.defaultValues.unit_id}
						attributes={{name:"unit_id", type:"select", placeholder:"CHOOSE UOM"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity", type:"text"}} />
					</tr>
					);
				} else {
					var item_label = this._getLabel(this.props.lists, this.props.defaultValues.item_id);
					var unitlists = this._getUOM(this.props.lists, this.props.defaultValues.item_id);
					var unit_label = this._getLabel(unitlists, this.props.defaultValues.unit_id);
					var description = this._getDescription(this.props.lists, this.props.defaultValues.item_id);
					
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{ item_label }</td>
							<td>{ description }</td>
							<td>{ unit_label }</td>
							<td>{ this.props.defaultValues.quantity }</td>
						</tr>
					);

				}
			}
		}
	},
	displayModal : function (evt) {
		ReactDOM.render(<CanvassComponent defaultValues={ this.state.defaultValues }
							data={ JSON.parse(this.state.defaultValues.canvasses) }
				            context='create'
				            callBackCanvassSave={this.callBackCanvassSave}/>, document.getElementById('myModal'));
	},
	callBackCanvassSave : function (obj) {
		var defaultValues = this.state.defaultValues;
		defaultValues.canvasses = obj;
		this.setState({defaultValues:defaultValues});
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
