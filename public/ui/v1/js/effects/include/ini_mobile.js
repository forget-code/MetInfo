define(function(require, exports, module) {
	var common = require('common');   		//公用类
	
	if($("form.ui-from").length>0){
		require.async('effects/form/form');
	}
//右下角弹出图标----------------------------------------------------------
   $(document).ready(function () { 
		if($("#footernav").length>0){
			btn = document.getElementById("info-nr-btn");
			btn.onclick = function () {
				var divs = document.getElementById("info-nr-phone").querySelectorAll("div");
				var className = className = this.checked ? "on" : "";
				for (i = 0; i < divs.length; i++) {
					divs[i].className = className;
				}
				document.getElementById("jisou-info").style.display = "on" == className ? "block" : "none";
			}
		}
		if($("#footer").length>0){
			$("body").css("padding-bottom","45px");
		}
    });
//over
	/*产品模块*/
	if(met_module==3){
		if(MetpageType==2){
			common.metHeight($(".met_module3_list ul.list_1 li h2"));
		}
		if(MetpageType==3){
			$('.met_imgshowbox').flexslider({directionNav: false});
			/*参数排版*/
			var productW = $("#showproduct .pshow");
			if(productW){
				productW.find("dd .met_box li").height(function(){
					if($(this).height()<$(this).find('span').height()){
						return $(this).find('span').height();
					}
				});
			}
			$("#showproduct .met_nav li a").width($("#showproduct").width()/2-1);
			$("#showproduct .met_nav #scroller").width($("#showproduct .met_nav li").width()*$("#showproduct .met_nav li").length+30);
			if($("#showproduct .met_nav li").length>2){
				$("#showproduct .met_nav").append("<i class='am-icon-forward'></i>");
			}
			var IScroll = $.AMUI.iScroll;
			var myScroll = new IScroll('#wrapper', { scrollX: true, freeScroll: true });
			$("#showproduct .met_nav").css("visibility","visible");
			common.metHeight($("#showproduct .met_related_list li h2"));
		}
	}
	/*图片模块*/
	if(met_module==5&&MetpageType==3){
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

		$('.met_imgshowbox').flexslider({directionNav: false});
	}
	/*
		列表页
	*/
	if(MetpageType==2){
	

		
	}//列表页结束
	
	/*
		详情页
	*/
	if(MetpageType==3){
	
		if($(".met_editor table").length>0){
			$(".met_editor table").wrap("<div class='met_editor_table'></div>");
		}
	
		if($('#page_break').length>0){//编辑器分页
			$('#page_break .num li:first').addClass('on');
			$('#page_break .num li').click(function(){
				$('#page_break').find("div[id^='page_']").hide();
				if ($(this).hasClass('on')) {
					$('#page_break #page_' + $(this).text()).show();
				} else {
					$('#page_break').find('.num li').removeClass('on'); 
					$(this).addClass('on'); 
					$('#page_break').find('#page_' + $(this).text()).show(); 
				} 
			});
		}
		
		if(met_module==4){
			$("#showdownload .paralist li").height(function(){
				if($(this).height()<$(this).find('span').height()){
					return $(this).find('span').height();
				}
			});
			$("#showdownload .paralist").css('visibility','visible');
		}
		if(met_module==6){
			$("#showjob .paralist li").height(function(){
				if($(this).height()<$(this).find('span').height()){
					return $(this).find('span').height();
				}
			});
			$("#showjob .paralist").css('visibility','visible');
		}
		/*点击次数*/
		var metClicks = $(".met_Clicks");
		if(metClicks.length>0){
			var modulename = '';
			switch(met_module){
				case 2: 
					modulename = 'news';
				break;
				case 3: 
					modulename = 'product';
				break;
				case 4: 
					modulename = 'download';
				break;
				case 5: 
					modulename = 'img';
				break;
			}
			var urlw = met_weburl+'include/hits.php?type='+modulename+'&id='+id+'&metinfover=v1';
			$.ajax({
				type: "POST",
				url: urlw,
				dataType:"text",
				success: function(msg){
					metClicks.html(msg);
				}
			});
		}
	
	}//详情页结束

	/*视频*/
	var video = $(".metvideobox");        		
	if(video.length>0){
		require.async('effects/video-js/ini');
	}
	
	/*异步加载 - 站长统计 */
	var url=met_weburl+'include/interface/uidata.php?lang='+lang,h = window.location.href;
	if(h.indexOf("preview=1")!=-1)url = url + '&theme_preview=1';
	$.ajax({
		type: "POST",
		url: url,
		dataType:"json",
		success: function(msg){
			var c = msg.config;
			if(c.met_stat==1){			  //站长统计
				var navurl=classnow==10001?'':'../';
				var	stat_d=classnow+'-'+id+'-'+lang;
				var	url = met_weburl+'include/stat/stat.php?type=para&u='+navurl+'&d='+stat_d;
				$.getScript(url);
			}
		}
	});
	
	
});
