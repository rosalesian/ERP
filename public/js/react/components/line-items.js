window.DataStorage = React.createClass ({
	render : function () {
		return( <input type="hidden" name={this.props.name} value={JSON.stringify(this.props.data)}/> )
	}
});

window.TableComponent = React.createClass({
	getInitialState : function () {
		var columns=[];

		for(var i=0, colcount=this.props.table.columns.length; i<colcount; i++) {
			columns[this.props.table.columns[i].name] = this.props.table.columns[i];
		}

		return {
			columns: columns,
			inputValues:{},
			dataStorage:[],
			rows:[],
			canvassItems:{},
			editLineItem : false
		};
	},
	render : function () {
		var that = this;
		return(
			<div className="tableWrapper">

				<DataStorage data={this.state.dataStorage} name={this.props.table.storage} />

				<table className="table table-bordered react-table" style={{overflow:'auto'}}>
				<thead>
					<tr>
						{this.props.table.columns.map(function(column){
							return ( <th id={column.name} key={column.name}>{column.displayName}</th> );
						})}
					</tr>
				</thead>
				<tbody>
					{this.state.rows.map(function(row){
						return row
					})}

					{!this.state.editLineItem && (
					<tr style={{width:'auto'}}>
						{that.props.table.columns.map(function (column){
							if(column.fieldType=='link') {
								return( <LineInputComponent defaultValue={(that.state.inputValues!='') ? that.state.inputValues[column.name] : '' 	} column={that.state.columns[column.name]} key={column.name} callBackDisplay={that.displayModal} edit={true}/> );
							} else {
								return( <LineInputComponent defaultValue={(that.state.inputValues!='') ? that.state.inputValues[column.name] : '' 	} column={that.state.columns[column.name]} key={column.name} callBackUpdateOnChange={that.handleInputChangeEvent} edit={true}/> );
							}
						})}
					</tr>	
					)}		

					<tr>
						<td colSpan={this.props.table.columns.length}>
							{!this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add"} className={"btn btn-primary btn-flat"} onClick={that.handleAdd} /> )}
							{!this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} value={"Cancel"} className={"btn btn-default btn-flat"} onClick={that.handleCancel} /> )}
							{this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add New"} className={"btn btn-info btn-flat"} onClick={that.handleCancelCallback} /> )}
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		);
	},
	displayModal : function (id) {
		var rows;
		console.log(this.state.canvassItems);
		if(this.state.canvassItems.data==0) { rows=0 } else { rows = this.state.canvassItems.data };
		ReactDOM.render(<CanvassParentComponent rows={rows} handleSaveCanvass={this.handleSaveCanvass}/>, document.getElementById('myModal'))
	},
	displayModalEdit : function (id) {
		var rows; //= (typeof this.state.dataStorage[id]!='undefined' && this.state.canvassItems.data==0) ? this.state.dataStorage[id].canvass : [];	
		if(typeof this.state.dataStorage[id]!='undefined' && this.state.canvassItems.data==0) {
			rows = this.state.dataStorage[id].canvass;
		} else {
			rows = this.state.canvassItems.data;
		}

		ReactDOM.render(<CanvassParentComponent rows={rows} handleSaveCanvass={this.handleSaveCanvass}/>, document.getElementById('myModal'))
	},
	handleSaveCanvass: function (data) {
		var canvassItems = this.state.canvassItems;
		canvassItems = {'data': data};
		console.log(canvassItems);
		this.setState({canvassItems:canvassItems});
	},
	getUnitOfMeasure : function (item) {
		var data=[];
		var rateCS, ratePC, rateBX, ratePCK;
		if(item=='data1') {
		 data = [{value:"cs", label:"CS", conversionrate:12},{value:"pc", label:"PC", conversionrate:1},{value:"bx", label:"BX", conversionrate:3},{value:"pck", label:"PACK", conversionrate:5}];
		} else if(item=='data2') {
		 data = [{value:"cs", label:"CS", conversionrate:24},{value:"pc", label:"PC", conversionrate:1}];
		} else {
		 data = [{value:"cs", label:"CS", conversionrate:48},{value:"pc", label:"PC", conversionrate:1},{value:"bx", label:"BX", conversionrate:3}];
		}
		return data;
	},
	getRate : function (item) {
		var data={};
		if(item=='data1') data = {value:"100", conversion_factor:"12"};
		if(item=='data2') data = {value:"200", conversion_factor:"24"};
		if(item=='data3') data = {value:"300", conversion_factor:"48"};
		return data;	
	},
	computeGrossAmount : function (inputValues) {
		var rate = this.getRate(inputValues['item']);	
		inputValues['rate'] = (typeof inputValues['conversionrate'] !='undefined' && inputValues['uom']!='') ? parseFloat(parseInt(rate.value)/parseInt(rate.conversion_factor)) * inputValues['conversionrate'] : 0;
		inputValues['amount'] =  (typeof inputValues['quantity'] =='undefined' || inputValues['quantity'] =='' || isNaN(inputValues['quantity'])) ? 0 : parseInt(inputValues['quantity']) * parseFloat(inputValues['rate']);
		inputValues['vatamount'] = inputValues['amount'] * 0.12;
		inputValues['grossamount'] = inputValues['amount'] + inputValues['vatamount'];
		return inputValues;
	},
	handleInputChangeEvent : function (column, event){
		var inputValues = this.state.inputValues;
		var serverData = this.state.serverData;
		var columnsUpdate = this.state.columns;
		var purchaseprice={};

		switch(column.fieldType) {
			case "select":
				if(column.name=='item') {
					this.props.table.columns.map(function (column){
						if(column.name!='item'){
							inputValues[column.name]='';
						}
					})

					inputValues[column.name] = event.value;
					columnsUpdate['uom']['data'] = this.getUnitOfMeasure(event.value);
					inputValues['description'] = event.description;
					inputValues = this.computeGrossAmount(inputValues);
				}

				if(column.name=='uom') {
					inputValues['conversionrate'] = event.conversionrate;
					inputValues[column.name] = event.value;
					inputValues = this.computeGrossAmount(inputValues);					
				}
				break;	
			case "text":
				inputValues[column.name] = event.target.value;
				if(column.name=='quantity') {
					inputValues = this.computeGrossAmount(inputValues);
				}
				break;	
		}
		this.setState({inputValues:inputValues, columns:columnsUpdate});
	},
	handleAdd : function () {
		var canvassItems = this.state.canvassItems;
		var inputValues = this.state.inputValues;
		var obj={};
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		var rowCounter = rows.length;

		{this.props.table.columns.map(function (column){
			obj[column.name] = inputValues[column.name];
			inputValues[column.name] = '';
		})}

		obj.canvass = canvassItems.data;
		dataStorage.push(obj);
		
		canvassItems.data = 0;
		rows.push( <LineRow columns={this.props.table.columns} data={obj} id={rowCounter} callbackParent={this.lineRowCallBack} /> );
		this.setState({rows: rows, dataStorage:dataStorage, inputValues:inputValues, canvassItems:canvassItems});
	},
	handleCancel : function () {
		var inputValues = this.state.inputValues;
		var canvassItems = this.state.canvassItems;
		
		{this.props.table.columns.map(function (column) {
			inputValues[column.name] = '';
		})}
		canvassItems.data = 0;

		this.setState({inputValues:inputValues, editLineItem:false, canvassItems:canvassItems});
	},
	handleCancelCallback: function(){
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		var canvassItems = this.state.canvassItems;
		canvassItems.data = 0;
		rows.length=0;
		this.setState({rows:rows, canvassItems:canvassItems});


		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} />
		}

		this.setState({rows: rows, editLineItem:false});
	},
	handleUpdate : function (columns,dataIndex) {
		var dataStorage = this.state.dataStorage;
		var canvassItems = this.state.canvassItems;

		var rows = this.state.rows;
		var inputValues = this.state.inputValues;

		for(var j in columns) {
			if(inputValues[columns[j].name]!=null) {
				dataStorage[dataIndex][columns[j].name] = inputValues[columns[j].name];
			}
		}

		dataStorage[dataIndex].canvass = canvassItems.data;

		rows.length=0;
		this.setState({rows:rows});
		canvassItems.data = 0;

		for(var i in dataStorage) {
			rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} />
		}

		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false, canvassItems:canvassItems});
		console.log(this.state);
	},
	handleRemove : function (dataIndex) {
		var dataStorage = this.state.dataStorage;
		dataStorage.splice(dataIndex,1);
		var rows = this.state.rows;
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} />
		}

		this.setState({
			rows:rows, 
			dataStorage:dataStorage, 
			editLineItem:false
		});
	},
	lineRowCallBack : function(rowElem) {
		var elemArr = rowElem.split('-');
		var rowid = parseInt(elemArr[1]-1);
		
		var inputValues = this.state.inputValues;

		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(i==rowid) {
				for(var j=0, colcount=this.props.table.columns.length; j<colcount; j++) {
					inputValues[this.props.table.columns[j].name] = dataStorage[i][this.props.table.columns[j].name];
				}
				rows[i] = <LineRow columns={this.props.table.columns} data={inputValues} id={i} callbackParent={this.lineRowCallBack} anotherCallBack={this.handleUpdateChangeEventTrigger} callBackDisplay={this.displayModalEdit} edit={true} />
			} else {
				rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} edit={false}/>
			}
		}

		rows.splice(elemArr[1], 0, (<LineItemButtons columns={this.props.table.columns} dataIndex={rowid} callbackUpdate={this.handleUpdate} callbackCancel={this.handleCancelCallback} callbackRemove={this.handleRemove}/>));
		this.setState({rows: rows,editLineItem:true, dataStorage:dataStorage, inputValues:inputValues});
	},
	handleEditChange : function (objdata) {
		var inputValues = this.state.inputValues;
		inputValues[objdata.key] = objdata.value;
		this.setState({inputValues: inputValues});
	},
	handleUpdateChangeEventTrigger : function(column, event, index) {
		var inputValues = this.state.inputValues;
		var columnsUpdate = this.state.columns;
		var rows = this.state.rows;
		switch(column.name) {
			case "item":
				inputValues[column.name] = event.value;
				columnsUpdate['uom']['data'] = this.getUnitOfMeasure(event.value);
				inputValues['description'] = event.description;
				for(var j=0, counter=columnsUpdate['uom']['data'].length; j<counter; j++) {
					if(columnsUpdate['uom']['data'][j].value==inputValues['uom']){
						inputValues['conversionrate'] = columnsUpdate['uom']['data'][j].conversionrate;
						break;
					}
				}
				inputValues = this.computeGrossAmount(inputValues);
				break;
			case "uom":
				inputValues['conversionrate'] = event.conversionrate;
				inputValues[column.name] = event.value;
				inputValues = this.computeGrossAmount(inputValues);		
				break;
			case "quantity":
				inputValues[column.name] = event.target.value;
				inputValues = this.computeGrossAmount(inputValues);
				break;		
		}
		rows[index] = <LineRow columns={this.props.table.columns} data={inputValues} id={index} callbackParent={this.lineRowCallBack} anotherCallBack={this.handleUpdateChangeEventTrigger} edit={true} />
		this.setState({rows:rows, inputValues:inputValues, columns:columnsUpdate});
	}

});

window.LineItemButtons = React.createClass({
	handleUpdate : function () {
		this.props.callbackUpdate(this.props.columns, this.props.dataIndex);
	},
	handleCancel : function () {
		this.props.callbackCancel();
	},
	handleRemove : function () {
		this.props.callbackRemove(this.props.dataIndex);
	},
	render : function () {
		return (
				<tr colSpan={this.props.columns.length}><td colSpan={this.props.columns.length}>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleUpdate} value={"OK"} className={"btn btn-primary btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleCancel} value={"Cancel"} className={"btn btn-default btn-flat"}/>
					<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleRemove} value={"Remove"} className={"btn btn-default btn-flat"}/>
				</td></tr>
			);
	}
});

window.LineInputComponent = React.createClass({
	getDefaultProps : function () {
		return {
			column: {
				data:[]
			},
			edit:false
		};
	},
	getInitialState : function() {
		return {
			defaultValue:''
		};
	},
	componentWillReceiveProps : function(nextProps) {
		this.setState({defaultValue:nextProps.defaultValue});
	},
	onChangeHandler : function(column, event) {
		switch(column.fieldType) {
			case "select":
				this.setState({defaultValue:event.value});
				break;
			case "text":
				this.setState({defaultValue:event.target.value});
				break;	
		}
		this.props.callBackUpdateOnChange(column, event);
	},
	render : function () {
		var field;
		var column = this.props.column;
		if(this.props.edit) {
			switch(column.fieldType) {
				case "select":
					field = <Select className={column.className} name="form-field-name" value={this.state.defaultValue} options={column.data} onChange={this.onChangeHandler.bind(this,column)} clearable={false} />
					break;
				case "text":
					field = <input name={column.name} value={this.state.defaultValue} type={column.type} className={column.className} id={column.name}  onChange={this.onChangeHandler.bind(this,column)}/>;
					break;
				case "disabled":
					// field = <input name={column.name} value={this.state.defaultValue} type='text' disabled className={column.className} id={column.name} />;//  onChange={this.props.onChangeHandler.bind(this,column)}/>;
					field = <span>{this.state.defaultValue}</span>;
					break;
				case "link":
					field = <a href="#" data-toggle="modal" data-target="#myModal" onClick={this.displayModal}><i className="fa fa-toggle-up" style={{fontSize:"25px",marginLeft:"30%"}}></i></a>
					break;	
			}
		} else {
			field = this.props.edit;
		}

		return( <td> {field} </td> );
	},
	displayModal : function () {
		this.props.callBackDisplay();
	}
});

window.LineRow = React.createClass({
	getDefaultProps : function () {
		return {
			edit : false
		}
	},
	handleRowClick : function(event) {
		this.props.callbackParent(event.currentTarget.id);
	},
	handleCallBack : function(column,event) {
		this.props.anotherCallBack(column,event, this.props.id);
	},
	callBackDisplay : function () {
		this.props.callBackDisplay(this.props.id);
	},
	render: function () {
		var that = this;
		var row;
		if(this.props.edit) {
			return( <tr id={"item-"+parseInt(this.props.id+1)}>
					{this.props.columns.map(function (column) {
						if(column.fieldType=='link') {
							return( <LineColumn callBackDisplay={that.callBackDisplay} defaultValue={that.props.data[column.name]} column={column} data={that.props.data} key={column.name} edit={true} /> ); 
						} else {
							return( <LineColumn callbackParentRow={that.handleCallBack} defaultValue={that.props.data[column.name]} column={column} data={that.props.data} key={column.name} edit={true} /> ); 
						}
					})};
				</tr> );
		} else {
			return( <tr onClick={this.handleRowClick} id={"item-"+parseInt(this.props.id+1)}>
					{this.props.columns.map(function (column){
						return( <LineColumn column={column} data={that.props.data} key={column.name} /> );
					})};
				</tr> );
		}
	}
});
window.LineColumn = React.createClass({
	getDefaultProps : function () {
		return {
			edit : false
		}
	},
	getInitialState : function () {
		return {
			defaultValue:this.props.defaultValue
		}
	},
	handleChange : function (event) {
		var obj={};
		switch(this.props.column.fieldType){
			case "select":
				// obj['key'] = this.props.column.name;
				// obj['value'] = event.value;
				// obj[this.props.column.name] = event.value;
				this.setState({defaultValue:event.value, obj:obj});
				this.props.callbackParentRow(this.props.column, event);
				break;
			case "text":
				obj['key'] = this.props.column.name;
				obj['value'] = event.value;
				// obj[this.props.column.name] = event.target.value;
				this.setState({defaultValue:event.target.value, obj:obj});
				this.props.callbackParentRow(this.props.column, event);
				break;
		}
	},
	componentWillReceiveProps: function(nextProps) {
    	this.setState({defaultValue: nextProps.defaultValue});
	},
	displayModal : function () {
		this.props.callBackDisplay();
	},
	render : function () {
		var field;
		var that = this;
		if(this.props.edit) {
			switch(this.props.column.fieldType) {
				case "select":
						field = <Select className={this.props.column.className} name="form-field-name" value={this.state.defaultValue} options={this.props.column.data} onChange={this.handleChange} clearable={false} />
						break;
				case "text":
						field = <input id={this.props.column.name+'_row'} name={this.props.column.name} value={ this.state.defaultValue } type={this.props.column.type} className={this.props.column.className} id={this.props.column.name}  onChange={this.handleChange}/>;
						break;
				case "disabled":
					field = <span>{this.state.defaultValue}</span>;
					break;
				case "link":
					field = <a href="#" data-toggle="modal" data-target="#myModal" onClick={this.displayModal}><i className="fa fa-toggle-up" style={{fontSize:"25px",marginLeft:"30%"}}></i></a>
					break;			
			}
		} else {

			switch(this.props.column.fieldType) {
				case "select":
					var that = this;
					this.props.column.data.map(function (option) {
						if(option.value==that.props.data[that.props.column.name]) {
							field = option.label;
						}
					});
					break;
				case "text":
					field = this.props.data[this.props.column.name];
					break;	
				case "disabled":
				field = this.props.data[this.props.column.name];
				break;	
			}
		}
		return(<td> {field} </td>);
	}
});