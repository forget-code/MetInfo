define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	function appupdate(){
		var applist = '';
		if($.cookie('appupdate')){
			applist = $.cookie('appupdate').split('|');
		}
		$.each(applist, function(i, item){
			var app = item.split('-');
			if($('#'+app[0]).attr('data-ver') != app[1]){
				$('#'+app[0]).removeClass("hidden");
			}
		});
	}	
	if(!$.cookie('appupdate')){
		var url = apppath+'n=platform&c=system&a=doappupdate&applist='+$('#applist').val();
		$.ajax({
			url: url,//新增行的数据源
			type: "GET",
			cache: false,
			dataType: "jsonp",
			success: function(data) {
				$.cookie('appupdate', data.list, {path: '/'});
				appupdate();
			}
		});
	}else{
		appupdate();
	}
});