window.Date = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			name:'',
			label:'',
			context:''
		};
	},
	handleChange : function (event) {
		var obj = {};
		obj[this.props.attributes.name] = event.target.value;
		this.props.callBackParent(obj);
	},
	render : function () {
			var field;
			if(this.props.context=='create' || this.props.context=='edit') {
				field = <div className="form-group">
							<label for={this.props.attributes.id}>{this.props.attributes.label}</label>
			            	<input onChange={this.handleChange} 
			            	type="date" 
			            	value={this.props.defaultValue} 
			            	name={this.props.attributes.name} 
			            	id={this.props.attributes.name} 
			            	className="form-control" />	
			            </div> 
			} else {
				field =  <div className="form-group">
							<label for={this.props.attributes.id}>{this.props.attributes.label}</label><br />
							<span id={this.props.attributes.name}>{ this.props.defaultValue }</span>
			            </div>
			}

		return (
			<div className="row">
			<div className="box-body">
				{field}
            </div>
            </div>
        );
	}
});