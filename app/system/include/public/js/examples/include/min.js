define(function(require, exports, module) {

	var jQuery = $ = require('jquery');

	/*操作成功，失败提示信息*/
	if(top.location != location)$("html",parent.document).find('.returnover').remove();
	if($('.returnover').length>0){
		//alert($('.returnover').html());
		(function($){
		jQuery.fn.PositionFixed = function(options) {
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
			};
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
		};
		})(jQuery)
		$(document).ready(function() {
			$('body', parent.document).append('<div class="returnover">'+$('.returnover').html()+'</div>');
			var tur_ml = $('body', parent.document).find('.returnover').outerWidth();
			var tur_mt = $('body', parent.document).find('.returnover').outerHeight();
			tur_ml = parseInt(($('html',parent.document)[0].clientWidth-tur_ml)/2);
			tur_mt = parseInt(($('html',parent.document)[0].clientHeight-tur_mt)/2);
			$("html",parent.document).find('.returnover').css({
				top:tur_mt+'px',
				left:tur_ml+'px'
			});
			$('body', parent.document).find('.returnover').show();
			$("html",parent.document).find('.returnover').PositionFixed({x:tur_ml,y:tur_mt}); 
			setTimeout(function(){ $("html",parent.document).find('.returnover').hide(); }, 5000 );
		});
	}
	
	/*cookie*/
	require('epl/include/cookie');
	//adminlang = $.cookie('langset');当前后台语言
	
	//bootstrap
	require('pub/bootstrap/js/bootstrap.min');
	
	//初始化
	
	var common = require('common');   		//公用类
	
	/*---------页面组件加载---------*/
	
	/*表单验证*/
	if($('form.ui-from').length>0)require.async('epl/form/form');
	
	common.AssemblyLoad($("body"));
	
	/*---------动态事件绑定-----------------*/
	/*输入状态*/
	$(document).on('focus',"input[type='text'],input[type='input'],input[type='password'],textarea",function(){
		$(this).addClass('met-focus');
	});
	$(document).on('focusout',"input[type='text'],input[type='input'],input[type='password'],textarea",function(){
		$(this).removeClass('met-focus');
	});
	
	/*显示隐藏选项*/
	function showhidedom(m){
		var c = m.attr("data-showhide"),d=$("."+c);
		d.stop(true,true);
		if(d.is(":hidden")){
			d.removeClass('none').hide().slideDown();
			if(m.attr("type")=='radio'){
				m.parents('.fbox').find("input").not(m).change(function(){
					d.slideUp();
				});
			}
		}
	}
	$(document).ready(function(){ 
		var p = $(".ui-from input[type='radio'][data-showhide]:checked,.ui-from input[type='checkbox'][data-showhide]:checked");
		if(p.length>0){
			p.each(function(){
				showhidedom($(this));
			});
		}
	});
	$(document).on('change',".ui-from input[type='radio'][data-showhide]",function(){
		showhidedom($(this));
	});
	$(document).on('change',".ui-from input[type='checkbox'][data-showhide]",function(){
		var s = $(this).attr("checked")== 'checked'?true:false;
		if(s){
			showhidedom($(this));
		}else{
			var c = $(this).attr("data-showhide"),d=$("."+c);
			d.stop(true,true);
			d.slideUp();
		}
	});
	
	var dlp = '';
	/*浏览器兼容*/
	if($.browser.msie || ($.browser.mozilla && $.browser.version == '11.0')){ 
		var v = Number($.browser.version);
		if(v<10){
			function dlie(dl){
				var dw;
				dl.each(function(){
					var dt = $(this).find("dt"),dd = $(this).find("dd");
					if(dt.length>0){
						dt.css({"float":"left","overflow":"hidden"});
						dd.css({"float":"left","overflow":"hidden"});
						var wd = $(this).width() - (dt.width()+30) - 15;
						dd.width(wd);
						dw = wd;
					}
				});
				dl.each(function(){
					var dt = $(this).find("dt"),dd = $(this).find("dd");
					if(dt.length>0){
						dd.width(dw);
					}
				});
			}
			var dl = $(".v52fmbx dl");
			dlie(dl);
			dlp = 1;
		}
		if(v<12){
			/*提示文字兼容*/
			function searchzdx(dom,label){
				if(dom.val()==''){
					label.show();
				}else{
					label.hide();
				}
				dom.keyup(function(){
					if($(this).val()==''){
						label.show();
					}else{
						label.hide();
					}
				});
				label.click(function(){
					$(this).next().focus();
				});
			}
			$(document).ready(function(){ 
				var pd = $("input[type!='hidden'][placeholder],textarea[placeholder]");
				pd.each(function(){
					var t = $(this).attr("placeholder");
					$(this).removeAttr("placeholder");
					$(this).wrap("<div class='placeholder-ie'></div>");
					$(this).before("<label>"+t+"</label>");
					searchzdx($(this),$(this).prev("label"));
				});
				setInterval(function(){
					pd.each(function(){
						searchzdx($(this),$(this).prev("label"));
					});
				}, "200"); 
			});
		}
	}
	
	/*宽度变化后调整*/
	$("body").attr("data-body-wd",$("body").width());
	$(window).resize(function() {
		if($("body").attr("data-body-wd")!=$("body").width()){
			if(dlp==1){
				dlie(dl);
			}
			$(".ui-table").width("100%");
			$("body").attr("data-body-wd",$("body").width());
		}
	});
	
	require('tem/js/own');//加载应用脚本
	
	/*返回顶部*/
	require('epl/include/jquery.goup');
	$(document).ready(function () {
		$.goup({
			location:'right',
			bottomOffset: 10,
			locationOffset: 10,
			title: '',
			containerColor:'#000',
			titleAsText: true
		});
	});
	
	/*技术支持*/
function support(){
	var url = apppath+'n=platform&c=support&a=doinfo';
	$.ajax({
		url: url,
		type: "GET",
		cache: false,
		data: $("input[name='supporturldata']").val(),
		dataType: "jsonp",
		success: function(data) {
			$(".support_loading").hide();
			if(data.support=='notlogin'){
				$(".support_no").show();
			}
			if(data.support=='expire'){
				$(".support_desc").show();
				$("#support_expiretime").html('<span class="text-danger">'+data.expiretime+'</span>');
			}else if(data.support=='notopen'){
				$(".support_no").show();
			}else if(data.support=='youok'){
				$(".support_youok,.support_desc").show();
				$("#support_expiretime").html(data.expiretime);
				require.async(data.url,function(){
					var obj = jQuery.parseJSON(data.metdata);
					var inter = setInterval(function(){
						if(window.mechatMetadata){
							clearInterval(inter);
							window.mechatMetadata(obj);
						}
					},500);
					$(".supportmechatlink").click(function(){
						mechatClick();
						return false;
					});
				});
			}
			$(".supportbox").data('supportdropdown','1');
			$.cookie('supportdropdown','1');
		}
	});
}
	$(".supportbox").on('show.bs.dropdown', function () {
		if(!$(this).data('supportdropdown'))support();
	})
	if($.cookie('MECHAT-CHATSTATUS')=='true'){
		support();
	}
	
	/*应用安装、升级*/	
	if($('.metcms_upload_download').length>0)require.async('epl/include/download');
	
	
});
