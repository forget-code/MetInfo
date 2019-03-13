define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');
	
	if($(".content_add").length)require.async('tem/js/content_add');
	if($(".product_index").length)require.async('tem/js/product_index');
	if($(".product_add").length)require.async('tem/js/product_add');
	if($(".product_para").length)require.async('tem/js/product_para');
	//if($(".product_shop").length)require.async('tem/js/product_shop');
	if($(".product_shop").length)require.async($(".product_shop").attr('data-url'));
	if($(".article_add").length)require.async('tem/js/article_add');

});