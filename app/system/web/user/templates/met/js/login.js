define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/validator/entrance');
	$('.login_index form').bootstrapValidator();
	
});