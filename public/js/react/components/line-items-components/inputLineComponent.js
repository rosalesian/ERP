window.InputLineComponent = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			attributes: {
				name:'',
				type:'',
				placeholder:''
			},
			context:''
		};
	},
	handleChange : function (event) {
		var obj = {};
		obj.name = this.props.attributes.name;
		if(this.props.attributes.type=='select') {
			obj[this.props.attributes.name] = event.value;
		} else {
			obj[this.props.attributes.name] = event.target.value;
		}
		this.props.callBackParent(obj);
	},
	render : function () {
		var field;
		switch(this.props.attributes.type) {
			case  "select" :
				field = <Select onChange={this.handleChange} 
                id={this.props.attributes.name} 
                className="react-select-input-mainline" 
                value={this.props.defaultValue}
                options={this.props.options}
                placeholder={this.props.attributes.placeholder} 
                clearable={false} />
 			break;
			case "text" :
				field = <input onChange={this.handleChange} 
            	type="text" 
            	value={this.props.defaultValue} 
            	id={this.props.attributes.name}
            	className="form-control" />
			break;
			case "date" :
				field = <input onChange={this.handleChange} 
            	type="date" 
            	value={this.props.defaultValue} 
            	id={this.props.attributes.name}
            	className="form-control" />
			break;
			case "textarea" :
				field = <textarea onChange={this.handleChange} 
				value={this.props.defaultValue} 
				id={this.props.attributes.name}
				className="form-control" />
			break;
			case "display" :
				field = <span>{ this.props.defaultValue }</span>
			break;
		}

		return ( <td> {field} </td> );
	}
});