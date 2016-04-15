window.JOMainComponent = React.createClass({
	getDefaultProps : function () {
		return { 
			lists:{},
			data:[],
			context:''
		};
	},
	getInitialState : function () {
		return {
			data:{},
			type:'',
			prcategory_id: '',
			context:'',
			isCheck: '',

			item_id: '',
			jobtype_id: '',
			joborder_id: '',
			jobdescription: '',
			noofdays: '',
		

			//for edit
			type_id: (typeof this.props.data.type_id=='undefined') ? '' : this.props.data.type_id,
			requested_by: (typeof this.props.data.requested_by=='undefined') ? '' : this.props.data.requested_by,
			prcategory_id: (typeof this.props.data.prcategory_id=='undefined') ? '' : this.props.data.prcategory_id,
			maintenancetype_id: (typeof this.props.data.maintenancetype_id=='undefined') ? '' : this.props.data.maintenancetype_id,
			transdate: (typeof this.props.data.transdate=='undefined') ? '' : this.props.data.transdate,
			memo: (typeof this.props.data.memo=='undefined') ? '' : this.props.data.memo,
			asset_id: (typeof this.props.data.asset_id=='undefined') ? '' : this.props.data.asset_id,
			pr_id: (typeof this.props.data.id=='undefined') ? '' : this.props.data.id,
			type_id : (typeof this.props.data.type_id=='undefined') ? '' : this.props.data.type_id,
			date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
			remarks : (typeof this.props.data.remarks=='undefined') ? '' : this.props.data.remarks,
			requester : (typeof this.props.data.requester=='undefined') ? '' : this.props.data.requester,
			total: '',
			id: ''
			

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
			       
			       <JOrimaryComponent 
			       lists={this.props.lists}
			       context={this.props.context} 
			       defaultValues={this.state} 
			       callBackParent={this.handleChangeCallBack} />
			    </div>

			     <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Labor Cost</a></li>
					    <li><a href="#tab_2" data-toggle="tab">Notes</a></li>
					    
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            
				           <LaborCostTable callBackParent={this.handleCallBackLine}
					            data={this.props.laborcosts}
					            pr_id={this.state.pr_id}
					            context={this.props.context} />

				        </div>
				        <div className="tab-pane" id="tab_2">
				        	

				        </div>
				       
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

window.JOrimaryComponent = React.createClass({
	handleChangeCallBack : function (obj) {
		this.props.callBackParent(obj);
	},
	getDefaultProps : function () {
		return { defaultValues:{}, context:'' }
	},
	getInitialState : function () {
		return {
			data:{}
		};
	},
	componentDidMount : function () {
		this.request = $.get(base_url+'/ajax/job/request', function (response) {
			this.setState({data:response});
		}.bind(this));
	},
	componentWillUnmount : function () {
		this.request.abort();
	},
	render : function () 
	{
		console.log(this.props.defaultValues);
		if(this.props.context=='create' || this.props.context=='edit') 
		{
			
			return (
				<Wrapper>
	            	<FieldContainer>

	            	<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}
		    				options={this.props.lists.assets}
		    				defaultValue={this.props.defaultValues.asset_id}
		    				attributes={{name:"asset_id", label:"ASSET"}} />

		        		<DateMainComponent callBackParent={this.handleChangeCallBack}
		        				context={this.props.context}
		        				defaultValue={this.props.defaultValues.transdate} 
		        				attributes={{name:"transdate", label:"DATE"}} />   	
		        	</FieldContainer>

		        	<FieldContainer>
		    			<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}
		    				options={this.props.lists.maintenancetypes}
		    				defaultValue={this.props.defaultValues.maintenancetype_id}
		    				attributes={{name:"maintenancetype_id", label:"TYPE OF MAINTENACE"}} />

		    			<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}
		    				options={this.props.lists.prcategories}
		    				defaultValue={this.props.defaultValues.prcategory_id}
		    				attributes={{name:"prcategory_id", label:"CATEGORIES"}} />
		    		</FieldContainer>

		    		<FieldContainer>
			    		<SelectMainComponent callBackParent={this.handleChangeCallBack}
			    				context={this.props.context}
			    				options={this.props.lists.empployees}
			    				defaultValue={this.props.defaultValues.requested_by}
			    				attributes={{name:"requested_by", label:"REQUESTED BY"}} />
						
		        		<TextAreaMainComponent callBackParent={this.handleChangeCallBack} 
		        				context={this.props.context}
		        				defaultValue={this.props.defaultValues.memo}
		        				attributes={{name:"memo", label:"REMARKS"}} />

	        		</FieldContainer>    
		        </Wrapper>
			);
			
		}
		else {
			return (
				<Wrapper>
	            	<FieldContainer>
		            	<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}
		    				defaultValue={this.props.defaultValues.requested_by}
		    				attributes={{name:"requested_by", label:"REQUESTED BY"}} />
	        		
		        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}
		    				defaultValue={this.props.defaultValues.asset_id}
		    				attributes={{name:"asset_id", label:"ASSET"}} />

			        	<DateMainComponent callBackParent={this.handleChangeCallBack}
	        				context={this.props.context}
	        				defaultValue={this.props.defaultValues.transdate} 
	        				attributes={{name:"transdate", label:"DATE"}} />	

	        		</FieldContainer>

					<FieldContainer> 
						<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}		    				
		    				defaultValue={this.props.defaultValues.maintenancetype_id}
		    				attributes={{name:"maintenancetype_id", label:"TYPE OF MAINTENACE"}} />

						<SelectMainComponent callBackParent={this.handleChangeCallBack}
		    				context={this.props.context}		    				
		    				defaultValue={this.props.defaultValues.prcategory_id}
		    				attributes={{name:"prcategory_id", label:"CATEGORIES"}} />

		        		<TextAreaMainComponent callBackParent={this.handleChangeCallBack} 
	        				context={this.props.context}
	        				defaultValue={this.props.defaultValues.memo}
	        				attributes={{name:"memo", label:"REMARKS"}} />

		        		</FieldContainer>

		            	<FieldContainer>
		        			<SummaryComponent defaultValue={this.props.defaultValues.total}/>
		        	</FieldContainer>

		        </Wrapper>
			);
		}
	}
});


window.SummaryComponent = React.createClass({
	render : function () {
		var subtotal=this.props.defaultValue,
			vat=0,
			total=0;

		vat = parseFloat(subtotal * parseFloat(0.12));
		total = subtotal + vat;
		return (
				<table className="table" style={{border:'1px solid #f4f4f4', marginTop:'15px'}}>
					<thead>
						<tr>
							<th colSpan="2" className="summary-header">SUMMARY</th>
						</tr>
					</thead>
					<tbody className="summary-container">
						<tr>
							<td>SUBTOTAL</td>
							<td>{subtotal}</td>
						</tr>
						<tr>
							<td style={{borderBottom:'1px solid black'}}>VAT</td>
							<td style={{borderBottom:'1px solid black'}}>{vat}</td>
						</tr>
						<tr>
							<td><b>TOTAL</b></td>
							<td>{total}</td>
						</tr>
					</tbody>							
				</table>
		);
	}
});

window.LaborCostTable = React.createClass({
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
				rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
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
			description:'',
			item_label:'',
			jobtype_label: '',
			jobtype_id: '',
			no_of_days: '',

			pr_id:this.props.pr_id
		};
	},
	_initial_data : function () {
		var state = {};
			state.item_id = '';
			state.jobtype_id='';
			state.jobtype_label = '';
			state.joborder_id='';
			state.jobdescription='';
			state.no_of_days='';
		return state;
	},
	render : function () {
		//console.log(this.state);
		if(this.props.context=='view') {
			return (
				<div className="tableWrapper">
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Item</th>
							<th>Job description</th>
							<th>Repair type</th>
							<th>No of days</th>
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
					<DataStorage data={this.state.dataStorage} name="labor_costs" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Item</th>
							<th>Job description</th>
							<th>Repair type</th>
							<th>No of days</th>
						</tr>
					</thead>
					<tbody>
						{this.state.rows.map(function (row){
							return row
						})}
						
						{!this.state.editLineItem && (
							<TableRowLabor callBackParent={this.handleCallBack}
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
	//create labor cost
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
				case "jobtype_id":
						state.jobtype_id = obj.jobtype_id;
						state.jobtype_label = obj.jobtype_label;
					break;
				case "no_of_days":
						state.no_of_days=obj.no_of_days;
					break;
			}
			rows[obj.id] = <TableRowLabor callBackParent={this.handleCallBack}
							defaultValues={state}
							edit={true}
							id={obj.id}
							handleCallBackParentClick={this.handleCallBackClick} />
			this.setState(state);
			this.setState({rows:rows});
		}

	},
	handleAdd : function () {
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.push( <TableRowLabor callBackParent={this.handleCallBack}
					defaultValues={this.state} id={rows.length} key={rows.length} handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj = {
			item_id:this.state.item_id,
			item_label:this.state.item_label,
			description: this.state.description,
			jobtype_id:this.state.jobtype_id,
			jobtype_label:this.state.jobtype_label,
			no_of_days:this.state.no_of_days,
			id: ''
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
				rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							edit={true}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
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
		state.description = dataStorage[rowid].description;
		state.jobtype_id = dataStorage[rowid].jobtype_id;
		state.jobtype_label = dataStorage[rowid].jobtype_label;
		state.no_of_days = dataStorage[rowid].no_of_days;
		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;
		
		dataStorage[id].item_id = this.state.item_id,
		dataStorage[id].item_label = this.state.item_label,
		dataStorage[id].description = this.state.description,
		dataStorage[id].jobtype_id = this.state.jobtype_id,
		dataStorage[id].jobtype_label = this.state.jobtype_label,
		dataStorage[id].no_of_days = this.state.no_of_days

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
		}
		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
		this.props.callBackParent(dataStorage);
	},
	handleRemove : function (id) {
		var dataStorage = this.state.dataStorage;
		dataStorage.splice(id,1);
		var rows = this.state.rows;
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
		}

		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
	},
	handleCancel : function () {
		if(this.state.editLineItem) {
			var rows = this.state.rows;
			var dataStorage = this.state.dataStorage;
			rows.length=0;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <TableRowLabor callBackParent={this.handleCallBack}
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

//change tablerow
//CHANGE THE LABEL
window.TableRowLabor = React.createClass({
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
					<td>{this.props.defaultValues.jobtype_label}</td>
					<td>{this.props.defaultValues.no_of_days}</td>
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


						<REPAIR_TYPE callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getJoborderType'}
						defaultValue={this.props.defaultValues.jobtype_id} />

						<Quantity callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.no_of_days}
						attributes={{name:"no_of_days"}} />
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

						<REPAIR_TYPE callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getJoborderType'}
						defaultValue={this.props.defaultValues.jobtype_id} />

						

						<Quantity callBackParent={this.handleCallBack}
						defaultValue={this.props.defaultValues.no_of_days}
						attributes={{name:"no_of_days"}} />
					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.item_label}</td>
							<td>{this.props.defaultValues.description}</td>
							<td>{this.props.defaultValues.jobtype_label}</td>
							<td>{this.props.defaultValues.no_of_days}</td>
						</tr>
					);
				}
			}
		}
	},
	displayModal : function (defaultValues, evt) {
		//console.log(defaultValues);
		ReactDOM.render(<CanvassComponent callBackParent={this.handleCallBackLine}
							defaultValues={defaultValues}
				            context='create' />, document.getElementById('myModal'));
	},
	handleSaveCanvass : function (data) {
		//console.log(data);
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

