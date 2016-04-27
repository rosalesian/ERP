window.Description = React.createClass({
	getDefaultProps : function () {
		return {
			defaultValue : ''
		};
	},
	getInitialState : function () {
		return {
			defaultValue : this.props.defaultValue
		}
	},
	componentWillReceiveProps : function (nextprops) {
		this.setState({defaultValue:nextprops.defaultValue});
	},
	render : function () {
		return( <td> <span>{ this.state.defaultValue }</span> </td> );
	}
});