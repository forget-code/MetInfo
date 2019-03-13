define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var langtxt = ownlangtxt;

	$(document).ready(function() {
		var ver = $('.v52fmbx').attr("data-metcms_v"),patch = $('.v52fmbx').attr("data-patch");
		var url = apppath+'n=platform&c=system&a=dosysnew'+'&ver='+ver+'&patch='+patch;
		if($(".newpatch").attr('data-auto') == 1){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'jsonp',
				cache: false,
				success: function(data) {
					if(data.metok==1){
						$(".newpatch").html(langtxt.be_updated+data.metcms_v+'&nbsp;&nbsp;<span style="color:#2064e2;" class="download-noclick"></span><span style="color:#2064e2;cursor: pointer;" id="target" class="metcms_upload_download" data-a-download="cms|new|doc|1|">'+langtxt.checkupdate+'</span>');
						$(".newpatch").css('color','#ff9600');
						var str = window.parent.document.URL; 
						var s = str.indexOf("renewable") 
						if(s > '-1'){
							//alert(window.parent.document.URL); 
							document.getElementById("target").click(); 
						}
					}else{
						$(".newpatch").html(langtxt.latest_version);
					}
				}
			});
		}else{
			$(".newpatch").html('检测到手动安装包'+'&nbsp;&nbsp;<span style="color:#2064e2;" class="download-noclick"></span><span style="color:#2064e2;cursor: pointer;display:none;" id="target" class="metcms_upload_download" data-a-download="cms|new|install|1|">'+'点击升级'+'</span>'+'<span style="color:#2064e2;cursor: pointer;" class="manual-install">点击升级</span>');
			$(".newpatch").css('color','#ff9600');
		}
		
		$(document).on('click', ".manual-install",function(){
			$('.metcms_upload_download').show();
			$('.manual-install').hide();
			$('.metcms_upload_download').html('系统升级中，请稍后...');
			$(".metcms_upload_download").click(); 
		});
		
		var bdUrl = $(".bdsharebuttonbox").attr("data-bdUrl"),
			bdText = $(".bdsharebuttonbox").attr("data-bdText"),
			bdPic = $(".bdsharebuttonbox").attr("data-bdPic"),
			bdCustomStyle = $(".bdsharebuttonbox").attr("data-bdCustomStyle");
		window._bd_share_config={
			"common":{
				"bdUrl":bdUrl,
				"bdSnsKey":{},
				"bdText":bdText,
				"bdMini":"2",
				"bdMiniList":false,
				"bdPic":bdPic,
				"bdStyle":"2",
				"bdSize":"16"
			},
			"share":[{
				bdCustomStyle: bdCustomStyle
			}]
		};
		with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?cdnversion='+~(-new Date()/36e5)];
		
	})
});