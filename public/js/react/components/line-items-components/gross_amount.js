window.GROSSAmount = React.createClass({
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
		obj.name = 'gross_amount';
		obj['gross_amount'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	name="gross_amount" 
            	id="gross_amount"
            	className="form-control" />
			</td> 
		);
	}
});