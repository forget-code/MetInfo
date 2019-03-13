/*!
 * 前台模板通用功能
 * M['weburl'] 		网站网址
 * M['lang']  		网站语言
 * M['tem']  		模板目录路径
 * M['classnow']  	当前栏目ID
 * M['id']  		当前页面ID
 * M['module']  	当前页面所属模块
 * M['device_type'] 客户端判断（d：PC端，t：平板端，m：手机端）
 * met_prevarrow,
   met_nextarrow    slick插件翻页按钮自定义html
 */
$(function(){
    if(M['classnow']==10001){
        // 首页首屏内动画预加载
        var $met_indexbody1_appear=$('.met-index-body:eq(0) [data-plugin="appear"]');
        if($met_indexbody1_appear.length){
            $met_indexbody1_appear.scrollFun(function(val){
                val.appearDiy();
            });
        }
    }
    // 列表图片高度预设及删除
    var $imagesize=$('.imagesize[data-scale]');
    if($imagesize.length) $imagesize.imageSize();
    // 图片延迟加载
    var $original=$('[data-original]');
    if($original.length){
        metFileLoadFun(M.weburl+'public/ui/v2/static/plugin/jquery.lazyload.min.js',function(){
            return typeof $.fn.lazyload=='function';
        },function(){
            $original.lazyload();
        });
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
    if($('[boxmh-mh]').length) $('[boxmh-mh]').boxMh('[boxmh-h]');//左右区块最小高度设置
    // 侧栏图片列表
    var $sidebar_piclist=$('.sidebar-piclist-ul');
    if($sidebar_piclist.find('.masonry-child').length>1 && typeof $.fn.masonry=='function'){
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
                autoplay=data[3]||false,
                src=data[4],
                vhtml='<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="'+width+'" height="'+height+'" poster="'+poster+'" data-setup=\'{"autoplay":'+autoplay+'}\' webkit-playsinline playsinline x5-playsinline x-webkit-airplay="allow" x5-video-player-type="h5" x5-video-player-fullscreen><source src="'+src+'" type="video/mp4" /></video></div>';
            $(this).after(vhtml).remove();
        });
        $.include(M['weburl']+'public/ui/v1/js/effects/video-js/video-js.css');
        if(M['device_type']=='d'){
            $.include(M['weburl']+"public/ui/v1/js/effects/video-js/video_hack.js",function(){
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
    // 选项卡列表水平滚动处理（需调用swiper插件）
    navtabSwiper:function(){
        var $self=$(this),
            $navObj_p=$(this).parents('.subcolumn-nav'),
            navtabsDefault=function(){
                if(typeof Swiper =='undefined') return false;
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
        navtabsDefault();
        $(window).resize(function(){
            navtabsDefault();
        })
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
            if (typeof fun==="function") fun(img);
            return;
        }
        img.onload=function(){
            if (typeof fun==="function") fun(this);
        };
    },
    // 图片加载完成回调
    imageloadFun:function(fun){
        $(this).each(function(){
            if($(this).data('lazy') || $(this).data('original')){// 图片延迟加载时
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
                $self_scale=$(this),
                $img=$(imgObj,this),
                img_length=$img.length;
            if(!isNaN(scale)) scale=scale.toString();
            // 图片对象筛选
            for (var i = 0; i < img_length; i++) {
                for (var s = 0; s < $img.length; s++) {
                    if($($img[s]).parents('[data-scale]').eq(0).index('[data-scale]')!=$self_scale.index('[data-scale]')){
                        $img.splice(s,1);
                        break;
                    }
                }
                if(s==$img.length) break;
            }
            if($img.length && scale.indexOf('x')>=0){
                scale=scale.split('x');
                scale=scale[0]/scale[1];
                // 图片高度预设
                if($img.attr('src')){
                    $img.height(Math.round($img.width()*scale));
                }else{
                    var time=setInterval(function(){
                        if($img.attr('src')){
                            $img.height(Math.round($img.width()*scale));
                            clearInterval(time);
                        }
                    },30);
                }
                $(window).resize(function(){
                    $img.each(function(){
                        if($(this).is(':visible') && $(this).data('original') && $(this).attr('src')!=$(this).data('original')) $(this).height(Math.round($(this).width()*scale));
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
     * @param  {Number}  top            离窗口触发的距离，默认为30
     * @param  {Boolean} loop           是否循环触发，默认不循环触发
     * @param  {Boolean} skip_invisible 不可见元素的是否触发事件，默认不触发
     */
    scrollFun:function(fun,options){
        if (typeof fun==="function") {
            options=$.extend({
                top:30,
                loop:false,
                skip_invisible:true
            },options);
            $(this).each(function(){
                var $self=$(this),
                    fun_open=true,
                    windowDistanceFun=function(){// 窗口距离触发回调
                        if(fun_open){
                            var this_t=$self.offset().top,
                                scroll_t=$(window).scrollTop(),
                                this_scroll_t=this_t-scroll_t-$(window).height(),
                                this_scroll_b=this_t+$self.outerHeight()-scroll_t,
                                visible=options.skip_invisible?$self.is(":visible"):true;
                            if(this_scroll_t<options.top && this_scroll_b>0 && visible){
                                if(!options.loop) fun_open=false;
                                fun($self);
                            }
                        }
                    };
                windowDistanceFun();
                // 滚动时窗口距离触发回调
                if(fun_open){
                    $(window).scroll(function(){
                        if(fun_open) windowDistanceFun();
                    })
                }
            });
        }
    },
    /**
     * appearDiy 手动appear动画（需调用appear插件）
     */
    appearDiy:function(){
        if(typeof $.fn.appear !='undefined'){
            setTimeout(function(){
                $(this).appear({
                    force_process:true,
                    interval:0
                });
            },300);
        }
    },
    /**
     * galleryLoad 画廊（需调用lightGallery插件）
     * @param  {Array} dynamic 自定义图片数组
     */
    galleryLoad:function(dynamic){
        if(typeof $.fn.lightGallery == 'undefined') return false;
        $("body").addClass("met-lightgallery");//画廊皮肤
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
    },
    // 表格响应式格式化（需调用tablesaw插件）
    tablexys:function(){
        var $self=$(this);
        $(this).addClass('table table-striped table-bordered table-hover').each(function(){
            // if(!$(this).hasClass('tablesaw')) $(this).addClass('tablesaw table-striped table-bordered table-hover tablesaw-sortable tablesaw-swipe').attr({"data-tablesaw-mode":"swipe",'data-tablesaw-sortable':''});
            var $editor=$(this).parents('.met-editor');
            if($(this).width()>$editor.width()){
                $(this).css({'max-width':$editor.width()-parseInt($editor.css('paddingLeft'))-parseInt($editor.css('paddingRight'))});
            }
        })
        Breakpoints.get('xs').on({
            enter:function(){
                $self.each(function(){
                    $(this).wrapAll('<div class="w-full" style="overflow-x: auto;"></div>');
                    // if(!$('thead',this).length){
                    //     var td=$("tbody tr:eq(0) td",this),th='';
                    //     if(td.length==0) td=$("tbody tr:eq(0) th",this);
                    //     td.each(function(){
                    //         th+=$(this).prop('outerHTML');
                    //     });
                    //     if(th.indexOf('</td>')>=0) th=th.replace(/<\/td>/g,'</th>');
                    //     if(th.indexOf('<td')>=0) th=th.replace(/<td/g,'<th');
                    //     $(this).prepend("<thead><tr>"+th+"</tr></thead>");
                    //     $('thead th',this).each(function(index, el) {
                    //         var colspan=parseInt($(this).attr('colspan'));
                    //         if(colspan>1){
                    //             $(this).removeAttr('colspan');
                    //             var outerHTML=$(this).prop('outerHTML'),
                    //                 html='';
                    //             for (var i = 1; i < colspan; i++) {
                    //                 html+=outerHTML;
                    //             }
                    //             $(this).after(html);
                    //         }
                    //     });
                    //     $("tbody tr:eq(0)",this).remove();
                    //     $("td,th",this).attr('width','auto');
                    // }
                });
                // $(document).trigger("enhance.tablesaw");
            }
        });
    }
});
// 加载当前页面js
function metPageJs(js){
    $('body').append('<script src="'+js+'"></script>');
}
// 执行模板UI自定义的函数
function metui(array){
    for (var key in array){
        if(typeof array[key]=='string' && key=='name'){
            METUI[array[key]]=$('.'+array[key]);
        }else if(typeof array[key]=='function'){
            array[key]();
        }
    }
}
window.METUI=[];
window.METUI_FUN=[];