var ItemGrid = (function(){
	var element, options,grid; 

	function _render(el, settings){		
		//create table
		grid = $(el);
		grid.attr("border","1");
		options = settings;

		grid.append("<thead><tr></tr></thead><tbody></tbod><tfoot></tfoot>")
		var header;
		for(column in options.columns){
			header += "<th>"+column.name+"</th>"
		}
		grid.find("thead").append(header);
		console.log("created");
/*		var thead = header.insertRow(0);
		for(var i=0; i < options.columns.length; i++){
			var column = options.columns[i];
			var cell = thead.insertCell(i);
			cell.innerHTML = column.name;
		}
		thead.insertCell(thead.cells.length);

		//add footer to the table		
		var footer = grid.createTFoot();
		var tfoot = footer.insertRow(0);
		var fcell = tfoot.insertCell(0);

		var btnAddRow = document.createElement("input");
		btnAddRow.setAttribute("type", "button");
		btnAddRow.setAttribute("value", "Add Row");
		btnAddRow.setAttribute("name", "add-row");
		btnAddRow.setAttribute("class", "btn btn-info btn-sm");
		btnAddRow.onclick = _addRow;

		fcell.appendChild(btnAddRow);*/
	}

	function _addRow(){
		var row = grid.insertRow(grid.rows.length - 1);
				
		for(var i = 0; i < options.columns.length; i++){
			var column = options.columns[i];
			var cell = row.insertCell(i);
			var field = document.createElement(column.type);
			field.setAttribute("class","form-control");
			//field.onfocusout = _showRow;		
			cell.appendChild(field);
		}
		var actionCell = row.insertCell(row.cells.length);
		row.onclick = _editRow;
		row.onfocusout = function(){console.log("hello world")};
		

		var btnDelRow = document.createElement("input");
		btnDelRow.setAttribute("type", "button");
		btnDelRow.setAttribute("value", "Delete");
		btnDelRow.setAttribute("name", "del-row");
		btnDelRow.setAttribute("class", "btn btn-danger btn-sm");
		btnDelRow.onclick = _deleteRow;
		actionCell.appendChild(btnDelRow);
		//console.log(row.cells.length);
	}

	function _deleteRow(event){
		grid.deleteRow(event.target.parentNode.parentNode.rowIndex);
		//grid.deleteRow();
	}

	function _showRow(event){
		var row = event.target.parentNode.parentNode;
		var cells = row.cells;
		for(var i=0; i < cells.length - 1; i++){
			var cell = cells[i];
			cell.innerHTML = cell.value;
		}
	}

	function _editRow(event){
		console.log("edit row");
	}
	function create(el, options){
		_render(el, options);		
	}
	return {
		create: create
	};
}());

/*function ItemGrid(element, options){
	this.element = element;
	this.settings = options;
	this.init();
	$this;
}

ItemGrid.prototype = {
	init: function(){
		$this = document.getElementById(this.element);
		
		this.render();
	},

	render: function(){

		$this.setAttribute("border", 1);

		var header = $this.createTHead();

		var row = header.insertRow(0);

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);

		cell1.innerHTML = "Id";
		cell2.innerHTML = "Name";
		cell3.innerHTML = "Description";
		cell4.innerHTML = "column1";
		cell5.innerHTML = "column2";

		var footer = $this.createTFoot();
		var frow = footer.insertRow(0);
		var fcell = frow.insertCell(0);

		var btnAddRow = document.createElement("input");
		btnAddRow.setAttribute("type", "button");
		btnAddRow.setAttribute("value", "Add Row");
		btnAddRow.setAttribute("name", "add-row");
		btnAddRow.setAttribute("class", "btn btn-info btn-sm");
		btnAddRow.onclick = this.addRow;

		fcell.appendChild(btnAddRow);
	},

	addRow: function(){
		//console.log(e.target.parentNode.parentNode.parentNode.parentNode);
		var row = $this.insertRow($this.rows.length - 1);

		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);

		cell1.innerHTML = "cell1";
		cell2.innerHTML = "cell2";
		cell3.innerHTML = "cell3";
		cell4.innerHTML = "cell4";
		cell5.innerHTML = "cell5";

		var btnDelRow = document.createElement("input");
		btnDelRow.setAttribute("type", "button");
		btnDelRow.setAttribute("value", "Delete");
		btnDelRow.setAttribute("name", "del-row");
		btnDelRow.setAttribute("class", "btn btn-danger btn-sm");
		//console.log(_parent);
		btnDelRow.onclick = ItemGrid.delRow;
		cell6.appendChild(btnDelRow);
	},

	delRow: function(e){
		console.log("testing");
		//$this.deleteRow(e.target.parentNode.parentNode.rowIndex);
	}
}*/