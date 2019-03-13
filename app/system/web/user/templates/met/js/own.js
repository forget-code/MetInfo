define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	
	require('pub/bootstrap/js/bootstrap.min');
	if(page_type == 'login')require.async('tem/js/login');
	if(page_type == 'register')require.async('tem/js/register');
	if(page_type == 'valid_email')require.async('tem/js/valid_email');
	if(page_type == 'getpassword_mailset')require.async('tem/js/getpassword_mailset');
	if(page_type == 'profile_index')require.async('tem/js/profile_index');
	if(page_type == 'profile_safety')require.async('tem/js/profile_safety');
	if(page_type == 'profile_emailedit')require.async('tem/js/profile_emailedit');
	if(page_type == 'getpassword')require.async('tem/js/getpassword');
	
	if($("#getcode").length){
		$("#getcode").click(function(){
			var src = $(this).attr("src") + '&math=' + Math.random();
			$(this).attr("src",src);
		});
	}
	
	require('pub/weboverall/own');
	
});