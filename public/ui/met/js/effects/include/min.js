define(function(require, exports, module) {
	var common = require('common');   			//全局库
	require('effects/font-awesome/css/font-awesome.min.css');//图标字体
	require('css/metinfo.css');                 //UI样式
	require('effects/include/ini');   			//系统功能
	require('effects/ie6_png/ie6-min');			//ie6透明
	



	

	
	var metZoom = $(".metZoom");				//详情页图片样式
	if(metZoom.length>0 && id && (met_module==3 || met_module==5)){
		require.async('effects/zoom/min');
	}	
	
	common.metHits();                           //网页点击数
	
	var metPage = $(".metpager_1v1");           //翻页样式
	if(metPage.length>0){
		common.metPage();           
	}

	var metNav = $(".metNav");					//导航平均宽度
	if(metNav.length>0){
		common.metNav(metNav);                       
	}

	var metProduct = $("#productlist");			//产品列表页ie6/7平均宽度
	var dataP = metProduct.find("ul").data("ie67");
		ProImg(metProduct,dataP);
	var metImg = $("#imglist");					//图片列表页ie6/7平均宽度
	var dataI = metImg.find("ul").data("ie67");
		ProImg(metImg,dataI)
	function ProImg(m,d){
		if(m.length>0 && d){
			if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"")=="MSIE6.0"){ 
				common.metProduct(m,d);  
			}
			if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"")=="MSIE7.0"){ 
				common.metProduct(m,d);  
			}                      
		}
	}
	
	var metProT=$(".metProT");					//产品详情页面切换
	var metProB=$("#metProB");
	if(metProT.length>0){
		common.metProTab(metProT,metProB);
	}
	

	
	var banner1=$(".metinfo-banner1");			//banner 样式一
	if(banner1.length>0){
		require('effects/banner/nivo-slider/nivo-slider.css');
		require('effects/banner/nivo-slider/jquery.nivo.slider.pack.js');
		$(".flash").prepend("<style type='text/css'>.metinfo-banner1 img{ height:"+banner1.height()+"px !important;}</style>");
		$('#slider').nivoSlider({effect: 'random', pauseTime:5000,directionNav:false});
	}

	var banner2=$(".banner2");					//banner 样式二
	if(banner2.length>0){
		common.metBanner2(banner2);
	}
	
	var banner3=$(".metinfo-banner3");			//banner 样式三
	if(banner3.length>0){
		require('effects/banner/nivo-slider/nivo-slider.css');
		require('effects/banner/nivo-slider/jquery.nivo.slider.pack.js');
		$(".flash").prepend("<style type='text/css'>.metinfo-banner3 img{ height:"+banner3.height()+"px !important;}</style>");
		$('#slider').nivoSlider({effect: 'fade',slices: 30, pauseTime:5000,directionNav:false});
	}
	
	var banner4=$("#metinfo_banner4");			//banner 样式四
	if(banner4.length>0){
		require('effects/banner/banner4/style.css');
		require('effects/banner/banner4/flash4.js');
	}
	
	var banner5=$(".metinfo-banner5");			//banner 样式五
	if(banner5.length>0){
		require('effects/banner/nivo-slider/nivo-slider.css');
		require('effects/banner/nivo-slider/jquery.nivo.slider.pack.js');
		$(".metinfo-banner5").before("<style type='text/css'>.metinfo-banner5 img{ height:"+banner5.height()+"px !important;}</style>");
        $('#slider').nivoSlider({
			effect: 'fade',
			animSpeed:200,
			pauseTime:5000,
			controlNav:false,
			afterLoad: function(){ 
				
				$(".metinfo-banner5").hover(function(tm){
					$(this).addClass("metinfo-banner5-hover");
				},function(){
					$(this).removeClass("metinfo-banner5-hover");
				});
				$(".nivo-prevNav,.nivo-nextNav").attr('onselectstart','return false');
				$(".nivo-prevNav").hover(function(){
					$(this).addClass("nivo-prevNav-hover");
				},function(){
					$(this).removeClass("nivo-prevNav-hover");
				});
				$(".nivo-nextNav").hover(function(){
					$(this).addClass("nivo-nextNav-hover");
				},function(){
					$(this).removeClass("nivo-nextNav-hover");
				});

			} 
		});
	}
	
	var banner6=$(".flash6");			//banner 样式六
	if(banner6.length>0){
		require('effects/banner/banner6/css.css');
		require('effects/banner/banner6/jquery.bxSlider.min.js');
		$('#slider6').bxSlider({ mode:'vertical',autoHover:true,auto:true,pager: true,pause: 5000,controls:false});
	}
	
	var banner7=$(".metinfo-banner7");			//banner 样式七
	if(banner7.length>0){
		require('effects/banner/banner7/style.css');
		require('effects/banner/banner7/modernizr.min.js');
		require('effects/banner/banner7/box-slider-all.jquery.min.js');
	}			
					
	var banner8=$(".flexslider_flash");			//banner 样式八
	if(banner8.length>0){
		require('effects/banner/jq-flexslider/flexslider.css');
		require('effects/banner/jq-flexslider/jquery.flexslider-min.js');
		$('.flashfld').flexslider({ animation: 'slide',controlNav:false});
	}
		
					





//metPNG.fix('html,.fixpng,img,background');
	//common2.common23();
	
	/*导航下拉
	var nav1=$(".metect-nav");
	if(nav1.length>0){
		var zx = require('effects/nav/nav');
			if(zx)zx.nav(nav1);
	}
	
	exports.nav = function(dom){
	dom.each(function(){
		var M = $(this);
	
	*/

});