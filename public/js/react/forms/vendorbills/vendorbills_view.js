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

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.suppliers_inv_no}
                    attributes={{name:"suppliers_inv_no", type:"text", label:"SUPPLIER'S INVOICE NO"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.items}
                    defaultValue={this.props.defaultValues.vendor_id}
                    attributes={{name:"vendor_id", type:"select", label:"VENDOR"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                   	options={this.props.lists.billtypes}
                    defaultValue={this.props.defaultValues.billtype_id}
                    attributes={{name:"billtype_id", type:"select", label:"BILL TYPE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.duedate}
                    attributes={{name:"duedate", type:"date", label:"DUE DATE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.approvalstatus}
                    defaultValue={this.props.defaultValues.approvalstatus_id}
                    attributes={{name:"approvalstatus_id", type:"select", label:"APPROVAL STATUS"}} />

                </FieldContainer>

                <FieldContainer>


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.departments}
                    defaultValue={this.props.defaultValues.department_id}
                    attributes={{name:"department_id", type:"select", label:"DEPARTMENT "}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.divisions}
                    defaultValue={this.props.defaultValues.division_id}
                    attributes={{name:"division_id", type:"select" ,label:"DIVISION"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.branches}
                    defaultValue={this.props.defaultValues.branch_id}
                    attributes={{name:"branch_id", type:"select", label:"BRANCH"}} />

          

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.chartofaccounts}
                    defaultValue={this.props.defaultValues.coa_id}
                    attributes={{name:"coa_id", type:"select", label:"CHART OF ACCOUNT "}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.memo}
                    attributes={{name:"memo", type:"textarea", label:"MEMO"}} />


                </FieldContainer>


                <FieldContainer>

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.terms}
                    defaultValue={this.props.defaultValues.terms_id}
                    attributes={{name:"terms_id", type:"select", label:"TERMS"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.nontrades}
                    defaultValue={this.props.defaultValues.billtype_nontrade_subtype_id}
                    attributes={{name:"billtype_nontrade_subtype_id", type:"select", label:"NON-TRADE"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.date}
                    attributes={{name:"date", type:"date", label:"DATE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    options={this.props.lists.postingperiods}
                    defaultValue={this.props.defaultValues.posting_period_id}
                    attributes={{name:"posting_period_id", type:"select", label:"POSTING PERIOD ID"}} />


                </FieldContainer>


            </Wrapper>


           );
        }
        else
        {
        	return (
            <Wrapper>
                <FieldContainer>

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.suppliers_inv_no}
                    attributes={{name:"suppliers_inv_no", type:"select", label:"SUPPLIER'S INVOICE NO"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context} 
                    defaultValue={this.props.defaultValues.vendor_id}
                    attributes={{name:"vendor_id", type:"select", label:"VENDOR"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.billtype_id}
                    attributes={{name:"billtype_id", type:"select", label:"BILL TYPE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.duedate}
                    attributes={{name:"duedate", type:"date", label:"DUE DATE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.approvalstatus_id}
                    attributes={{name:"approvalstatus_id", type:"select", label:"APPROVAL STATUS"}} />

                </FieldContainer>

                <FieldContainer>


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.department_id}
                    attributes={{name:"department_id", type:"select", label:"DEPARTMENT "}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.division_id}
                    attributes={{name:"division_id", type:"select", label:"DIVISION"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.branch_id}
                    attributes={{name:"branch_id", type:"select", label:"BRANCH"}} />

          

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.coa_id}
                    attributes={{name:"coa_id", type:"select", label:"CHART OF ACCOUNT "}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.memo}
                    attributes={{name:"memo", type:"textarea", label:"MEMO"}} />

                </FieldContainer>


                <FieldContainer>

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.terms_id}
                    attributes={{name:"terms_id", type:"select", label:"TERMS"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.billtype_nontrade_subtype_id}
                    attributes={{name:"billtype_nontrade_subtype_id", type:"select", label:"NON-TRADE"}} />

                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.date}
                    attributes={{name:"date", type:"date", label:"DATE"}} />


                    <InputMainComponent callBackParent={this.handleChangeCallBack}
                    context={this.props.context}
                    defaultValue={this.props.defaultValues.posting_period_id}
                    attributes={{name:"posting_period_id", type:"select", label:"POSTING PERIOD ID"}} />


                </FieldContainer>


            </Wrapper>


           );
        }
    }
});




window.DataStorage = React.createClass ({
    render : function () {
        return( <input type="hidden" name={this.props.name} value={JSON.stringify(this.props.data)}/> )
    }
});


window.VENDORTable = React.createClass({
	getDefaultProps : function () {
		return {
			editLineItem:false,
			data:[],
			pr_id:'',
            items: []
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
            lists: [],
			pr_id:this.props.pr_id
		};
	},
    componentDidMount : function () {
        if(this.props.context=='create' || this.props.context=='edit') {
            this._ajaxRequest(base_url+'/ajax/transactions/getVendorBill/items');
        }
    },
    _ajaxRequest : function (source) {
        return $.ajax({
            url:source,
            dataType: 'json',
            type:'GET',
            success : function (response) {
                //console.log(response);
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
                            lists = {lists}
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
				case "uom_id":
						state.uom_id = obj.uom_id;
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
                            lists={lists}
							id={obj.id}
							handleCallBackParentClick={this.handleCallBackClick} />
			this.setState(state);
			this.setState({rows:rows});
		}

	},
	handleAdd : function () {
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.push( <TableRow callBackParent={this.handleCallBack}
                    lists={lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];

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
							id={i}
                            lists={lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
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
                            lists = {lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <TableRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
                            lists = {lists}
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
             var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
			rows.length=0;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <TableRow callBackParent={this.handleCallBack}
								defaultValues={dataStorage[i]}
								id={i}
                                lists = {lists}
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
            lists: [],
            defaultValues:{}
		}
	},
    getInitialState : function() {
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

    _getUOMLabel : function (arraylists, itemid) {
        for(var i=0, linecount=arraylists.length; i<linecount; i++) {
            if(arraylists[i].value==itemid) {
                return arraylists[i].label;
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
   
    _getJobtype_id : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
    _getJobtype_label : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
    _getTaxLabel : function(arraylists, id) {
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
                                    console.log(this.props.lists);
                var description = (typeof this.props.lists.items!='undefined') ? this._getDescription(this.props.lists.items, this.props.defaultValues.item_id) : '';
                var uom = (typeof this.props.lists.items!='undefined') ? this._getUOM(this.props.lists.items, this.props.defaultValues.item_id) : '';
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.items}
                        defaultValue={this.props.defaultValues.item_id}
                        attributes={{name:"item_id", type:"select", placeholder:"CHOOSE ITEM"}} />



                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={description}
                        attributes={{type:"display"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={uom}
                        defaultValue={this.props.defaultValues.uom_id}
                        attributes={{name:"uom_id", type:"select", placeholder:"CHOOSE UOM"}} />


						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.quantity}
						attributes={{name:"quantity", type:"text"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount", type:"text"}} />


						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.taxcodes}
						defaultValue={this.props.defaultValues.taxcode_id}
                        attributes={{name:"taxcode_id", type:"select", placeholder:"CHOOSE TAXCODE"}}  />


						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount", type:"text"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount", type:"text"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.unit_cost}
						attributes={{name:"unit_cost", type:"text" }} />
						


					</tr>
				);
			} else {

                var description = (typeof this.props.lists.items!='undefined') ? this._getDescription(this.props.lists.items, this.props.defaultValues.item_id) : '';
                var uom = (typeof this.props.lists.items!='undefined') ? this._getUOM(this.props.lists.items, this.props.defaultValues.item_id) : '';
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						     <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.items}
                        defaultValue={this.props.defaultValues.item_id}
                        attributes={{name:"item_id", type:"select", placeholder:"CHOOSE ITEM"}} />



                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={description}
                        attributes={{type:"display"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={uom}
                        defaultValue={this.props.defaultValues.uom_id}
                        attributes={{name:"uom_id", type:"select", placeholder:"CHOOSE UOM"}} />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.quantity}
                        attributes={{name:"quantity", type:"text"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.amount}
                        attributes={{name:"amount", type:"text"}} />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.taxcodes}
                        defaultValue={this.props.defaultValues.taxcode_id}
                        attributes={{name:"taxcode_id", type:"select", placeholder:"CHOOSE TAXCODE"}}  />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.tax_amount}
                        attributes={{name:"tax_amount", type:"text"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.gross_amount}
                        attributes={{name:"gross_amount", type:"text"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.unit_cost}
                        attributes={{name:"unit_cost", type:"text" }} />
						


					</tr>
					);
				} else {
                    console.log(this.props.lists.items);
                     var item_label = (typeof this.props.lists.items!='undefined') ? this._getLabel(this.props.lists.items, this.props.defaultValues.item_id) : '';
                 
                    var unitlists = (typeof this.props.lists.items!='undefined') ? this._getUOM(this.props.lists.items, this.props.defaultValues.item_id) : '';

                  
                    var description = (typeof this.props.lists.items!='undefined') ? this._getDescription(this.props.lists.items, this.props.defaultValues.item_id) : '';
                    var taxlable = (typeof this.props.lists.taxcodes!='undefined') ? this._getTaxLabel(this.props.lists.taxcodes, this.props.defaultValues.taxcode_id) : '';
                    console.log(this.props.edit);
                    if(unitlists == '') {
                            return (
                            <tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
                                <td>{item_label}</td>
                                <td>{description}</td>
                                <td>{unitlists}</td>
                                <td>{this.props.defaultValues.quantity}</td>
                                <td>{this.props.defaultValues.amount}</td>
                                <td>{taxlable}</td>
                                <td>{this.props.defaultValues.tax_amount}</td>
                                <td>{this.props.defaultValues.gross_amount}</td>
                                <td>{this.props.defaultValues.unit_cost}</td>
                            </tr>
                        );
                    }
                    else
                    {
                        return (
                        <tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
                            <td>{item_label}</td>
                            <td>{description}</td>
                            <td>{unitlists[0].label}</td>
                            <td>{this.props.defaultValues.quantity}</td>
                            <td>{this.props.defaultValues.amount}</td>
                            <td>{taxlable}</td>
                            <td>{this.props.defaultValues.tax_amount}</td>
                            <td>{this.props.defaultValues.gross_amount}</td>
                            <td>{this.props.defaultValues.unit_cost}</td>
                        </tr>
                    );
                    }
					
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
			pr_id:'',
            items: []
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
            lists:[],
			pr_id:this.props.pr_id
		};
	},
        componentDidMount : function () {
        if(this.props.context=='create' || this.props.context=='edit') {
            this._ajaxRequest(base_url+'/ajax/transactions/getVendorBill/expenses');
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
                        rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
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
            var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
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
                            lists = {lists}
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
					break;
				case "gross_amount":
						state.gross_amount=obj.gross_amount;
					break;
				case "coa_id":
						state.coa_id=obj.coa_id;
					break;
				case "department_id":
						state.department_id=obj.department_id;
					break;
				case "division_id":
						state.division_id=obj.division_id;
					break;
				case "branch_id":
						state.branch_id=obj.branch_id;
					break;
				case "vendor_id":
						state.vendor_id=obj.vendor_id;
					break;

				
			}
			rows[obj.id] = <EXPENSESRow callBackParent={this.handleCallBack}
							defaultValues={state}
							edit={true}
                            lists = {lists}
							id={obj.id}
							handleCallBackParentClick={this.handleCallBackClick} />
			this.setState(state);
			this.setState({rows:rows});
		}

	},
	handleAdd : function () {
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];

		rows.push( <EXPENSESRow callBackParent={this.handleCallBack}
                    lists = {lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.length=0;

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(i==rowid) {
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							edit={true}
							id={i}
                            lists={lists}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
                            lists={lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
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
                            lists = {lists}
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
        var lists = (typeof this.state.lists!='undefined') ? this.state.lists : [];
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <EXPENSESRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
                            lists = {lists}
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
			context:'',
            lists:[],
            defaultValues:{}
		}
	},
     _getChartOfAccount : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
     _getDepartment : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
    _getDivision : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
     _getBranch : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
     _getVendor : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
     _getTaxCode : function(arraylists, id) {
        for(var i=0, count=arraylists.length; i<count; i++) {
            if(arraylists[i].value==id) {
                return arraylists[i].label;
            }
        }
    },
	render : function () {
        console.log(this.props.defaultValues.coa_label);
		if(this.props.context=='view') {
			return (
				<tr>
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
		} else {
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						
						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.chartOfAccounts}
						defaultValue={this.props.defaultValues.coa_id} 
                        attributes={{name:"coa_id", type:"select", placeholder:"CHART OF ACCOUNT"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.departments}
						defaultValue={this.props.defaultValues.department_id}
                        attributes={{name:"department_id", type:"select", placeholder:"DEPARTMENT"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.divisions}
						defaultValue={this.props.defaultValues.division_id} 
                        attributes={{name:"division_id", type:"select", placeholder:"DIVISION"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.branches}
						defaultValue={this.props.defaultValues.branch_id} 
                        attributes={{name:"branch_id", type:"select", placeholder:"BRANCH"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.vendors}
						defaultValue={this.props.defaultValues.vendor_id} 
                        attributes={{name:"vendor_id", type:"select", placeholder:"VENDOR"}} />


						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.amount}
						attributes={{name:"amount", type:"text"}} />


						<InputLineComponent callBackParent={this.handleCallBack} 
						options={this.props.lists.taxcodes}
						defaultValue={this.props.defaultValues.taxcode_id} 
                        attributes={{name:"taxcode_id", type:"select", placeholder:"TAX CODE"}} />


						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.tax_amount}
						attributes={{name:"tax_amount", type:"text"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.gross_amount}
						attributes={{name:"gross_amount", type:"text"}} />


					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>

					<InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.chartOfAccounts}
                        defaultValue={this.props.defaultValues.coa_id} 
                        attributes={{name:"coa_id", type:"select", placeholder:"CHART OF ACCOUNT"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.departments}
                        defaultValue={this.props.defaultValues.department_id}
                        attributes={{name:"department_id", type:"select", placeholder:"DEPARTMENT"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.divisions}
                        defaultValue={this.props.defaultValues.division_id} 
                        attributes={{name:"division_id", type:"select", placeholder:"DIVISION"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.branches}
                        defaultValue={this.props.defaultValues.branch_id} 
                        attributes={{name:"branch_id", type:"select", placeholder:"BRANCH"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.vendors}
                        defaultValue={this.props.defaultValues.vendor_id} 
                        attributes={{name:"vendor_id", type:"select", placeholder:"VENDOR"}} />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.amount}
                        attributes={{name:"amount", type:"text"}} />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        options={this.props.lists.taxcodes}
                        defaultValue={this.props.defaultValues.taxcode_id} 
                        attributes={{name:"taxcode_id", type:"select", placeholder:"TAX CODE"}} />


                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.tax_amount}
                        attributes={{name:"tax_amount", type:"text"}} />

                        <InputLineComponent callBackParent={this.handleCallBack} 
                        defaultValue={this.props.defaultValues.gross_amount}
                        attributes={{name:"gross_amount", type:"text"}} />
						


					</tr>
					);
				} else {
                   
                      var chartofaccount = (typeof this.props.lists.chartOfAccounts!='undefined') ? this._getChartOfAccount(this.props.lists.chartOfAccounts, this.props.defaultValues.coa_id) : '';
                      console.log(chartofaccount);
                        var department = (typeof this.props.lists.departments!='undefined') ? this._getDepartment(this.props.lists.departments, this.props.defaultValues.department_id) : '';
                        var divition = (typeof this.props.lists.divisions!='undefined') ? this._getDivision(this.props.lists.divisions, this.props.defaultValues.division_id) : '';
                        var branch = (typeof this.props.lists.branches!='undefined') ? this._getBranch(this.props.lists.branches, this.props.defaultValues.branch_id) : '';
                        var vendor = (typeof this.props.lists.vendors!='undefined') ? this._getVendor(this.props.lists.vendors, this.props.defaultValues.vendor_id) : '';
                        var taxcode = (typeof this.props.lists.taxcodes!='undefined') ? this._getTaxCode(this.props.lists.taxcodes, this.props.defaultValues.taxcode_id) : '';
                      
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{chartofaccount}</td>
							<td>{department}</td>
							<td>{divition}</td>
							<td>{branch}</td>
							<td>{vendor}</td>
							<td>{this.props.defaultValues.amount}</td>
							<td>{taxcode}</td>
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
