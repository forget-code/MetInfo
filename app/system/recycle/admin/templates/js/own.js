define(function (require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	require('tem/js/metvar');
	if($('#file_upload').length){
		require('tem/js/jquery.uploadify.v2.1.4.min');
		require.async('tem/js/iframes',function(a){
			metuploadify('#file_upload','sql','');
		});
	}

	function linkSmit(my, type, txt) {
		text = txt ? txt: user_msg['js7'];
		var tp = type != 1 ? 1: confirm(text) ? 1: '';
		if (tp == 1) {
			return true;
		}
		return false;
		require.async('epl/upload/own',function(a){
			a.func(dom);
		});
	}
})