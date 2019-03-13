define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');

	var themefunc = require('own_tem/js/func');//公共函数
	/*图片上传*/
	var up = require('own_tem/js/upload');
		up.bannerup($('.banner_rep input'));
	/*删除*/
	$(document).on('click',".banner_del",function(){
		$(this).parents("li").slideUp().remove();
		themefunc.ajaxiframe(8);
	});
	/*添加*/
	$(document).on('click',".banner_add",function(){
		if($(".bannerlist li").length==0){
			var html = $("textarea[name='bannerlist_li_html']").val();
			$(".bannerlist ul").append(html);
			// 组件添加（新模板框架banner文字颜色控件）
			if($('.bannerlist li .ftype_color .fbox input').length>0){
				require.async(['epl/color/jquery.minicolors.css','epl/color/jquery.minicolors.min'],function(){
					$(".bannerlist li .ftype_color .fbox input").minicolors();
				});
			}

			up.bannerup($('.banner_rep input'));
		}else{
			// banner添加修改（新模板框架v2）
			var html=$(".bannerlist li:eq(0)").clone(),
				num=$(".bannerlist ul>li").length;
			html.removeAttr("data-bannerid").hide().find("input:not([type=radio])").val('').attr({value:'','data-myvalue':''});
			html.find("img").attr('src','');
			html.find("input[name*=img_text_position]").attr({name:'img_text_position'+num}).removeAttr('checked');
			html.find(".ftype_radio label:last-child input[name*=img_text_position]").attr({checked:''});
			html.appendTo(".bannerlist ul");

			var d = $(".bannerlist li:last-child");
			d.slideDown();
			$('.bannerlist ul').sortable('destroy');
			$('.bannerlist ul').sortable().bind('sortupdate', function() {
				themefunc.ajaxiframe(9);
			});
			// 组件添加（新模板框架banner文字颜色控件）
			var $ftype_color=d.find(".ftype_color .fbox input");
			if($ftype_color.length>0){
				d.find(".ftype_color .fbox .minicolors-swatch-color").css({'background-color':''});
				require.async(['epl/color/jquery.minicolors.css','epl/color/jquery.minicolors.min'],function(){
					$ftype_color.minicolors();
				});
			}

		}
	});
	/*设置标题和链接*/
	$(document).on('click',".banner_more",function(){
		var d = $(this).next(".banner_input");
		if(d.is(":hidden")){
			d.slideDown();
		}else{
			d.slideUp();
		}
	});
	/*鼠标经过*/
	$(document).on('hover',".bannerlist li a",function(e){
		var imgto = 1,divto = 0,delto = 0;
		if(e.type=='mouseenter'){
			imgto = 0.3;
			divto = 0.9;
			delto = 0.9;
		}
		$(this).find("img").stop(true,true);
		$(this).find("div.banner_rep").stop(true,true);
		$(".banner_del").stop(true,true);
		$(this).find("img").fadeTo("slow",imgto);
		$(this).find("div.banner_rep").fadeTo("slow",divto);
		$(this).find(".banner_del").fadeTo("slow",delto);
	});
	/*拖曳排序*/
	require('own_tem/js/jquery.sortable.min');

	exports.sortable = function(){
		$('.bannerlist ul').sortable().bind('sortupdate', function() {
				themefunc.ajaxiframe(10);
		});
	}

});