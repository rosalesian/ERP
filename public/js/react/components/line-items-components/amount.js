window.Amount = React.createClass({
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
		obj.name = 'amount';
		obj['amount'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	id="amount"
            	className="form-control" />
			</td> 
		);
	}
});