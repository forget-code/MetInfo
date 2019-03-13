jQuery.fn.appadvsFixed = function(options) {
	var defaults = {
		css:'',
		x:0,
		y:0
	};
	var o = jQuery.extend(defaults, options);
	var isIe6=false;
	if($.browser.msie && parseInt($.browser.version)==6)isIe6=true;			
	var html= $('html');
	if (isIe6 && html.css('backgroundAttachment') !== 'fixed') {
		html.css('backgroundAttachment','fixed') 
    }
	return this.each(function() {
	var domThis=$(this)[0];
	var objThis=$(this);
		if(isIe6){
			var left = parseInt(o.x) - html.scrollLeft(),
				top = parseInt(o.y) - html.scrollTop();
			objThis.css('position' , 'absolute');
			domThis.style.setExpression('left', 'eval((document.documentElement).scrollLeft + ' + o.x + ') + "px"');
			domThis.style.setExpression('top', 'eval((document.documentElement).scrollTop + ' + o.y + ') + "px"');	
		}else{
			objThis.css('position' , 'fixed').css('top',o.y).css('left',o.x);
		}
	});
}
function app_advertising_para(y){
	var d=$('#app_advertising_js').attr('src');d=d.split('?');d=d[1];d=d.split('&');
	var t=d[y];t=t.split('=');t=t[1];
		return t;
}
function app_advertising_pingjun(dom,type){
	var body = type==1?parseInt($(window).height()):parseInt($(window).width());
	var block = type==1?parseInt(dom.outerHeight()):parseInt(dom.outerWidth(true));
	var top=body-block;
	
	return top;
}
function app_advertising_rbadvs(dom,m,w,h,bd,bg){
	var domhtm = dom.find('.app-advertising-rbadvs-html');
	dom.css({'width':w+'px','height':h+'px'});
	domhtm.css({'width':w+'px','height':h+'px'});
	if(domhtm.size()>0){
		dom.css({
			'background':bg,
			'border':'2px solid '+bd
		});
	}
	if(m>0){
		setTimeout(function(){
			dom.hide();
		},m*1000);
	}
	var top = app_advertising_pingjun(dom,1);
	var left = app_advertising_pingjun(dom,2);
	dom.appadvsFixed({x:left,y:top});
}
function app_advertising_banner(m,type){
	var a=1000,b=m*1000,obj=$(".app-advertising-banner");
	if(type==2){
		obj.show(1);
		obj.width(obj.find('img').width());
		obj.height(obj.find('img').height());
	var top = parseInt(app_advertising_pingjun(obj,1)/2);
	var left = parseInt(app_advertising_pingjun(obj,2)/2);
		obj.appadvsFixed({x:left,y:top});
		setTimeout(function(){
            obj.hide();
        },b);
	}else{
		obj.delay(500).slideDown(a);
		if(m!=0)obj.delay(b).slideUp(a);
	}
}
function app_advertising(){
	var u=app_advertising_para(0),columnid=app_advertising_para(1),lang=app_advertising_para(2);
	$.getJSON(u+'include/interface/app-advs.php?app_advertising_u='+u+'&lang='+lang+'&columnid='+columnid+'&jsoncallback=?',function (json){
		if(json.metcms!=''){
			if(json.leftok=='1'){//左对联
				var lefthtml="<div class='app-advertising app-advertising-left'><a href='"+json.leftlinkurl+"' target='_blank'><img src='"+json.leftimgurl+"' width='"+json.leftimgx+"' height='"+json.leftimgy+"' /></a><a href='javascript:;' class='app-advertising-close'>close</a></div>";
				$("body").append(lefthtml);
				if(json.leftx==''){
					json.leftx = parseInt(app_advertising_pingjun($(".app-advertising-left"),1)/2);
				}
				json.leftx=parseInt(json.leftx);
				json.lefty=parseInt(json.lefty);
				$(".app-advertising-left").appadvsFixed({x:json.lefty,y:json.leftx});
				if(json.couplettime!=0){
					setTimeout(function(){
						$(".app-advertising-left").hide();
					},json.couplettime*1000);
				}
			}
			if(json.rightok=='1'){//右对联
				var righthtml="<div class='app-advertising app-advertising-right'><a href='"+json.rightlinkurl+"' target='_blank'><img src='"+json.rightimgurl+"' width='"+json.rightimgx+"' height='"+json.rightimgy+"' /></a><a href='javascript:;' class='app-advertising-close'>close</a></div>";
				$("body").append(righthtml);
				$(".app-advertising-right").css({'width':function(){ return $(this).find('img').width()}});
				if(json.rightx==''){
					json.rightx = parseInt(app_advertising_pingjun($(".app-advertising-right"),1)/2);
				}
				json.rightx=parseInt(json.rightx);
				json.righty=parseInt((app_advertising_pingjun($(".app-advertising-right"),2)))-parseInt(json.righty);
				$(".app-advertising-right").appadvsFixed({x:json.righty,y:json.rightx});
				if(json.couplettime!=0){
					setTimeout(function(){
						$(".app-advertising-right").hide();
					},json.couplettime*1000);
				}
			}
			if(json.bannerok=='1'){//通栏广告
				var bannerhtml="<div class='app-advertising-banner'><a href='"+json.bannerlinkurl+"' target='_blank'><img src='"+json.bannerimgurl+"' id='app-advertising-banner-img' width='"+json.bannerimgx+"' height='"+json.bannerimgy+"' /></a>";
				if(json.bannertype==2)bannerhtml+="<a href='javascript:;' class='app-advertising-close'>close</a>";
					bannerhtml+="</div>";
				$("body").prepend(bannerhtml);
				app_advertising_banner(json.bannertime,json.bannertype);
			}
			if(json.rbadvsok=='1'){//右下角广告
				var rbadvshtml="<div class='app-advertising-rbadvs'>";
				rbadvshtml+=json.rbadvstype==2?"<div class='app-advertising-rbadvs-html'>"+json.rbadvshtml+"</div>":"<a href='"+json.rbadvslinkurl+"' target='_blank' class='app-advertising-rbadvs-img'><img src='"+json.rbadvsimgurl+"' width='"+json.rbadvsimgx+"' height='"+json.rbadvsimgy+"' /></a>";
				rbadvshtml+="<a href='javascript:;' class='app-advertising-close'>close</a></div>";
				$("body").append(rbadvshtml);
				app_advertising_rbadvs($('.app-advertising-rbadvs'),json.rbadvstime,json.rbadvsimgx,json.rbadvsimgy,json.rbadvsbdcr,json.rbadvsbgcr);
			}
			//关闭广告按钮
			$(".app-advertising-close").live("click",function(){
				$(this).parent("div").remove();
			});
			$(".app-advertising-close").live("hover",function(tm) {
				if (tm.type == 'mouseover' || tm.type == 'mouseenter') $(this).addClass("app-advertising-close-hover");
				if (tm.type == 'mouseout' || tm.type == 'mouseleave') $(this).removeClass("app-advertising-close-hover");
			});
		}
	});
}
$(document).ready(function(){
	app_advertising();
});