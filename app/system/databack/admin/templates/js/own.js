define(function (require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	require('siteurl/app/system/include/static2/vendor/alertify/alertify.js');
	require('own_tem/js/metvar');
	if($('#file_upload').length) require('own_tem/js/jquery.uploadify.v2.1.4.min');
	if(typeof adminurls != 'undefined'){
		require.async('own_tem/js/iframes',function(a){
			metuploadify('#file_upload','sql','');
		});
	}

	$(document).on('click','.unzip_upload',function(){
		var url = $(this).data('url');

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(res) {
			if(res.status){
				alertify.success(res.msg)
					setTimeout(function(){
						location.href=location.href+'&turnovertext=';
					},1000)
			}else{
				alertify.error(res.msg)
			}
		});
	});

	$(document).on('click','.delete_zip',function(){
		var url = $(this).data('url');
		var type = $(this).data('type');
		alertify.okBtn(METLANG.confirm).cancelBtn(METLANG.cancel).confirm(METLANG.webupatejs1, function (ev) {
			ev.preventDefault();
	        if (ev) {
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'json',
					data:{type:type}
				})
				.done(function(res) {
					if(res.status){
						alertify.success(res.msg)
							setTimeout(function(){
								location.href=location.href+'&turnovertext=';
							},1000)
					}else{
						alertify.error(res.msg)
					}
				});
	        } else {
	        	ev.preventDefault();
	            alertify.error(METLANG.webupatejs2);
	        }
	    });
	});
	// 导入数据
	$(document).on('click', '.import-data', function(event) {
		event.preventDefault();
		var $self=$(this);
		$.ajax({
			url: $(this).attr('href'),
			type: 'POST',
			dataType: 'json',
			data:{pre:$(this).data('pre')},
			success:function(result) {
				result.status=parseInt(result.status);
				switch(result.status){
					case 0:
						alert(result.msg);
						location.href=result.url;
						break;
					case 1:
						$('.import-user-modal').modal();
						if(typeof result.msg !='undefined'){
							$('.import-user-modal .modal-body').html(result.msg).show();
						}else{
							$('.import-user-modal .modal-body').hide();
						}
						$('.import-user-modal .modal-footer a').each(function(index, el) {
							$(this).attr({href:$(this).data('url')+$self.data('pre')});
						});
						break;
					case 2:
						metAlert(METLANG.webupatejs3,0,1);
						location.href=result.url;
						break;
				}
			}
		});
	});
	$(document).on('click', '.import-user-modal a', function(event) {
		metAlert(METLANG.webupatejs3,0,1);
	})
});
function linkSmit(my, type, txt) {
	text = txt ? txt:METLANG.js7;
	var tp = type != 1 ? 1: confirm(text) ? 1: '';
	if (tp == 1) {
		return true;
	}
	return false;
	require.async('epl/upload/own',function(a){
		a.func(dom);
	});
}
function metdatabase(my){
	var nxt=my.next('span.tips');
	nxt.empty();
	nxt.append('<img src="'+own_tem+'/images/loadings.gif" style="position:relative; top:3px;" />'+dataexplain4);
	$("input[type='submit']").attr('disabled',true);
	location.href=my.attr('url');
	return false;
}