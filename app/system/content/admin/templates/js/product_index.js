define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	var common = require('common');

	
	require('pub/bootstrap/submenu/bootstrap-submenu.min.css');
	require('pub/bootstrap/submenu/bootstrap-submenu.min');
	
	$('.dropdown-submenu > a').submenupicker();
	
	$(".list-type-update a").click(function(){
		var nm = $(this).data('value'),ip=$("input[name='submit_type']");
		if(nm){
			if(!$("input[name='id']:checked").length){
				common.metalert({html:'没有选中的记录'});
				return false;
			}
			if($(this).parents('.list-type-update').data('type')){
				$("input[name='columnid']").val(nm);
				nm = $(this).parents('.list-type-update').data('type');
			}
			if(ip.length>0){
				ip.val(nm);
			}else{
				$(this).parents("form").append("<input type='hidden' name='submit_type' value='"+nm+"' />");
			}
			$(this).parents("form").submit();
		}
	});
	
	function popovers(){
		$('a[data-toggle="popover"]').popover({
			content:function(){
				return '<a class="btn btn-primary btn-sm" role="button" href="'+$(this).attr("href")+'&recycle=1" style="margin-right:5px;">放入回收站</a><a class="btn btn-danger btn-sm" role="button" href="'+$(this).attr("href")+'&recycle=0" style="margin-right:5px;">彻底删除</a><a class="btn btn-default btn-sm listdeleteno" role="button" href="javascript:;">取消</a>';
			},
			html:true,
			placement:'left'
		});
	}
	$(document).on( 'init.dt', function ( e, settings ) {
		popovers();
		var api = new $.fn.dataTable.Api( settings );
		api.on( 'draw.dt', function ( e, settings, json ) {
			popovers();
		});
	});
	$(document).on('click','a.listdeleteno',function(){
		$(this).parents(".popover:eq(0)").prev().popover('hide');
	});
	
	$(document).on('click','[data-toggle="popover"]',function(){
		return false;
	});
	
	$(document).on('click','.list-type-del',function(){
		if(!$("input[name='id']:checked").length){
			common.metalert({html:'没有选中的记录'});
			return false;
		}
		var nm = 'del',ip=$("input[name='submit_type']");
		$("input[name='recycle']").val($(this).data('value'));
		if(ip.length>0){
			ip.val(nm);
		}else{
			$(this).parents("form").append("<input type='hidden' name='submit_type' value='"+nm+"' />");
		}
		$(this).parents("form").submit();
	});
	
	$('button[data-toggle="popover"]').popover({
		content:function(){
			return '<button class="btn btn-primary btn-sm list-type-del" role="button" data-value="1" style="margin-right:5px;">放入回收站</button><button class="btn btn-danger btn-sm list-type-del" role="button" data-value="0" style="margin-right:5px;">彻底删除</button><a class="btn btn-default btn-sm listdeleteno" role="button" href="javascript:;">取消</a>';
		},
		html:true,
		placement:'top'
	});
	
	/*排序*/
	function orderby(my,type){
		$("a.orderby-link").find(".orderby-arrow").remove();
		$("a.orderby-link").next().val('');
		my.append('<span class="orderby-arrow '+type+'"></span>');
		my.next().val(type);
		var table = $('.dataTable').DataTable();
		table.ajax.reload();
	}
	$("a.orderby-link").click(function(){
		if($(this).find(".orderby-arrow").length){
			if($(this).find(".desc").length){
				orderby($(this),'asc');
			}else{
				orderby($(this),'desc');
			}
		}else{
			orderby($(this),'desc');
		}
	});
	$("select[name='search_type']").change(function(){
		$("a.orderby-link").find(".orderby-arrow").remove();
		$("a.orderby-link").next().val('');
	});
	
	$(document).on( 'init.dt', function (e, settings, json) { //表格加载完成时执行
		//alert(json);
		$('.prov').attr('data-checked', '');
	}); 

	$('.prov').change(function(){
		$('#class1id').val($('.prov').val());
		
	});
});