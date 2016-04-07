window.VPMainComponent = React.createClass({
	getDefaultProps : function () {
		return { 
			data:[],
			context:'',
			lineitems:[]
		};
	},
	getInitialState : function () {
		if(this.props.context=='create') {
			return {
				data : {},
				lineitems: this.props.items,
				purchaseorder_id: (typeof this.props.data.id=='undefined') ? '' : this.props.data.id,
				type_id : (typeof this.props.data.type_id=='undefined') ? '' : this.props.data.type_id,
				vendor_id : (typeof this.props.data.vendor_id=='undefined') ? '' : this.props.data.vendor_id,
				paymenttype_id : (typeof this.props.data.paymenttype_id=='undefined') ? '' : this.props.data.paymenttype_id,
				terms_id : (typeof this.props.data.terms_id=='undefined') ? '' : this.props.data.terms_id,
				date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
				delivered_to : (typeof this.props.data.delivered_to=='undefined') ? '' : this.props.data.delivered_to,
				remarks : (typeof this.props.data.memo=='undefined') ? '' : this.props.data.memo,
				requested_by : (typeof this.props.data.requested_by=='undefined') ? '' : this.props.data.requested_by,
				total:''
			};
		} else if (this.props.context=='view'){
			return {
				data : {},
				lineitems: this.props.items,
				payee_id: (typeof this.props.data.payee_id=='undefined') ? '' : this.props.data.payee_id,
				date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
				transno : (typeof this.props.data.transno=='undefined') ? '' : this.props.data.transno,
				branch_id : (typeof this.props.data.branch_id=='undefined') ? '' : this.props.data.branch_id,
				principal_id : (typeof this.props.data.principal_id=='undefined') ? '' : this.props.data.principal_id,
				checkno : (typeof this.props.data.checkno=='undefined') ? '' : this.props.data.checkno,
				checkdate : (typeof this.props.data.checkdate=='undefined') ? '' : this.props.data.checkdate,
				coa_id : (typeof this.props.data.coa_id=='undefined') ? '' : this.props.data.coa_id,
				posting_period_id : (typeof this.props.data.posting_period_id=='undefined') ? '' : this.props.data.posting_period_id
			};
		} else {
			return {
				data : {},
				lineitems: this.props.items,
				payee_id: (typeof this.props.data.payee_id=='undefined') ? '' : this.props.data.payee_id,
				date : (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,
				transno : (typeof this.props.data.transno=='undefined') ? '' : this.props.data.transno,
				branch_id : (typeof this.props.data.branch_id=='undefined') ? '' : this.props.data.branch_id,
				principal_id : (typeof this.props.data.principal_id=='undefined') ? '' : this.props.data.principal_id,
				checkno : (typeof this.props.data.checkno=='undefined') ? '' : this.props.data.checkno,
				checkdate : (typeof this.props.data.checkdate=='undefined') ? '' : this.props.data.checkdate,
				coa_id : (typeof this.props.data.coa_id=='undefined') ? '' : this.props.data.coa_id,
				posting_period_id : (typeof this.props.data.posting_period_id=='undefined') ? '' : this.props.data.posting_period_id
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
			       
			       <VPPrimaryComponent
			       context={this.props.context}
			       defaultValues={this.state}
			       lists={this.props.lists}
			       callBackParent={this.handleChangeCallBack}
			       ajaxCallBack = {this.handleAjax} />
			    </div>

		        <div className="nav-tabs-custom">
				    <ul className="nav nav-tabs">
					    <li className="active"><a href="#tab_1" data-toggle="tab">Item</a></li>
					    <li><a href="#tab_2" data-toggle="tab">File</a></li>
					    <li><a href="#tab_3" data-toggle="tab">Notes</a></li>
				    </ul>
			    	<div className="tab-content">
				        <div className="tab-pane active" id="tab_1">
				            
				            <VPTable callBackParent={this.handleCallBackLine}
				            data={this.state.lineitems}
				            payee_id={this.state.payee_id}
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

window.VPWrapper = React.createClass({
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

window.VPFieldContainer = React.createClass({
	render : function () {
		return( <div className="col-md-4 col-sm-6 col-xs-12"> {this.props.children} </div> );
	}
});

window.VPPrimaryComponent = React.createClass({
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
		if(this.props.context=='edit' || this.props.context=='create') {
			return (
				<VPWrapper>
	            	<VPFieldContainer>
	            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.vendors}
	    				defaultValue={this.props.defaultValues.payee_id}
	    				attributes={{name:"payee_id", label:"PAYEE"}} />

	            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.coa_id}
	    				attributes={{name:"coa_id", label:"A/P ACCOUNT"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.transno}
	    				attributes={{name:"transno", label:"ACCOUNT"}} />

	        		</VPFieldContainer>

					<VPFieldContainer>
	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.principal_id}
	    				attributes={{name:"principal_id", label:"PRINCIPAL"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.branch_id}
	    				attributes={{name:"branch_id", label:"LOCATION"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				options={this.props.lists.items}
	    				defaultValue={this.props.defaultValues.posting_period_id}
	    				attributes={{name:"posting_period_id", label:"POSTING PERIOD"}} />
	        		</VPFieldContainer>

	            	<VPFieldContainer>
		            	<DateMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.date} 
	    				attributes={{name:"date", label:"DATE"}} />

	    				<TextMainComponent callBackParent={this.handleChangeCallBack} 
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.checkno} 
	    				attributes={{name:"checkno", label:"CHECK NO."}} />

	    				<DateMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.checkdate} 
	    				attributes={{name:"checkdate", label:"CHECK DATE"}} />
	    
	            	</VPFieldContainer>
		        </VPWrapper>
			);
		} else {
			return (
				<VPWrapper>
	            	<VPFieldContainer>
	            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.payee_id}
	    				attributes={{name:"payee_id", label:"PAYEE"}} />

	            		<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.coa_id}
	    				attributes={{name:"coa_id", label:"A/P ACCOUNT"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.transno}
	    				attributes={{name:"transno", label:"ACCOUNT"}} />

	        		</VPFieldContainer>

					<VPFieldContainer>
	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.principal_id}
	    				attributes={{name:"principal_id", label:"PRINCIPAL"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.branch_id}
	    				attributes={{name:"branch_id", label:"LOCATION"}} />

	    				<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.posting_period_id}
	    				attributes={{name:"posting_period_id", label:"POSTING PERIOD"}} />
	        		</VPFieldContainer>

	            	<VPFieldContainer>
		            	<DateMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.date} 
	    				attributes={{name:"date", label:"DATE"}} />

	    				<TextMainComponent callBackParent={this.handleChangeCallBack} 
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.checkno} 
	    				attributes={{name:"checkno", label:"CHECK NO."}} />

	    				<DateMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.checkdate} 
	    				attributes={{name:"checkdate", label:"CHECK DATE"}} />
	    
	            	</VPFieldContainer>
		        </VPWrapper>
			);
		}

	}
});

/*******************************************************************
********************************************************************
*******************************************************************/
window.DataStorageVP = React.createClass ({
	render : function () {
		var data = [];
		for(var i=0, counter=this.props.data.length; i<counter; i++) {
			if(this.props.data[i].apply) {
				data.push(this.props.data[i]);
			}
		}
		return( <input type="hidden" name={this.props.name} value={JSON.stringify(data)}/> )
	}
});

window.VPTable = React.createClass({
	getDefaultProps : function () {
		return { data:[], context:'' };
	},
	getInitialState : function () {
		return {
			rows:[],
			dataStorage:[]
		};
	},
	componentDidMount : function () {
		if(this.props.context=='edit' || this.props.context=='view') {
			this._handleAjax(this.props.payee_id);
		}
	},
	componentWillReceiveProps : function (nextprops) {
		if(this.props.payee_id!=nextprops.payee_id) {
			this._handleAjax(nextprops.payee_id);			
		}
	},
	_handleAjax : function (id) {
		var vp = [];
		$.ajax({
			url:base_url+'/getVendorBills/'+id,
			dataType: 'json',
			type:'GET',
			success : function (response) {
				console.log(response);
				var rows = this.state.rows;
				var dataStorage = this.state.dataStorage;
				rows.length=0;
				dataStorage.length=0;
				for(var i=0,counter=response.length; i<counter; i++) {
					var amount=0,obj={};

					obj={
						apply:true,
						payment_amount:response[i].amount,
						vendor_id:response[i].vendor_id,
						id:response[i].id,
						bill_id:response[i].id,
						duedate:response[i].duedate,
						transno:response[i].transno,
						amount:response[i].amount
					};

					dataStorage.push(obj);
					rows[i] = <VPRow callBackParent={this.handleChange}
						defaultValues={obj}
						id={i}
						key={i}
						context={this.props.context}
						callBackReceiveIR={this.callBackReceiveIR} />;
	 			}
				
				this.setState({
					data:vp,
					rows:rows,
					dataStorage:dataStorage
				});

			}.bind(this)
		});
	},
	handleChange : function (obj) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		dataStorage[obj.index][obj.name] = obj[obj.name];
		rows[obj.index] = <VPRow callBackParent={this.handleChange} 
							defaultValues={dataStorage[obj.index]}
							id={obj.index}
							key={obj.index}
							callBackReceiveIR={this.callBackReceiveIR} />;

		this.setState({dataStorage:dataStorage, rows:rows});						
	},
	callBackReceiveIR: function (obj) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		if(obj.name=='apply') {
			dataStorage[obj.index][obj.name] = obj[obj.name];
			dataStorage[obj.index]['payment_amount'] = dataStorage[obj.index]['amount']; 
			rows[obj.index] = <VPRow callBackParent={this.handleChange} 
								defaultValues={dataStorage[obj.index]}
								id={obj.index}
								key={obj.index}
								callBackReceiveIR={this.callBackReceiveIR} />;	
		} else {
			dataStorage[obj.index]['apply'] = obj[obj.name];
			rows[obj.index] = <VPRow callBackParent={this.handleChange} 
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
					<DataStorageVP data={this.state.dataStorage} name="items" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Due Date</th>
							<th>Ref No.</th>
							<th>Amount</th>
							<th>Payment</th>
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
					<DataStorageVP data={this.state.dataStorage} name="items" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Apply</th>
							<th>Due Date</th>
							<th>Ref No.</th>
							<th>Amount</th>
							<th>Payment</th>
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

window.ApplyVP = React.createClass({
	getInitialState : function () {
		return { defaultChecked:this.props.defaultChecked };
	},
	handleChange : function (evt) {
		this.setState({defaultChecked:evt.target.checked});
		this.props.callBackReceiveIR({index:this.props.index, apply:evt.target.checked, name:this.props.name});
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

window.VPRow = React.createClass({
	getDefaultProps: function () {
		return { defaultValues:{} };
	},
	render: function() {
		if(this.props.context=='view') {
			return(
				<tr>
					<td>{this.props.defaultValues.duedate}</td>
					<td>{this.props.defaultValues.transno}</td>
					<td>{this.props.defaultValues.amount}</td>
					<td>{this.props.defaultValues.payment_amount}</td>

				</tr>
				);
		} else {
			return(
				<tr id={"item-"+parseInt(this.props.id+1)}>
					<ApplyVP name="apply"
					defaultChecked={this.props.defaultValues.apply}
					index={this.props.id}
					callBackReceiveIR={this.props.callBackReceiveIR}/>

					<DisplayLineComponent defaultValue={this.props.defaultValues.duedate} />
					<DisplayLineComponent defaultValue={this.props.defaultValues.transno} />
					<DisplayLineComponent defaultValue={this.props.defaultValues.amount} />

					<TextLineComponent callBackParent={this.handleCallBack}
					name="payment_amount"
					defaultValue={this.props.defaultValues.payment_amount}
					isReceived={this.props.defaultValues.apply} />
				</tr>
			);
		}
	},
	handleCallBack : function (obj) {
		obj.index = this.props.id;
		this.props.callBackParent(obj);
	}
});

