var TABLE = {
	columns: [
		{name: "item", displayName: "Item", fieldType: "select", className: "form-control"},
		{name: "discription", displayName: "Description", fieldType: "text", className: "form-control"},
		{name: "uom", displayName: "Unit", fieldType: "select", className: "form-control"},
		{name: "quantity", displayName: "Quantity", fieldType: "text", className: "form-control"},
		{name: "rate", displayName: "Rate", fieldType: "text", className: "form-control"},
		{name: "amount", displayName: "Amount", fieldType: "text", className: "form-control"}
	]
};

var LineItems = React.createClass({
	getInitialState: function(){
		return {rows: []};
	},
	handleUpdate: function(event){
		var rows = this.state.rows;
		rows.push(<LineRow columns={this.props.table.columns} edit={true}/>);
		this.setState({rows: rows});
	},
	handleCancel: function(event){
		alert("cancel");
	},
	render: function(){
		var columns = this.props.table.columns;
		var rows = this.state.rows;
		return (
			<div>
				<table className="table table-bordered">
				<thead>
					<tr>{columns.map(function(column){
						return <th id={column.name}>{column.displayName}</th>;
					})}</tr>
				</thead>
				<tbody>
					{rows.map(function(row){
						return row
					})}
					<tr>
						<td colSpan={columns.length}>
						<input type={"button"} onClick={this.handleUpdate} value={"Add"} className={"btn btn-primary"}/>
						<input type={"button"} onClick={this.handleCancel} value={"Cancel"} className={"btn btn-default"}/>
						</td>
					</tr>
				</tbody>
				</table>
			</div>
		);
	} 
});

var LineRow = React.createClass({
	getInitialState: function(){
		return {
			edit: this.props.edit,
			data: {}
		};
	},
	handleRowClick: function(event){
		this.setState({edit: true});
	},
	render: function(){
		var columns = this.props.columns;
		var edit = this.state.edit;
		return (
			<tr onClick={this.handleRowClick}>
				{columns.map(function(column){
					return <LineCell column={column} edit={edit} />;
				})}
			</tr>
		);		
	}
});

var LineCell = React.createClass({
	getInitialState: function(){
		return {value: "hello"};
	},
	handleChange: function(event){		
		this.setState({value: event.target.value});
	},
	render: function(){
		var column = this.props.column;
		var edit = this.props.edit;
		var field;
		if(edit){
			switch(column.fieldType){
				case "select":
					field = <select name={column.name} className={column.className} id={column.name} onChange={this.handleChange}></select>;
					break;
				default:
					field = <input name={column.name} type={column.type} className={column.className} id={column.name} onChange={this.handleChange}></input>;
					break;
			}			
		}
		else{
			field = this.state.value;
		}

		return <td>{field}</td>;
	}
});

ReactDOM.render(<LineItems table={TABLE}/>, document.getElementById("line-items"));
