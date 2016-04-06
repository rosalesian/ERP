window.VENDOR = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
	getInitialState : function () {
		return { 
			data:[],
			defaultValue:this.props.defaultValue,
			placeholder:''
		};
	},
	componentDidMount : function () {
		this.request = $.ajax({
			url:this.props.source,
			dataType: 'json',
			type:'GET',
			beforeSend : function () {
				this.setState({placeholder:'loading...'});
			}.bind(this),
			success : function (response) {
				var data=this.state.data;
				data.length=0;
				for(var i in response) {
					data.push({value:response[i].value, label:response[i].label, description:response[i].description});
				}
				this.setState({data : data, placeholder:'Choose Item'});
			}.bind(this)
		});
	},
	componentWillUnmount : function () {
		this.request.abort();
	},
	_ajaxRequest : function (source) {
		$.ajax({
			url:source,
			dataType: 'json',
			type:'GET',
			beforeSend : function () {
				this.setState({placeholder:'loading...'});
			}.bind(this),
			success : function (response) {
				var data=this.state.data;
				data.length=0;
				for(var i in response) {
					data.push({value:response[i].value, label:response[i].label, description:response[i].description});
				}
				this.setState({data : data, placeholder:'Choose Item'});
			}.bind(this)
		});
	},
	componentWillReceiveProps : function (nextprops) {
		return this._ajaxRequest(nextprops.source)
	},
	handleChange : function (event) {
		var obj = {};
		obj.name = '';
		obj['vendor_id'] = event.value;
		obj['vendor_label'] = event.label;
		this.setState({defaultValue:event.value});
		this.props.callBackParent(obj);
	},
	render : function () {
		return( 
			<td>
				<Select onChange={this.handleChange} 
                id="vendor_id" 
                className="react-select-input-mainline" 
                name="vendor_id"
                value={this.state.defaultValue}
                options={this.state.data} 
                placeholder={this.state.placeholder} 
                clearable={false} />
			</td>
		);
	}
});