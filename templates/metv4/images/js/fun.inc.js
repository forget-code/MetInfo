//鼠标经过显示和定义class类函数
function proxy(dom,lei,type){
	if(dom){
		dom.hover(
		  function(){
			$(this).addClass(lei);
			if(type==1){
				if($(this).find('.sub').length>0){
					$(this).find('.sub').show();
				}else{
					$(this).addClass(lei+'er');
				}
			}
		  },
		  function(){
			$(this).removeClass(lei);
			if(type==1){
				if($(this).find('.sub').length>0){
					$(this).find('.sub').hide();
				}else{
					$(this).removeClass(lei+'er');
				}
			}
		  }
		);
	}
}
//定义class类函数
function metaddclass(dom,lei){
	if(dom)dom.addClass(lei);
}
//会员中心iftame等高函数
function Iframedom(){  
	var Iframe = $("#iframe");
	var Iframe_Conts = Iframe.contents().find("body");
		Iframe_Conts.css("height","100%");
	var Iframe_div = Iframe_Conts.find("div.main_deng");
	var Iframe_div1 = Iframe_Conts.find("div.main_zhuce");
		Iframe_div.css("margin","0px auto");
		Iframe_div1.css("margin","0px auto");
	var Iframe_Height = Iframe_Conts.outerHeight(true);
		Iframe.height(Iframe_Height);
}
//内页侧导航click函数
function navnow(dom,part2,part3){
	var li = dom.find(".navnow dt[id*='part2_']");
	var dl = li.next("dd.sub");
		dl.hide();
		if(part2.next("dd.sub").length>0)part2.next("dd.sub").show();
		if(part3.length>0)part3.parent('dd.sub').show();
		li.bind('click',function(){
			var fdl = $(this).next("dd.sub");
			if(fdl.length>0){
				fdl.is(':hidden')?fdl.show():fdl.hide();
				fdl.is(':hidden')?$(this).removeClass('launched'):$(this).addClass('launched');
			}
		});
}
//内页侧导航函数
function partnav(c2,c3,jsok){
	var part2 = $('#part2_'+c2);
	var part3 = $('#part3_'+c3);
	metaddclass(part2,'on');
	metaddclass(part3,'on');
	if(jsok==0)$('#sidebar dd.sub').show();
	if(jsok==1)navnow($('#sidebar'),part2,part3);
}
//定义宽度和等高函数
function metaddwdht(dom,p){
	dom.width(dom.find('img').width()+p);
	metHeight(dom);
}