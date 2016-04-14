window.InputMainComponent = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			name:'',
			context:'',
			options:[]
		};
	},
	handleChange : function (event) {
		var obj = {};
		if(this.props.attributes.type=='select') {
			obj[this.props.attributes.name] = event.value;
		} else {
			obj[this.props.attributes.name] = event.target.value;			
		}

		this.props.callBackParent(obj);
	},
	render : function () {
			var field;
			if(this.props.context=='create' || this.props.context=='edit') {
				switch(this.props.attributes.type) {
					case "select" :
						field = <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label>
							<Select onChange={this.handleChange}
			                id={this.props.attributes.name}
			                className="react-select-input-mainline"
			                name={this.props.attributes.name}
			                value={this.props.defaultValue}
			                options={this.props.options}
			                placeholder={"CHOOSE "+this.props.attributes.label}
			                clearable={false} />
		           		</div> 
					break;
					case "text" :
						field = <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label>
			            	<input onChange={this.handleChange} 
			            	type="text" 
			            	value={this.props.defaultValue} 
			            	name={this.props.attributes.name} 
			            	id={this.props.attributes.name} 
			            	className="form-control" />	
			            </div>	
					break;
					case "date" :
						field = <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label>
			            	<input onChange={this.handleChange} 
			            	type="date" 
			            	value={this.props.defaultValue}
			            	name={this.props.attributes.name}
			            	id={this.props.attributes.name}
			            	className="form-control" />
			            </div> 
					break;
					case "textarea" :
						field = <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label>
							<textarea onChange={this.handleChange} 
							value={this.props.defaultValue} 
							name={this.props.attributes.name} 
							id={this.props.attributes.name} 
							className="form-control" />
			            </div> 
					break;
					case "display" :
						field = <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label>br />
							<span id={this.props.attributes.name}>{ this.props.defaultValue }</span>
						</div>	
					break;
				}
			} else {
				field =  <div className="form-group">
							<label for={this.props.attributes.name}>{this.props.attributes.label}</label><br />
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