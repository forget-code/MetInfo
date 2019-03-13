define(function(require, exports, module) {

	var $ = require('jquery'); //加载Jquery 1.11.1
	var common = require('common'); //加载公共函数文件（语言文字获取等）
	require('siteurl/app/system/include/static2/vendor/alertify/alertify.js');
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

			if(res.status == 1){
				if(!res.data){
					$('.'+skin_name+'_progress-bar').css('width','100%');
					$('.'+skin_name+'_name').text('100%')
					alertify.success(METLANG.jsok)
					setTimeout(function(){
						location.href=location.href+'&turnovertext=';
					},1000)
				}else{
					for (var i = 0; i < res.data.length; i++) {
						var ui = res.data[i];
						download_ui(res.skin_name,ui.parent_name,ui.ui_name,ui.ui_version);
					}
				}
			}else{
				if(res.status == '-1'){
					alertify.error(res.msg)
					setTimeout(function(){
						location.href=location.href+res.url;
					},4000)
				}else{
					$('.'+skin_name+'_progress-bar').css('width','100%');
					$('.'+skin_name+'_name').text('100%')
					alertify.success(METLANG.jsok)
					setTimeout(function(){
						location.href=location.href+'&turnovertext=';
					},2000)
				}

			}
		})

	});
	$(document).on( 'init.dt', function (e, settings, json) { //表格加载完成时执行

	for (var i = 0; i < json.data.length; i++) {
		var skin_name = json.data[i][1];
		if(skin_name){
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
					$('.'+skin_name+'_name').text(METLANG.opsuccess)
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
					alertify.success(METLANG.jsok)
					setTimeout(function(){
						location.href=location.href+'&turnovertext=';
					},500)
				}
			}else{
				$('.'+skin_name+'_progress-bar').css('width','100%');
				$('.'+skin_name+'_progress-bar').removeClass('progress-bar-success').addClass('progress-bar-danger');

				$('.'+skin_name+'_name').text(res.msg)

			}
		})
	}

	$(document).on('click','.tem_install',function(){
		var skin_name = $(this).data('name');
		$('.'+skin_name+'_progress').removeClass('hide').addClass('active');
		// $(this).remove();
		var that = $(this);
		$('.'+skin_name+'_name').text(METLANG.met_template_downloadtemjs);
		setTimeout(function () {
			$('.'+skin_name+'_progress-bar').css('width','100%');
		}, 1000);

		$.ajax({
			type: 'POST',
			url: install_tem_url,
			dataType: 'json',
			data:{skin_name:skin_name}
		})
		.done(function(res) {

			if(res.status){
				$('.'+skin_name+'_name').text(METLANG.met_template_downloadtemokjs);
				setTimeout(function () {
					$('.'+skin_name+'_name').text(METLANG.met_template_downloaduijs);
				}, 1000);
				that.removeClass('tem_install').addClass('tem_import');
				that.click();
			}else{
				$('.'+skin_name+'_progress').removeClass('hide');
				alertify.error(res.msg)
			}
		})
	});


	$(document).on('click','.set_default',function(){
		var url = $(this).data('url');
		$.ajax({
			type: 'GET',
			url: url,
			dataType: 'json'
		})
		.done(function(res){
			if(res.status){
				alertify.success(res.msg)
				setTimeout(function(){
					location.href=location.href+'&turnovertext=';
				},500)
			}else{
				alertify.error(res.msg)
			}
		})
	});


	$(document).on('click','.install_data',function(){

		//http://www.met.com/admin/index.php?lang=cn&anyid=13&n=databack&c=index&a=dopackdata
		var url = $(this).data('url');
		var skin_name = $(this).attr('id');
		var that = $(this);
		$('#myModal').modal('show')
		$("input[name=skin_name]").val(skin_name);
		$("input[name=url]").val(url);

	});

	$('#myModal').on('hidden.bs.modal', function () {
		$('.show_data').html('')
		$("input[name=skin_name]").val('');
		$("input[name=url]").val('');
	})


	$(document).on('click','#backup_recovery',function(){
		var skin_name = $("input[name=skin_name]").val()
		var url = $("input[name=url]").val()
		localStorage.backup = 1;
		$('.'+skin_name+'_progress').removeClass('hide');
		$('#'+skin_name).siblings('a').remove();
		$('#'+skin_name).remove();
		$('#myModal').modal('hide')
		$.ajax({
			type: 'GET',
			url: clear_zip_url,
			dataType: 'json'
		})
		.done(function(res){
			if(res.status == 1){
				down_data(skin_name,0);
			}else if(res.status == -1){
				alertify.error(res.msg)
				setTimeout(function(){
					location.href=location.href+res.url;
				},4000)
			}else{
				alertify.error(res.msg)
			}
		});
	});

	$(document).on('click','#recovery',function(){
		var skin_name = $("input[name=skin_name]").val()
		var url = $("input[name=url]").val()
		localStorage.backup = 0;
		$('.'+skin_name+'_progress').removeClass('hide');
		$('#'+skin_name).siblings('a').remove();
		$('#'+skin_name).remove();
		$('#myModal').modal('hide')
		$.ajax({
			type: 'GET',
			url: clear_zip_url,
			dataType: 'json'
		})
		.done(function(res){
			if(res.status == 1){
				down_data(skin_name,0);
			}else if(res.status == -1){
				alertify.error(res.msg)
				setTimeout(function(){
					location.href=location.href+res.url;
				},4000)
			}else{
				alertify.error(res.msg)
			}
		});
	});

	function down_data(skin_name,current=0)
	{
		$.ajax({
			type: 'POST',
			url: down_data_url,
			dataType: 'json',
			data:{skin_name:skin_name,current:current}
		})
		.done(function(res){

			if(res.status){
				$('.'+skin_name+'_progress-bar').css('width',(current+1)/res.total*100+'%');
				$('.'+skin_name+'_name').text(((current+1)/res.total*100).toFixed(0)+'%')
				if(res.total > current+1){

					down_data(skin_name,current+1)
				}else{
					unzip_data(skin_name)
				}
			}

		})
	}

	function unzip_data(skin_name)
	{
		$.ajax({
			type: 'POST',
			url: unzip_data_url,
			dataType: 'json',
			data:{skin_name:skin_name}
		})
		.done(function(res){
			if(localStorage.backup == 1){
				backup_data(backup_sql_url);
				backup_data(backup_upload_url)
			}

			import_sql(skin_name)

		})
	}

	function backup_data(url)
	{
		$.ajax({
			type: 'GET',
			url: url,
			async: false,
			dataType: 'json'
		}).done(function(res){
			console.log(res)
		})
	}

	function import_sql(skin_name)
	{
		$('.'+skin_name+'_name').text(METLANG.updateinstallnow)
		$.ajax({
			type: 'POST',
			url: import_sql_url,
			dataType: 'json',
			data:{skin_name,skin_name}
		}).done(function(res){
			if(res.status){
				alertify.success(res.msg)
				setTimeout(function(){
					location.href=location.href+'&turnovertext=';
				},2000)
			}else{
				alertify.error(res.msg)
			}
		})
	}
});

