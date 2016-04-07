window.VendorBillMainComponent = React.createClass({
    getDefaultProps : function () {
        return {
            data:[],
            context:''
        };
    },
    getInitialState : function () {
        return {
            data:{},
            type:'',
            date:'',

            asset: '',
            requested_by: '',
            maintenancetype_id: '',
            prcategory_id: '',
       

            posting_period_id: '',
            items: '',
            expenses: '',
            transno: '',
     
            context: '',


           

            billtype_id: (typeof this.props.data.billtype_id=='undefined') ? '' : this.props.data.billtype_id,
           	department_id: (typeof this.props.data.department_id=='undefined') ? '' : this.props.data.department_id,

            duedate: (typeof this.props.data.duedate=='undefined') ? '' : this.props.data.duedate,
         
            division_id: (typeof this.props.data.division_id=='undefined') ? '' : this.props.data.division_id,
            transno: (typeof this.props.data.transno=='undefined') ? '' : this.props.data.transno,
            billtype_nontrade_subtype_id: (typeof this.props.data.billtype_nontrade_subtype_id=='undefined') ? '' : this.props.data.billtype_nontrade_subtype_id,
			posting_period_id: (typeof this.props.data.posting_period_id=='undefined') ? '' : this.props.data.posting_period_id,

			vendor_id: (typeof this.props.data.vendor_id=='undefined') ? '' : this.props.data.vendor_id,
			date: (typeof this.props.data.date=='undefined') ? '' : this.props.data.date,


            coa_id: (typeof this.props.data.coa_id=='undefined') ? '' : this.props.data.coa_id,

            amount: (typeof this.props.data.amount=='undefined') ? '' : this.props.data.amount,
            vendor_id: (typeof this.props.data.vendor_id=='undefined') ? '' : this.props.data.vendor_id,
          
            division_id: (typeof this.props.data.division_id=='undefined') ? '' : this.props.data.division_id,
         

            branch_id: (typeof this.props.data.branch_id=='undefined') ? '' : this.props.data.branch_id,


            suppliers_inv_no: (typeof this.props.data.suppliers_inv_no=='undefined') ? '' : this.props.data.suppliers_inv_no,
            terms_id: (typeof this.props.data.terms_id=='undefined') ? '' : this.props.data.terms_id,
            approvalstatus_id: (typeof this.props.data.approvalstatus_id=='undefined') ? '' : this.props.data.approvalstatus_id,
            memo: (typeof this.props.data.memo=='undefined') ? '' : this.props.data.memo
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

                    <VendorBillPrimaryComponent
                    lists={this.props.lists}
                    context={this.props.context}
                    defaultValues={this.state}
                    callBackParent={this.handleChangeCallBack} />

                </div>

                <div className="nav-tabs-custom">
                    <ul className="nav nav-tabs">
                        <li className="active"><a href="#tab_1" data-toggle="tab">ITEM</a></li>
                        <li><a href="#tab_2" data-toggle="tab">EXPENSES</a></li>
                    </ul>
                    <div className="tab-content">
                        <div className="tab-pane active" id="tab_1">

                            <VENDORTable callBackParent={this.handleCallBackLine}
                            data={this.props.items}
                            pr_id={this.state.pr_id}
                            context={this.props.context} />

                        </div>
                         <div className="tab-pane" id="tab_2">

                            <EXPENSESTable callBackParent={this.handleCallBackLine}
                            data={this.props.expenses}
                            pr_id={this.state.pr_id}
                            context={this.props.context} />

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

window.VendorBillPrimaryComponent = React.createClass({
    handleChangeCallBack : function (obj) {
        this.props.callBackParent(obj);
    },
    getDefaultProps : function () {
        return { defaultValues:{}, context: '' }
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
        if(this.props.context=='create' || this.props.context=='edit')
        {
        	return (
            <Wrapper>
                <FieldContainer>

                    <TextMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.suppliers_inv_no}
                    attributes={{name:"suppliers_inv_no", label:"SUPPLIER'S INVOICE NO"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.items}
                    defaultValue={this.props.defaultValues.vendor_id}
                    attributes={{name:"vendor_id", label:"VENDOR"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                   	options={this.props.lists.billtypes}
                    defaultValue={this.props.defaultValues.billtype_id}
                    attributes={{name:"billtype_id", label:"BILL TYPE"}} />


                    <DateMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.duedate}
                    attributes={{name:"duedate", label:"DUE DATE"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.approvalstatus}
                    defaultValue={this.props.defaultValues.approvalstatus_id}
                    attributes={{name:"approvalstatus_id", label:"APPROVAL STATUS"}} />

                </FieldContainer>

                <FieldContainer>


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.departments}
                    defaultValue={this.props.defaultValues.department_id}
                    attributes={{name:"department_id", label:"DEPARTMENT "}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.divisions}
                    defaultValue={this.props.defaultValues.division_id}
                    attributes={{name:"division_id", label:"DIVISION"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.branches}
                    defaultValue={this.props.defaultValues.branch_id}
                    attributes={{name:"branch_id", label:"BRANCH"}} />

          

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.chartofaccounts}
                    defaultValue={this.props.defaultValues.coa_id}
                    attributes={{name:"coa_id", label:"CHART OF ACCOUNT "}} />


                    <TextAreaMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.memo}
                    attributes={{name:"memo", label:"MEMO"}} />

                    <TextMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.transno}
                    attributes={{name:"transno", label:"SUPPLIER'S INVOICE NO"}} />




                </FieldContainer>


                <FieldContainer>

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.terms}
                    defaultValue={this.props.defaultValues.terms_id}
                    attributes={{name:"terms_id", label:"TERMS"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.nontrades}
                    defaultValue={this.props.defaultValues.billtype_nontrade_subtype_id}
                    attributes={{name:"billtype_nontrade_subtype_id", label:"NONE TRADE"}} />

                    <DateMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.date}
                    attributes={{name:"date", label:"DATE"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.postingperiods}
                    defaultValue={this.props.defaultValues.posting_period_id}
                    attributes={{name:"posting_period_id", label:"POSTING PERIOD ID"}} />


                </FieldContainer>


            </Wrapper>


           );
        }
        else
        {
        	return (
            <Wrapper>
                <FieldContainer>

                    <TextMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.suppliers_inv_no}
                    attributes={{name:"suppliers_inv_no", label:"SUPPLIER'S INVOICE NO"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    
                    defaultValue={this.props.defaultValues.vendor_id}
                    attributes={{name:"vendor_id", label:"VENDOR"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                  
                    defaultValue={this.props.defaultValues.billtype_id}
                    attributes={{name:"billtype_id", label:"BILL TYPE"}} />


                    <DateMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.duedate}
                    attributes={{name:"duedate", label:"DUE DATE"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                   
                    defaultValue={this.props.defaultValues.approvalstatus_id}
                    attributes={{name:"approvalstatus_id", label:"APPROVAL STATUS"}} />

                </FieldContainer>

                <FieldContainer>


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    
                    defaultValue={this.props.defaultValues.department_id}
                    attributes={{name:"department_id", label:"DEPARTMENT "}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
               
                    defaultValue={this.props.defaultValues.division_id}
                    attributes={{name:"division_id", label:"DIVISION"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                   
                    defaultValue={this.props.defaultValues.branch_id}
                    attributes={{name:"branch_id", label:"BRANCH"}} />

          

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                   
                    defaultValue={this.props.defaultValues.coa_id}
                    attributes={{name:"coa_id", label:"CHART OF ACCOUNT "}} />


                    <TextAreaMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.memo}
                    attributes={{name:"memo", label:"MEMO"}} />

                    <TextMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.transno}
                    attributes={{name:"transno", label:"SUPPLIER'S INVOICE NO"}} />




                </FieldContainer>


                <FieldContainer>

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                  
                    defaultValue={this.props.defaultValues.terms_id}
                    attributes={{name:"terms_id", label:"TERMS"}} />

                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
               
                    defaultValue={this.props.defaultValues.billtype_nontrade_subtype_id}
                    attributes={{name:"billtype_nontrade_subtype_id", label:"NONE TRADE"}} />

                    <DateMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.date}
                    attributes={{name:"date", label:"DATE"}} />


                    <SelectMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    
                    defaultValue={this.props.defaultValues.posting_period_id}
                    attributes={{name:"posting_period_id", label:"POSTING PERIOD ID"}} />


                </FieldContainer>


            </Wrapper>


           );
        }
    }
});




window.VENDORTable = React.createClass({
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
			uom_id:'',
			amount: '',
			tax_amount: '',
			gross_amount: '',
			unit_cost: '',
			taxcode_label: '',
			taxcode_id: '',
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
			state.uom_id = '';
			state.amount = '';
			state.unit_cost = '';
			state.taxcode_id = '';
			state.taxcode_label = '';
			state.tax_amount = '';
			state.gross_amount = '';
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
							<th>Amount</th>
							<th>Tax Code</th>
							<th>Tax Amount</th>
							<th>Gross Amount</th>
							<th>Unit Cost</th>
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
							<th>Amount</th>
							<th>Tax Code</th>
							<th>Tax Amount</th>
							<th>Gross Amount</th>
							<th>Unit Cost</th>
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
				case "uom_id":
						state.uom_id = obj.uom_id;
						state.uom_label = obj.uom_label;
					break;
				case "quantity":
						state.quantity=obj.quantity;
					break;	
				case "amount":
						state.amount=obj.amount;
					break;
				case "tax_amount":
						state.tax_amount=obj.tax_amount;
					break;
				case "taxcode_id":
						state.taxcode_id=obj.taxcode_id;
						state.taxcode_label=obj.taxcode_label;
					break;
				case "gross_amount":
						state.gross_amount=obj.gross_amount;
					break;
				case "unit_cost":
						state.unit_cost=obj.unit_cost;
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
	handleAdd : function () {
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.push( <TableRow callBackParent={this.handleCallBack}
					defaultValues={this.state} id={rows.length} key={rows.length} handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj = {
			item_id:this.state.item_id,
			item_label:this.state.item_label,
			description: this.state.description,
			uom_id:this.state.uom_id,
			amount:this.state.amount,
			taxcode_id:this.state.taxcode_id,
			taxcode_label:this.state.taxcode_label,
			tax_amount:this.state.tax_amount,
			gross_amount:this.state.gross_amount,
			unit_cost:this.state.unit_cost,
			uom_label:this.state.uom_label,
			quantity:this.state.quantity,
			id:'',
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
		state.uom_id = dataStorage[rowid].uom_id;
		state.amount = dataStorage[rowid].amount;
		state.taxcode_id = dataStorage[rowid].taxcode_id;
		state.taxcode_label = dataStorage[rowid].taxcode_label;
		state.tax_amount = dataStorage[rowid].tax_amount;
		state.gross_amount = dataStorage[rowid].gross_amount;
		state.unit_cost = dataStorage[rowid].unit_cost;
		state.uom_label = dataStorage[rowid].uom_label;
		state.description = dataStorage[rowid].description;
		state.quantity = dataStorage[rowid].quantity;
		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;
	
		dataStorage[id].item_id = this.state.item_id;
		dataStorage[id].item_label = this.state.item_label;
		dataStorage[id].description = this.state.description;
		dataStorage[id].uom_id = this.state.uom_id;
		dataStorage[id].uom_label = this.state.uom_label;
		dataStorage[id].amount = this.state.amount;
		dataStorage[id].unit_cost = this.state.unit_cost;
		dataStorage[id].taxcode_id = this.state.taxcode_id;
		dataStorage[id].taxcode_label = this.state.taxcode_label;
		dataStorage[id].tax_amount = this.state.tax_amount;
		dataStorage[id].gross_amount = this.state.gross_amount;
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
	handleRemove : function (id) {
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
	handleCancel : function () {
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
					<td>{this.props.defaultValues.amount}</td>
				
					<td>{this.props.defaultValues.taxcode_label}</td>
					<td>{this.props.defaultValues.tax_amount}</td>
					<td>{this.props.defaultValues.gross_amount}</td>
				
					<td>{this.props.defaultValues.unit_cost}</td>

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

						<VENDORBILLUOM callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getUOM/'+this.props.defaultValues.item_id}
						defaultValue={this.props.defaultValues.uom_id} />

						<Quantity callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity"}} />

						<Amount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount"}} />


						<TAXCode callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getTaxCode'}
						defaultValue={this.props.defaultValues.taxcode_id} />


						<TAXAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount"}} />

						<GROSSAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount"}} />

						<UNITCost callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.unit_cost}
						attributes={{name:"unit_cost"}} />
						


					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<Item callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.item_id} />

						<Description callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.description} />

						<VENDORBILLUOM callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getUOM/'+this.props.defaultValues.item_id}
						defaultValue={this.props.defaultValues.uom_id} />

						<Quantity callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity"}} />

						<Amount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount"}} />


						<TAXCode callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getTaxCode'}
						defaultValue={this.props.defaultValues.taxcode_id} />


						<TAXAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount"}} />

						<GROSSAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount"}} />

						<UNITCost callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.unit_cost}
						attributes={{name:"unit_cost"}} />
						


					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.item_label}</td>
							<td>{this.props.defaultValues.description}</td>
							<td>{this.props.defaultValues.uom_label}</td>
							<td>{this.props.defaultValues.quantity}</td>
							<td>{this.props.defaultValues.amount}</td>
							<td>{this.props.defaultValues.taxcode_id}</td>
							<td>{this.props.defaultValues.tax_amount}</td>
							<td>{this.props.defaultValues.gross_amount}</td>
							<td>{this.props.defaultValues.unit_cost}</td>
						</tr>
					);
				}
			}
		}
	},
	displayModal : function (defaultValues, evt) {
		console.log(defaultValues);
		ReactDOM.render(<CanvassComponent callBackParent={this.handleCallBackLine}
							defaultValues={defaultValues}
				            context='create' />, document.getElementById('myModal'));
	},
	handleSaveCanvass : function (data) {
		console.log(data);
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


// expenses table
window.EXPENSESTable = React.createClass({
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
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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
			amount: '',
			coa_id: '',
			coa_label: '',
			tax_amount: '',
			gross_amount: '',
			taxcode_label: '',
			taxcode_id: '',
			department_id: '',
			department_label: '',
			division_id: '',
			division_label: '',

			branch_id: '',
			branch_label: '',

			vendor_id: '',
			vendor_label: '',

			pr_id:this.props.pr_id
		};
	},
	_initial_data : function () {
		var state = {};
			state.amount = '';
			state.coa_id = '';
			state.taxcode_id = '';
			state.taxcode_label = '';
			state.coa_label = '';
			state.tax_amount = '';
			state.gross_amount = '';
			state.department_id = '';
			state.department_label = '';
			state.division_id = '';
			state.division_label = '';
			state.branch_id = '';
			state.branch_label = '';

			state.vendor_id = '';
			state.vendor_label = '';

		return state;
	},
	render : function () {
		if(this.props.context=='view') {
			return (
				<div className="tableWrapper">
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Chart Of Account</th>
							<th>Department</th>
							<th>Division</th>
							<th>Branch</th>
							<th>Vendor</th>
							<th>Amount</th>
							<th>Tax Code</th>
							<th>Tax Amount</th>
							<th>Gross Amount</th>
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
					<DataStorage data={this.state.dataStorage} name="expenses" />
					<table className="table table-bordered react-table" style={{overflow:'auto'}}>
					<thead>
						<tr>
							<th>Chart Of Account</th>
							<th>Department</th>
							<th>Division</th>
							<th>Branch</th>
							<th>Vendor</th>
							<th>Amount</th>
							<th>Tax Code</th>
							<th>Tax Amount</th>
							<th>Gross Amount</th>
						</tr>
					</thead>
					<tbody>
						{this.state.rows.map(function (row){
							return row
						})}
						
						{!this.state.editLineItem && (
							<EXPENSESRow callBackParent={this.handleCallBack}
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
				case "amount":
						state.amount=obj.amount;
					break;
				case "tax_amount":
						state.tax_amount=obj.tax_amount;
					break;
				case "taxcode_id":
						state.taxcode_id=obj.taxcode_id;
						state.taxcode_label=obj.taxcode_label;
					break;
				case "gross_amount":
						state.gross_amount=obj.gross_amount;
					break;
				case "coa_id":
						state.coa_id=obj.coa_id;
						state.coa_label=obj.coa_label;
					break;
				case "department_id":
						state.department_id=obj.department_id;
						state.department_label=obj.department_label;
					break;
				case "division_id":
						state.division_id=obj.division_id;
						state.division_label=obj.division_label;
					break;
				case "branch_id":
						state.branch_id=obj.branch_id;
						state.branch_label=obj.branch_label;
					break;
				case "vendor_id":
						state.vendor_id=obj.vendor_id;
						state.vendor_label=obj.vendor_label;
					break;

				
			}
			rows[obj.id] = <EXPENSESRow callBackParent={this.handleCallBack}
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
		rows.push( <EXPENSESRow callBackParent={this.handleCallBack}
					defaultValues={this.state} id={rows.length} key={rows.length} handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj = {
			amount:this.state.amount,
			taxcode_id:this.state.taxcode_id,
			taxcode_label:this.state.taxcode_label,
			tax_amount:this.state.tax_amount,
			gross_amount:this.state.gross_amount,
			coa_id:this.state.coa_id,
			coa_label:this.state.coa_label,
			department_id:this.state.department_id,
			department_label:this.state.department_label,
			division_id:this.state.division_id,
			division_label:this.state.division_label,

			branch_id:this.state.branch_id,
			branch_label:this.state.branch_label,

			vendor_id:this.state.vendor_id,
			vendor_label:this.state.vendor_label,
			id:'',

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
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							edit={true}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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
		state.amount = dataStorage[rowid].amount;
		state.taxcode_id = dataStorage[rowid].taxcode_id;
		state.taxcode_label = dataStorage[rowid].taxcode_label;
		state.tax_amount = dataStorage[rowid].tax_amount;
		state.gross_amount = dataStorage[rowid].gross_amount;
		state.coa_id = dataStorage[rowid].coa_id;
		state.coa_label = dataStorage[rowid].coa_label;
		state.department_id = dataStorage[rowid].department_id;
		state.department_label = dataStorage[rowid].department_label;
		state.division_id = dataStorage[rowid].division_id;
		state.division_label = dataStorage[rowid].division_label;

		state.branch_id = dataStorage[rowid].branch_id;
		state.branch_label = dataStorage[rowid].branch_label;

		state.vendor_id = dataStorage[rowid].vendor_id;
		state.vendor_label = dataStorage[rowid].vendor_label;

		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;
	
		dataStorage[id].amount = this.state.amount;
		dataStorage[id].taxcode_id = this.state.taxcode_id;
		dataStorage[id].taxcode_label = this.state.taxcode_label;
		dataStorage[id].tax_amount = this.state.tax_amount;
		dataStorage[id].gross_amount = this.state.gross_amount;
		dataStorage[id].coa_id = this.state.coa_id;
		dataStorage[id].coa_label = this.state.coa_label;
		dataStorage[id].department_id = this.state.department_id;
		dataStorage[id].department_label = this.state.department_label;
		dataStorage[id].division_id = this.state.division_id;
		dataStorage[id].division_label = this.state.division_label;
		dataStorage[id].branch_id = this.state.branch_id;
		dataStorage[id].branch_label = this.state.branch_label;
		dataStorage[id].vendor_id = this.state.vendor_id;
		dataStorage[id].vendor_label = this.state.vendor_label;

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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
			rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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

window.EXPENSESRow = React.createClass({
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
					<th>{this.props.defaultValues.coa_label}</th>
					<th>{this.props.defaultValues.department_label}</th>
					<th>{this.props.defaultValues.division_label}</th>
					<th>{this.props.defaultValues.branch_label}</th>
					<th>{this.props.defaultValues.vendor_label}</th>
					<td>{this.props.defaultValues.amount}</td>
					<td>{this.props.defaultValues.taxcode_label}</td>
					<td>{this.props.defaultValues.tax_amount}</td>
					<td>{this.props.defaultValues.gross_amount}</td>

				</tr>
			);
		} else {
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						
						<CASHONHand callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getCoa'}
						defaultValue={this.props.defaultValues.coa_id} />

						<DEPARTEMENT callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getDepartment'}
						defaultValue={this.props.defaultValues.department_id} />

						<DIVISION callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getDivision'}
						defaultValue={this.props.defaultValues.division_id} />

						<BRANHCES callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getBranch'}
						defaultValue={this.props.defaultValues.branch_id} />

						<VENDOR callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getVendor'}
						defaultValue={this.props.defaultValues.vendor_id} />


						<Amount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount"}} />


						<TAXCode callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getTaxCode'}
						defaultValue={this.props.defaultValues.taxcode_id} />


						<TAXAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount"}} />

						<GROSSAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount"}} />


					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>

						<CASHONHand callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getCoa'}
						defaultValue={this.props.defaultValues.coa_id} />

						<DEPARTEMENT callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getDepartment'}
						defaultValue={this.props.defaultValues.department_id} />

						<DIVISION callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getDivision'}
						defaultValue={this.props.defaultValues.division_id} />

						<BRANHCES callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getBranch'}
						defaultValue={this.props.defaultValues.branch_id} />

						<VENDOR callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getVendor'}
						defaultValue={this.props.defaultValues.vendor_id} />


						<Amount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount"}} />


						<TAXCode callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getTaxCode'}
						defaultValue={this.props.defaultValues.taxcode_id} />


						<TAXAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount"}} />

						<GROSSAmount callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount"}} />
						


					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.coa_label}</td>
							<td>{this.props.defaultValues.department_label}</td>
							<td>{this.props.defaultValues.division_label}</td>
							<td>{this.props.defaultValues.branch_label}</td>
							<td>{this.props.defaultValues.vendor_label}</td>
							<td>{this.props.defaultValues.amount}</td>
							<td>{this.props.defaultValues.taxcode_label}</td>
							<td>{this.props.defaultValues.tax_amount}</td>
							<td>{this.props.defaultValues.gross_amount}</td>
						</tr>
					);
				}
			}
		}
	},
	displayModal : function (defaultValues, evt) {
		console.log(defaultValues);
		ReactDOM.render(<CanvassComponent callBackParent={this.handleCallBackLine}
							defaultValues={defaultValues}
				            context='create' />, document.getElementById('myModal'));
	},
	handleSaveCanvass : function (data) {
		console.log(data);
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
