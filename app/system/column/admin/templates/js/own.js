define(function (require, exports, module) {
	var $ = require('jquery');
	var common = require('common');
	// require('own/templates/js/bootstrap-hover-dropdown.min');
	// require.async('tem/js/iframes',function(a){
	// 	metuploadify('#file_upload','sql','');
	// });

	// function linkSmit(my, type, txt) {
	// 	text = txt ? txt: user_msg['js7'];
	// 	var tp = type != 1 ? 1: confirm(text) ? 1: '';
	// 	if (tp == 1) {
	// 		return true;
	// 	}
	// 	return false;
	// 	require.async('epl/upload/own',function(a){
	// 		a.func(dom);
	// 	});
	// }
	$(document).on('mouseenter','[data-hover="dropdown"]',function(){
		$(this).parent('.dropdown').addClass('open');
		$(this).attr("aria-expanded", "true");
	});
	$(document).on('mouseenter','.dropdown-menu',function(){
		$(this).parent('.dropdown').addClass('open');
	});
		$(document).on('mouseleave','.dropdown-menu',function(){
		$(this).parent('.dropdown').removeClass('open');
	});
	$(document).on('mouseleave','[data-hover="dropdown"]',function(){
		$(this).parent('.dropdown').removeClass('open');
		$(this).attr("aria-expanded", "false");
	});
	$(document).on('mouseenter','.dropdown-submenu',function(){
		$(this).children(".dropdown-menu").show();
		$(this).attr("aria-expanded", "true");
		$(this).siblings().children(".dropdown-menu").hide();
	});
	$(document).on('mouseleave','.dropdown-submenu',function(){
		$(this).children(".dropdown-menu").hide();
		$(this).attr("aria-expanded", "false");
		$(this).siblings().children(".dropdown-menu").hide();
	});
	$(document).on('click',"*[data-add-cloumn]",function(){
		var url = $(this).attr("data-add-cloumn"),d=$(this).parents('tr');
		//alert(d.html());
		//AJAX获取HTML并追加到页面
		d.after('<tr><td colspan="'+d.find('td').length+'">Loading...</td></tr>');

		$.ajax({
			url: url,//新增行的数据源
			type: "POST",
			data: 'ai=' + window.ai,
			success: function(data) {
				d.next("tr").remove();
				d.after(data);
				d.next("tr").find("input[type='text']").eq(0).focus();
				common.defaultoption(d.next("tr"));
				common.ifreme_methei();//高度重置
			}
		});

		window.ai++;
		return false;
	});
	// var ai = 0;
	// $(document).on('click',"*[data-table-addlist]",function(){



	// });
	// 弹出图标选择框
	$('.icon-add').click(function(event) {
		if(!$('.icon-iframe').attr('src')) $('.icon-iframe').attr({src:$('.icon-iframe').data('src')});
	});
	$('.icon-iframe').load(function() {
		var $icon_iframe=$(this).contents(),
			icon_iframe_window=$(this).prop('contentWindow'),
			icon_iframe_document=icon_iframe_window.document;
		// 图标设置框-选择图标库
		$icon_iframe.find('.iconchoose .iconchoose-href').click(function(event) {
			$icon_iframe.find('.icon-list').hide();
			$icon_iframe.find('.icon-detail').attr({hidden:''});
			$icon_iframe.find('.icon-detail[data-name='+$(this).data('icon')+']').removeAttr('hidden');
			$('.icon-modal .back-iconlist').removeAttr('hidden');
		});
		// 选择图标
		$icon_iframe.find('.icon-detail .icondemo-wrap').click(function(event) {
			$icon_iframe.find('.icon-detail .icondemo-wrap').removeClass('checked');
			$(this).addClass('checked');
		})
	});
	// 返回图标列表页
	$('.icon-modal .back-iconlist').click(function(event) {
		var $icon_iframe=$('.icon-iframe').contents();
		$(this).attr({hidden:''});
		$icon_iframe.find('.icon-list').show();
		$icon_iframe.find('.icon-detail').attr({hidden:''}).find('.icondemo-wrap').removeClass('checked');
	})
	// 保存图标选择
	$(document).on('click', '.icon-modal button[type=submit]', function(event) {
		var $icon_iframe=$('.icon-iframe').contents(),
			$icon_checked=$icon_iframe.find('.icon-detail .icondemo-wrap.checked'),
			icon=$icon_checked.parents('.icon-detail').data('prev')+$icon_checked.find('.icon-title').html();
		$('input[name=icon]').val(icon);
		$('.icon-modal').modal('hide');
	})
	// 图标设置框关闭时还原框内显示
	$(document).on('show.bs.modal', '.icon-modal', function(event) {
		var $icon_iframe=$('.icon-iframe').contents();
		$('.icon-modal .back-iconlist').click();
		$icon_iframe.find('.icon-detail .icondemo-wrap').removeClass('checked');
	})

	//提升栏目
	$(document).on('click', '.up', function(event) {
		$('#movenow').val($(this).data('nowid'));
		$('#move-modal').modal();
	});
	
	//展开
	$(document).on('click', '.next-column', function(event) {
		var myid = $(this).data('my-id');
		var status = $(this).data('status');
		if(status){
			$(this).find('i').addClass('fa-caret-right');
			$(this).find('i').removeClass('fa-caret-down');
			$(this).parents('tr').css('background','#f5f5f5');
		}else{
			$(this).find('i').removeClass('fa-caret-right');
			$(this).find('i').addClass('fa-caret-down');
		}
		var change = status ? 0 : 1;
		$(this).data('status', change);
		$(".bigid").each(function(){
			if($(this).val() == myid){
				if(status){
					$(this).parents('tr').hide();
				}else{
					$(this).parents('tr').show();
				}
			}
		});
	});
	var close=false;
	$(document).on('click', '#expandall', function(event) {
			if(close){
				$(this).text(expandText);
				close=false;
				$('.next-column').find('i').removeClass('fa-caret-down').addClass('fa-caret-right');
				$(".bigid").each(function(){
					if($(this).val()!=0){
						$(this).parents('tr').hide();
					}else{
						$(this).parents('tr').show();
					}
				});
			}else{
			$(this).text(closeText);
			close=true;
			$('tr').show();
			$('.next-column').find('i').removeClass('fa-caret-right').addClass('fa-caret-down');
		}
	});

	//切换出foldername输入框
	$(document).on('change', '.module-select', function(event) {
		var checked = $(this).data('checked');
		var select = $(this).val();
		var id = $(this).data('id');
		if(select == 0){
			$("#span-"+id).hide();
			$("input[name='foldername-"+id+"'").hide();
			$("input[name='out_url-"+id+"'").show();
		}else{
			if(checked == select){
				$("#span-"+id).show();
				$("input[name='foldername-"+id+"'").hide();
				$("input[name='out_url-"+id+"'").hide();
			}else{
				$("#span-"+id).hide();
				$("input[name='foldername-"+id+"'").show();
				$("input[name='out_url-"+id+"'").hide();
			}
		}
		var f = '';

		switch (select) {
			case '0':
			case '1':
			case '2':
			case '3':
			case '4':
			case '5':
				f = '';
			break;
			case '6':
				f = 'job';
			break;
			case '7':
				f = 'message';				
			break;
			case '8':
				f = '';				
			break;
			case '9':
				f = 'link';				
			break;
			case '10':
				f = 'member';							
			break;		
			case '11':
				f = 'search';						
			break;
			case '12':
				f = 'sitemap';							
			break;
		}

		if(f){
			$("input[name='foldername-"+id+"'").attr('readonly', 'readonly');
			$("input[name='foldername-"+id+"'").val(f);
		}else{
			$("input[name='foldername-"+id+"'").attr('readonly', false);
			$("input[name='foldername-"+id+"'").val(f);
		}
	});
	
	// 保存图标选择
	$(document).on('click', '.to-lang-select', function(event) {
		$("input[name='to_lang']").val($(this).data('value'));
		$("#lang").html($(this).html()+"<span class=\"caret\"></span>");
	});
});
