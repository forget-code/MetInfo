define(function(require, exports, module) {

	var $ = require('jquery');
	
	/*=====================================================|
	|                  详情页面缩略图滚动                  |
	|=====================================================*/

	require.async('effects/zoom/common.css');	
	
	var labelBut = "<div class='met_ButPrev'></div><div class='met_ButNext'></div>";
	var _metTab = $(".metZoomTab"),_metImg = $(".metZoomImg"),_metTab_img = _metTab.find("img");
	_metTab.prepend(labelBut);
	_metTab_img.wrapAll("<span></span>");
	_metTab_img.wrap("<p></p>");
	_metTab_img.after("<i></i>");
		
	var productW = $("#showproduct");
	if(productW){productW.find("dd").width(productW.width()-productW.find("dt").width()-5);}
	
	var _time,_speed = 0;                 //左右切换
	var _metSpan = _metTab.find('span'),_left = _metTab.find(".met_ButPrev"),_right = _metTab.find(".met_ButNext");
	var _imgWidth = _metTab.find("img").length*70,_tabWidth = _metTab.width();
	_if = _tabWidth<_imgWidth?true:false;

	_metTab_img.each(function(e){      //鼠标经过图片切换
		var thisTab = $(this);
		var times;  		  
			_metTab.find("img").eq(0).siblings().css("display","block");
		thisTab.hover(
		  function () {
				var fileUrl = $(this);
				times = setTimeout(function(){
					var src_file = fileUrl.attr("file"),file_zoomfile = fileUrl.attr("zoomfile"),ids = fileUrl.attr("id"),aids = fileUrl.attr("aid");					
					$(".metZoom").attr({ "src":src_file, "file":file_zoomfile, "id":ids, "aid":aids});
					
					thisTab.siblings("i").css("display","block");
					thisTab.parent("p").siblings().find("i").css("display","none");
				},200)
		  },function () { clearTimeout(times); }
		);
		
	});
	
	_left.hover(function () {
					_metTab.find('.met_ButPrev').css('background-position','left 18px');
					if(_if){
						_time = setInterval(function(){
							if(_speed != 0){_speed++;_metSpan.css('margin-left',_speed)}else{clearInterval(_time)}
						},10)	
					}							
			 },function () {
					_metTab.find('.met_ButPrev').css('background-position','left -42px');
					clearInterval(_time)
			 }); 
	_right.hover(function () {
					_metTab.find('.met_ButNext').css('background-position','right 18px');
					if(_if){
						_stop = -(_imgWidth-_tabWidth-10);
						_time = setInterval(function(){
							if(_speed != _stop){_speed--;_metSpan.css('margin-left',_speed)}else{clearInterval(_time)}
						},10)	
					}
			 },function () {
					_metTab.find('.met_ButNext').css('background-position','right -42px');
					clearInterval(_time)
			 });


			 
	require.async('effects/zoom/zoom_1/min');               //图片点击放大
	if($(".metZoomImg[rel='gal1']").length>0){
		require.async('effects/zoom/zoom_2/min');           //图片鼠标放大
	}

	
});