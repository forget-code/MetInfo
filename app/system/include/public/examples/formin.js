define(function(require, exports, module) {
	
	var $ = jQuery = require('jquery');
	var $input = $("input[type='file']");
	if($input.length){
		//异步加载上传组件
		function Preview(event){
			var val = '';
			if(event.attr("value")){
				val=["<img src='"+event.attr("value")+"' class='file-preview-image'>"];
			}
			return val;
		}
		require.async('pub/bootstrap/fileinput/entrance',function(event){
			$input.each(function(){
				uploadUrl = $(this).attr('data-url');
				$(this).fileinput({
					initialPreview:Preview($(this)),
					language:'zh',             //语言文字
					browseLabel:upfiletext,    //按钮文字
					showCaption:false,         //输入框
					showRemove:false,          //删除按钮
					showUpload:false,          //上传按钮
					uploadUrl: uploadUrl,      //处理上传
					browseClass:'btn btn-success',//按钮class
					uploadAsync:false          //异步批量上传
				});
			});
			uploadUrl = $input.attr('data-url');
			$input.fileinput({
				initialPreview:Preview($(this)),
				language:'zh',             //语言文字
				browseLabel:upfiletext,    //按钮文字
				showCaption:false,         //输入框
				showRemove:false,          //删除按钮
				showUpload:false,          //上传按钮
				uploadUrl: uploadUrl,      //处理上传
				browseClass:'btn btn-success',//按钮class
				uploadAsync:false          //异步批量上传
			}).on("filebatchselected", function(event, files) {
				var box = $(this).parents(".file-input"),f =  box.find(".file-preview .file-preview-frame");
				if(f.length>1)f.eq(0).remove();
				box.find(".file-preview").show();
				$(this).fileinput("upload");
			}).on('filebatchuploadsuccess', function(event, data, previewId, index) {
				var path = data.response.path+'?'+$.now();
				if($("input[name='"+$(this).attr("name")+"'][type='hidden']").length){
					$("input[name='"+$(this).attr("name")+"'][type='hidden']").attr('value',path);
				}else{
					$(this).after("<input type='hidden' name='"+$(this).attr("name")+"' value='"+path+"' />");
				}
				if(data.response.type == 'head'){
					var box = $(this).parents(".file-input"),f =  box.find(".file-preview .file-preview-frame"),img = f.find(".file-preview-image");
					img.attr('src', path);
					img.attr('style', 'width:200px!important');
				}
				//alert();
			}).on('filecleared', function(event) {
				$("input[name='"+$(this).attr("name")+"'][type='hidden']").attr('value','');
			});
		});
	}
	var $select = $(".select-linkage");
	if($select.length){
		require.async('pub/examples/select-linkage/jquery.cityselect',function(event){
			$select.each(function(){
				var prov = $(this).find("select").eq(0).data('selected'),
					city = $(this).find("select").eq(1).data('selected'),
					dist = $(this).find("select").eq(2).data('selected');
					city = city?city:undefined;
					dist = dist?dist:undefined;
				$(this).citySelect({url:pub+'examples/select-linkage/city.min.php',prov:prov, city:city, dist:dist, nodata:"none"});
			});
			$select.find("select").removeClass("hidden");
		});
	}
	
	$('form').submit(function(){
		var checkbox = $("form input[type='checkbox']");
		checkbox.each(function(){
			var d=$(this),l=d.val();
			if($("input[name='"+d.attr('name')+"']").length>1){
				var v='',c = $("form input[name='"+d.attr('name')+"']:checked");
				var z = $("input[data-checkbox='"+d.attr('name')+"']");
				if(c.length==0){
					z.remove();
				}else{
					c.each(function(i){
						v+=(i+1)==c.length?$(this).val():$(this).val()+'|';
					});
					if(z.length>0){
						z.val(v);
					}else{
						$('form').append("<input name='"+d.attr('name')+"' data-checkbox='"+d.attr('name')+"' type='hidden' value='"+v+"' />");
					}
				}
			}
		});
	});
	
});