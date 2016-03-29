window.Remarks = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			class:'',
			id:'',
			name:''
		};
	},
	handleChange : function (event) {
		var obj = {};
			obj[this.props.attributes.name] = event.target.value;
			this.props.callBackParent(obj);
	},
	render : function () {
		return(
			<div className="row">
			<div className="box-body">
			<div className="form-group">
                <label for={this.props.attributes.id}>{this.props.attributes.label}</label>
				<textarea onChange={this.handleChange} 
				value={this.props.defaultValue} 
				name={this.props.attributes.name} 
				id={this.props.attributes.name} 
				className="form-control" />
            </div>
            </div>
            </div>
        );
	}
});