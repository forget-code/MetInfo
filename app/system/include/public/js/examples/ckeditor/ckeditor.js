define("epl/ckeditor/ckeditor", [basepath+'ckeditor/ckeditor.js'],
function(require, exports, module) {

	var $ = require('jquery');
	var common = require('common');

	function ckeditor(name,type,x,y) {
		var d = $("textarea[name='" + name + "']"),p=d.parents(".ftype_ckeditor");
		/*加载状态*/
		//d.before('<div id="linzai_' + name + '">Loading...</div>');
		if(p.prev("dt").length<1){
			p.css({'padding':'0px','margin':'0px'});
			d.parent(".fbox").css("padding","0px 5px");
		}else{
			x = x?x:'98%';
		}
		p.find('.fbox').css('margin','0px');
		/*配置编辑器*/
		var config = {};
		config.filebrowserBrowseUrl = basepath + 'ckfinder/ckfinder.html';
		config.filebrowserImageBrowseUrl = basepath + 'ckfinder/ckfinder.html?Type=Images';
		config.filebrowserFlashBrowseUrl = basepath + 'ckfinder/ckfinder.html?Type=Flash';
		config.filebrowserUploadUrl = basepath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		config.filebrowserImageUploadUrl = basepath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		config.filebrowserFlashUploadUrl = basepath + 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
		if (type == 1) {
			config.toolbar_Full = [
			['Bold', 'TextColor', 'Link', 'Unlink', 'Image','video','Table','FontSize'],
			['NumberedList','BulletedList','JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			['PasteText', 'Source']
			];
			config.height = 160;
			config.enterMode=2;
		} else if(type==2){
			config.toolbar_Full = [
			['FontSize','Bold', 'TextColor', 'Link', 'Unlink', 'Image','video','Source']
			];
			config.height = 160;
			config.enterMode=2;
		}else{
			config.height = 400;
		}
		//config.contentsCss = siteurl + 'templates/default/images/css/metinfo.css';
		if(x)config.width = x;
		if(y)config.height = y;
		CKEDITOR.replace(name, config);
		/*加载完成后*/
		CKEDITOR.on('instanceReady',
		function() {
			//$('#linzai_' + name).remove();
		});
	}
	
	exports.func = function(d){
		d = d.find('.ftype_ckeditor .fbox textarea');
		d.each(function(){
			var n = $(this).attr('name'),t=$(this).attr('data-ckeditor-type'),x=$(this).attr('data-ckeditor-x'),y=$(this).attr('data-ckeditor-y');
			ckeditor(n,t,x,y);
		});
	}
	
});
