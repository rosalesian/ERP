window.Item = React.createClass({
	getDefaultProps : function () {
		return { defaultValue:'' }
	},
	getInitialState : function () {
		return { defaultValue : this.props.defaultValue }
	},
	getUnitOfMeasure : function (item) {
		var data=[];
		var rateCS, ratePC, rateBX, ratePCK;
		if(item=='data1') {
		 data = [{value:"cs", label:"CS", conversionrate:12},{value:"pc", label:"PC", conversionrate:1},{value:"bx", label:"BX", conversionrate:3},{value:"pck", label:"PACK", conversionrate:5}];
		} else if(item=='data2') {
		 data = [{value:"cs", label:"CS", conversionrate:24},{value:"pc", label:"PC", conversionrate:1}];
		} else {
		 data = [{value:"cs", label:"CS", conversionrate:48},{value:"pc", label:"PC", conversionrate:1},{value:"bx", label:"BX", conversionrate:3}];
		}
		return data;
	},
	getItems : function() {
		return [
			{value:"data1", label:"4000318 CDM FRUIT & NUT 6X24X65G", description:"This is Data 1"},
			{value:"data2", label:"4005793 CDM ROAST ALMOND 6X24X65G (CS)", description:"This is Data 2"},
			{value:"data3", label:"4000304 30G CDM FRUIT & NUT (1X12X24)", description:"This is Data 3"}
		];
	},
	handleChange : function (evt) {
		var units = this.getUnitOfMeasure(evt.value);
		var obj = {
			units : units,
			item : evt
		};

		this.props.callBackParent(obj);
		this.setState({defaultValue : evt.value});
	},
	render : function () {
		return (
			<td>
				<Select className="react-select-input-lineitem"
				name="form-field-name" value={this.state.defaultValue}
				options={this.getItems()} onChange={this.handleChange}
				clearable={false} />
			</td>
		);
	}
});