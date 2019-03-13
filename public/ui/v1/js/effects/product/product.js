define(function(require, exports, module) {
	var common = require('common'); 

	if(MetpageType==2){//列表页
		var ul_1 = $('.met_module3_list ul.list_1');
		if(ul_1.length>0){
			var minwidth = parseInt(ul_1.find('li img').attr("width"))+20;
			ul_1.find("li a").width(function(){ return $(this).find('img').attr("width");});
			common.listpun(ul_1,ul_1.find("li"),minwidth);
			common.metHeight($(".met_module3_list ul.list_1 li h2"));
			ul_1.css("visibility","visible");
		}
		var ul_2 = $('.met_module3_list ul.list_2');
		if(ul_2.length>0){
			ul_2.find("dt").width(function(){ return $(this).find('img').attr("width");});
			ul_2.find("dd").css('margin-left','-'+ul_2.find("dt").width()+'px');
			ul_2.find("dd .met_listbox").css('margin-left',ul_2.find("dt").width()+'px');
			ul_2.css("visibility","visible");
		}
	}
	if(MetpageType==3){//详情页
		/*产品展示图片*/
		require.async('effects/flexslider/flexslider.css');
		require.async('effects/flexslider/jquery.flexslider',function(){
			$('#showproduct dl.pshow dt .met_imgshowbox').flexslider({
				selector: ".slides > figure",
				directionNav: false,
				controlNav: true,
				manualControls: $("#showproduct dl.pshow dt ol li"),
				touch: true,
				slideshowSpeed:999999999,
				animationSpeed:20,
				pauseOnHover: true,
				start: function() {
					$('#showproduct dl.pshow dt .met_box').css('visibility','visible');
				}
			});
		});
		require.async('effects/product/proshow');
		/*参数排版*/
		var productW = $("#showproduct .pshow");
		if(productW){
			productW.find("dt").width(function(){ return parseInt($(this).attr("data-product_x"))+220;});
			productW.find("dd").css('margin-left','-'+(parseInt(productW.find("dt").width())+1)+'px');
			productW.find("dd .met_box").css('margin-left',(parseInt(productW.find("dt").width())+1)+'px');
			productW.find("dd .met_box li").height(function(){
				if($(this).height()<$(this).find('span').height()){
					return $(this).find('span').height();
				}
			});
			productW.css("visibility","visible");
		}
		/*选项卡*/
		if($("#showproduct .met_nav li").length>1){
			$("#showproduct .met_nav li").hover(function(){
				$(this).addClass("met_hover");
			},function(){
				$(this).removeClass("met_hover");
			});
			function showproductnav(url){
				var list = url.split("#mettab");
					list = parseInt(list[1])-1;
				if($("#showproduct .met_nav_contbox .met_editor").length>=(list+1)){
					$("#showproduct .met_nav li").removeClass("met_now");
					$("#showproduct .met_nav_contbox .met_editor").hide();
					$("#showproduct .met_nav_contbox .met_editor").eq(list).show();
					$("#showproduct .met_nav li").eq(list).addClass("met_now");
				}
			}
			var timespnav;
			$("#showproduct .met_nav li").click(function(){
				clearTimeout(timespnav);
				timespnav = setTimeout(function () {
					showproductnav(location.href);
				}, 200);
			});
			showproductnav(location.href);
		}
		/*相关产品*/
		var related_list = $('.met_related_list');
		if(related_list.length>0){
			var minwidth = parseInt(related_list.find('li img').attr("width"))+20;
			related_list.find("li a").width(function(){ return $(this).find('img').attr("width");});
			common.listpun(related_list,related_list.find("li"),minwidth);
			related_list.css("visibility","visible");
		}
	}
});