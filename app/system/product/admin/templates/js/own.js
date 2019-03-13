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
	common.showMoreSet();
	$('select[name=class1_select]').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class1=$(this).val();
			var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class1_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class1_select='+class1;

			$('a.btn.btn-danger').attr('href',url1);
		})
		$('select[name=class2_select]').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class2=$(this).val();
			    var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class2_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class2_select='+class2;
			$('a.btn.btn-danger').attr('href',url1);
		})
		$('select[name=class3_select]').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class3=$(this).val();
			var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class3_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class3_select='+class3;
			$('a.btn.btn-danger').attr('href',url1);
		})
		
		
		$('select[name=class1]').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class1=$(this).val();
			var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class1_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class1_select='+class1;

			$('a.btn.btn-danger').attr('href',url1);
		})
		$('select[name=class2').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class2=$(this).val();
			    var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class2_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class2_select='+class2;
			$('a.btn.btn-danger').attr('href',url1);
		})
		$('select[name=class3_select]').change(function(){
			var url=$('a.btn.btn-danger').attr('href');
			var class3=$(this).val();
			var str=url.split('&');
			    for (var i = str.length - 1; i >= 0; i--) {
			    	if(str[i].indexOf("class3_select")>-1){
	                    url=url.replace('&'+str[i],'');
			    	}
			    }
			var url1=url+'&class3_select='+class3;
			$('a.btn.btn-danger').attr('href',url1);
		})
});