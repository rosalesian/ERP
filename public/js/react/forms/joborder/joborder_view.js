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
			prcategory_id: ''
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
			       
			       <JOrimaryComponent defaultValues={this.state} callBackParent={this.handleChangeCallBack} />
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
		return { defaultValues:{} }
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

            	<Date callBackParent={this.handleChangeCallBack} 
        				defaultValue={this.props.defaultValues.transdate} 
        				attributes={{name:"transdate", label:"DATE"}} />

        		<Type callBackParent={this.handleChangeCallBack}
        				defaultValue={this.props.defaultValues.asset}
        				attributes={{name:"asset", label:"ASSET NAME",options:this.state.data.typelist}} />

        		<Type callBackParent={this.handleChangeCallBack}
        				defaultValue={this.props.defaultValues.requested_by}
        				attributes={{name:"requested_by", label:"REQUESTED BY",options:this.state.data.listemployee}} />

        		</FieldContainer>

				<FieldContainer> 

					<Type callBackParent={this.handleChangeCallBack}
        				defaultValue={this.props.defaultValues.maintenancetype_id}
        				attributes={{name:"maintenancetype_id", label:"TYPE OF MAINTENACE",options:this.state.data.listmaintenancetype}} />

        			<Type callBackParent={this.handleChangeCallBack}
        				defaultValue={this.props.defaultValues.prcategory_id}
        				attributes={{name:"prcategory_id", label:"CATEGORIES",options:this.state.data.listspurchase}} />

        			<Remarks callBackParent={this.handleChangeCallBack} 
        				defaultValue={this.props.defaultValues.memo} 
        				attributes={{name:"memo", label:"REMARKS"}} />
        		</FieldContainer>

            
	        </Wrapper>
		);
	}
});
	
ReactDOM.render(<JOMainComponent />, document.getElementById("mainPR-container"));
