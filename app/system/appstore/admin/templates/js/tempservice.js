define(function(require, exports, module) {

	var common = require('common');
	$(document).on('click',".lookcontact",function(){
		//event.preventDefault();
		common.metalert({
			html:$(this).next().val(),
			type:'window',
			MaxWidth:600
		});
	});
	$(document).on('click',".shangjiaruzhu",function(){
		//event.preventDefault();
		common.metalert({
			html:$(this).next().val(),
			type:'window',
			MaxWidth:600
		});
	});
	
});