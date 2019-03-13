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
		var ver = $('.v52fmbx').attr("data-metcms_v"),patch = $('.v52fmbx').attr("data-patch");
		var url = apppath+'n=platform&c=system&a=dosysnew'+'&ver='+ver+'&patch='+patch;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'jsonp',
			cache: false,
			success: function(data) {
				if(data.metok==1){
					window.location.href=adminurl+"index.php?renewable=1#metnav_75";
				}
			}
		});
	}
	
});