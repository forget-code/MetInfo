define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var themefunc = require('tem/js/func');//函数
	var set = require('tem/js/set');//模板设置
	var langtxt = ownlangtxt;
	/*选项卡*/
	$('.theme ul.tabs').addClass('active').find('> li:eq(1)').addClass('current1');
	$('.theme ul.tabs li.list').hover(
		function () { 
			$(this).find("ul").stop(true,true);
			$(this).addClass('current');
			$(this).find("ul").delay(100).show();
		},
		function (){
			$(this).find("ul").stop(true,true);
			$(this).removeClass('current');
			$(this).find("ul li").removeClass('current');
			$(this).find("ul").delay(100).hide();
		}
	);
	$('.theme ul.tabs li a').click(function (g) { 
		if($(this).attr("target")!='_blank'){
			var tab = $(this).closest('.theme'),
			index = $(this).closest('li').index();
			tab.find('ul.tabs li').removeClass('current1');
			if(!$(this).attr("data-dup")){
				if(!$(this).closest('li').attr("class")){
					index++;
					$(this).closest('li.list').addClass('current1');
					//$(this).closest("ul").fadeOut("slow");
					$(this).closest("ul").delay(100).hide();
					$(".theme ul.tabs li a[data-dup='1']").find("span").html($(this).html());
					$("input[name='item_index']").val(index);
				}
			}else{
				$(this).closest('li').find("li:eq(0)").addClass('current1');
				$(".theme ul.tabs li a[data-dup='1']").find("span").html($(this).closest('li').find("li:eq(0) a").html());
			}
			$(this).closest('li').addClass('current1');
			tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
			tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
			tab.find('.tab_content').scrollTop(0);
		}
	});	
	
	/*初始布局调整*/
	themefunc.iht();
	$(window).resize(function() {
		themefunc.iht();
	});
	
	/*iframe处理*/
	function iframechuli(d){
		/*获取当前页面URL*/
		d.attr("data-src",window.frames["themeshow"].document.location.href);
		/*a链接*/
		var a = $(window.frames["themeshow"].document).find("a");
		var mobile = $("input[name='mobile']").val();
		a.each(function(){
			var h = $(this).attr("href");
			$(this).attr("target",'');
			if(h&&h.indexOf('theme_preview=1')==-1&&h.indexOf('javascript:')==-1&&h.indexOf('#')==-1&&h.indexOf('.jpg')==-1&&h.indexOf('.png')==-1&&h.indexOf('.gif')==-1){
				var p = h.substr(h.length-1,1),z = p=='/'?'index.php?':'&';
				var href = mobile==1?h+z+'theme_preview=1&met_mobileok=1':h+z+'theme_preview=1';
				$(this).attr("href",href);
			}
		});
		/*表单*/
		var form = $(window.frames["themeshow"].document).find("form");
		form.each(function(){
			var h = $(this).attr("action");
			if(h.indexOf('theme_preview=1')==-1){
				if(h){
					var p = h.substr(h.length-1,1),z = p=='/'?'index.php?':'&';
					$(this).attr("action",h+z+'theme_preview=1');
				}
			}
		});
		
		if(d.attr('data-sctop')){
			$(window.frames["themeshow"].document).scrollTop(d.attr('data-sctop'));
			d.removeAttr('data-sctop');
		}
		$(window.frames["themeshow"].document).find("body").attr("themeshow","1");
	}
	var ifchulitm;
	$("#themeshow").load(function(){  
		iframechuli($(this));
		clearInterval(ifchulitm);
		ifchulitm = setInterval(function(){ 
			var p = $(window.frames["themeshow"].document).find("body").attr("themeshow");
			if(!p)iframechuli($("#themeshow"));
		}, "800");
	});
	
	/*模板选择*/
	function mbop(d,t){
		d.find("img").stop(true,true);
		d.find(".theme-mb-ow").stop(true,true);
		if(t=='hover'){
			d.find("img").fadeTo("slow",0.3);
			d.find(".theme-mb-ow").fadeIn("slow");
		}else{
			if(d.find(".theme-mb-ow[data-mbqy='1']").length==0){
				d.find("img").fadeTo("slow",1);
				d.find(".theme-mb-ow").fadeOut("slow");
			}
		}
	}
	$(".theme-mb dd").hover(
		function () {
			mbop($(this),'hover');
		},
		function (g) {
			mbop($(this));
		}
	);
	var showmb = $(".theme-mb-ow[data-mbqy='1']");
	showmb.show();
	mbop(showmb.parent("dd"),'hover');
	showmb.find("a").eq(0).addClass('theme-mb-qy-ok');
	function lidb(index,f){
		if(index==1&&!f){
			$(".listzhezhao").show();
		}
		if(index<5){
			var d = $('div.tabs_item:eq(' + index + ')');
			if(d.html()==''){
				index++;
				var url = own_form
						+'a=dolidb&listdb='+index
						+'&met_skin_user='+$("input[name='met_skin_user']").val()
						+'&mobile='+$("input[name='mobile']").val();
				d.load(url, function(t) {
					themefunc.iht();
					lidb(index,f);
					if(index==5){//全部加载完成后初始化
						set.rendering(f);
						if(f){//切换模板后
							$("input[name='met_skin_css']").val('metinfo.css');
							themefunc.ajaxiframe();
							$(".iframezhezhao").hide();
						}
						$(".listzhezhao").hide();
					}
				});
			}
		}
	}
	$(".theme-mb-ow a").click(function(){
		var t = $(this).parent();
		if(t.attr("data-mbqy")!=1){
			$(".theme-mb-ow a").html(langtxt.skinusenow);
			$(this).html(langtxt.skinused);
			$(".iframezhezhao").show();
			var dbmb = $(".theme-mb-ow[data-mbqy='1']");
			dbmb.attr("data-mbqy",'');
			mbop(dbmb.parent("dd"));
			dbmb.hide();
			t.attr("data-mbqy","1");
			$(".theme-mb-ow a").removeClass('theme-mb-qy-ok');
			$(this).addClass('theme-mb-qy-ok');
			$("input[name='met_skin_user']").val(t.parents('dl').find('dt').text());
			set.removeckeditor();//销毁编辑器
			$('div.tabs_item').not('div.tabs_item:eq(0)').html('');
			lidb(1,1);
		}
		return false;
	});
	lidb(1);
	
	if($(".theme-right-erweima").length>0){
		var d = $(".theme-right-erweima .erweima");
		$.ajax({			
			url:basepath+'app/wap/wap.php?wap_dimensional_size='+d.attr("data-size")+'&met_dimensional_logo='+d.attr("data-logo")+'&action=dimensional&lang='+lang,
			type: 'GET',
			success: function(data) {
				d.html("<img src='"+siteurl+"upload/files/dimensional.png' />");
			}
		});
	}
	
	/*底部保存按钮*/
	$("form").submit(function(){
		themefunc.ajaxiframe(1,1);
	});
	$(".theme-save a").click(function(){
		$("input[name='submit']").click();
	});

});