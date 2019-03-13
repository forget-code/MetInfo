define(function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');
	var langtxt = ownlangtxt;
	require('siteurl/app/system/include/static2/vendor/alertify/alertify.js');
	$(document).ready(function() {
		var url = own_form + 'a=docheck_update';
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			cache: false,
			success: function(data) {
				switch (data.status) {
		        	case 1:
		        		$(".newpatch").html(METLANG.be_updated+data.cms_version+'&nbsp;&nbsp;<span style="color:#2064e2;cursor: pointer;" class="download_metcms" data-ver="'+data.cms_version+'">'+METLANG.langexplain5+'</span>');
						$(".newpatch").css('color','#ff9600');
		        		break;
		        	case -1:
		        		$(".newpatch").html(METLANG.updatefileexist+'&nbsp;&nbsp;<span class="install_metcms btn btn-info btn-xs" data-ver="'+data.cms_version+'">'+METLANG.appinstall+'</span>');
		        		break;
		        	case -2:
		        		$(".newpatch").html(METLANG.updatephpver+data.cms_version);
		        		break;
		        	default:
		        		$(".newpatch").html(METLANG.latest_version);
		        		break;
		        }
			}
		});

		// 点击重新下载
		$(document).on('click','.anew_metcms',function(){
			var cms_version = $(this).data('ver')
			$.ajax({
				url: own_form+'a=dodelete_zip',
				type: 'GET',
				dataType: 'json',
				data: {cms_version: cms_version},
			})
			.done(function(){

			});

			down_zip(cms_version,0);
		});

		//点击下载
		$(document).on('click','.download_metcms',function(){
			$.ajax({
				url: own_form+'a=dodown_warning',
				type: 'POST',
				dataType:'json'
			})
			.done(function(result) {
				if(parseInt(result.status)){
					$('.update-modal .modal-body').html(result.msg);
				}else{
					$('.update-modal .modal-body').html(result.msg);
					$('.btn_metcms_update').remove();
					$('.btn-default').remove();
				}
			});
			$('.update-modal').modal();

		});

		// 下载升级包
		$(document).on('click', '.btn_metcms_update', function(event) {
			$('.update-modal').modal('hide');
			down_zip($('.download_metcms').data('ver'),0);
		});

		//点击安装弹出弹框
		$(document).on('click','.install_metcms',function(){
			$.ajax({
				url: own_form+'a=doupdate_warning',
				type: 'POST',
				dataType:'json'
			})
			.done(function(result) {
				if(parseInt(result.status)){
					$('.install-modal .modal-body').html(result.msg);
				}
			});
			$('.install-modal').modal();
		});
		// 安装系统
		$(document).on('click', '.btn_metcms_install', function(event) {
			install_metcms($('.install_metcms').data('ver'));
		});
		/**
		 * 下载系统升级压缩包
		 */
		function down_zip(cms_version,current){
			$.ajax({
				url: own_form+'a=dodown_update',
				type: 'POST',
				dataType: 'json',
				data: {cms_version: cms_version,current:current},
			})
			.done(function(res) {
				if(res.status){
					$('.download_metcms').text(METLANG.updatedownloadnow+((current+1)/res.total*100).toFixed(0)+'%')
					if(res.current == res.total-1){
						$('.download_metcms').text(METLANG.updatedownloadover).addClass('install_metcms').removeClass('download_metcms');
					}else{
						down_zip(cms_version,current+1);
					}
				}
			})
		}

		/**
		 * 执行安装
		 */
		function install_metcms(cms_version)
		{
			$('.btn_metcms_install').text(METLANG.updateinstallnow);
			$.ajax({
				url: own_form+'a=doinstall_metcms',
				type: 'POST',
				dataType: 'json',
				data: {cms_version: cms_version},
			})
			.done(function(res){
				if(res.status){
					alertify.success(res.msg);
					window.location.reload();
				}else{
					alertify.error(res.msg);
				}
			});

		}
	})
});