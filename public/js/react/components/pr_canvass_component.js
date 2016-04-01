/***********************************************************************************************************************************
***********************************************************************************************************************************/
window.CanvassComponent = React.createClass({
	getDefaultProps : function () {
		return {
			editLineItem:false,
			data:[],
			pr_id:'',
			defaultValues:{}
		};
	},
	getInitialState : function () {
		var dataStorage = [];
		var rows=[];
		if(this.props.data.length!=0) {
			dataStorage = this.props.data;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							pr_id={this.props.pr_id}
							context={this.props.context}
							handleCallBackParentClick={this.handleCallBackClick} />
			}
		}

		return {
			editLineItem:false,
			dataStorage:dataStorage,
			rows:rows,
			vendor_id:'',
			vendor_label:'',
			terms_id:'',
			terms_label:'',
			cost:'',
			pr_id:this.props.pr_id
		};
	},
	componentWillReceiveProps : function(nextprops) {
		console.log(nextprops);
		var dataStorage = [];
		var rows=[];
		if(nextprops.data.length!=0) {
			dataStorage = nextprops.data;
			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							pr_id={nextprops.pr_id}
							context={nextprops.context}
							handleCallBackParentClick={this.handleCallBackClick} />
			}
		}

		this.setState({
			dataStorage:dataStorage,
			rows:rows,
		});

	},
	_initial_data : function () {
		var state = {};
			state.vendor_id = '';
			state.vendor_label=''; 
			state.terms_label='';
			state.terms_id = ''
			state.cost='';
		return state;
	},
	render : function () {
	var that = this;
	return (
		<div className="modal-dialog">
		<div className="modal-content" style={{width:'900px',marginLeft:'-20%'}}>
		<div className="modal-header">
		    <button type="button" className="close" data-dismiss="modal" aria-label="Close">
		      <span aria-hidden="true">×</span></button>
		    <h4 className="modal-title">Canvass Items</h4>
		</div>
			<div className="modal-body" id="modalContainer">

			<DataStorage data={this.state.dataStorage} name="items" />

			<table className="table table-bordered react-table" style={{overflow:'auto'}}>
			<thead>
				<tr>
					<th>Vendor</th>
					<th>Price</th>
					<th>Terms</th>
				</tr>
			</thead>
			<tbody>
				{this.state.rows.map(function (row){
					return row
				})}
				
				{!this.state.editLineItem && (
					<CanvassRow callBackParent={this.handleCallBack}
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
			<div className="modal-footer">
			<button type="button" className="btn btn-default pull-left" data-dismiss="modal" onClick={this.handleCancel}>Close</button>
			<button type="button" className="btn btn-primary" data-dismiss="modal" onClick={this.handleSaveCanvass}>Save changes</button>
			</div>
		</div>
		</div>
	);
	},
	handleSaveCanvass : function () {
		var data = JSON.stringify(this.state.dataStorage);
		$.ajax({
		headers:{'X-CSRF-TOKEN':this.props.defaultValues._token},
		url:base_url+'/api/1.0/pritem/'+this.props.defaultValues.id+'/canvass',
		type:'POST',
		data:{canvasses:data},
		success : function (response) {
			console.log(response);
		}.bind(this)
	});
	},
	handleCallBack : function (obj) {
		if(obj.context=='create') {
			this.setState(obj);
		} else {
			var rows = this.state.rows;
			var state = this.state;
			
			switch(obj.name) {
				case "vendor_id":
						state.vendor_id = obj.vendor_id;
						state.vendor_label = obj.vendor_label;
					break;
				case "terms_id":
						state.terms_id = obj.terms_id;
						state.terms_label = obj.terms_label;
					break;
				case "cost":
						state.cost=obj.cost;
					break;	
			}
			rows[obj.id] = <CanvassRow callBackParent={this.handleCallBack}
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
		rows.push( <CanvassRow callBackParent={this.handleCallBack}
					defaultValues={this.state} id={rows.length} key={rows.length} handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj = {
			vendor_id:this.state.vendor_id,
			vendor_label:this.state.vendor_label,
			terms_id:this.state.terms_id,
			terms_label:this.state.terms_label,
			cost:this.state.cost
		};
		dataStorage.push(obj);
		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage});
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
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							edit={true}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
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
		state.vendor_id = dataStorage[rowid].vendor_id;
		state.vendor_label = dataStorage[rowid].vendor_label;
		state.terms_id = dataStorage[rowid].terms_id;
		state.terms_label = dataStorage[rowid].terms_label;
		state.cost = dataStorage[rowid].cost;
		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {
		console.log(this.state);
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;
		dataStorage[id] = {
			vendor_id:this.state.vendor_id,
			vendor_label:this.state.vendor_label,
			terms_id:this.state.terms_id,
			terms_label:this.state.terms_label,
			cost:this.state.cost
		};

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
		}
		this.setState(this._initial_data()); //empty state values
		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
	},
	handleRemove : function (id) {
		var dataStorage = this.state.dataStorage;
		dataStorage.splice(id,1);
		var rows = this.state.rows;
		rows.length=0;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <CanvassRow callBackParent={this.handleCallBack}
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
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
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

/***********************************************************************************************************************************
***********************************************************************************************************************************/
window.CanvassRow = React.createClass({
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
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<CanvassVendor callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.item_id} />

						<CanvassPrice callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.cost} />

						<CanvassTerms callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.terms_id} />
					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<CanvassVendor callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.vendor_id} />

						<CanvassPrice callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.cost} />

						<CanvassTerms callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.terms_id} />
					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.vendor_label}</td>
							<td>{this.props.defaultValues.cost}</td>
							<td>{this.props.defaultValues.terms_label}</td>
						</tr>
					);
				}
			}
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

/***********************************************************************************************************************************
***********************************************************************************************************************************/
window.CanvassVendor = React.createClass({
getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
getInitialState : function () {
	return { 
		data:[],
		defaultValue:this.props.defaultValue,
		placeholder:''
	};
},
componentDidMount : function () {
	this.request = $.ajax({
		url:this.props.source,
		dataType: 'json',
		type:'GET',
		beforeSend : function () {
			this.setState({placeholder:'loading...'});
		}.bind(this),
		success : function (response) {
			var data=this.state.data;
			data.length=0;
			for(var i in response) {
				data.push({value:response[i].value, label:response[i].label, description:response[i].description});
			}
			this.setState({data : data, placeholder:'Choose Vendor'});
		}.bind(this)
	});
},
componentWillUnmount : function () {
	this.request.abort();
},
_ajaxRequest : function (source) {
	$.ajax({
		url:source,
		dataType: 'json',
		type:'GET',
		beforeSend : function () {
			this.setState({placeholder:'loading...'});
		}.bind(this),
		success : function (response) {
			var data=this.state.data;
			data.length=0;
			for(var i in response) {
				data.push({value:response[i].value, label:response[i].label, description:response[i].description});
			}
			this.setState({data : data, placeholder:'Choose Item'});
		}.bind(this)
	});
},
componentWillReceiveProps : function (nextprops) {
	return this._ajaxRequest(nextprops.source)
},
handleChange : function (event) {
	var obj = {};
	obj.name = 'vendor_id';
	obj['vendor_id'] = event.value;
	obj['vendor_label'] = event.label;
	this.setState({defaultValue:event.value});
	this.props.callBackParent(obj);
},
render : function () {
	return( 
		<td>
			<Select onChange={this.handleChange} 
            id="vendor_id" 
            className="react-select-input-mainline" 
            name="item_id"
            value={this.state.defaultValue}
            options={this.state.data} 
            placeholder={this.state.placeholder} 
            clearable={false} />
		</td>
	);
}
});
/***********************************************************************************************************************************
***********************************************************************************************************************************/
window.CanvassTerms = React.createClass({
getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
getInitialState : function () {
	return { 
		data:[],
		defaultValue:this.props.defaultValue,
		placeholder:''
	};
},
componentDidMount : function () {
	this.request = $.ajax({
		url:this.props.source,
		dataType: 'json',
		type:'GET',
		beforeSend : function () {
			this.setState({placeholder:'loading...'});
		}.bind(this),
		success : function (response) {
			var data=this.state.data;
			data.length=0;
			for(var i in response) {
				data.push({value:response[i].value, label:response[i].label, description:response[i].description});
			}
			this.setState({data : data, placeholder:'Choose Terms'});
		}.bind(this)
	});
},
componentWillUnmount : function () {
	this.request.abort();
},
_ajaxRequest : function (source) {
	$.ajax({
		url:source,
		dataType: 'json',
		type:'GET',
		beforeSend : function () {
			this.setState({placeholder:'loading...'});
		}.bind(this),
		success : function (response) {
			var data=this.state.data;
			data.length=0;
			for(var i in response) {
				data.push({value:response[i].value, label:response[i].label, description:response[i].description});
			}
			this.setState({data : data, placeholder:'Choose Terms'});
		}.bind(this)
	});
},
componentWillReceiveProps : function (nextprops) {
	return this._ajaxRequest(nextprops.source)
},
handleChange : function (event) {
	var obj = {};
	obj.name = 'terms_id';
	obj['terms_id'] = event.value;
	obj['terms_label'] = event.label;
	this.setState({defaultValue:event.value});
	this.props.callBackParent(obj);
},
render : function () {
	return( 
		<td>
			<Select onChange={this.handleChange} 
            id="terms_id" 
            className="react-select-input-mainline" 
            name="terms_id"
            value={this.state.defaultValue}
            options={this.state.data} 
            placeholder={this.state.placeholder} 
            clearable={false} />
		</td>
	);
}
});

/***********************************************************************************************************************************
***********************************************************************************************************************************/
window.CanvassPrice = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			edit:false
		};
	},
	getInitialState : function () {
		return { data:[] };
	},
	handleChange : function (event) {
		var obj = {};
		obj.name = 'cost';
		obj['cost'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	name="cost"
            	className="form-control" />
			</td> 
		);
	}
});