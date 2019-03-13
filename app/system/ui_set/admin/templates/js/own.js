define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var set = require('own_tem/js/set');// 模板设置
	var langtxt = typeof ownlangtxt !== 'undefined'?ownlangtxt:'';
	// 可视化模式
	if($('.set-block').length){
		if($('.set-img').length){
			// 图片上传框
			setTimeout(function(){
				$('#UploadModal').addClass('set-img-modal');
			},500)
		}else if($('.set-config-page').length){
			// 设置框重载设置参数后回调
			window.parent.configPageModalFun('config-page',function(){
				set.rendering();
			})
		}else if($('.set-config-public').length){
			window.parent.configModalFun('config-public',function(){
				set.rendering();
			})
		}else{
			// 设置框重载设置参数后回调
			window.parent.pagesetModalFun(function(){
				set.rendering();
			})
		}
	}
	if($('.set-pageset-nav .ui-item').length){
		$('.set-pageset-nav .ui-item').click(function(event) {
			$(this).toggleClass('checked');
		});
	}
	// 表单提交
	$("form").submit(function(event) {
		// 可视化模式处理
		if($(this).hasClass('set-block-form')){
			$(this).ajaxSubmit({
				dataType : "json",
				success:function(message) {
		        	if(parseInt(message.status)){
		        		window.parent.metAlert();
		    			$('.page-iframe',parent.document).prop('contentWindow').location.reload();
		    			var modal_name='blockset';
		    			if($(".set-block").hasClass('set-img')) modal_name='img';
		    			if($(".set-block").hasClass('set-config-page') || $(".set-block").hasClass('set-config-public')) modal_name='config';
		    			modal_name='.'+modal_name+'-modal';
		    			setTimeout(function(){
							$(modal_name+' .close',parent.document).click();
						},500)
		        	}
		        }
			})
			return false;
		}
		if($(this).hasClass('set-pageset-nav-form')){
			var applist={applist:[]};
			applist=applist.applist;
			$('.set-pageset-nav .ui-item',this).each(function(index, el) {
				var appinfo={};
				appinfo['id']=$(this).data('id');
				appinfo['display']=$(this).hasClass('checked')?2:1;
				applist.push(appinfo);
			});
			$.ajax({
				url: $(this).prop('action'),
				type: 'POST',
				dataType : "json",
				data: {applist: applist},
				success:function(message) {
		        	if(parseInt(message.status)){
		        		window.parent.metAlert();
		    			setTimeout(function(){
							window.parent.location.reload();
						},500)
		        	}
		        }
			})
			return false;
		}
	});
});