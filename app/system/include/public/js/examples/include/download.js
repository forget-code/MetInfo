define(function(require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	var langtxt = common.langtxt();

	require('tem/remodal/jquery.remodal.css');
	require('tem/remodal/jquery.remodal.min');
	
	var box = $('[data-remodal-id=modal]');

	$(document).on('click',".metcms_upload_download",function(){
		var html = $(this);
		var data_download = html.attr('data-a-download');
		if(data_download){			
			if(data_download == 'end'){
				return true;
			}else{
				url = adminurl+'n=system&c=download&a=dodownload';
				$.ajax({
					url: url,//新增行的数据源
					type: "POST",
					data:{'data':data_download},
					cache: false,
					dataType: "json",
					success: function(data) {
						html.attr('data-a-download',data.data);

						if(data.suc == 1){
							$(".download-noclick").html(data.html);
							html.html('');
						}else{
							$(".download-noclick").html('');
							html.html(data.html);
						}
						
						if(data.jsdo == 'confirm' || data.suc == 0){
							$(".temset_box").html(data.confirm);
							var inst = $.remodal.lookup[box.data('remodal')];
							inst.open();
						}	
						if(data.jsdo == 'refresh'){
							setTimeout(function (){parent.window.location.reload();},3000);
						}
						if (data.click == 1) {
							html.click();
						}
					}
				});
			}
		}
		return false;
	});
	var confirmclick = 0;
	$(document).on('click', "input[name='remodal-confirm']", function () {
		if(document.getElementById("olupdate_type").value != '1'){
			alert(langtxt.checkupdatetips);
			return false;
		}
		var str = $(".metcms_upload_download").attr('data-a-download');
		$(".metcms_upload_download").attr('data-a-download', str.replace('|check_doc|','|check|'));
		confirmclick = 1;
		$.remodal.lookup[box.data('remodal')].close();
		confirmclick = 0;
		$(".metcms_upload_download").html('');
		$(".download-noclick").html(langtxt.detection+'...');
		setTimeout(function (){$('.metcms_upload_download').click();},1000);
	});

	$(document).on('click', "input[name='remodal-cancel']", function () {
		$.remodal.lookup[box.data('remodal')].close();
	});
	
	$(document).on('close', '.remodal', function (e) {
		if(confirmclick == 0){
			$(".download-noclick").html('');
			$(".metcms_upload_download").html('<a href="#">'+langtxt.try_again+'</a>');
			var str = $(".metcms_upload_download").attr('data-a-download');
			var data = str.split('|');
			$(".metcms_upload_download").attr('data-a-download', str.replace('|check_doc|','|doc|'));
		}
	});
});