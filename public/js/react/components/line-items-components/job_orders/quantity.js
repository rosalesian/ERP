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
		obj.name = 'no_of_days';
		obj['no_of_days'] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		return (
			<td>
				<input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
  
            	id="no_of_days"
            	className="form-control" />
			</td> 
		);
	}
});