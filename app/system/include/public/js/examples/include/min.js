define(function(require, exports, module) {
	var jQuery = $ = require('jquery');
	require('lang_json_admin');

	/*操作成功，失败提示信息*/
	if(top.location != location) $("html",parent.document).find('.returnover').remove();
	// 弹出页面返回的提示信息
	var turnover=[];
	turnover['text']=getQueryString('turnovertext');
	turnover['type']=parseInt(getQueryString('turnovertype'));
	turnover['delay']=turnover['type']?undefined:0;
	if(turnover['text']) metAlert(turnover['text'],turnover['delay'],!turnover['type'],turnover['type']);
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
			if(dlp==1) dlie(dl);
			$(".ui-table").width("100%");
			$("body").attr("data-body-wd",$("body").width());
		}
	});
	require('own_tem/js/own');//加载应用脚本
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
	// 可视化弹框中页面隐藏头部
	if (parent.window.location.search.indexOf('&pageset=1') >= 0) $('.metcms_top_right').hide();
	// 会员信息
	function login(data, is_login){
		var pos = $('input[name="appposition"]').val();
		if(is_login){
			switch(pos){
				case 'memberinfo' :
					$("input[name='user_id']").val(data.user_id);
					$("input[name='user_mobile']").val(data.user_mobile);
					$("input[name='user_email']").val(data.user_email);
					$("input[name='user_qq']").val(data.user_qq);
				break;
				case 'lr' :
					toapplist();
				break;
				case 'applist' :
					$('.memberinfo').show();
					$('.user_id').html(data.user_id);
					$('.money').html(common.fmoney(data.money,2));
					if($('input[name="appposition_1"]').val()=='memberinfo'){
						$("input[name='user_id']").val(data.user_id);
						$("input[name='user_mobile']").val(data.user_mobile);
						$("input[name='user_email']").val(data.user_email);
						$("input[name='user_qq']").val(data.user_qq);
					}
				break;
			}
		}else{
			switch(pos){
				case 'memberinfo' :
					alert(js_error('error_code'));
					tologin();
				break;
				case 'lr' :
				break;
				case 'applist' :
					$('.login').show();
				break;
			}

		}
	}
	function toapplist() {
		window.location.href = own_name+'c=appstore&a=appstore';
	}
	// 会员信息链接添加返回地址参数
	if($('.appbox_right .login-info').length) {
		$('.appbox_right .login-info .login .ui-addlist,.appbox_right .login-info .user-loginout').each(function(index, el) {
			var encodeurl=$(this).hasClass('user-loginout')?encodeURIComponent(location.href):location.href,
				href=$(this).attr('href')+encodeURIComponent(encodeurl);
			$(this).attr({href:href});
		});
	}
	//请求会员信息
	window.secret_key = $('#secret_key').val();
	if(secret_key){
		$.ajax({
			url: apppath+'n=platform&c=platform&a=domember_obtain',//新增行的数据源
			type: "GET",
			data: 'user_key=' + secret_key ,
			cache: false,
			dataType: "jsonp",
			success: function(data) {
				if(data.user_id){
					login(data, 1);
				}else{
					login('', 0);
				}
			}
		});
	}else{
		login('', 0);
	}
});
// 弹出提示信息
function metAlert(text,delay,bg_ok,type){
    delay=typeof delay != 'undefined'?delay:2000;
    bg_ok=bg_ok?'bgshow':'';
    if(text!=' '){
        text=text||METLANG.jsok;
        text='<div>'+text+'</div>';
        if(parseInt(type)==0) text+='<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>';
        if(!$('.metalert-text').length){
        	var html='<div class="metalert-text">'+text+'</div>';
        	if(bg_ok) html='<div class="metalert-wrapper alert '+bg_ok+'">'+html+'</div>';
        	$('body').append(html);
        }
        var $met_alert=$('.metalert-text'),
            $obj=bg_ok?$('.metalert-wrapper'):$met_alert;
        $met_alert.html(text);
        $obj.show();
        if($met_alert.height()%2) $met_alert.height($met_alert.height()+1);
    }
    if(delay){
        setTimeout(function(){
            var $obj=bg_ok?$('.metalert-wrapper'):$('.metalert-text');
            $obj.fadeOut();
        },delay);
    }
}
function js_error(error) {
	switch(error){
		case 'error_code':
			return langtxt.please_again;
		break;
		case 'error_passpay':
			return langtxt.password_mistake;
		break;
		case 'error_code':
			return langtxt.please_again;
		break;
		case 'error_evamuch':
			return langtxt.product_commented;
		break;
		case 'error_nobuyeva':
			return langtxt.goods_comment;
		break;
		case 'error_nop':
			return langtxt.permission_download;
		break;
		default :
			return error;
		break;
	}
}
function tologin() {
	window.location.href = adminurl+'anyid=65&n=appstore&c=member&a=dologin&returnurl='+ encodeURIComponent(location.href);
}