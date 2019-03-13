define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');
	require('own_tem/css/metinfo.css');
	if($(".content_add").length)require.async('own_tem/js/content_add');
	if($(".product_index").length)require.async('own_tem/js/product_index');
	if($(".product_add").length)require.async('own_tem/js/product_add');
	if($(".product_para").length)require.async('own_tem/js/product_para');
	//if($(".product_shop").length)require.async('own_tem/js/product_shop');
	if($(".product_shop").length)require.async($(".product_shop").attr('data-url'));
	if($(".article_add").length)require.async('own_tem/js/article_add');
 	$(document).on('init.dt',function() {
		$('input.lanmu').parents('tr').hide();
        $('tr td input.columntitle').each(function(){
        	 var val= $(this).val();
        	     $(this).parents('td').attr({title:val});
        });
	})
	// 选择所属栏目
	$("input[name='met_clumid_all']").change(function(){
		if($(this).attr("checked")){
			$('.flashaddclumn input').attr("checked",true);
		}else{
			$('.flashaddclumn input').attr("checked",false);
		}
	});
	$('.flashaddclumn input').change(function(){
		if(!$(this).attr("checked")) $("input[name='met_clumid_all']").attr("checked",false);
	});
});
// banner编辑添加页面保存验证
function flashsubm() {
	var val_clum = '';
	$('.flashaddclumn input[name*=met_clumid_]:checked').each(function(index,val) {
		if(index>0) val_clum+=',';
		val_clum += $(this).val();
	});
	if (val_clum=='') {
		alert(M_WORD['js67']);
		return false;
	}else{
		$("input[name='f_columnlist']").val(val_clum);
	}
	$('[data-upload-type][data-required]').each(function(index, el) {
		if(!$(this).val()) $(window).scrollTop($(this).parents('.ftype_upload').offset().top);
	});
}