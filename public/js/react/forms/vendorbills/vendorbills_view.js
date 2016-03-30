window.VendorBillMainComponent = React.createClass({
	getInitialState : function () {
		return {
			data:{},
			type:'',
			date:'',
			memo:'',
			asset: '',
			requested_by: '',
			maintenancetype_id: '',
			prcategory_id: '',

			suppliers_inv_no: '',
			vendor_id: '',
			department_id: '',
			division_id: '',
			branch_id: '',
			terms_id: '',
			billtype_nontrade_subtype_id: '',
			duedate: '',
			coa_id: '',
			terms_id: '',
			approvalstatus_id: '',
			memo: '',
			posting_period_id: '',
			items: '',
			expenses: '',
			transno: '',
			context: ''
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
			       
			       <VendorBillPrimaryComponent context={this.props.context} defaultValues={this.state} callBackParent={this.handleChangeCallBack} />
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
	render : function () {
		return (
			<Wrapper>
            	<FieldContainer>

            

        		<TextMainComponent callBackParent={this.handleChangeCallBack} 
    				context={this.props.context}
    				defaultValue={this.props.defaultValues.suppliers_inv_no} 
    				attributes={{name:"suppliers_inv_no", label:"SUPPLIER'S INVOICE NO"}} />

        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.vendor_id}
    				attributes={{name:"vendor_id", label:"VENDOR"}} />

    			<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.billtype_id}
    				attributes={{name:"billtype_id", label:"BILL TYPE"}} />


    			<DateMainComponent callBackParent={this.handleChangeCallBack}
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.duedate} 
        				attributes={{name:"duedate", label:"DUE DATE"}} />	


        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.approvalstatus_id}
    				attributes={{name:"approvalstatus_id", label:"APPROVAL STATUS"}} />


	        	<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.items}
    				attributes={{name:"items", label:"ITEMS"}} />


        		</FieldContainer>

				<FieldContainer> 


	        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.department_id}
	    				attributes={{name:"department_id", label:"DEPARTEMENT"}} />

					<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.division_id}
	    				attributes={{name:"division_id", label:"DIVISION"}} />


        			<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.branch_id}
	    				attributes={{name:"branch_id", label:"BRANCH"}} />

	    			<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.coa_id}
	    				attributes={{name:"coa_id", label:"COA ID"}} />


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
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.terms_id}
	    				attributes={{name:"terms_id", label:"TERM"}} />

	    			<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.billtype_nontrade_subtype_id}
	    				attributes={{name:"billtype_nontrade_subtype_id", label:"NONE TRADE"}} />

					<DateMainComponent callBackParent={this.handleChangeCallBack}
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.date} 
        				attributes={{name:"date", label:"DATE"}} />	

					
					<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.terms_id}
	    				attributes={{name:"terms_id", label:"TERMS"}} />

					

					<SelectMainComponent callBackParent={this.handleChangeCallBack}
	    				context={this.props.context}
	    				source={base_url+'/ajax/getItems'}
	    				defaultValue={this.props.defaultValues.posting_period_id}
	    				attributes={{name:"posting_period_id", label:"POSTING PERIOD ID"}} />

        			
	    			<TextMainComponent callBackParent={this.handleChangeCallBack} 
	    				context={this.props.context}
	    				defaultValue={this.props.defaultValues.expenses} 
	    				attributes={{name:"expenses", label:"EXPENSES"}} />

        		</FieldContainer>

            
	        </Wrapper>

	       
		);
	}
});
	

