define(function(require, exports, module) {

	var $ = require('jquery'); //加载Jquery 1.11.1
	var common = require('common'); //加载公共函数文件（语言文字获取等）
	require('own_tem/js/sweetalert.min');
	if($('[data-remodal-id]').length){
		/*弹出框*/
		require('own_tem/remodal/jquery.remodal.css');
		require('own_tem/remodal/jquery.remodal.min');
	}

	// 点击导入按钮
	$(document).on('click','.tem_import',function(){
		var skin_name = $(this).data('name');
		$('.'+skin_name+'_progress').removeClass('hide');
		$(this).remove();
		$.ajax({
			url: import_url,
			type: 'POST',
			dataType: 'json',
			data: {skin_name:skin_name},
		})
		.done(function(res) {

			if(res.status){
				if(!res.data){
					$('.'+skin_name+'_progress-bar').css('width','100%');
					$('.'+skin_name+'_name').text('100%')
				}else{
					for (var i = 0; i < res.data.length; i++) {
						var ui = res.data[i];
						download_ui(res.skin_name,ui.parent_name,ui.ui_name,ui.ui_version);
					}
				}

			}else{
				$('.'+skin_name+'_progress-bar').css('width','100%');
				$('.'+skin_name+'_name').text('100%')
			}

		})

	});

	// 弹出提示信息
	function myalert(text,fadetime){
		text=text||'操作成功！';
		fadetime=fadetime||2000;
		if(!$('.returnover').length) $('body').append('<div class="returnover">'+text+'</div>');
		$('.returnover').html(text).show();
		if(fadetime!=false){
			setTimeout(function(){
				$('.returnover').fadeOut();
			},fadetime)
		}
	}

	$(document).on( 'init.dt', function (e, settings, json) { //表格加载完成时执行

	for (var i = 0; i < json.data.length; i++) {
		var skin_name = json.data[i][1];

		$.ajax({
			url: update_url,
			type: 'POST',
			dataType: 'json',
			data: {skin_name: skin_name},
		})
		.done(function(res) {
			if(res.status){
				$('#'+res.skin_name).removeClass('hide');
			}
		})
	}

	});

	$(document).on('click','.update_ui_list',function(){
		var url = $(this).data('url');
		var skin_name = $(this).attr('id');

		$('.'+skin_name+'_progress').removeClass('hide');
		$(this).remove();

		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
		})
		.done(function(res) {
			if(res.status){
				if(!res.data){
					$('.'+skin_name+'_progress-bar').css('width','100%');
					$('.'+skin_name+'_name').text('100%')
				}else{
					for (var i = 0; i < res.data.length; i++) {
					var ui = res.data[i];

					download_ui(res.skin_name,ui.parent_name,ui.ui_name,ui.ui_version);
					}
				}


			}else{
					$('.'+skin_name+'_progress-bar').css('width','100%');
					$('.'+skin_name+'_name').text('操作成功')
			}
		})
	});


	function download_ui(skin_name,parent_name,ui_name,ui_version){

		$.ajax({
			type: 'POST',
			url: download_ui_url,
			dataType: 'json',
			data:{skin_name:skin_name,parent_name,parent_name,ui_name:ui_name,ui_version:ui_version}
		})
		.done(function(res) {
			console.log(res)
			if(res.status){
				$('.'+skin_name+'_progress-bar').css('width',res.progress+'%');
				$('.'+skin_name+'_name').text(res.progress+'%')

				if(res.progress == 100){

					$('.'+skin_name+'_name').text('操作成功')
					window.location.reload()
				}
			}else{
				$('.'+skin_name+'_progress-bar').css('width','100%');
				$('.'+skin_name+'_progress-bar').removeClass('progress-bar-success').addClass('progress-bar-danger');

				$('.'+skin_name+'_name').text(res.msg)
			}
		})
	}

});

