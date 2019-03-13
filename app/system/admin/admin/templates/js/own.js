define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');
	//语言
	$(document).on('change',".lang-select-all", function(){
		if($(this).attr('checked')){
			$('.lang-select-one').attr('checked', 'checked');
		}
	});

	$(document).on('change',".lang-select-one", function(){
		if(!$(this).attr('checked')){
			$('.lang-select-all').attr('checked', false);
		}else{
			var all_check = 1;
			$('.lang-select-one').each(function(){
				if(!$(this).attr('checked')){
					all_check = 0;
				}
			});
			if(all_check == 1){
				$('.lang-select-all').attr('checked', 'checked');
			}
		}
		//alert('.column-lang-' + $(this).val());
		if($(this).attr('checked')){
			$('.column-lang-' + $(this).val()).attr('checked', 'checked');
		}else{
			$('.column-lang-' + $(this).val()).attr('checked', false);
		}
	});

	$(document).on('change',".column-lang", function(){
		var clang = $(this).data('lang-column');
		$('.lang-select-one').each(function(){
			if($(this).val() == clang){
				$(this).attr('checked', 'checked');
			}
		});
	});
	
	//操作
	$(document).on('change',".op-select-all", function(){
		if($(this).attr('checked')){
			$('.op-select-one').attr('checked', 'checked');
		}
	});

	$(document).on('change',".op-select-one", function(){
		if(!$(this).attr('checked')){
			$('.op-select-all').attr('checked', false);
		}else{
			var all_check = 1;
			$('.op-select-one').each(function(){
				if(!$(this).attr('checked')){
					all_check = 0;
				}
			});
			if(all_check == 1){
				$('.op-select-all').attr('checked', 'checked');
			}
		}
	});

	//权限
	$(document).on('change',".opwer-select-all", function(){
		if($(this).attr('checked')){
			$('.opwer-select-one').attr('checked', 'checked');
		}else{
            $('.opwer-select-one').attr('checked', false);
        }
	});

	$(document).on('change',".opwer-select-one", function(){
		if(!$(this).attr('checked')){
			$('.opwer-select-all').attr('checked', false);
		}else{
			var all_check = 1;
			$('.opwer-select-one').each(function(){
				if(!$(this).attr('checked')){
					all_check = 0;
				}
			});
			if(all_check == 1){
				$('.opwer-select-all').attr('checked', 'checked');
			}
		}
	});

	//权限全部选中
	$(document).ready(function(){
		if($('#opwer-id').data('checked') == 'all'){
			var str = '';
			$("[name='admin_pop']").each(function(){
				$(this).attr('checked', 'checked');
				str += $(this).val() + '|';
			});
			str = str.replace(/^\|+|\|+$/gm,'');
			$('#opwer-id').data('checked', str);
		}
	});

	//权限提交处理
	$(document).on('click',".submit", function(){
		var str = '';
		$("[name='admin_pop']").each(function(){
			if($(this).attr('checked')){
				str += $(this).val() + '|';
			}
		});
		str = str.replace(/^\|+|\|+$/gm,'');
		$('#admin_pop_list').val(str);
		return true;
	});

	//管理员类型切换
	$(document).on('change',"[name = 'admin_group']", function(){
		admin_change($(this).val());
	});

	function admin_change(v){
	  switch (v) {
	    case '1':
	      $("[name = 'langok']").attr('checked', 'checked');
	      $("[name = 'langok']").attr('disabled', 'disabled');
	      $("[name = 'admin_issueok']").attr('checked', null);
	      $("[name = 'admin_issueok']").attr('disabled', 'disabled');
	      $("[name = 'admin_op']").attr('checked', 'checked');
	      $("[name = 'admin_op']").attr('disabled', 'disabled');
	      $("[name = 'admin_pop']").attr('disabled', 'disabled');
	      $("[name = 'admin_pop']").each(function(){
	        if($(this).val().slice(0,1) == 'c' || $(this).val() == 's1007' || $(this).val() == 's1103' || $(this).val() == 's1201' || $(this).val() == 's1002' || $(this).val() == 's1003' || $(this).val() == 's1301' || $(this).val() == 's9999' || $(this).val() == 's1802'){
	          $(this).attr('checked', 'checked');
	        }else{
	          $(this).attr('checked', null);
	        }
	      });
	    break;
	    case '2':
	      $("[name = 'langok']").attr('checked', 'checked');
	      $("[name = 'langok']").attr('disabled', 'disabled');
	      $("[name = 'admin_issueok']").attr('checked', null);
	      $("[name = 'admin_issueok']").attr('disabled', 'disabled');
	      $("[name = 'admin_op']").attr('checked', 'checked');
	      $("[name = 'admin_op']").attr('disabled', 'disabled');
	      $("[name = 'admin_pop']").attr('disabled', 'disabled');
	      $("[name = 'admin_pop']").each(function(){
	        if($(this).val().slice(0,1) == 'c' || $(this).val() == 's1007' || $(this).val() == 's1103' || $(this).val() == 's1201' || $(this).val() == 's1002' || $(this).val() == 's1003'|| $(this).val() == 's1401'|| $(this).val() == 's1106'|| $(this).val() == 's1404'|| $(this).val() == 's1406' || $(this).val() == 's1301' || $(this).val() == 's9999' || $(this).val() == 's1802'){
	          $(this).attr('checked', 'checked');
	        }else{
	          $(this).attr('checked', null);
	        }
	      });
	    break;
	    case '3':
	      $("[name = 'langok']").attr('checked', 'checked');
	      $("[name = 'langok']").attr('disabled', 'disabled');
	      $("[name = 'admin_issueok']").attr('checked', null);
	      $("[name = 'admin_issueok']").attr('disabled', 'disabled');
	      $("[name = 'admin_op']").attr('checked', 'checked');
	      $("[name = 'admin_op']").attr('disabled', 'disabled');
	      $("[name = 'admin_pop']").attr('checked', 'checked');
	      $("[name = 'admin_pop']").attr('disabled', 'disabled');
	    break;
	    case '0':
	      $("[name = 'langok']").attr('checked', 'checked');
	      $("[name = 'langok']").attr('disabled', null);
	      $("[name = 'admin_issueok']").attr('checked', null);
	      $("[name = 'admin_issueok']").attr('disabled', null);
	      $("[name = 'admin_op']").attr('checked', 'checked');
	      $("[name = 'admin_op']").attr('disabled', null);
	      $("[name = 'admin_pop']").attr('checked', 'checked');
	      $("[name = 'admin_pop']").attr('disabled', null);
	      $("[name = 'admin_pop']").each(function(){
	        if($(this).val() == 's1801'){
	          $(this).attr('checked', null);
	        }
	      });
	    break;
	  }
	}

	$(document).ready(function() {
		if($("[name = 'admin_group']:checked").val() != 0){
			admin_change($("[name = 'admin_group']:checked").val());
		}
	});
});
