define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	function iht(){
		var ih = $(window).height();
		$(".theme-right iframe").height(ih);
		$(".theme .tab_content").height(ih-80);
		if($(".mobileiframe").length>0){
			$(".mobileiframe").css("margin",function(){
				return ((ih-$(this).outerHeight())/2)+'px auto';
			});
		}
	}
	exports.iht = function(){
		iht();
	}
	/*大图轮播数据处理*/
	function upimgchuli(){
		if($(".banner_add").length>0){
			var li = $(".index_bannerlist li"),v= new Object(),json;
			li.each(function(i){
				var img_path  = $(this).find("input[name='img_path']").val(),
					img_link  = $(this).find("input[name='img_link']").val(),
					img_title = $(this).find("input[name='img_title']").val(),
					// 添加变量（新模板框架banner属性）
					img_title_color = $(this).find("input[name='img_title_color']").val(),
					img_des = $(this).find("input[name='img_des']").val(),
					img_des_color = $(this).find("input[name='img_des_color']").val(),
					img_text_position = $(this).find("input[name='img_text_position']:checked").val(),

					id        = $(this).attr("data-bannerid");
					img_path = img_path.replace("../","");
				v[i] = new Object();
				v[i]['img_path'] = img_path;
				v[i]['img_link'] = img_link;
				v[i]['img_title'] = img_title;
				v[i]['img_title_color'] = img_title_color;
				v[i]['img_des'] = img_des;
				v[i]['img_des_color'] = img_des_color;
				v[i]['img_text_position'] = img_text_position;
				v[i]['id'] = id;
			});
			json = JSON.stringify(v);
			$("input[name='indexbannerlist']").val(json);
		}
	}
	/*预览*/
	function ajaxiframe(t){
		upimgchuli();
		if($(window).width()>700){
			//$("input[name='item_index']").val($(".tabs_item:visible").index());
			$("input[name='iframesrc']").val($("#themeshow").attr('data-src'));
			if(t!=1){
				jQuery.ajax({
					url:$(".ui-from").attr("action"),
					data:$(".ui-from").serialize()+'&preview=1',
					type:"POST",
					success:function(){
						var r = $("#themeshow"),src=r.attr('data-src')?r.attr('data-src'):r.attr('src');
						var top = $(window.frames["themeshow"].document).scrollTop();
						r.attr('data-sctop',top);
						r.attr('src',src );
					}
				});
			}
		}
	}
	exports.ajaxiframe = function(i,t){
		ajaxiframe(t);
	}

});