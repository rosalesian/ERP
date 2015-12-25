(function($, window, document, undefined) {

    var pluginName = "itemTable",
        defaults = null;

    var plugindatabase = [];     

    function Plugin(element, options) {
        plugindatabase[element.id]=[];
        this.element = element;
        this.settings = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
       	var $this;
    }
    Plugin.prototype = {
    	init: function(){
    			$this = $(this.element),
    			thead = document.createElement("thead"),
    			tbody = document.createElement("tbody"),
    			trow = document.createElement("tr"),
    			cell = document.createElement("td");
				$this.append(thead, tbody);

    			thead.appendChild(trow);

    			this.setColumns(this.settings.columns);
                this.addRow(this.settings.columns);
                this.addButtons(this.settings.columns);
    	},
    	setColumns: function(columns){ 
    		var cells = [], col, i=0;
    		for(; col = columns[i++];){
				cells[i] = "<td>"+ col.name +"</td>";
			}
    	   
    		$this.find("thead tr").append(cells.join(''));
    	},
    	addRow: function(columns){
    		var cells = [], col;
            var tr = document.createElement('tr');
            $(tr).attr({class:'add-element-container'});
            $this.find("tbody").append(tr);
            
            for(var i=0, col = columns.length; i<col; i++)
            {
                var td = document.createElement('td');  
                var element = this.setField(columns[i]);
              	$(td).append(element);
                $this.find("tbody tr:last-child").append(td);
            }
            var hidden = document.createElement('input');
            var hidden_id = this.element.id+'_'+'data_storage';
            $(hidden).attr({type:'hidden', id:hidden_id});

            $this.find("tbody tr:last-child").append(hidden);
    	},
    	setField: function(column){
            var input;
    		switch(column.field.type)
            {
        		case "text":
                    var txt = document.createElement('input');
                    $(txt).attr({type:'text', id:column.field.name}); 
        			if(column.field.attr) $(txt).attr(column.field.attr);
                    input = txt; 
        			break;
        		case "select":
                        var el = document.createElement(column.field.type);
                        $(el).attr({id:column.field.name});
                        if(column.field.attr) $(el).attr(column.field.attr);

                        for(var i=0, opt = column.field.value.length; i<opt; i++)
                        {
                            var opts = document.createElement('option');
                            (column.field.selected==column.field.value[i].value) ? $(opts).attr({value:column.field.value[i].value, selected:'selected'}) : $(opts).attr({value:column.field.value[i].value});
                            $(opts).append(document.createTextNode(column.field.value[i].display));   
                            $(el).append(opts);
                        }
                        input = el;

                     break;   
        		case "textarea":
                        var el = document.createElement(column.field.type);
                        $(el).attr({id:column.field.name});
                        if(column.field.attr) $(el).attr(column.field.attr);
                        input = el;
                        break;
        		case "checkbox":
                        var chckbx = document.createElement('input');
                        $(chckbx).attr({type:'checkbox',id:column.field.name});
                        if(column.field.attr) $(chckbx).attr(column.field.attr);
                        input = chckbx;
                        break;
        		case "radio":
                        var radio = document.createElement('input');
                        $(radio).attr({type:'radio', id:column.field.name});
                        if(column.field.attr) $(radio).attr(column.field.attr);
                        input = radio;
                        break;
            }
    		return input
    	},
        appendNewItem : function(columns){ // Append New Data in the table
            var data = {};
            var tablename = this.element.id;
            var trdata = document.createElement('tr');    
            var that = this;
            $(trdata).attr({id:'item-'+parseInt(plugindatabase[tablename].length+1)});            
            for(var i=0, count=columns.length;i<count;i++){
                var tddata = document.createElement('td');
                $(tddata).attr({id:columns[i].field.name+'_data'});
                $(tddata).append(document.createTextNode($('#'+tablename).find('#'+columns[i].field.name).val()));
                $(trdata).append(tddata);
                data[columns[i].field.name] = $('#'+tablename).find('#'+columns[i].field.name).val();
            }

            /**
            ** Method trigger when row is clicked. 
            **/
            $(trdata).on('click', function(e){
                if($('#'+tablename+' tbody #'+e.currentTarget.id).hasClass('active')==false) {
                    $('#'+tablename+' tbody #'+e.currentTarget.id).attr({class:'active'});
                    that.editData(e.currentTarget, $(this).parent(),columns);
                    that.editButtons(e.currentTarget);

                    /**
                    ** HIDE ADD ELEMENTS CONTAINER AND BUTTONS
                    **/
                    $('#'+tablename).find(".add-element-container").hide();
                    $('#'+tablename).find(".add-element-buttons").hide();
                    $this.find('tbody .select').selectpicker();   
                } 
            });

            if(plugindatabase[tablename])
            {
                $('#'+tablename).find(".add-element-container").before(trdata);
                
                plugindatabase[tablename].push(data);
                $('#'+tablename).find('.add-element-container').find('#'+tablename+'_data_storage').val(JSON.stringify(plugindatabase[tablename])); 
            }

        },
        editButtons : function(currentElement) {
            var btnupdate = document.createElement('button');
            var btncancel = document.createElement('button');
            var btnremove = document.createElement('button');
            var showadditem = document.createElement('button');
            var td = document.createElement('td');
            var tr = document.createElement('tr');
            var that = this;

            $(tr).attr({class:'edit-buttons-container'});
            $(td).attr({colspan:that.settings.columns.length});
            $(btnupdate).attr({class:'btn btn-info',id:'btnUpdate'});
            $(btncancel).attr({class:'btn btn-warning',id:'btnCancel'});
            $(btnremove).attr({class:'btn btn-error',id:'btnRemove'});
            $(showadditem).attr({class:'btn btn-default',id:'showadditem'});

            /**
            ** BIND EVENT AND FUNCTION TO EDIT BUTTONS
            **/
            $(btnupdate).on('click',function(){ that.updateData(currentElement); });
            $(btncancel).on('click',function(){ that.cancelData(currentElement); });
            $(btnremove).on('click',function(){ that.removeData(currentElement); });
            $(showadditem).on('click',function(){ that.showAddDataFieldsButton(currentElement); });
            /****** END ****/

            $(btnupdate).append(document.createTextNode('OK'));
            $(btncancel).append(document.createTextNode('Cancel'));
            $(btnremove).append(document.createTextNode('Remove'));
            $(showadditem).append(document.createTextNode('Add Item'));
            
            $(td).append(btnupdate);
            $(td).append(btncancel);
            $(td).append(btnremove);
            $(td).append(showadditem);

            $(tr).append(td);
            $('#'+this.element.id+' tbody #'+currentElement.id).after(tr);
        },
        updateData : function(currentElement){
            var that = this;
            var rowdata = currentElement.id.split('-');
            var tablename = that.element.id;
            var index = rowdata[1]-1;
            $($(currentElement).children()).each(function(){
                if(plugindatabase[tablename][index])
                {
                    var dataid =  this.id.split('_');
                    var value = $('#'+tablename).find('#'+currentElement.id).find('#'+this.id).find('#'+dataid[0]).val();
                    plugindatabase[tablename][index][dataid[0]] = value;
                    
                    $(this).empty();
                    $(this).append(document.createTextNode(value));
                }
            });
            $('#'+tablename).find('.add-element-container').find('#'+tablename+'_data_storage').val(JSON.stringify(plugindatabase[tablename]));
            $('.edit-buttons-container').remove();
            $(currentElement).removeClass('active');

            $('#'+tablename).find(".add-element-container").show();
            $('#'+tablename).find(".add-element-buttons").show();
        },
        cancelData : function(currentElement){
            var that = this;
            var rowdata = currentElement.id.split('-');
            var tablename = that.element.id;
            var index = rowdata[1]-1;
            $($(currentElement).children()).each(function(){
                if(plugindatabase[tablename][index])
                {
                    var dataid =  this.id.split('_');
                    $(this).empty();
                    $(this).append(document.createTextNode(plugindatabase[tablename][index][dataid[0]]));
                }
            });
            $('.edit-buttons-container').remove();
            $(currentElement).removeClass('active');

            $('#'+tablename).find(".add-element-container").show();
            $('#'+tablename).find(".add-element-buttons").show();
        },
        removeData : function(currentElement) {
            var rowdata = currentElement.id.split('-');
            var tablename = this.element.id;
            var index = rowdata[1]-1;
            plugindatabase[tablename].splice(index, 1);
            $('#'+tablename).find('.add-element-container').find('#'+tablename+'_data_storage').val(JSON.stringify(plugindatabase[tablename]));
            $(currentElement).remove();
            $('.edit-buttons-container').remove();   
            $($('#'+this.element.id+' tbody').children()).each(function(i){
                if(!($(this).hasClass('edit-buttons-container')) && !($(this).hasClass('add-element-container')) && !($(this).hasClass('add-element-buttons')))
                {  
                    $(this).removeAttr('id');
                    $(this).attr('id','item-'+parseInt(i+1));
                }
            });
            $('#'+tablename).find(".add-element-container").show();
            $('#'+tablename).find(".add-element-buttons").show();
        },
        showAddDataFieldsButton : function(currentElement) {
            var that = this;
            var rowdata = currentElement.id.split('-');
            var tablename = that.element.id;
            var index = rowdata[1]-1;
            $($(currentElement).children()).each(function(){
                if(plugindatabase[tablename][index])
                {
                    var dataid =  this.id.split('_');
                    $(this).empty();
                    $(this).append(document.createTextNode(plugindatabase[tablename][index][dataid[0]]));
                }
            });
            $('.edit-buttons-container').remove();
            $(currentElement).removeClass('active');

            $('#'+tablename).find(".add-element-container").show();
            $('#'+tablename).find(".add-element-buttons").show();
        },
        editData : function(currentElement, parentElement,column) {
            var that = this;
            // console.log(column);
            $($(parentElement).children()).each(function(){
                
                if($(this).hasClass('edit-buttons-container')) $(this).remove();

                if($(this).hasClass('active'))
                {
                    if(this.id!=currentElement.id)
                    {
                        var row = this.id;
                        var rowid = row.split('-');
                        var index = rowid[1]-1;
                        var i=0; 
                        if(plugindatabase[that.element.id][index])
                        {   
                            $($(this).children()).each(function(){
                                var tdelement;
                                var columnname = this.id;
                                var columnnameid = columnname.split('_');
                                $(this).empty();
                                $(this).append(document.createTextNode(plugindatabase[that.element.id][index][columnnameid[0]]));
                            });
                        }
                        

                        $(this).removeClass('active');
                    } else {
                        var row = currentElement.id;
                        var rowid = row.split('-');
                        var index = rowid[1]-1;
                        var trcontext = this;
                        
                        var i=0;
                        if(plugindatabase[that.element.id][index])
                        {
                            // $(trcontext).empty();
                            $($(currentElement).children()).each(function()
                            {
                                var tdelement;
                                var columnname = this.id;
                                var columnnameid = columnname.split('_');
                                $(this).empty();
                                var j=0;
                                while(j<column.length)
                                {
                                    if(column[j].field.name==columnnameid[0])
                                    {   
                                        switch(column[j].field.type)
                                        {
                                            case "text":
                                                var txt = document.createElement('input');
                                                $(txt).attr({type:'text', id:column[j].field.name, value:plugindatabase[that.element.id][index][columnnameid[0]]});

                                                if(column[j].field.attr) $(txt).attr(column[j].field.attr);
                                                tdelement = txt;
                                                break;
                                            case "select":
                                                    var el = document.createElement(column[j].field.type);
                                                    $(el).attr({id:column[j].field.name});
                                                    column[j].field.selected = plugindatabase[that.element.id][i][columnnameid[0]];
                                                    if(column[j].field.attr) $(el).attr(column[j].field.attr);

                                                    for(var k=0, opt = column[j].field.value.length; k<opt; k++)
                                                    {
                                                        var opts = document.createElement('option');
                                                        (column[j].field.selected==column[j].field.value[k].value) ? $(opts).attr({value:column[j].field.value[k].value, selected:'selected'}) : $(opts).attr({value:column[j].field.value[k].value});
                                                        $(opts).append(document.createTextNode(column[j].field.value[k].display));      
                                                        $(el).append(opts);
                                                    }
                                                    tdelement = el;
                                                 break;   
                                            case "textarea":
                                                    var el = document.createElement(column[j].field.type);
                                                    $(el).attr({id:column[j].field.name, value:plugindatabase[that.element.id][index][columnnameid[0]]});
                                                    $(el).append(document.createTextNode(plugindatabase[that.element.id][index][columnnameid[0]]));
                                                    if(column[j].field.attr) $(el).attr(column[j].field.attr);
                                                    tdelement = el;
                                                    break;
                                        }                                  
                                    }
                                    
                                    j++;
                                }
                                $(this).append(tdelement);
                            }); 
                        }
                    }
                }
            });
        },
        addButtons : function(columns) {
            var tr = document.createElement('tr');
            var td = document.createElement('td');
            var rows = columns.length;
            var btnadd = document.createElement('input');
            var that = this;
            $(btnadd).attr({
                class:'btn btn-primary',
                type:'button',
                id:'addBtn',
                value:'Add',
            });
            // Button Add
            $(btnadd).on('click', function(){ that.appendNewItem(columns); });

            $(td).attr({colspan:rows});
            $(td).append(btnadd);
            $(tr).append(td);
            $(tr).attr({class:'add-element-buttons'});
            $this.find("tbody").append(tr);

        },
    };

    $.fn[ pluginName ] = function (options) {
        return this.each(function () {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new Plugin(this, options));
            }
        });
    };
	
}) (jQuery, window, document);