/*******************************************************************
********************************************************************
*******************************************************************/
window.SummaryComponent = React.createClass({
	render : function () {
		var subtotal=this.props.defaultValue,
			vat=0,
			total=0;

		vat = parseFloat(subtotal * parseFloat(0.12));
		total = subtotal + vat;
		return (
				<table className="table" style={{border:'1px solid #f4f4f4', marginTop:'15px'}}>
					<thead>
						<tr>
							<th colSpan="2" className="summary-header">SUMMARY</th>
						</tr>
					</thead>
					<tbody className="summary-container">
						<tr>
							<td>SUBTOTAL</td>
							<td>{subtotal}</td>
						</tr>
						<tr>
							<td style={{borderBottom:'1px solid black'}}>VAT</td>
							<td style={{borderBottom:'1px solid black'}}>{vat}</td>
						</tr>
						<tr>
							<td><b>TOTAL</b></td>
							<td>{total}</td>
						</tr>
					</tbody>							
				</table>
		);
	}
});
