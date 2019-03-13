define(function (require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	require('own_tem/js/metvar');
	if($('#file_upload').length) require('own_tem/js/jquery.uploadify.v2.1.4.min');
	if(typeof adminurls != 'undefined'){
		require.async('own_tem/js/iframes',function(a){
			metuploadify('#file_upload','sql','');
		});
	}
})
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
function metdatabase(my){
	var nxt=my.next('span.tips');
	nxt.empty();
	nxt.append('<img src="'+own_tem+'/images/loadings.gif" style="position:relative; top:3px;" />{$_M[word][dataexplain4]}');
	$("input[type='submit']").attr('disabled',true);
	location.href=my.attr('url');
	return false;
}