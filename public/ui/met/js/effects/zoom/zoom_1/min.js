define(function(require, exports, module) {

	var $ = require('jquery');	
	//详情页图片样式一
	
	var label = "<div id='append_parent'></div><div id='ajaxwaitid'></div>";
	var _metTab = $(".metZoomTab"),_metImg = $(".metZoomImg"),_metTab_img = _metTab.find("img");
	
	$("body").prepend(label);
	
	var TmetZoom = $(".metZoom");         //点击放大		
	_metImg.click(function(){
		TmetZoom.trigger("click");
	});
	TmetZoom.on("click", function(e){
		var file = $(this).attr("file");
		zoom(this, file, 0, 0, 0);
		e.preventDefault();
		return false;
	});

	window.IMGDIR = weburl+'public/ui/met/js/effects/zoom/zoom_1/img/';   //全局变量及数据
	window.VERHASH = 'zfhf';
	window.JSPATH = weburl+'public/ui/met/js/effects/zoom/zoom_1/';
	
	window.met_blank_d="新窗口打开",window.met_full_d="实际大小",window.met_close_d="关闭",window.met_zoom_d="鼠标滚轮缩放图片",window.met_loading_d="请稍候...",window.met_error_d="内部错误，无法显示此内容",window.met_zimg_prev="上一张",window.met_zimg_next="下一张";
	
	require.async('effects/zoom/zoom_1/zoom');		
	
});	