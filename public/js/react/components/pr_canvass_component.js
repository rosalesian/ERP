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