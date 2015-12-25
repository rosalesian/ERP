(function(jq, doc, win){
	jq.fn.dTable = function(options){
		jq(this).html("<thead></thead><tbody></tbody>");
		console.log(options.columns[1].field.type);
	};
}(jQuery, document, window))