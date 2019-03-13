$(function(){
	// 产品列表页
	if($('.met-product').length){
		// 图片懒加载
		var $metpro_original=$(".met-product [data-original]");
		if($metpro_original.length){
			var $pro_fluid=$(".met-product .container-fluid");
			if($pro_fluid.length){
				$pro_fluid.each(function(){
					var $self=$(this);
					$(this).width($(this).width());
					setTimeout(function(){
						$self.width('');
					},2000)
				});
			}
			metAnimOnScroll('met-grid');
		}
	}

	// 详情页轮播图
	// 产品详情页、图片模块详情页共用
	var $met_img_slick=$('#met-imgs-slick'),
		$met_img_slick_slide=$met_img_slick.find('.slick-slide');
	if($met_img_slick_slide.length>1){
		// 缩略图水平滑动
		$met_img_slick.on('init',function(event,slick){
			$met_img_slick.find('ul.slick-dots').navtabSwiper();
		})
		// 开始轮播
		var slick_lazyloadPrevNext=slick_swipe=true,
			slick_fade=slick_arrows=false;
		if(device_type=='d'){
			if($met_img_slick.hasClass('fngallery')){
				slick_lazyloadPrevNext=slick_swipe=false;
				slick_fade=true;
			}
		}
		if(!slick_swipe) $met_img_slick.addClass('slick-fade');//如果切换效果为淡入淡出，则加上标记class
		if(device_type!='m') slick_arrows=true;
		$met_img_slick.slick({
			arrows:slick_arrows,
	        dots:true,
	        speed:300,
	        fade:slick_fade,
	        swipe:slick_swipe,
	        customPaging:function(a,b) {
	        	var $selfimg=$met_img_slick_slide.eq(b),
	        		src=$selfimg.find('.lg-item-box').data('exthumbimage'),
	        		alt=$selfimg.find('img').attr('alt'),
	        		img_html='<img src="'+src+'" alt="'+alt+'" />';
	        	return img_html;
	        },
	        lazyloadPrevNext:slick_lazyloadPrevNext,
	        prevArrow:met_prevarrow,
	        nextArrow:met_nextarrow,
		})
		$met_img_slick.on('beforeChange', function(event, slick, currentSlide, nextSlide){
			$met_img_slick_slide.each(function(index, el) {
				var thisimg=$('img',this),
					thisimg_datasrc=thisimg.attr('data-src');
				if(!thisimg.attr('data-lazy') && thisimg.attr('src')!=thisimg_datasrc) thisimg.attr({src:thisimg_datasrc});
			});
        });
	}
	// 画廊加载
	var $fngallery=$('.fngallery');
	if($fngallery.length){
		var $fngalleryimg=$fngallery.find('.slick-slide img');
		if($fngalleryimg.length){
			var fngallery_open=true;
			$fngalleryimg.each(function() {
				$(this).one('click',function(){
					if(fngallery_open){
						if(device_type=='m'){
							$.initPhotoSwipeFromDOM('.fngallery','.slick-slide:not(.slick-cloned) [data-med]');
						}else{
							$fngallery.galleryLoad();
						}
						fngallery_open=false;
					}
				});
			})
		}
	}

	// 选项卡水平滚动
	var $met_showpro_navtab=$('.met-showproduct-navtabs');
	if($met_showpro_navtab.length) $met_showpro_navtab.navtabSwiper();

	// 产品详情页标准模式
	if($('.met-showproduct.pagetype1').length){
		// 选项卡点击切换触发事件
		$met_showpro_navtab.find('a[data-toggle="tab"]').on('shown.bs.tab',function(){
			var href=$(this).attr('href');
			$('img:eq(0)',href).trigger('scroll');
		})
	}

	// 产品详情页时尚模式
	var $showprotype2=$('.met-showproduct.pagetype2');
	if($showprotype2.length){
		var $pro_navbar=$showprotype2.find('.navbar'),
			pro_navbar_t=$pro_navbar.offset().top,
			pro_navbar_fixclass='navbar-fixed-top animation-slide-top',
			$protype2_navtabs_a=$pro_navbar.find('.met-showproduct-navtabs li a'),
			proNavbarScroll=function(){
				var st=$(window).scrollTop();
				// 标题工具栏固定
				if(st>pro_navbar_t){
					if(!$pro_navbar.hasClass(pro_navbar_fixclass)) $pro_navbar.addClass(pro_navbar_fixclass).parent().height($pro_navbar.height());
				}else if($pro_navbar.hasClass(pro_navbar_fixclass)){
					$pro_navbar.removeClass(pro_navbar_fixclass).parent().height('');
				}
				// 选项卡自动选中
				$protype2_navtabs_a.each(function(){
					var offsettop=proTabTop($(this),$pro_navbar);
					if(st>=(offsettop-30)) proNavActive($(this));// 30为区域上下内边距，根据需要调整
				});
			};
		proNavbarScroll();
		$(window).scroll(function(){
			proNavbarScroll();
		});
		// 选项卡点击滚动事件
		$protype2_navtabs_a.click(function(e){
			e.preventDefault();
			var $self=$(this),
				scrollTopInt=setInterval(function(){
					var st=$(window).scrollTop(),
						scroll_goto=proTabTop($self,$pro_navbar);
					if(st>=scroll_goto-1 || st+$(window).height()>=$(document).height()-1){
						proNavActive($self);
						clearInterval(scrollTopInt);
					}
					$('html,body').animate({scrollTop:scroll_goto},300,"linear");
				},300)
		})
	}
});
// 选中选项卡
function proNavActive(dom){
	dom.addClass('active').parent().siblings('li').find('.nav-link').removeClass('active');
}
// 获取选项卡内容距离顶部的位置
function proTabTop(dom,topdom){
	var offsettop=$(dom.attr("href")).offset().top-topdom.height();
	return offsettop;
}
// 瀑布流配置
function metAnimOnScroll(obj){
	new AnimOnScroll( document.getElementById(obj),{
		minDuration:0.4,
		maxDuration:0.7,
		viewportFactor:0.2
	});
}