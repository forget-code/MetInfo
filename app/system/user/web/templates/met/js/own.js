define(function(require, exports, module) {

	var $ = jQuery = require('jquery');

	require('pub/bootstrap/js/bootstrap.min');
	if(page_type == 'login')require.async('own_tem/js/login');
	if(page_type == 'register')require.async('own_tem/js/register');
	if(page_type == 'valid_email')require.async('own_tem/js/valid_email');
	if(page_type == 'getpassword_mailset')require.async('own_tem/js/getpassword_mailset');
	if(page_type == 'profile_index')require.async('own_tem/js/profile_index');
	if(page_type == 'profile_safety')require.async('own_tem/js/profile_safety');
	if(page_type == 'profile_emailedit')require.async('own_tem/js/profile_emailedit');
	if(page_type == 'getpassword')require.async('own_tem/js/getpassword');

	if($("#getcode").length){
		$("#getcode").click(function(){
			var src = $(this).attr("src") + '&math=' + Math.random();
			$(this).attr("src",src);
		});
	}

	require('pub/weboverall/own');

});