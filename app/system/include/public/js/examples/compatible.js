define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	require('epl/include/cookie');
	require('pub/bootstrap/js/bootstrap.min');
	$(document).ready(function() {
		/*上传组件*/
		window.adminurl = window.adminurl+'index.php?lang='+window.lang+'&';
		var upload = $('.ftype_upload .fbox input');
		if(upload.length){
			require.async('epl/upload/own',function(a){
				a.func($('body'));
			});
		}
		// 颜色选择组件（新模板框架banner文字颜色属性组件）
		if($('.ftype_color').length>0){
			require.async(['epl/color/jquery.minicolors.css','epl/color/jquery.minicolors.min'],function(){
				$('.ftype_color .fbox input').minicolors();
			});
		}

		var edturl;
		require.async('edturl/compatible');
		/*编辑器
		var editor = $('textarea.ckeditor');
		if(editor.length){
			require.async('edturl/ueditor.config');
			require.async('edturl/ueditor.all.min',function(){
				editor.each(function(){
					var name = $(this).attr('name')

					$(this).attr("id",'container_'+name);
					var ue = UE.getEditor('container_'+name,{
						iframeCssUrl: siteurl + 'app/system/include/public/bootstrap/css/bootstrap.min.css',
						scaleEnabled :true,
						initialFrameWidth : '100%',
						initialFrameHeight : 400
					});
				});
			});
		}*/
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
	});
});
