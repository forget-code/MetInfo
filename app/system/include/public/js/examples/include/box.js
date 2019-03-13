define(function(require, exports, module) {

	var common = require('common');
	
	/*链接处理*/
	
	$(".metcms_cont_left dl dd a").click(function(event){
		if($(this).attr("target")!='_blank'){
			event.preventDefault();
			var url = $(this).attr("href");
			$(".metcms_cont_right_box iframe").attr("src",url);
			var u = location.href;
			var id = $(this).attr("id");
				id = id.split('metinfo_');
			if(u.indexOf("#")!=-1){
				u = u.split('#');
				location.href = u[0] + '#' + id[1];
			}else{
				location.href = location.href+'#'+id[1];
			}
			$(".metcms_cont_left dl dd a").removeClass('on');
			$(this).addClass('on');
		}
	});
	var du = location.href;
	if(du.indexOf("#")!=-1){
		du = du.split("#");
		var dom = $("#metinfo_"+du[1]);
		$(".metcms_cont_right_box iframe").attr("src",dom.attr("href"));
		$(".metcms_cont_left dl dd a").removeClass('on');
		dom.addClass('on');
	}
	
	
	/*侧栏*/
	function leftsideshow(dl,t){
		var dd = dl.find("dd");
		$(".metcms_cont_left dl.jslist dd").stop(true,true);
		$(".metcms_cont_left dl.jslist").removeClass('on');
		dl.addClass('on');	
		if(t==1){
			$(".metcms_cont_left dl.jslist dd").hide();
			dd.show(); 
		}else{
			dd.show(); 
		}
	}
	
	var times,times1;
	$(".metcms_cont_left dl.jslist").hover(
		function(){
			clearTimeout(times);
			var dl=$(this),dd = $(this).find("dd");
				if(dd.is(":hidden")){
					times1 = setTimeout(function () {
						$(".metcms_cont_left dl.jslist dd").hide();
						leftsideshow(dl);
					}, 200);
				}
		},
		function(){
			clearTimeout(times1);
			var dd = $(this).find("dd");
			times = setTimeout(function() {
				dd.hide()
			}, 300)
		}
	);
	
	$("dl.jslist:last-child").find("dd").css({"top":"auto","bottom":"-1px"});
	
	/*左右等高*/
	$('.metcms_cont_left,.metcms_cont_right_box,.metcms_cont_right_box iframe').height($(window).height());
	$(window).resize(function () {
		$('.metcms_cont_left,.metcms_cont_right_box,.metcms_cont_right_box iframe').height($(window).height());
	})
	
	
	/*升级控件*/	
	if($('.metcms_upload_download').length>0)require.async('epl/include/download');
	
	/*自动补丁*/
	if($('#met_automatic_upgrade').val() == 1)require.async('epl/include/patch');
	
});
