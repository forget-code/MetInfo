define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/validator/entrance');
	$('.register_index form').bootstrapValidator();
	
});