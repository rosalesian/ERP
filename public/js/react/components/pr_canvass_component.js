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
		return {
			editLineItem:false,
			dataStorage:[],
			term_lists:[],
			vendor_lists:[],
			rows:[],
			vendor_id:'',
			terms_id:'',
			cost:'',
			pr_id:this.props.pr_id
		};
	},
	componentDidMount : function () {
		this._ajaxRequest(base_url+'/api/getCanvassLists', this.props);
	},
	_ajaxRequest : function (source, props) {
		return $.ajax({
			url:source,
			dataType: 'json',
			type:'GET',
			success : function (response) {
				var vendor_lists = this.state.vendor_lists;
				var term_lists = this.state.term_lists
				var dataStorage = this.state.dataStorage;
				var rows=this.state.rows;
				rows.length=0;
				dataStorage.length=0;
				vendor_lists.length=0;
				term_lists.length=0;
				vendor_lists = response.vendors;
				term_lists = response.terms;

				if(props.data.length!=0) {
					dataStorage = props.data;
					for(var i=0, counter=dataStorage.length; i<counter; i++) {
						rows[i] = <CanvassRow callBackParent={this.handleCallBack}
									defaultValues={dataStorage[i]}
									id={i}
									key={i}
									lists={{vendor_lists:vendor_lists, term_lists:term_lists}}
									pr_id={props.pr_id}
									context={props.context}
									handleCallBackParentClick={this.handleCallBackClick} />
					}
				}

				this.setState({
					vendor_lists : vendor_lists,
					term_lists : term_lists,
					rows:rows,
					dataStorage:dataStorage
				});

			}.bind(this)
		});
	},
	componentWillReceiveProps : function(nextprops) {
		this._ajaxRequest(base_url+'/api/getCanvassLists', nextprops);
	},
	_initial_data : function () {
		var state = {};
			state.vendor_id = '';
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
					lists={{vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists}}
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
			this.props.callBackCanvassSave(data); //Update Parent data
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
					break;
				case "terms_id":
						state.terms_id = obj.terms_id;
					break;
				case "cost":
						state.cost=obj.cost;
					break;	
			}
			rows[obj.id] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={state}
							lists={{vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists}}
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
					defaultValues={this.state}
					lists={{ vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists }}
					id={rows.length}
					key={rows.length}
					handleCallBackParentClick={this.handleCallBackClick}/> );
		var obj={};
		obj.id='';
		obj.vendor_id = this.state.vendor_id;
		obj.terms_id = this.state.terms_id;
		obj.cost = this.state.cost;

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
							lists={{vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists}}
							id={i}
							key={i}
							handleCallBackParentClick={this.handleCallBackClick} />
			} else {
				rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							lists={{ vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists }}
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
		state.terms_id = dataStorage[rowid].terms_id;
		state.cost = dataStorage[rowid].cost;
		this.setState(state);

		this.setState({rows:rows, editLineItem:true});
	}
	},
	handleUpdate : function (id) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		rows.length=0;

		dataStorage[id].vendor_id = this.state.vendor_id;
		dataStorage[id].terms_id = this.state.terms_id;
		dataStorage[id].cost = this.state.cost;

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <CanvassRow callBackParent={this.handleCallBack}
							defaultValues={dataStorage[i]}
							id={i}
							lists={{ vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists }}
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
							lists={{ vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists }}
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
								lists={{ vendor_lists:this.state.vendor_lists, term_lists:this.state.term_lists }}
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
			context:'',
			lists:{
				vendor_lists:[],
				term_lists:[]
			}
		}
	},
	_getVendorLabel : function (vendorid) {
		var lists = this.props.lists.vendor_lists;
		for(var i=0, count=lists.length; i<count; i++) {
			if(lists[i].value==vendorid) {
				return lists[i].label;
			}
		}
	},
	_getTermLabel : function (termid) {
		var lists = this.props.lists.term_lists;
		for(var i=0, count=lists.length; i<count; i++) {
			if(lists[i].value==termid) {
				return lists[i].label;
			}
		}
	},
	render : function () {
			if(this.props.create) {
				return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<InputLineComponent 
						callBackParent={this.handleCallBack}
						options={this.props.lists.vendor_lists}
						defaultValue={this.props.defaultValues.vendor_id}
						attributes={{name:"vendor_id", type:"select", placeholder:"CHOOSE VENDOR"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.cost} 
						attributes={{name:'cost', type:"text"}}/>

						<InputLineComponent 
						callBackParent={this.handleCallBack}
						options={this.props.lists.term_lists}
						defaultValue={this.props.defaultValues.terms_id}
						attributes={{name:"terms_id", type:"select", placeholder:"CHOOSE TERMS"}} />
					</tr>
				);
			} else {
				if(this.props.edit) {
					return (
					<tr id={"item-"+parseInt(this.props.id+1)}>
						<InputLineComponent 
						callBackParent={this.handleCallBack}
						options={this.props.lists.vendor_lists}
						defaultValue={this.props.defaultValues.vendor_id}
						attributes={{name:"vendor_id", type:"select", placeholder:"CHOOSE VENDOR"}} />

						<InputLineComponent callBackParent={this.handleCallBack} 
						defaultValue={this.props.defaultValues.cost} 
						attributes={{name:'cost', type:"text"}}/>

						<InputLineComponent 
						callBackParent={this.handleCallBack}
						options={this.props.lists.term_lists}
						defaultValue={this.props.defaultValues.terms_id}
						attributes={{name:"terms_id", type:"select", placeholder:"CHOOSE TERMS"}} />
					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{ this._getVendorLabel(this.props.defaultValues.vendor_id) }</td>
							<td>{ this.props.defaultValues.cost }</td>
							<td>{ this._getTermLabel(this.props.defaultValues.terms_id) }</td>
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