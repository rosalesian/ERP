window.InputTag = React.createClass({
	getDefaultProps : function () {
		return {
			class:'',
			id:'',
			name:''
		};
	},
	getInitialState : function () {

		if(this.props.attributes.defaultValue) {
			return { defaultValue:this.props.attributes.defaultValue };
		} else {
			return { defaultValue:'' };
		}
	},
	handleChange : function (event) {
		if(this.props.attributes.type=="select") {
			this.setState({defaultValue:event.value});
		} else {
			this.setState({defaultValue:event.target.value});
		}
	},
	render : function () {
		var field;
		switch(this.props.attributes.type) {
			case "select":
					field = <Select onChange={this.handleChange} id={this.props.attributes.id} className="react-select-input-mainline" name={this.props.attributes.name} value={this.state.defaultValue} options={this.props.attributes.options} placeholder={this.props.attributes.options[0].label} clearable={false} />
					break;
			case "textarea":
					field = <textarea onChange={this.handleChange} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;		
			case "text":
					field = <input onChange={this.handleChange} type={this.props.attributes.type} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;
			case "date":
					field = <input onChange={this.handleChange} type={this.props.attributes.type} value={this.state.defaultValue} name={this.props.attributes.name} id={this.props.attributes.id} className="form-control" />
					break;
			case "disabled":
					field = <input type="text" className="form-control" placeholder={this.props.attributes.placeholder} disabled/>
					break;
			case "label":
					field = <span id={this.props.attributes.id} className="form-control"></span>			
		}

		return(
			<div className="row">
				<div className="box-body">
					<div className="form-group">
		                <label for={this.props.attributes.id}>{this.props.attributes.label}</label>
		                {field}
		            </div>
	            </div>
            </div>
        );
	}
});

window.Wrapper = React.createClass({
	render : function () {
		return(
			 <div className="row">
				<div className="col-md-12"> 
					{ this.props.children }
				</div>
			</div>
		);
	}
});

window.FieldContainer = React.createClass({
	render : function () {
		return( <div className="col-md-4 col-sm-6 col-xs-12"> {this.props.children} </div> );
	}
});