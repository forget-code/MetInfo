define(function(require, exports, module) {

	var $ = jQuery = require('jquery');
	//上传组件
	function imgupload(){
		require.async('epl/upload/webuploader.min',function(){
			var uploader = WebUploader.create({
				auto: true,
				swf: siteurl + 'app/system/include/public/js/examples/upload/Uploader.swf',
				server: basepath + 'index.php?c=uploadify&m=include&a=doupimg&lang='+lang,
				pick: '#filePicker',
				compress:{
					width: 2000,
					height: 2000,
					noCompressIfLarger: true
				},
				accept: {
					title: 'Images',
					extensions: 'gif,jpg,jpeg,bmp,png,svg',//增加文件格式（新模板框架v2）
					mimeTypes: 'image/*'
				}
			});
			//文件上传成功时
			uploader.on( 'uploadSuccess', function( file, response ) {
				if(response.error!='0'){
					alert(response.errorcode);
				}else{
					var path = siteurl + response.path;
					var $li = $(
							'<li title="' + response.name + '" style="background-image:url('+path+');">' +
								'<div class="check hide" data-value="'+response.original+'" data-path="'+path+'"><i class="fa fa-check"></i></div>' +
								'<div class="widget-image-meta">'+response.x+'x'+response.y+'</div>' +
							'</li>'
						);
						$("#upimglist").prepend( $li );
				}
			});
			uploader.on( 'startUpload', function() {
				$("#filePicker span.filePicker-txt").html("上传中...");
			});
			//文件全部上传完成时
			uploader.on( 'uploadFinished', function( file ) {
				$("#filePicker span.filePicker-txt").html("本地上传");
				$("div.holder").jPages("destroy").jPages({
					containerID : "upimglist",
					perPage :20,
					previous:'上一页',
					next:'下一页'
				});
			});
		});
	}
	//图片列表
	function imglistlaod(){
		var set = setInterval(function(){
			if($("#upimglist").attr('data-ok') == 1){
				require('epl/upload/jPages.css');
				require.async('epl/upload/jPages.min',function(){
					$("div.holder").jPages({
						containerID : "upimglist",
						perPage :20,
						previous:'上一页',
						next:'下一页'
					});
				});
				if($("#upimglist").attr('data-ok') == 1)clearInterval(set);
			}
		},1000);
		$.ajax({
		   type: "POST",
		   dataType: "json",
		   url: adminurl+'n=system&c=filept&a=dogetfile',
		   success: function(obj){
				var html = '',weburl = siteurl.substring(0,siteurl.length-1);
				$.each(obj, function (n, value) {
					var path = weburl + value.path;
					html += '<li title="'+value.name+'" style="background-image:url('+path+');">';
					html += '<div class="check hide" data-value="'+value.value+'" data-path="'+path+'"><i class="fa fa-check"></i></div>';
					html += '<div class="widget-image-meta">'+value.x+'x'+value.y+'</div>';
					html += '</li>';
				});
				$("#upimglist").append(html);
				$("#upimglist").attr('data-ok', 1);
		   }
		});
	}
	//图片库
	function imgku(){
		//生成模态框
		var txt = '<div class="modal fade" id="UploadModal" aria-hidden="true">';
			txt += '	<div class="modal-dialog">';
			txt += '		<div class="modal-content">';
			txt += '			<div class="modal-header clearfix" role="tabpanel">';
			txt += '				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			txt += '				<h4>选择图片</h4><button class="btn btn-success" id="filePicker"><span class="filePicker-txt">本地上传</span></button>';
			txt += '			</div>';
			txt += '			<div class="modal-body">';
			txt += '				<div class="tab-content">';
			txt += '					<ul id="upimglist" class="clearfix"></ul><div class="holder"></div>';
			txt += '				</div>';
			txt += '			</div>';
			txt += '			<div class="modal-footer">';
			txt += '			<button type="button" class="btn btn-primary">确定</button>';
			txt += '			<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>';
			txt += '			</div>';
			txt += '		</div>';
			txt += '	</div>';
			txt += '</div>';
		$("body").append(txt);
		//选中图片事件
		$(document).on('click','#upimglist li',function(){
			var dom = $("input[name='"+$("#UploadModal").data("inputname")+"']"),check = $(this).find("div.check"),ok = check.is(':hidden');
			if(!dom.data('upload-many')){
				$("#upimglist li div.check").addClass('hide');
				$('#upimglist li .widget-image-meta').removeClass('hide');
			}
			if(ok){
				check.removeClass('hide');
				$(this).find('.widget-image-meta').addClass('hide');
			}else{
				check.addClass('hide');
			}
		});
		//鼠标经过显示隐藏尺寸
		$(document).on('mouseenter mouseout','#upimglist li',function(){
			var d = $(this).find('.widget-image-meta'),c=$(this).find('div.check');
			if(event.type=='mouseover'){
				d.addClass('hide');
			}else if(event.type=='mouseout'){
				if(c.is(':hidden'))d.removeClass('hide');
			}
		});
		//确定选中图片事件
		$(document).on('click','#UploadModal .modal-footer button.btn-primary',function(){
			var x = $("#upimglist li div.check:visible"),l = x.length;
			if(l){
				var dom = $("input[name='"+$("#UploadModal").data("inputname")+"']");
				if(!dom.data('upload-many')){
					if(dom.next().find('li.sort').length)dom.next().find('li.sort').remove();
				}
				x.each(function(i){
					imgadd(dom,$(this).data('path'),$(this).data('value'));
				});
				imgvalue(dom);
				$('#UploadModal').modal('hide');
			}else{
				alert("请选择图片");
			}
		});
		//点击图片库按钮
		$(document).on('click','.ftype_upload .app-image-list li.imgku button',function(){
			$('#UploadModal').modal('show');
			if(!$("#UploadModal").data("ini")){
				imglistlaod();//获取图片列表、分页
				imgupload();//上传组件加载
				$("#UploadModal").data("ini",'1').data("inputname",$(this).data('name'));
			}else{
				$("#UploadModal").data("inputname",$(this).data('name'));
				$("#upimglist li div.check").addClass('hide');
				$('#upimglist li .widget-image-meta').removeClass('hide');
			}
		});
	}
	/*插入图片*/
	function imgadd(dom,src,value){
		// 函数重写（新模板框架v2）
		var $appimagelist=dom.next().find(".app-image-list"),
			sort_l=$appimagelist.find('.sort').length;
		$li = ' <li class="sort">' +
			'<a href="'+src+'" target="_blank">' +
				'<img src="'+src+'">' +
			'</a>' +
			'<span class="close hide" data-imgval="'+value+'">&times;</span>' +
			'</li>';
		dom.next().find(".app-image-list li.upnow").before($li);
		// 商品图尺寸设置
		var imgtemp = new Image();
        imgtemp.src = src;
        imgtemp.index=sort_l;
        imgtemp.onload = function(){
			dom.next().find(".app-image-list li.sort:eq("+this.index+") [data-imgval]").attr({'data-size':this.width+'x'+this.height});
		}
	}
	/*重新赋值*/
	function imgvalue(dom){
		var list = dom.next().find('li.sort'),value = '',l = list.length;
		list.each(function(i){
			var vl = $(this).find("span").data('imgval');
			value += (i+1)==l?vl:vl + '|';
		});
		dom.attr('value',value);
	}

	exports.func = function(e){
		var ik = false,tf = false;
		//构建版面
		var es = e.find('.ftype_upload .fbox input');
		es.each(function(){
			if($(this).data("upload-type")=='doupimg' || $(this).data("upload-type")=='doupico'){
				ik = true;
				var dom = $(this),name = dom.attr('name');
				var doaction = $(this).data("upload-type");
				var data_key = $(this).data("upload-key");
				dom.hide();
				var html = '<div class="picture-list ui-sortable">';
					html+= '<ul class="js-picture-list app-image-list clearfix">';
					html+= '<li class="upnow">' +
							'<div data-name="'+name+'" id="filePicker_'+name+'" class="btn btn-default" style="border-radius:0px"><span class="uptxt">上传</span></div>' +
							'</li>';
					if($(this).data("upload-type")=='doupimg')html+= '<li class="imgku">';
					if($(this).data("upload-type")=='doupimg')html+= '<button type="button" data-name="'+name+'" class="btn btn-default">从图片库选择</button>';
					if($(this).data("upload-type")=='doupimg')html+= '</li>';
					html+= '</ul>';
					html+= '</div>';
				dom.after(html);
				var src = dom.val();
				if(src){
					src += '|';
					var srcs = src.split('|'),isrc='';
					for(var i=0;i<srcs.length;i++){
						if(srcs[i]!=''){
							isrc = srcs[i].split('../');
							isrc = siteurl + isrc[1];
							imgadd(dom,isrc,srcs[i]);
							isrc = '';
						}
					}
				}
				require.async('epl/upload/webuploader.min',function(){
					var uploaders = WebUploader.create({
						auto: true,
						swf: siteurl + 'app/system/include/public/js/examples/upload/Uploader.swf',
						server: basepath + 'index.php?c=uploadify&m=include&a='+doaction+'&lang='+lang + '&data_key=' +data_key,
						pick: {
						id:'#filePicker_'+name,
						multiple :false
						},
						compress:{
							width: 2000,
							height: 2000,
							noCompressIfLarger: true
						},
						accept: {
							title: 'Images',
							extensions: 'gif,jpg,jpeg,bmp,png,ico,svg',//增加文件格式（新模板框架v2）
							mimeTypes: 'image/*'
						}
					});
					//文件上传成功时
					uploaders.on( 'uploadSuccess', function( file, response ) {
						if(response.error!='0'){
							alert(response.errorcode);
						}else{
							if(!dom.data('upload-many')){
								if(dom.next().find('li.sort').length)dom.next().find('li.sort').remove();
							}
							var path = siteurl + response.path;
							imgadd(dom,path,response.original);
							imgvalue(dom);
						}
					});
					uploaders.on( 'startUpload', function() {
						$('#filePicker_'+name+' span.uptxt').html("上传中...");
					});
					//文件全部上传完成时
					uploaders.on( 'uploadFinished', function( file ) {
						$('#filePicker_'+name+' span.uptxt').html("上传");
					});
				});
			}
			if($(this).data("upload-type")=='doupfile'){
				tf = true;
			}
		});
		if(tf){
			require.async('epl/uploadify/upload',function(a){
				a.func(e);
			});
		}
		if(ik){

			/*拖曳排序*/
			require.async('pub/examples/dragsort/jquery.dragsort-0.5.2.min',function(){
				$('.ftype_upload ul.app-image-list').dragsort({
					dragSelector: "li.sort",
					dragBetween: false ,
					dragEnd: function() {
						var dom = $(this).parents('.picture-list').prev();
						imgvalue(dom);
					}
				}).find('.sort a').click(function(e) {//火狐浏览器拖拽会跳转的兼容
					if(navigator.userAgent.indexOf("Firefox") > -1) e.preventDefault();
				});
			});

			//删除按钮
			$(document).on('click','.ftype_upload .app-image-list li.sort span',function(){
				var dom = $(this).parents('.picture-list').prev();
				$(this).parent('li.sort').remove();
				imgvalue(dom);
			});

			imgku();//图片库
		}

	}
});
