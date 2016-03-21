window.Requester = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			name:'',
			label:''
		};
	},
	handleChange : function (event) {
		var obj = {};
		obj[this.props.attributes.name] = event.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		var options=[], placeholder='';
		if(typeof this.props.attributes.options=='undefined') {
			options=[];
			placeholder='Choose Name of Requester';
		} else {
			for(var i in this.props.attributes.options) {
				options.push({value:this.props.attributes.options[i].value, label:this.props.attributes.options[i].label});
			}
			placeholder = options[0].label;
		}

		return(
			<div className="row">
			<div className="box-body">
			<div className="form-group">
                <label for={this.props.attributes.id}>{this.props.attributes.label}</label>
                <Select onChange={this.handleChange} 
                id={this.props.attributes.name} 
                className="react-select-input-mainline" 
                name={this.props.attributes.name} 
                value={this.props.defaultValue} 
                options={options} 
                placeholder={placeholder} 
                clearable={false} />
            </div>
            </div>
            </div>
        );
	}
});