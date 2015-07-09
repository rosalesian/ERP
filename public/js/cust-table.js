(function(jq, win, doc){
	jq("#add-row").bind("click", addRow);
	jq("#del-row2").bind("click", delRow);
	jq("#edit-row").bind("click", editRow);
	
	function addRow(){
		jq("#line-table tbody").append(
			"<tr>"+
			"<td>State 1</td>"+
			"<td>Condition 1</td>"+
			"<td>Active</td>"+
			"<td><button id='del-row2' type='button'>Remove</button></td>"+
			"</tr>"
		);

		jq("#del-row2").bind("click", delRow);
	}
	
	function delRow(){
			var par = $(this).parent().parent(); //tr
			par.remove();
	}

	function editRow(){
		alert("edit button has been clicked");
	}

}(jQuery, window, document))