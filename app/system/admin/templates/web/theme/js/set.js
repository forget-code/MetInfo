define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	
	var themefunc = require('tem/js/func');//函数
	var up = require('tem/js/upload');//自定义上传组件
	var banner = require('tem/js/banner');/*大图轮播设置*/
	var ckeditor = require('tem/js/ckeditor');/*大图轮播设置*/
	/*提示文字*/
	require('tem/tips/css/simpletooltip.min.css');
	require('tem/tips/js/simpletooltip.min');
	function tipscl(){
		$('.v52fmbx dl').each(function(){
			var tips = $(this).find("span.tips");
			if(tips.length>0&&tips.html()!=''){
				$(this).attr("title",tips.html());
			}
		});
		$('.v52fmbx dl').simpletooltip({position: 'right'});
	}
	
	/*展开隐藏设置*/
	require('tem/js/jquery.rotate');//载入旋转插件
	function rotatecl(){
		$("h3.v52fmbx_hr").prepend('<i class="fa fa-sort-desc"></i>');
		$('h3.v52fmbx_hr').each(function(){
			var dl = $(this).nextUntil('h3.v52fmbx_hr');
			dl.wrapAll("<div class='dllistwrap' data-num='"+dl.length+"'></div>");
		});
		$('h3.v52fmbx_hr').find("i").rotate({ 
			duration:300, 
			angle: 0, 
			animateTo:-90 
		});
		$(".tabs_item").each(function(){
			$(this).find(".dllistwrap").eq(0).show();
			$(this).find(".v52fmbx_hr").eq(0).find("i").rotate({ 
					duration:300, 
					angle: -90, 
					animateTo:0 
			});
		});
		
		$('h3.v52fmbx_hr').click(function(){
			if($(this).next(".dllistwrap").is(":hidden")){
				var tshow = $(this).parents(".tabs_item").find(".dllistwrap").not(":hidden").prev();
				$(this).parents(".tabs_item").find(".dllistwrap").slideUp();
				tshow.find("i").rotate({ 
					duration:200, 
					angle: 0, 
					animateTo:-90 
				});
				$(this).next(".dllistwrap").slideDown();
				$(this).find("i").rotate({ 
					duration:200, 
					angle: -90, 
					animateTo:0 
				});
				$(this).next(".dllistwrap").find(".metuplaodify").css('left',$(this).next(".dllistwrap").find(".ftype_upload input[data-upload-type]").outerWidth());
			}else{
				$(this).next(".dllistwrap").slideUp();
				$(this).find("i").rotate({ 
					duration:300, 
					angle: 0, 
					animateTo:-90 
				});
			}
		});
	}
	
	/*触发预览*/
	function ptir(){
		var jting = $(".ftype_upload input[type='text'],.ftype_color input[type='text']");
		if(jting.length>0){
			jting.each(function(){
				$(this).attr("data-myvalue",$(this).val());
			});
			setInterval(function(){
				jting.each(function(){
					if($(this).val()!=$(this).attr("data-myvalue")){
						$(this).attr("data-myvalue",$(this).val());
						themefunc.ajaxiframe(4);
					}
				});
			},400);
		}
	}
	$(document).on('change',".ui-from select",function(){
		themefunc.ajaxiframe(2);
	});
	var theme_t;
	$(document).on('input propertychange',".ui-from .ftype_input input,.ftype_textarea textarea",function(){
		clearTimeout(theme_t);
		theme_t = setTimeout(function () {
			themefunc.ajaxiframe(3);
		}, 800);
	});

	$(document).on('change',".ui-from input[type='radio'],.ui-from input[type='checkbox']",function(){
		themefunc.ajaxiframe(5);
	});
	
	/*颜色主题选择*/
	$(document).on('click',".theme_color a",function(){
		var s = $(this).attr("data-cssname");
		var y = $("input[name='met_skin_css']");
		if(y.val!=s){
			y.val(s);
			themefunc.ajaxiframe(6);
			$(".theme_color a").removeClass('now');
			$(this).addClass('now');
		}
	});

	/*全部载入完成后*/
	exports.rendering = function(f){
		if($(window).width()>900)tipscl();
		rotatecl();
		ckeditor.jiazai();
		banner.sortable();
		up.bannerup($('.banner_rep input'));//处理动态加载的自定义上传组件
		common.AssemblyLoad($("body"));
		common.defaultoption();
		ptir();
		/*编辑器内容变化捕获*/
		if($('.ftype_ckeditor_theme .fbox textarea').length>0){
			var theme_e;
			function chang1(){		
				var content,d = $('.ftype_ckeditor_theme .fbox textarea');
					d.each(function(){
						if(UE.getEditor[$(this).attr('name')]){
							content = UE.getEditor[$(this).attr('name')].getContent();
							if($(this).val()!=content){
								clearTimeout(theme_e);
								$(this).val(content);	
								theme_e = setTimeout(function () { themefunc.ajaxiframe(7); }, "820");
							}
						}
					});
			}
			setInterval(chang1, "800"); 
			setTimeout(function () { clearTimeout(theme_e); }, "820");
		}
		if(!f){
			$(".tabs_item").hide();
			var index = $("input[name='item_index']").val();
			$(".theme ul.tabs li a[data-dup='1']").find("span").html($('.theme ul.tabs li ul li:eq('+(index-1)+') a').html());
			$(".tabs_item:eq("+index+")").slideDown();
			$('.theme ul.tabs').addClass('active').find('li ul li:eq('+(index-1)+')').addClass('current1');
		}
		if($.browser.msie || ($.browser.mozilla && $.browser.version == '11.0')){ 
			var v = Number($.browser.version);
			if(v<10){
				function dlie(dl){
					var dw;
					dl.each(function(){
						var dt = $(this).find("dt"),dd = $(this).find("dd");
						if(dt.length>0){
							dt.css({"float":"left","width":"105px"});
							dd.css({"float":"left","width":"180px"});
						}
					});
				}
				var dl = $(".v52fmbx dl");
				dlie(dl);
			}
		}
	}
 
	/*编辑器内容获取*/
	exports.removeckeditor = function(){
		var d = $('.ftype_ckeditor_theme .fbox textarea');
		if(d.length>0){
			d.each(function(){
				var n = $(this).attr('name');
				if(UE.getEditor[n]){
					UE.destroy(UE.getEditor[n]);
				}
			});
		}
	}
	
});