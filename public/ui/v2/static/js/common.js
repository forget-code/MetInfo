/*!
 * M['weburl'] 		网站网址
 * M['lang']  		网站语言
 * M['navurl']      相对于根目录地址
 * M['tem']  		模板目录路径
 * M['classnow']  	当前栏目ID
 * M['id']  		当前页面ID
 * M['module']  	当前页面所属模块
 * default_placeholder 开发者自定义默认图片延迟加载方式，'base64'：灰色背景；自定义背景图片路径；'blur'：图片高斯模糊；默认为'blur'
 * met_prevarrow,met_nextarrow slick插件翻页按钮自定义html
 * device_type       客户端判断（d：PC端，t：平板端，m：手机端）
 */
M['plugin_lang']=true;//前台页面插件文件多语言开关
$(function(){
    // 移动端兼容
    // if(device_type!='d') $('body').wrapInner('<div class="cover"></div>');
    // 列表图片高度预设及删除
    var $imagesize=$('.imagesize[data-scale]');
    if($imagesize.length) $imagesize.imageSize();
    // 图片延迟加载
    var $original=$('[data-original]');
    // 图片加载方式整理
    if("undefined" == typeof default_placeholder) var default_placeholder='blur';
    met_placeholder=met_placeholder||default_placeholder;
    if(met_placeholder!=default_placeholder && met_placeholder!=met_lazyloadbg_base64 && "undefined" != typeof default_placeholder && default_placeholder.indexOf(M['tem'])>=0){
        if(met_placeholder==met_lazyloadbg){
            if(!met_lazyloadbg_set) met_placeholder=default_placeholder;
        }else if(met_lazyloadbg!=met_lazyloadbg_base64){
            met_lazyloadbg=default_placeholder;
        }
    }
    if($original.length){
        setTimeout(function(){
            $original.lazyload({placeholder:met_placeholder});
        },0)
    }
    // 内页子栏目导航水平滚动
    var $metcolumn_nav=$('.met-column-nav-ul');
    if($metcolumn_nav.length){
        Breakpoints.on('xs',{
            enter:function(){
                $metcolumn_nav.navtabSwiper();
            }
        })
    }
    // 手风琴
    $(document).on('click', '[data-toggle=collapses]', function() {
        $(this).next('.collapse').slideToggle().parent().siblings().find('.collapse').slideUp();
    });
    if($('[boxmh-mh]').length) $('[boxmh-mh]').boxMh('[boxmh-h]');//左右区块最小高度设置
    // 侧栏图片列表
    var $sidebar_piclist=$('.sidebar-piclist-ul');
    if($sidebar_piclist.find('.masonry-child').length>1){
        // 图片列表瀑布流
        Breakpoints.on('xs sm',{
            enter:function(){
                setTimeout(function(){
                    $sidebar_piclist.masonry({itemSelector:".masonry-child"});
                },500)
            }
        });
    }
    // 视频插件异步加载
    if($(".metvideobox").length && !$('link[href*="video-js.css"]').length && !$(".metvideobox .metvideo").length){
        $(".metvideobox").each(function(){
            var data=$(this).attr("data-metvideo").split("|"),
                width=data[0],
                height=data[1],
                poster=data[2],
                autoplay=data[3],
                src=data[4],
                vhtml='<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="'+width+'" height="'+height+'" poster="'+poster+'" data-setup=\'{\"autoplay\":'+autoplay+'}\'><source src="'+src+'" type="video/mp4" /></video></div>';
            $(this).after(vhtml).remove();
        });
        $.include(M['navurl']+'public/ui/v1/js/effects/video-js/video-js.css');
        if(device_type=='d'){
            $.include(M['navurl']+"public/ui/v1/js/effects/video-js/video_hack.js",function(){
                setTimeout(function(){
                    $('.metvideo').videoSizeRes();
                },0)
            });
        }else{
            $('.metvideo').videoSizeRes();
        }
    }
    if($('.met-editor iframe,.met-editor embed').length) $('.met-editor iframe,.met-editor embed').videoSizeRes();
});
// 全局函数
$.fn.extend({
    // 选项卡列表水平滚动处理
    navtabSwiper:function(){
        var $self=$(this),
            $navObj_p=$(this).parents('.subcolumn-tile'),
            navtabSdefault=function(){
                var navObjW=$self.find('>li').parentWidth();
                if(navObjW>$self.parent().width()){
                    // 添加或初始化水平滚动处理
                    if($self.hasClass('swiper-wrapper')){
                        if(!$self.hasClass('flex-start')) $self.addClass('flex-start');
                    }else{
                        $self
                        .addClass("swiper-wrapper flex-start")
                        .wrap("<div class=\"swiper-container swiper-navtab\"></div>").after('<div class="swiper-scrollbar"></div>')
                        .find(">li").addClass("swiper-slide");
                        var swiperNavtab=new Swiper('.swiper-navtab',{
                            slidesPerView:'auto',
                            scrollbar:'.swiper-scrollbar',
                            scrollbarHide:false,
                            scrollbarDraggable:true
                        });
                    }
                    if($navObj_p.length && $('.product-search').length) $navObj_p.height('auto').css({'margin-bottom':10});
                    // 下拉菜单被隐藏特殊情况处理
                    if($self.find('.dropdown').length && $(".swiper-navtab").length){
                        if(!$(".swiper-navtab").hasClass('overflow-visible')) $(".swiper-navtab").addClass("overflow-visible");
                    }
                }else if($self.hasClass('flex-start')){
                    $self.removeClass('flex-start');
                    $navObj_p.css({'margin-bottom':0});
                }
        };
        navtabSdefault();
        $(window).resize(function(){
            navtabSdefault();
        })
        $(this).removeClass('hidden-xs-down');
        // 移动端下拉菜单浮动方向
        Breakpoints.on('xs sm',{
            enter:function(){
                $self.find('.dropdown-menu').each(function(){
                    if($(this).parent('li').offset().left > $(window).width()/2-$(this).parent('li').width()/2){
                        $(this).addClass('dropdown-menu-right');
                    }
                });
            }
        });
    },
    // 单张图片加载完成回调
    imageloadFunAlone:function(fun){
        var img=new Image();
        img.src=$(this).data('original') || $(this).data('lazy') || $(this).attr('src');
        if (img.complete){
            if (typeof fun==="function") fun();
            return;
        }
        img.onload=function(){
            if (typeof fun==="function") fun();
        };
    },
    // 图片加载完成回调
    imageloadFun:function(fun){
        $(this).each(function(){
            if($(this).data('lazy') || $(this).data('original')){//图片延迟加载时
                var thisimg=$(this),
                    loadtime=setInterval(function(){
                        if(thisimg.attr('src')==thisimg.data('original') || thisimg.attr('src')==thisimg.data('lazy')){
                            clearInterval(loadtime);
                            thisimg.imageloadFunAlone(fun);
                        }
                    },100)
            }else if($(this).attr('src')){
                $(this).imageloadFunAlone(fun);
            }
        });
    },
    /**
     * imageSize 图片高度预设及删除
     * @param    {String} imgObj 目标图片类
     */
    imageSize:function(imgObj){
        var imgObj=imgObj||'img';
        $(this).each(function(){
            var scale=$(this).data('scale'),
                $img=$(imgObj,this);
            if(scale && $img.length){
                // 图片高度预设
                var time=setInterval(function(){
                    if($img.attr('src')){
                        $img.height(Math.round($img.width()*scale));
                        clearInterval(time);
                    }
                },50);
                $(window).resize(function(){
                    $img.each(function(){
                        if($(this).attr('src')!=$(this).data('original') && $(this).is(':visible')) $(this).height(Math.round($(this).width()*scale));
                    })
                });
                // 图片高度删除
                $img.each(function(){
                    var $self=$(this);
                    $(this).imageloadFun(function(){
                        $self.height('').removeAttr('height');
                    })
                });
            }
        });
    },
    // 父元素宽度计算
    parentWidth:function(sonNum){
        var sonTrueNum=$(this).length,
            parentObjW=0;
        if(sonNum>sonTrueNum||!sonNum) sonNum=sonTrueNum;
        $(this).each(function(index, el) {
            var sonObjW=$(this).outerWidth()+parseInt($(this).css('marginLeft'))+parseInt($(this).css('marginRight'));
            parentObjW+=sonObjW;
        });
        return parentObjW+sonNum;
    },
    /**
     * scrollFun 窗口距离触发
     * @param  {Number}  top            离窗口触发的距离
     * @param  {Boolean} loop           是否循环触发
     * @param  {Boolean} skip_invisible 是否跳过不可见元素的触发事件
     */
    scrollFun:function(fun,options){
        if (typeof fun==="function") {
            var defaults={
                    top:30,
                    loop:false,
                    skip_invisible:true,
                    is_scroll:false
                };
            $.extend(defaults,options);
            $(this).each(function(){
                var $self=$(this),
                    fun_open=true,
                    windowDistanceFun=function(){// 窗口距离触发回调
                        if(fun_open){
                            var this_t=$self.offset().top,
                                scroll_t=$(window).scrollTop(),
                                this_scroll_t=this_t-scroll_t-$(window).height(),
                                this_scroll_b=this_t+$self.outerHeight()-scroll_t,
                                visible=defaults.skip_invisible?$self.is(":visible"):true;
                            if(this_scroll_t<defaults.top && this_scroll_b>0 && visible){
                                if(!defaults.loop) fun_open=false;
                                fun($self);
                            }
                        }
                    };
                windowDistanceFun();
                // 滚动时窗口距离触发回调
                if(defaults.is_scroll){
                    $(window).scroll(function(){
                        if(fun_open) windowDistanceFun();
                    })
                }
            });
        }
    },
    /**
     * appearDiy 手动appear动画
     * @param  {Boolean} is_reset 是否重置动画
     */
    appearDiy:function(is_reset){
        $(this).each(function(){
            var $self=$(this),
                animation='animation-'+$(this).data('animate');
            if(is_reset){
                // 重置动画
                $(this).removeClass(animation).removeClass('appear-no-repeat').addClass('invisible');
            }else{
                // 执行动画
                $(this).addClass(animation).addClass('appear-no-repeat');
                setTimeout(function(){
                    $self.removeClass('invisible');
                },0)
            }
        });
    },
    /**
     * galleryLoad 画廊
     * @param  {Array} dynamic 自定义图片数组
     */
    galleryLoad:function(dynamic){
        $("body").addClass("met-white-lightGallery");//画廊皮肤
        if(dynamic){
            // 自定义图片数组
            $(this).lightGallery({
                loop:true,
                dynamic:true,
                dynamicEl:dynamic,
                thumbWidth:64,
                thumbContHeight:84
            });
        }else{
            // 默认加载画廊
            $(this).lightGallery({
                selector:'.lg-item-box:not(.slick-cloned)',
                exThumbImage:'data-exthumbimage',
                thumbWidth:64,
                thumbContHeight:84,
                nextHtml:'<i class="iconfont icon-next"></i>',
                prevHtml:'<i class="iconfont icon-prev"></i>'
            });
        }
    },
    // 内页左右区块最小高度设置
    boxMh:function(boxmh_h){
        if($(this).length && $(boxmh_h).length){
            var $self=$(this),
                $boxmh_h=$(boxmh_h),
                box_mh=function(){
                    var boxmh_mh_t=$self.offset().top,
                        boxmh_h_t=$boxmh_h.offset().top,
                        mh=$boxmh_h.outerHeight();
                    if(boxmh_mh_t==boxmh_h_t){//两个区块并排时
                        if(mh!=$boxmh_h.attr('data-height')){
                            $boxmh_h.attr({'data-height':mh});
                            $self.css({'min-height':mh});
                        }
                    }else{
                        $boxmh_h.attr({'data-height':''});
                        $self.css({'min-height':''});
                    }
                };
            box_mh();
            setInterval(function(){
                box_mh();
            },50)
        }
    },
    // 视频尺寸自适应
    videoSizeRes:function(){
        $(this).each(function(){
            var $self=$(this),
                scale=$(this).attr('height')/$(this).attr('width'),
                width=$(this).width();
            if(!scale) scale=parseInt($(this).css('height'))/parseInt($(this).css('width'));
            if(scale){
                $(this).height($(this).width()*scale);
                $(window).resize(function() {
                    if($self.width()<=width) $self.height($self.width()*scale);
                });
            }
        });
    }
});