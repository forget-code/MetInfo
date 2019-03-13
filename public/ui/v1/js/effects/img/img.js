define(function(require, exports, module) {
	var common = require('common'); 

	if(MetpageType==2){//列表页
		var ul_1 = $('#imglist ul.list_1');
		if(ul_1.length>0){
			var minwidth = parseInt(ul_1.find('li img').attr("width"))+20;
			ul_1.find("li a").width(function(){ return $(this).find('img').attr("width");});
			common.listpun(ul_1,ul_1.find("li"),minwidth);
			ul_1.css("visibility","visible");
		}
		var ul_2 = $('#imglist ul.list_2');
		if(ul_2.length>0){
			ul_2.find("dt").width(function(){ return $(this).find('img').attr("width");});
			ul_2.find("dd").css('margin-left','-'+ul_2.find("dt").width()+'px');
			ul_2.find("dd .met_listbox").css('margin-left',ul_2.find("dt").width()+'px');
			ul_2.css("visibility","visible");
		}
	}
	if(MetpageType==3){//详情页
	
		if($(".imgparalist li").length>0){
			$(".imgparalist li").height(function(){
				if($(this).height()<$(this).find('span').height()){
					return $(this).find('span').height();
				}
			});
			$(".imgparalist").css('visibility','visible');
		}else{
			$(".imgparalist").hide();
		}

		$('#showimg .met_slide_list').width($('#showimg .met_slide_list img').attr("width"));
		
		require('effects/img/css/imgshow.css');
		require('effects/img/jquery.exposure.min');
		var width  = $(".met_slide_box").attr("data-sidewidth"),
			height = $(".met_slide_box").attr("data-sideheight");
		$(".met_slide_box").width(width);
		$(".met_slide_box .left,.met_slide_box .right").css({"top":'0px',"opacity":"0","height":height+'px'});
		$(".met_slide_box .left,.met_slide_box .right").hover(function(){
			$(".met_slide_box .left,.met_slide_box .right").stop(true,true);
			$(this).fadeTo("slow", 1);
		},function(){
			$(".met_slide_box .left,.met_slide_box .right").stop(true,true);
			$(this).fadeTo("slow", 0);
		});
		$('.met_slide_list ul').exposure({carouselControls : true,
			imageControls : true,
			pageSize : 5,
			slideshowControlsTarget : '#slideshow',
			onThumb : function(thumb) {
				var li = thumb.parents('li');				
				var fadeTo = li.hasClass('active') ? 1 : 0.3;
				
				thumb.css({display : 'none', opacity : fadeTo}).stop().fadeIn(200);
				
				thumb.hover(function() { 
					thumb.fadeTo('fast',1); 
				}, function() { 
					li.not('.active').children('img').fadeTo('fast', 0.3); 
				});
			},
			onImage : function(image, imageData, thumb) {
				// Check if wrapper is hovered.
				var hovered = $('.exposureWrapper').hasClass('exposureHover');
				
				// Fade out the previous image.
				$('.exposureWrapper > .exposureLastImage').stop().fadeOut(500, function() {
					$(this).remove();
				});
				
				// Fade in the current image.
				image.hide().stop().fadeIn(1000);
				
				if ($.exposure.showThumbs && thumb && thumb.length) {
					thumb.fadeTo('fast', 1).addClass('selected');
				}
				if($(".exposureData .caption").html()==''){
					$(".exposureData").hide();
				}else{
					$(".exposureData").show();
				}
			},
			onCarousel : function(firstImage, lastImage) {
				$('.exposureThumbs li').hide().children('img.selected').stop().css('opacity', 0.3).removeClass('selected');
			},
			onSlideshowPlayed : function() {
				$('.exposurePauseSlideshow').css('display','inline');
			}
		});
		$(".exposureThumbs img,.met_slide_box .left,.met_slide_box .right,#exposure").click(function(){
			$(".exposureThumbs img").css('opacity', 0.3); 
		});
		
	}
});