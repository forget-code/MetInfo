define(function(require, exports, module) {

	var $ = require('jquery');	
	//详情页图片样式二
	
	require.async('effects/zoom/zoom_2/jqzoom');	

	var jqWidth = $(".metZoom").width();
	var jqHeight = $(".metZoom").height();
	
	
	var imgdetail_x= jqWidth;
	var imgdetail_y= jqHeight;
	
	$(document).ready(function() {
	var bimht=$('#metshowtype_2').parent('dt');
		bimht=bimht.size()>0?bimht.parent('dl').width():700;
	var dwef=bimht-jqWidth-10;
		$('.metZoomImg').jqzoom({
				zoomWidth: dwef,
				zoomHeight:jqHeight,
				xOffset:10,
				yOffset:0,
				zoomType: 'standard',
				lens:true,
				preloadImages: false,
				alwaysOn:false
			});
	});
	
});	