define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
		require('epl/uploadify/jquery.uploadify.v2.1.4.min');
	var langtxt = common.langtxt();
	var text1 = langtxt.jsx15;
	var text2 = langtxt.js35;
	var text3 = langtxt.jsx17;
	var themefunc = require('tem/js/func');
	
	function uperror(r,t){ //错误提示
		alert(r);
	}
	function upHandle(o,d,lval,cval){ //处理回传值
		d.val(o.path);
		var listval=$("input[name='"+lval+"']"),
		contentval=$("input[name='"+cval+"']");
		if(listval)listval.val(o.thumblist_path);
		if(contentval)contentval.val(o.thumbcontent_path);
		d.parents("a.img").find("img").attr("src","../"+o.path);
		themefunc.ajaxiframe();
	}
	function upload(d) { //上传
		var t_html,n=d.attr("name"),t,url,is_thumblist,is_thumbcontent;
		d.addClass("text");
		t_html ='<div class="metuplaodify">';
		t_html+='<form id="upfileFormmet_'+n+'" enctype="multipart/form-data">';
		t_html+='<div class="file_uploadfrom">';
		t_html+='<input name="'+n+'_upload" type="file">';
		t_html+='</div>';
		t_html+='<a href="javascript:;" title="'+text1+'" class="upbutn">'+text1+'</a>';
		t_html+='</form>';
		t_html+='<span class="uptips"></span>';
		t_html+='</div>';
		d.after(t_html);
		//
		d.next('.metuplaodify').find("div.file_uploadfrom").css("opacity", "0");
	}
	
	exports.bannerup = function(d){
		d.each(function(){
			upload($(this));
		});
	}
		$(document).on('change',".banner_rep input[type='file']",function(){
			var d=$(this).parents(".metuplaodify").prev(),
				w=d.attr('data-upload-imgwidth'),
				h=d.attr('data-upload-imgheight'),
				lval=d.attr('data-upload-listval'),
				cval=d.attr('data-upload-contentval'),
				url = basepath + 'index.php?c=uploadify&m=include&a='+d.attr('data-upload-type')+'&lang='+lang,
				t = d.next('.metuplaodify').find(".uptips");
			$(this).parents("form").ajaxSubmit({ //异步上传并返回结果
				type: "POST",
				url: url,
				uploadProgress:function(e, w, l, r){
					d.parent(".banner_rep").css("opacity",1);
					d.parent(".banner_rep").find(".upbutn").html(r+'%');
					//t.html(r+'%');
				},
				error: function (r) {
					if(typeof r !== 'string')r=text2;
					uperror(r,t);
				},
				success: function (r) {
					var obj = eval('('+r+')');
					if(obj.error==0){
						d.parent(".banner_rep").find(".upbutn").html(text1);
						d.parent(".banner_rep").css("opacity",0);
						//t.html(text3);
						upHandle(obj,d,lval,cval);
					}else{
						//uperror(obj.errorcode,t);
					}
				}
			});
			return false;
			$(this).parents("form").submit();
		});
		$(document).on('mouseenter mouseout','.file_uploadfrom input',function(){
			if(event.type=='mouseover'){
				$(this).parent('.file_uploadfrom').next(".upbutn").addClass('upbutn_hover');
			}else if(event.type=='mouseout'){
				$(this).parent('.file_uploadfrom').next(".upbutn").removeClass('upbutn_hover');
			}
		});
		$(".file_uploadfrom").mousedown(function(){
			$(this).next(".upbutn").addClass("upbutn_active");
		}).mouseup(function(){
			$(this).next(".upbutn").removeClass("upbutn_active");
		}).mouseleave(function(){
			$(this).next(".upbutn").removeClass("upbutn_active");
		});
});
