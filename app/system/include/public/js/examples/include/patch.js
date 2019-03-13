define(function(require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	require('epl/include/cookie');
	if(!$.cookie('upgraderemind')){
		url = adminurl+'n=system&c=patch&a=dopatch';
		$.ajax({
			url: url,//新增行的数据源
			type: "POST",
			cache: false,
			dataType: "json",
			success: function(data) {
				$.cookie('upgraderemind', '1', {path: '/'});
			}
		});
	}
});