define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');
	
	$("input[name='addtype']").change(function(){
		if($(this).val()==2){
			$("input[name='addtime']").focus();
		}
	});
	
});