define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');

	$(document).on('submit',".ui-from",function(){
		jQuery.ajax({
			url:$(".ui-from").attr("action"),
			data:$(".ui-from").serialize(),
			type:"POST",
			success:function(addurl){
				if(addurl && addurl!=''){
					window.location.href=addurl;
				}
			}
		});
		return false;
	});

});