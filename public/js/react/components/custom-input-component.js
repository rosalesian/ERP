window.InputTag = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			class:'',
			id:'',
			name:''
		};
	},
	getInitialState : function () {
		return { defaultValue : this.props.attributes.defaultValue };
	},
	handleChange : function (event) {
		var obj = {};
		if(this.props.attributes.type=="select") {
			obj[this.props.attributes.name] = event.value;
			this.props.callBackParent(obj);
			this.setState({defaultValue:event.value});
		} else {
			obj[this.props.attributes.name] = event.target.value;
			this.props.callBackParent(obj);
			this.setState({defaultValue:event.target.value});
		}
	},
	render : function () {
		var field;
		switch(this.props.attributes.type) {
			case "select":
					field = <Select onChange={this.handleChange} id={this.props.attributes.id} className="react-select-input-mainline" name={this.props.attributes.name} value={this.state.defaultValue} options={this.props.attributes.options} placeholder={this.props.attributes.options[0].label} clearable={false} />
					break;
			case "textarea":
					field = <textarea onChange={this.handleChange} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;		
			case "text":
					field = <input onChange={this.handleChange} type={this.props.attributes.type} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;
			case "date":
					field = <input onChange={this.handleChange} type={this.props.attributes.type} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;
			case "disabled":
					field = <input type="text" className="form-control" placeholder={this.props.attributes.placeholder} disabled/>
					break;
			case "label":
					field = <span id={this.props.attributes.id} className="form-control"></span>			
		}

		return(
			<div className="row">
				<div className="box-body">
					<div className="form-group">
		                <label for={this.props.attributes.id}>{this.props.attributes.label}</label>
		                {field}
		            </div>
	            </div>
            </div>
        );
	}
});


/*******************************************************************
********************************************************************
*******************************************************************/

window.PrTable = React.createClass({
	getDefaultProps : function () {
		return {
			editLineItem:false,
		};
	},
	getInitialState : function () {
		return {
			editLineItem:this.props.editLineItem,
			dataStorage:[],
			rows:[]
		};
	},
	render : function () {		
		var that = this;
		return (
			<div className="tableWrapper">
				<table className="table table-bordered react-table" style={{overflow:'auto'}}>
				<thead>
					<tr>
						<th>Item</th>
						<th>Description</th>
						<th>Units</th>
						<th>Quantity</th>
					</tr>
				</thead>
				<tbody>
					{this.state.rows.map(function (row){
						return row
					})}
					<TableRow callBackParent={this.handleCallBack} edit={true} />
					<tr>
						<td colSpan='4'>
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
	handleCallBack : function (obj) {
		this.setState(obj);
	},
	handleAdd : function () {
		var inputs = {};
		var dataStorage = this.state.dataStorage;
		var rows = this.state.rows;
		inputs = {
			item:this.state.item,
			description:this.state.item.description,
			unit:this.state.uom,
			quantity:this.state.quantity
		};
		console.log(this.state);
		rows.push( <TableRow data={inputs} id={rows.length}/> )
		this.setState({rows:rows});
	}
});

window.TableRow = React.createClass({
	getDefaultProps : function () {
		return {
			edit:false,
			item:'',
			description:'',
			units:''
		}
	},
	getInitialState : function () {
		return {
			item:'',
			description:'',
			units:''
		}
	},
	render : function () {
		var row;
		if(this.props.edit) {
			var description = (typeof(this.state.item)!='undefined') ? this.state.item.description : '';
			var units = (typeof(this.state.units)!='undefined') ? this.state.units : '';
			return (
				<tr>
					<Item callBackParent={this.handleCallBack} />
					<Description defaultValue={description} />
					<UnitOfMeasures callBackParent = {this.handleCallBack} data={units} />
					<Quantity callBackParent={this.handleCallBack} />
				</tr>
			);
		} else {
			return(
				<tr onClick={this.handleRowClick} id={"item-"+parseInt(this.props.id+1)}>
					<td>{this.props.data.item.label}</td>
					<td>{this.props.data.description}</td>
					<td>{this.props.data.unit.label}</td>
					<td>{this.props.data.quantity}</td>
				</tr>
			);
		}	
	},
	handleCallBack : function (obj) {
		this.props.callBackParent(obj);
		this.setState(obj);
	}
});

window.Description = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
	getInitialState : function () {
		return {
			defaultValue : this.props.defaultValue
		}
	},
	componentWillReceiveProps : function(nextProps) {
		this.setState({defaultValue:nextProps.defaultValue});
	},
	render : function () {
		return(
			<td>
				<span>{this.state.defaultValue}</span>
			</td>
		);
	}
});

window.Rate = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
	getInitialState : function () {
		return {
			defaultValue : this.props.defaultValue
		}
	},
	componentWillReceiveProps : function(nextProps) {
		this.setState({defaultValue:nextProps.defaultValue});
	},
	render : function () {
		return(
			<td>
				<span>{this.state.defaultValue}</span>
			</td>
		);
	}
});

window.UnitOfMeasures = React.createClass({
	getDefaultProps : function () {
		return { defaultValue : '' }
	},
	getInitialState : function () {
		return { defaultValue : this.props.defaultValue }
	},
	handleChange : function (evt) {
		var obj = {uom : evt};

		this.props.callBackParent(obj);
		this.setState({ defaultValue : evt.value });
	},
	render : function () {
		return (
			<td>
				<Select className="react-select-input-lineitem" name="form-field-name" value={this.state.defaultValue} options={this.props.data} onChange={this.handleChange} clearable={false} />
			</td>
		);
	}
});

window.Quantity = React.createClass({
	getDefaultProps : function () {
		return { defaultValue : '' }
	},
	getInitialState : function () {
		return {defaultValue : this.props.defaultValue }
	},
	handleChange : function (evt) {
		var obj = {quantity : evt.target.value};
		this.setState({ defaultValue : evt.target.value });
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input name="quantity" value={this.state.defaultValue} type="text" className="form-control" id="quantity" onChange={this.handleChange}/>
			</td>
		);
	}
});

