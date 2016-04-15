window.TextLineComponent = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
		};
	},
	handleChange : function (event) {
		var obj = {};
		obj.name = this.props.attributes.name;
		obj[this.props.attributes.name] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		var field;
			field = <input onChange={this.handleChange} 
	            	type="text" 
	            	value={this.props.defaultValue} 
	            	name={this.props.attributes.name}
	            	className="form-control" />
		return (<td>{field}</td>);
	}
});