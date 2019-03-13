/*
采用SeaJS模块化架构，本文件为入口模块。
require        |用于载入JS或CSS文件,可用已配置路径"tem"(当前模板目录路径)
-------------------------------
已默认载入Jquery 1.11.1
-------------------------------
可用全局变量：
met_weburl     |网站网址
lang           |当前语言
classnow       |当前页面所属栏目ID
id             |当前页面ID（仅详情页有）
met_module     |当前页面所属模块
met_skin_user  |当前所用模板目录名称
MetpageType    |页面位置，1为首页，2为列表页，3为详情页
-------------------------------
var common = require('common'); //公用库，加载后才支持JQuery以及一些方法
common.listpun(整体元素,列表元素,最小宽度);//自适应排版
common.metHeight(元素);//等高
*/
define(function(require,exports,module){
	var common=require('common');
	function navfucn(d,m){
		if(d.is(":hidden")){
			$(".tem_head .tem_langlist:visible,.tem_head nav:visible").collapse('close');
			$(".tem_top i").removeClass('met_now');
			d.collapse('open');
			m.addClass('met_now');
		}else{
			d.collapse('close');
			m.removeClass('met_now');
		}
	}
	$(".tem_top i.am-icon-bars").on("click",function(){
		navfucn($(".tem_head nav"),$(this));
	});
	$(".tem_top i.am-icon-globe").on("click",function(){
		navfucn($(".tem_head .tem_langlist"),$(this));
	});
	
	$('.tem_banner').flexslider({directionNav: false});
	
	if ($(".tem_index_product").length > 0) {
		common.metHeight($(".tem_index_product ul li h2"));
	}
	
	if ($(".tem_index_news_slides").length > 0) {
		$('.tem_index_news_slides').flexslider({
			directionNav: false,
			controlNav: true,
			manualControls: $(".tem_index_news_tab li"),
			touch: false,
			slideshow: false,
			pauseOnHover: true
		})
	}
	
	$('.tem_index_case_list').flexslider({
		directionNav: false
	})
});