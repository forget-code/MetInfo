define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/validator/entrance');
	
	$('.member-profile form').bootstrapValidator();

	require('pub/examples/formin');
		
});