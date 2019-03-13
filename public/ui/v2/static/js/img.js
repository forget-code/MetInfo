$(function(){
	// 图片列表页浏览模式
	var metimg_showbtn=".met-img-showbtn";
	if($(metimg_showbtn).length){
		// 点击浏览按钮进入画廊
		if(device_type=='d'){
			$(document).on('click',metimg_showbtn,function(){
				var displayimg=$(this).data("displayimg").split('|'),
					dyarr=new Array();
				$.each(displayimg,function(index,value){
					if(value!=''){
						var st=value.split('*');
						dyarr[index]=new Array();
						dyarr[index]['src']=st[1];
						dyarr[index]['thumb']=st[1];
						dyarr[index]['subHtml']=st[0];
					}
				})
				$(this).galleryLoad(dyarr);// 画廊初始化
			});
		}else{
			$(document).on('click',metimg_showbtn,function(){
				if(!$(this).next('.img-photoswipe').length){
					var displayimg=$(this).data("displayimg").split('|'),
						html='';
					$.each(displayimg,function(index,value){
						if(value){
							var st=value.split('*');
							html+='<a href="'+st[1]+'" data-size="'+st[2]+'" data-med="'+st[1]+'" data-med-size="'+st[2]+'" class="vertical-align"><img src="'+st[1]+'" alt="'+st[0]+'" class="cover-image"/></a>';
						}
					})
					$(this).after('<div class="img-photoswipe">'+html+'</div>');
					$.initPhotoSwipeFromDOM($(this).next('.img-photoswipe'));// 画廊初始化
				}
				$(this).next('.img-photoswipe').find('a:eq(0)').trigger('click');
			})
		}
	}
	if(!$('.img-paralist li').length) $('.img-paralist').remove();// 删除图片模块详情页参数列表无内容的结构
});