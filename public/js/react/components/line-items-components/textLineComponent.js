window.TextLineComponent = React.createClass({
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
		obj.name = this.props.name;
		obj[this.props.name] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		var field;
		if(this.props.isReceived) {
			field = <input onChange={this.handleChange} 
	            	type="text" 
	            	value={this.props.defaultValue} 
	            	name={this.props.name}
	            	id={this.props.name}
	            	className="form-control" />
		} else {
	        field = <input onChange={this.handleChange} 
	            	type="text" 
	            	disabled="disabled"
	            	name={this.props.name}
	            	id={this.props.name}
	            	className="form-control" />    	
		}
		return (<td>{field}</td>);
	}
});