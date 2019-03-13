define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');
	
	if($(".content_add").length)require.async('own_tem/js/content_add');
	if($(".product_index").length)require.async('own_tem/js/product_index');
	if($(".product_add").length)require.async('own_tem/js/product_add');
	if($(".product_para").length)require.async('own_tem/js/product_para');
	//if($(".product_shop").length)require.async('own_tem/js/product_shop');
	if($(".product_shop").length)require.async($(".product_shop").attr('data-url'));
	if($(".article_add").length)require.async('own_tem/js/article_add');
	$(".ftype_select-linkage select").change(function(){
        var class1=$(this).val();
        var url1= $('ul li a.syset').attr('href');
        var str=url1.split('=');
        console.log(str);
        var classid=str[str.length-1];
            url1=url1.replace(classid,class1);
            $('ul li a.syset').attr('href',url1);
	})

});