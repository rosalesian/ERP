function getItems () {
	return [
		{value:"data1", label:"4000318 CDM FRUIT & NUT 6X24X65G", description:"This is Data 1"},
		{value:"data2", label:"4005793 CDM ROAST ALMOND 6X24X65G (CS)", description:"This is Data 2"},
		{value:"data3", label:"4000304 30G CDM FRUIT & NUT (1X12X24)", description:"This is Data 3"}
	];
}

function getDays () {
	return [
		{value:'1day', label:'1 Day'},
		{value:'11day', label:'11 Days'},
		{value:'10day', label:'10 Days'},
		{value:'15day', label:'15 Days'},
		{value:'20day', label:'20 Days'}
	];
}

window.CanvassDataStorage = React.createClass({
	render : function () {
		return( <input type="hidden" name={'canvassDataStorage'} value={JSON.stringify(this.props.data)} /> )
	}
});

window.CanvassParentComponent = React.createClass({
	getDefaultProps : function() {
		return {
			edit: false,
			rows : []
		};
	},
	componentWillReceiveProps : function (nextprops) {
		if(nextprops.rows.length>0) {
			var obj={};
			var rows=this.state.rows;
			var dataStorage = this.state.dataStorage;
			rows.length=0;
			dataStorage.length=0;

			for(var i=0, counter=nextprops.rows.length; i<counter; i++) {
				obj = {
					vendors : getItems(),
					days : getDays(),
					vendor:nextprops.rows[i].vendor,
					price:nextprops.rows[i].price,
					approved:nextprops.rows[i].approved,
					day:nextprops.rows[i].day
				}
				dataStorage.push(obj);
				rows.push(<LineRowCanvass data={obj} index={i+1} callBackClick = {this.handleClickEventEdit}/>)
			}
			this.setState({rows:rows, dataStorage:dataStorage});
		} else {
			this.setState({rows:[], dataStorage:[]});
		}
	},
	getInitialState : function() {
		var rows=[];
		var dataStorage=[];
		if(this.props.rows.length>0) {	
			var obj={};
			for(var i=0, counter=this.props.rows.length; i<counter; i++) {
				obj = {
					vendors : getItems(),
					days : getDays(),
					vendor:this.props.rows[i].vendor,
					price:this.props.rows[i].price,
					approved:this.props.rows[i].approved,
					day:this.props.rows[i].day
				}
				dataStorage.push(obj);
				rows[i] = <LineRowCanvass data={obj} index={i+1} callBackClick = {this.handleClickEventEdit}/>
			}
		}
		
		return {
			dataStorage:dataStorage,
			rows:rows,
			vendorValue:'',
			priceValue:'',
			approvedValue:'',
			dayValue:'',
			edit: false
		}
	},
	onChangeVendor : function (evt) {
		this.setState({vendorValue:evt.value});
	},
	onChangePrice : function (evt) {
		this.setState({priceValue:evt.target.value});
	},
	onChangeApproved : function (evt) {
		this.setState({approvedValue:(evt.target.value=='on')?1:0});
	},
	onChangeDay : function (evt) {
		this.setState({dayValue:evt.value});
	},
	handleAdd : function() {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		var rowcounter = rows.length + 1;

		var obj = {
			vendors : getItems(),
			days : getDays(),
			vendor : this.state.vendorValue,
			price : this.state.priceValue, 
			approved : (this.state.approvedValue=="") ? 0 : 1,
			day : this.state.dayValue
		};
		
		dataStorage.push(obj);

		rows.push( <LineRowCanvass data={obj} index={rowcounter} callBackClick = {this.handleClickEventEdit}/> );

		this.setState({
			dataStorage:dataStorage,
			rows:rows,
			vendorValue:'',
			priceValue:'',
			approvedValue:'',
			dayValue:''
		});
	},
	handleClickEventEdit : function (index) {
		var elemArr = index.split('-');
		var rowid = parseInt(elemArr[1]-1);
		var vendorValue = this.state.vendorValue;
		var priceValue = this.state.priceValue;
		var approvedValue = this.state.approvedValue;
		var dayValue = this.state.dayValue;

		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.length=0;
		this.setState({rows:rows});
		
		var obj;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(i==rowid) {
				vendorValue = dataStorage[i].vendor;
				priceValue = dataStorage[i].price;	
				approvedValue = dataStorage[i].approved;
				dayValue = dataStorage[i].day;

				obj = {
					vendors : getItems(),
					days : getDays(),
					vendor:vendorValue,
					price:priceValue,
					approved:approvedValue,
					day:dayValue
				}

				rows[i] = <LineRowCanvass data={obj} index={i+1} onChangeDay={this.onChangeDay} onChangeApproved={this.onChangeApproved} onChangeVendor={this.onChangeVendor} onChangePrice={this.onChangePrice} edit={true} />
			} else {
				obj = {
					vendors : getItems(),
					days : getDays(),
					vendor:dataStorage[i].vendor,
					price:dataStorage[i].price,
					approved:dataStorage[i].approved,
					day:dataStorage[i].day
				}
				rows[i] = <LineRowCanvass data={obj} index={i+1} callBackClick = {this.handleClickEventEdit}/>
			}
		}

		rows.splice(elemArr[1], 0, (<CanvassUpdateButtons dataIndex={rowid} callbackUpdate={this.handleUpdate} callbackCancel={this.handleCancel} callbackRemove={this.handleRemove}/>));
		this.setState({
			rows:rows, 
			edit:true, 
			dataStorage:dataStorage,
			vendorValue:vendorValue,
			priceValue:priceValue,
			approvedValue:approvedValue,
			dayValue:dayValue
		});
	},
	handleUpdate : function (id) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		var vendorValue = this.state.vendorValue;
		var priceValue = this.state.priceValue;
		var approvedValue = this.state.approvedValue;
		var dayValue = this.state.dayValue;
				
		if(vendorValue!=null && priceValue!=null && approvedValue!=null && dayValue!=null) {
			dataStorage[id]['vendor'] = vendorValue;
			dataStorage[id]['price'] = priceValue;
			dataStorage[id]['approved'] = approvedValue;
			dataStorage[id]['day'] = dayValue;
		}

		rows.length=0;
		this.setState({rows:rows});
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(approvedValue!='0') {
				if(i==id) {
					dataStorage[i]['approved'] = approvedValue;
				} else {
					dataStorage[i]['approved'] = 0;
				}
			}

			rows[i] = <LineRowCanvass data={dataStorage[i]} index={i+1} callBackClick = {this.handleClickEventEdit}/>
		}

		this.setState({rows:rows, dataStorage:dataStorage, edit:false});
	},
	handleRemove : function (id) {
		var dataStorage = this.state.dataStorage;
		dataStorage.splice(id,1);
		var rows = this.state.rows;
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <LineRowCanvass data={dataStorage[i]} index={i+1} callBackClick = {this.handleClickEventEdit}/>
		}

			this.setState({
			rows:rows,
			dataStorage:dataStorage,
			edit:false,
			vendorValue:'',
			priceValue:'',
			approvedValue:'',
			dayValue:'',
		});
	},
	handleCancel : function () {
		if(this.state.edit) {
			var rows = this.state.rows;
			var dataStorage = this.state.dataStorage;
			rows.length=0;
			this.setState({rows:rows});

			for(var i=0, counter=dataStorage.length; i<counter; i++) {
				rows[i] = <LineRowCanvass data={dataStorage[i]} index={i+1} callBackClick = {this.handleClickEventEdit}/>
			}

			this.setState({
				rows:rows, 
				edit:false,
				vendorValue:'',
				priceValue:'',
				approvedValue:'',
				dayValue:'',
			});

		} else {
			var vendorValue = this.state.vendorValue;
			var priceValue = this.state.priceValue;
			var approvedValue = this.state.approvedValue;
			var dayValue = this.state.dayValue;
			// var dataStorage = this.state.dataStorage;
			// var rows = this.state.rows;
			// dataStorage.length = 0;
			// rows.length = 0;

			this.setState({
//				rows: rows,
//				dataStorage: dataStorage,
				vendorValue:'',
				priceValue:'',
				approvedValue:'',
				dayValue:'',
				edit:false
			});
		}
	},
	handleSaveCanvass : function () {
		// alert('Canvass Added Successfully');
		var data = [];
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			data.push({
				vendor: dataStorage[i].vendor,
				price: dataStorage[i].price,
				approved: dataStorage[i].approved,
				day: dataStorage[i].day
			});
		}

		this.props.handleSaveCanvass(data);
		dataStorage.length=0;
		rows.length = 0;
		this.setState({dataStorage:dataStorage, rows:rows});
	},
	render : function () {
		return (
			<div className="modal-dialog">
            	<div className="modal-content" style={{width:'900px',marginLeft:'-20%'}}>
	            <div className="modal-header">
		                <button type="button" className="close" data-dismiss="modal" aria-label="Close">
		                  <span aria-hidden="true">×</span></button>
		                <h4 className="modal-title">Canvass Items</h4>
	            </div>
	            <div className="modal-body" id="modalContainer">

					<CanvassDataStorage data={this.state.dataStorage}/>

					<table className="table table-bordered">
					<thead>
					<tr>
						<th>Approved</th>
						<th>Vendor</th>
						<th>Price</th>
						<th>Day(s)</th>
					</tr>
					</thead>
					<tbody>
						{this.state.rows.map(function (row) {
							return row;
						})}

					{!this.state.edit && (	
					<tr>
						<td> <input type="radio" name="approved" onChange={this.onChangeApproved.bind(this)} /> </td>
						<td> <Select className="react-select-input-lineitem" value={this.state.vendorValue} options={getItems()} onChange={this.onChangeVendor.bind(this)} clearable={false} /> </td>
						<td> <input type="text" value={this.state.priceValue} className='form-control' onChange={this.onChangePrice.bind(this)}/> </td>
						<td> <Select className="react-select-input-lineitem" value={this.state.dayValue} options={getDays()} onChange={this.onChangeDay.bind(this)} clearable={false} /> </td>
					</tr>)}
					<tr>
						<td colSpan="4">
							{!this.state.edit && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add"} className={"btn btn-primary btn-flat"} onClick={this.handleAdd} /> )}
							{!this.state.edit && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} value={"Cancel"} className={"btn btn-default btn-flat"} onClick={this.handleCancel} /> )}
							{this.state.edit && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add New"} className={"btn btn-info btn-flat"} onClick={this.handleCancel} /> )}
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
	}
});

window.CanvassUpdateButtons = React.createClass({
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
				<tr colSpan={4}>
				<td colSpan={4}>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleUpdate} value={"OK"} className={"btn btn-primary btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleCancel} value={"Cancel"} className={"btn btn-default btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleRemove} value={"Remove"} className={"btn btn-default btn-flat"}/>
				</td></tr>
			);
	}
});

window.LineRowCanvass = React.createClass({
	getDefaultProps : function () {
		return {
			edit:false
		}
	},
	getInitialState : function () {
		return {
			defaultApproved:this.props.data.approved,
			defaultVendor:this.props.data.vendor,
			defaultPrice:this.props.data.price,
			defaultDay:this.props.data.day,
		};
	},
	handleClick : function (evt) {
		this.props.callBackClick(evt.currentTarget.id);
	},
	onChangeApproved : function (evt) {
		this.setState({defaultApproved:evt.target.value});
		this.props.onChangeApproved(evt);
	},
	onChangeVendor : function (evt) {
		this.setState({defaultVendor:evt.value});
		this.props.onChangeVendor(evt);
	},
	onChangePrice : function (evt) {
		this.setState({defaultPrice:evt.target.value});
		this.props.onChangePrice(evt);
	},
	onChangeDay : function (evt) {
		this.setState({defaultDay:evt.value});
		this.props.onChangeDay(evt);
	},
	render : function () {
		var vendor, day;
		if(this.props.edit) {
			// Get Label of the vendor selected
			for(var i in this.props.data.vendors) {
				if(this.props.data.vendors[i].value==this.props.data.vendor){
					vendor = this.props.data.vendors[i].label;
					break;
				};
			}

			// Get Label of the day selected
			for(var i in this.props.data.days) {
				if(this.props.data.days[i].value==this.props.data.day){
					day = this.props.data.days[i].label;
					break;
				};
			}
			
			var radio;
			if(this.state.defaultApproved==1) {
				radio = <input type="radio" checked onChange={this.onChangeApproved}/>
			} else { 
				radio = <input type="radio" onChange={this.onChangeApproved}/> 
			}
		
			return(
				<tr>
					<td> {radio} </td>
					<td> <Select className="react-select-input-lineitem" value={this.state.defaultVendor} options={this.props.data.vendors} onChange={this.onChangeVendor} clearable={false} /> </td>
					<td> <input type="text" value={this.state.defaultPrice} className='form-control' onChange={this.onChangePrice}/> </td>
					<td> <Select className="react-select-input-lineitem" value={this.state.defaultDay} options={this.props.data.days} onChange={this.onChangeDay} clearable={false} /> </td>
				</tr>
			);
		} else {

			// Get Label of the vendor selected
			for(var i in this.props.data.vendors) {
				if(this.props.data.vendors[i].value==this.props.data.vendor){
					vendor = this.props.data.vendors[i].label;
					break;
				};
			}

			// Get Label of the day selected
			for(var i in this.props.data.days) {
				if(this.props.data.days[i].value==this.props.data.day){
					day = this.props.data.days[i].label;
					break;
				};
			}

			return (
				<tr onClick={this.handleClick} id={'item-'+this.props.index}>
					<td>{(this.props.data.approved=='1') ? 'Yes' : 'No'}</td>
					<td>{vendor}</td>
					<td>{this.props.data.price}</td>
					<td>{day}</td>
				</tr>
			);

		}
	}
});

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
			rows=[];
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
			editLineItem:this.props.editLineItem,
			dataStorage:dataStorage,
			rows:rows,
			vendor_id:'',
			vendor_label:'',
			terms_id:'',
			terms_label:'',
			price:'',
			pr_id:this.props.pr_id
		};
	},
	_initial_data : function () {
		var state = {};
			state.vendor_id = '';
			state.vendor_label=''; 
			state.terms_label='';
			state.terms_id = ''
			state.price='';
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
				case "price":
						state.price=obj.price;
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
			price:this.state.price
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
		state.price = dataStorage[rowid].price;
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
			price:this.state.price
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
						defaultValue={this.props.defaultValues.price} />

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
						defaultValue={this.props.defaultValues.price} />

						<CanvassTerms callBackParent={this.handleCallBack} 
						source={base_url+'/ajax/getItems'}
						defaultValue={this.props.defaultValues.terms_id} />
					</tr>
					);
				} else {
					return (
						<tr onClick={this.handleClick} id={"item-"+parseInt(this.props.id+1)}>
							<td>{this.props.defaultValues.vendor_label}</td>
							<td>{this.props.defaultValues.price}</td>
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
		obj.name = 'price';
		obj['price'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	name="price"
            	className="form-control" />
			</td> 
		);
	}
});