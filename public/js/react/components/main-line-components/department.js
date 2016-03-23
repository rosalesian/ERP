window.Department = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : '',
			name:'',
			label:'',
			context:''
		};
	},
	getInitialState : function () {
		return { data:[] };
	},
	componentDidMount : function () {
		if(this.props.context=='create' || this.props.context=='edit') {
			this.request = $.ajax({
				url:base_url+'/ajax/getItems',
				dataType: 'json',
				type:'GET',
				success : function (response) {
					var data=this.state.data;
					data.length=0;
					for(var i in response) {
						data.push({value:response[i].value, label:response[i].label});
					}
					this.setState({data : data});
				}.bind(this)
			});
		}
	},
	componentWillUnmount : function () {
		if(this.props.context=='create' || this.props.context=='edit') {
			this.request.abort();
		}
	},
	handleChange : function (event) {
		var obj = {};
		obj[this.props.attributes.name] = event.value;
		this.props.callBackParent(obj);
	},
	render : function () {
		var field;
		if(this.props.context=='create' || this.props.context=='edit') {
			field = <div className="form-group">
						<label for={this.props.attributes.id}>{this.props.attributes.label}</label>
						<Select onChange={this.handleChange} 
		                id={this.props.attributes.name} 
		                className="react-select-input-mainline" 
		                name={this.props.attributes.name} 
		                value={this.props.defaultValue} 
		                options={this.state.data} 
		                placeholder="Choose Type"
		                clearable={false} />
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