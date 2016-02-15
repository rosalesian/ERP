window.LineItems = React.createClass({
	getInitialState: function() {
		var rows = [];
		var dataStorage = [];
		var objectValues= {};
		if(this.props.initialData) {
			for(var i=0, counter=this.props.initialData.length; i<counter; i++) {
				
				var obj = {}
				for(var j=0, colcount= this.props.table.columns.length; j<colcount; j++) {
					obj[this.props.table.columns[j].name] = this.props.initialData[i][this.props.table.columns[j].name]
				}

				dataStorage.push(obj)
				rows.push(<LineRow columns={this.props.table.columns} data={obj} id={i} callbackParent={this.lineRowCallBack} />)
			}

			return {
				dataStorage : dataStorage,
				rows : rows,
				editLineItem : false
			}

		} else {
			// this.props.table.columns.map(function (column) {
   //              if(column.fieldType=="select") {
   //           	   objectValues[column.name] = column.data[0].value;                	
   //              } else {
   //              	objectValues[column.name] = null;
   //              }
   //          });
			return {
				dataStorage : [],
				rows : [],
				objectValues,
				editLineItem : false
			};
		}
		
	},
	handleAdd: function(event){
		var obj={};
		var that = this;
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		var rowCounter = rows.length;
		this.props.table.columns.map(function (column) {
			// if(column.fieldType=="select" && that.state[column.name]=='' || that.state[column.name]==null) {
			// 	obj[column.name] = that.state.objectValues[column.name];
			// }else {
				obj[column.name] = that.state[column.name];
			// }
			that.state[column.name] = null;
		});

		
		
		dataStorage.push(obj);
		rows.push(<LineRow columns={this.props.table.columns} data={obj} id={rowCounter} callbackParent={this.lineRowCallBack} />);
		this.setState({rows: rows, dataStorage:dataStorage});
	},
	handleCancel: function(){
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} />
		}

		this.setState({rows: rows, editLineItem:false});
	},
	handleUpdate : function (columns,dataIndex) {
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		for(var j=0, linecount = columns.length; j<linecount; j++){
			if(this.state[columns[j].name]!=null) {
				dataStorage[dataIndex][columns[j].name] = this.state[columns[j].name];
			}
		}
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} />
		}

		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
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

		this.setState({rows:rows, dataStorage:dataStorage, editLineItem:false});
	},
	lineRowCallBack : function(rowElem) {
		var elemArr = rowElem.split('-');
		var rowid = parseInt(elemArr[1]-1);
		
		var rows = this.state.rows;
		var dataStorage = this.state.dataStorage;
		rows.length=0;
		this.setState({rows:rows});

		for(var i=0, counter=dataStorage.length; i<counter; i++) {
			if(i==rowid) {
				rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} anotherCallBack={this.renderFieldCallBack} edit={true} />
			} else {
				rows[i] = <LineRow columns={this.props.table.columns} data={dataStorage[i]} id={i} callbackParent={this.lineRowCallBack} edit={false}/>
			}
		}

		rows.splice(elemArr[1], 0, (<LineItemButtons columns={this.props.table.columns} dataIndex={rowid} callbackUpdate={this.handleUpdate} callbackCancel={this.handleCancel} callbackRemove={this.handleRemove}/>));
		this.setState({rows: rows,editLineItem:true, dataStorage:dataStorage});
	},
	renderFieldCallBack : function (objdata) {
		this.setState(objdata);
	},
	render: function(){
		var columns = this.props.table.columns;
		var rows = this.state.rows;
		var field;
		var that = this;
		return (
			<div className="tableWrapper">
				
				<DataStorage data={this.state.dataStorage} name={this.props.table.storage}/>
				
				<table className="table table-bordered react-table" style={{overflow:'auto'}}>
				<thead>
					<tr>
						{columns.map(function(column){
							return ( <th id={column.name} key={column.name}>{column.displayName}</th> );
						})}
					</tr>
				</thead>
				<tbody>
					{this.state.rows.map(function(row){
						return row
					})}

					{!this.state.editLineItem && (
					<tr>
						{this.props.table.columns.map(function (column){
							return( <RenderFields column={column} callbackParent={ that.renderFieldCallBack } key={column.name}/> );
						})}
					</tr>
					)}				
					<tr>
						<td colSpan={columns.length}>
							{ !this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleAdd} value={"Add"} className={"btn btn-primary btn-flat"}/>)}
							{ !this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleCancel} value={"Cancel"} className={"btn btn-default btn-flat"}/>)}
							{ this.state.editLineItem && (<input type={"button"} style={{width:'auto', marginRight:'5px'}} onClick={this.handleCancel} value={"Add New"} className={"btn btn-info btn-flat"}/>)}
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		);
	}
});
window.DataStorage = React.createClass ({
	render : function () {
		return( <input type="hidden" name={this.props.name} value={JSON.stringify(this.props.data)} /> )
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

window.LineRow = React.createClass({
	getDefaultProps : function () {
		return {
			edit : false
		}
	},
	handleRowClick : function(event) {
		this.props.callbackParent(event.currentTarget.id);
	},
	handleCallBack : function(objdata) {
		this.props.anotherCallBack(objdata);
	},
	render: function () {
		var that = this;
		var row;
		if(this.props.edit) {
			return( <tr id={"item-"+parseInt(this.props.id+1)}>
					{this.props.columns.map(function (column){
						return( <LineColumn callbackParentRow={that.handleCallBack} defaultValue={that.props.data[column.name]} column={column} data={that.props.data} key={column.name} edit={true} /> );
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
				obj[this.props.column.name] = event.value;
				this.setState({defaultValue:event.value, obj:obj});
				this.props.callbackParentRow(obj);
				break;
			case "text":
				obj[this.props.column.name] = event.target.value;
				this.setState({defaultValue:event.target.value, obj:obj});
				this.props.callbackParentRow(obj);
				break;
		}
	},
	componentWillReceiveProps: function(nextProps) {
    	this.setState({defaultValue: nextProps.defaultValue});
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
			}
		}
		return(<td> {field} </td>);
	}
});

window.RenderFields = React.createClass({
	getInitialState : function() {
		return {
			defaultValue:''
		};
	},
	handleChange : function(event) {
		var obj={};
		switch(this.props.column.fieldType){
			case "select":
					obj[this.props.column.name] = event.value;
					this.setState({defaultValue:event.value});
					this.props.callbackParent(obj);
					break;
			case "text":
					obj[this.props.column.name] = event.target.value;
					this.setState({defaultValue:event.target.value});
					this.props.callbackParent(obj);
					break;		
		}
	},
	render : function () {
		var column = this.props.column;
		var field;
		switch(column.fieldType) {
			case "select":
					field = <Select className={column.className} name="form-field-name" value={this.state.defaultValue} options={column.data} onChange={this.handleChange} clearable={false} />
					break;
			case "text":
					field = <input name={column.name} value={this.state.defaultValue} type={column.type} className={column.className} id={column.name}  onChange={this.handleChange}/>;
					break;
		}
		return(<td> {field} </td>);
	}
});

/*****************************************************************************************************
******************************************************************************************************
******************************************************************************************************
******************************************************************************************************/

// window.TableComponent = React.createClass({
// 	getInitialState : function () {
// 		return {
// 			inputValues:{},
// 			rows:[],
// 			dataStorage:[]
// 		};
// 	},
// 	render : function () {
// 		var that = this;

// 		return(
// 			<div className="tableWrapper">
				
// 				<table className="table table-bordered react-table" style={{overflow:'auto'}}>
// 				<thead>
// 					<tr>
// 						{this.props.table.columns.map(function(column){
// 							return ( <th id={column.name} key={column.name}>{column.displayName}</th> );
// 						})}
// 					</tr>
// 				</thead>
// 				<tbody>
// 					{this.state.rows.map(function (row) {
// 							return row
// 					})}

// 					<tr>
// 						{this.props.table.columns.map(function (column){
// 							return( <LineInputComponent defaultValue={(that.state.inputValues!='') ? that.state.inputValues[column.name] : '' 	} column={column} key={column.name} onChangeHandler={that.handleInputChangeEvent}/> );
// 						})}
// 					</tr>			
// 					<tr>
// 						<td colSpan={this.props.table.columns.length}>
// 							<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add"} className={"btn btn-primary btn-flat"} onClick={this.handleAdd}/>
// 							<input type={"button"} style={{width:'auto', marginRight:'5px'}} value={"Cancel"} className={"btn btn-default btn-flat"} onClick={this.handleCancel}/>
// 							<input type={"button"} style={{width:'auto', marginRight:'5px'}}  value={"Add New"} className={"btn btn-info btn-flat"}/>
// 						</td>
// 					</tr>
// 				</tbody>
// 				</table>
// 			</div>
// 			);
// 	},
// 	handleInputChangeEvent : function (column, event) {
// 		var inputValues = this.state.inputValues;
// 		console.log(inputValues);
// 		var that = this;
// 		switch(column.fieldType) {
// 		case "select":
// 				if(column.name=='item') {
// 					for(var i=0, counter=that.props.table.columns.length; i<counter; i++) {
// 						for(var j=0, counts=column.data.length; j<counts; j++) {
// 							if(column.data[j]['value']==event.value) {
// 								if(column.data[j][that.props.table.columns[i]['name']]!=null) {
// 									inputValues[that.props.table.columns[i]['name']] = column.data[j][that.props.table.columns[i]['name']];
// 									break;
// 								}
// 							}
// 						}
// 					}
// 				}
// 				inputValues[column.name] = event.value;
// 			break;
// 		case "text":
// 			if(column.name='quantity') {
// 				if(!isNaN(event.target.value)){
// 					(event.target.value=='') ? inputValues['amount'] = 0  : inputValues['amount'] = parseInt(event.target.value) * parseInt(inputValues.rate);
// 				}
// 			}		
// 			inputValues[column.name] = event.target.value;	
// 			break;
// 		}
// 		this.setState({inputValues:inputValues});
// 		console.log(this.state.inputValues);
// 	},
// 	handleAdd : function () {
// 		var inputValues = this.state.inputValues;
// 		var obj={};
// 		var that = this;
// 		var dataStorage = this.state.dataStorage;
// 		var rows = this.state.rows;
// 		var rowCounter = rows.length;

// 		{this.props.table.columns.map(function (column){
// 			obj[column.name] = inputValues[column.name];
// 			inputValues[column.name] = '';
// 		})}
// 		console.log(obj);
// 		this.setState({inputValues:inputValues});
// 		// dataStorage.push(obj);
// 		// rows.push(<LineRow columns={this.props.table.columns} data={obj} id={rowCounter} callbackParent={this.lineRowCallBack} />);
// 		// this.setState({rows: rows, dataStorage:dataStorage, inputValues:inputValues});
// 	},
// 	handleCancel : function () {
// 		var inputValues = this.state.inputValues;
// 		{this.props.table.columns.map(function (column){
// 			inputValues[column.name] = '';
// 		})}
// 		this.setState({inputValues:inputValues});
// 	}
// });

// window.LineInputComponent = React.createClass({
// 	render : function () {
// 		var field;
// 		var column = this.props.column;
// 		switch(column.fieldType) {
// 			case "select":
// 					field = <Select className={column.className} name="form-field-name" value={this.props.defaultValue} options={column.data} onChange={this.props.onChangeHandler.bind(this,column)} clearable={false} />
// 					break;
// 			case "text":
// 					field = <input name={column.name} value={this.props.defaultValue} type={column.type} className={column.className} id={column.name}  onChange={this.props.onChangeHandler.bind(this,column)}/>;
// 					break;
// 			case "disabled":
// 					field = <input name={column.name} value={this.props.defaultValue} type='text' disabled className={column.className} id={column.name} />;//  onChange={this.props.onChangeHandler.bind(this,column)}/>;
// 					break;		
// 		}
// 		return( <td> {field} </td> );
// 	}
// });
