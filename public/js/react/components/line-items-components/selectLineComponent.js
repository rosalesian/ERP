window.SelectLineComponent = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
	getInitialState : function () {
		return { 
			data:[],
			defaultValue:this.props.defaultValue,
		};
	},
	handleChange : function (event) {
		var obj = {};
		obj.name = this.props.attributes.name;
		obj[this.props.attributes.name] = event.value;
		obj[this.props.attributes.name+'_label'] = event.label;
		this.props.callBackParent(obj);
	},
	render : function () {
		return( 
			<td>
				<Select onChange={this.handleChange}
                id={this.props.attributes.name}
                className="react-select-input-mainline" 
                value={this.props.defaultValue}
                options={this.props.options}
                placeholder={this.props.attributes.placeholder} 
                clearable={false} />
			</td>
		);
	}
});