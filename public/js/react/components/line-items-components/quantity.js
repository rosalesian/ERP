window.Quantity = React.createClass({
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
		obj.name = 'quantity';
		obj['quantity'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	name="quantity" 
            	id="quantity"
            	className="form-control" />
			</td> 
		);
	}
});