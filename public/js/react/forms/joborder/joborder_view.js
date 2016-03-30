window.JOMainComponent = React.createClass({
	getInitialState : function () {
		return {
			data:{},
			type:'',
			transdate:'',
			memo:'',
			asset: '',
			requested_by: '',
			maintenancetype_id: '',
			prcategory_id: '',
			context:''
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
			       
			       <JOrimaryComponent context={this.props.context} defaultValues={this.state} callBackParent={this.handleChangeCallBack} />
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
	render : function () {
		return (
			<Wrapper>
            	<FieldContainer>

        		<DateMainComponent callBackParent={this.handleChangeCallBack}
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.transdate} 
        				attributes={{name:"transdate", label:"DATE"}} />	

        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getItems'}
    				defaultValue={this.props.defaultValues.asset}
    				attributes={{name:"asset", label:"ASSET"}} />

        		<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getEmployee'}
    				defaultValue={this.props.defaultValues.requested_by}
    				attributes={{name:"requested_by", label:"REQUESTED BY"}} />

        		</FieldContainer>

				<FieldContainer> 

				<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getMaintenancetype'}
    				defaultValue={this.props.defaultValues.maintenancetype_id}
    				attributes={{name:"maintenancetype_id", label:"TYPE OF MAINTENACE"}} />

				<SelectMainComponent callBackParent={this.handleChangeCallBack}
    				context={this.props.context}
    				source={base_url+'/ajax/getPurchseRequest'}
    				defaultValue={this.props.defaultValues.prcategory_id}
    				attributes={{name:"prcategory_id", label:"CATEGORIES"}} />

        		<TextAreaMainComponent callBackParent={this.handleChangeCallBack} 
        				context={this.props.context}
        				defaultValue={this.props.defaultValues.memo}
        				attributes={{name:"memo", label:"REMARKS"}} />

        		</FieldContainer>

            
	        </Wrapper>
		);
	}
});
