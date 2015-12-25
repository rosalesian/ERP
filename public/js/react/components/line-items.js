var LineItems = React.createClass({
	getInitialState: function(){
		return{row: {
			item: "item1", 
			description: "this is a test",
			uom: "pieces",
			quantity: "12",
			rate: "12.50",
			amount: "150.25"
		}}
	},

	render: function(){
		var headers = [];
		for(var header in this.state.row){
			headers.push(
				<th>{header}</th>
			);
		}
		return (
			<div>
				<table className="table table-bordered">
				<thead>
					<tr>
					{headers}
					</tr>
				</thead>
				<tbody>
					<LineRow row={this.state.row} />
				</tbody>
				</table>
			</div>
		);
	} 
});

var LineRow = React.createClass({

	render: function(){
		var columns = [];

		for(var obj in this.props.row){
			columns.push(
				<LineCell value={this.props.row[obj]}/>
			);
		}
		return (
			<tr>
				{columns}
			</tr>
		);
	}
});

var LineCell = React.createClass({
	render: function(){
		return (
			<td>{this.props.value}</td>
		);
	}
});
ReactDOM.render(<LineItems />, document.getElementById("line-items"));
