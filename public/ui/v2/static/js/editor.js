$(function(){
	// 编辑器响应式表格
	var $meteditor_table=$(".met-editor table");
	if($meteditor_table.length) $meteditor_table.tablexys();
	// 编辑器图片处理
	var $metEditorImg=$(".met-editor img");
	if($metEditorImg.length){
		// 响应式图片
		$metEditorImg.each(function(index, el) {
            var thumbdir=$(this).data('original').replace(M['weburl'],'');
            thumbdir=M['navurl']+'include/thumb.php?dir='+thumbdir+'&x=';
            if(!$(this).attr('data-srcset') && ($(this).data('width')>=700 || $(this).attr('width')>=700)){
                var data_srcset=thumbdir+'450 450w,'+$(this).data('original'),
                    sizes="(max-width:450px) 450px";
                $(this).attr({'data-srcset':data_srcset,sizes:sizes});
            }
        });
		Breakpoints.get('xs').on({
			enter:function(){
				var editorimg_gallery_open=true;
				// 编辑器画廊
				$(".met-editor").each(function(){
					if($("img",this).length && !$(this).hasClass('no-gallery')){
						// 图片画廊参数设置
						var $self=$(this),
							imgsizeset=true;
						$("img",this).one('click',function(){
							if(imgsizeset){
								$self.find('img').each(function(){
		    						var original=$(this).data('original'),
		    							size='500x500';
		    						if($(this).data('width')){
		    							size=$(this).data('width')+'x'+$(this).data('height');
		    						}else if($(this).attr('width') && $(this).attr('height')){
		    							size=$(this).attr('width')+'x'+$(this).attr('height');
		    						}
									if(!($(this).parents('a').length && $(this).parents('a').find('img').length==1)) $(this).wrapAll('<a></a>');
									$(this).parents('a').attr({href:original,'data-size':size,'data-med':original,'data-med-size':size});
				    			});
				    			imgsizeset=false;
							}
			    			if(editorimg_gallery_open){
				    			$.initPhotoSwipeFromDOM('.met-editor');
								editorimg_gallery_open=false;
			    			}
			    		});
					}
				});
			}
		})
	}
});
// 表格响应式格式化
$.fn.tablexys=function(){
	var $self=$(this);
	$(this).addClass('tablesaw table-striped table-bordered table-hover tablesaw-sortable tablesaw-swipe').attr({"data-tablesaw-mode":"swipe",'data-tablesaw-sortable':''});
	Breakpoints.get('xs').on({
		enter:function(){
			$self.each(function(){
				if(!$('thead',this).length){
					var td=$("tbody tr:eq(0) td",this),th;
					if(td.length==0) td=$("tbody tr:eq(0) th",this);
					td.each(function(){
						th+='<th data-tablesaw-sortable-col>'+$(this).html()+'</th>';
					});
					$(this).prepend("<thead><tr>"+th+"</tr></thead>");
					$("tbody tr:eq(0)",this).remove();
					$("tbody td",this).attr('width','auto');
				}
			});
			$(document).trigger("enhance.tablesaw");
		}
	});
}