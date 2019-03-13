$(function(){
	// 翻页ajax加载
	if($(".met-pager-ajax").length){
		var $metpagerajax_link=$(".met-pager-ajax-link");
		if($(".met_pager a").length==1) $(".met_pager").attr({hidden:''});
		if($metpagerajax_link.hasClass("hidden-md-up")){
			Breakpoints.get('xs').on({
				enter:function(){
					metpagerajax();
				}
			});
		}else{
			metpagerajax();
			setTimeout(function(){
				$metpagerajax_link.scrollFun(function(val){
		            val.appearDiy();
				});
			},0)
		}
	}
});
// 分页脚本
function metpagerajax(){
	var $metpagerbtn=$("#met-pager-btn"),
		$metpagerajax=$(".met-pager-ajax"),
		pagemax=$(".met_pager a").length-1,
		page=$metpagerbtn.data("page"),
		metpagerbtnText=function(){
			if(pagemax){
				if(pagemax <= page && page>1) $metpagerbtn.addClass('disabled').text('已经是最后一页了');
			}else{
				$metpagerbtn.attr({hidden:''});
			}
		};
	metpagerbtnText();
	$metpagerbtn.click(function(){
		if(!$metpagerbtn.hasClass('disabled')){
			page++;
			$.ajax({
				url:$metpagerbtn.data("url")+'&page='+page,
				type:'POST',
				success:function(data){
					setTimeout(function(){
						$metpagerajax.append(data);
						metpagerajaxFun(page);
						metpagerbtnText();
					},500)
				}
			});
		}
	});
}
// 无刷新分页获取到数据追加到页面后，可以在此方法继续处理
function metpagerajaxFun(page){
	var $metpagerajax=$('.met-pager-ajax'),
		metpager_original='.page'+page+' [data-original]';
	if($metpagerajax.find(metpager_original).length){
		// 图片高度预设
		// setTimeout(function(){
			$metpagerajax.imageSize(metpager_original);
		// },0)
		// 图片延迟加载
	    $metpagerajax.find(metpager_original).lazyload({placeholder:met_placeholder});
		setTimeout(function(){
			$('html,body').stop().animate({scrollTop:$(window).scrollTop()+2},0);
	    },300)
	}
	if($('#met-grid').length) metAnimOnScroll('met-grid');// 产品模块瀑布流
}