/*!
 * M['weburl']      网站网址
 * M['lang']        网站语言
 * M['tem']         模板目录路径
 * M['classnow']    当前栏目ID
 * M['id']          当前页面ID
 * M['module']      当前页面所属模块
 * met_prevarrow,
   met_nextarrow    slick插件翻页按钮自定义html
 * M['device_type'] 客户端判断（d：PC端，t：平板端，m：手机端）
 */
$(function(){
    /*导航处理*/
   var aLink=$(".met-nav").find('.dropdown a.nav-link');
    aLink.click(function(){
        if(!Breakpoints.is('xs') && $(this).data("hover")){
            if($(this).attr('target')=='_blank'){
                window.open($(this).attr('href'));
            }else{
                location=$(this).attr('href');
            }
        }
    });
    var nav_li=$(".navlist .dropdown");
    $.fn.hoverDelay = function(options){
        var defaults = {
            // 鼠标经过的延时时间
            hoverDuring: 200,
            // 鼠标移出的延时时间
            outDuring: 0,
            // 鼠标经过执行的方法
            hoverEvent: function(){
                // 设置为空函数，绑定的时候由使用者定义
                $.noop();
            },
            // 鼠标移出执行的方法
            outEvent: function(){
                $.noop();
            }
        };
        var sets = $.extend(defaults,options || {});
        var hoverTimer, outTimer;
        return $(this).each(function(){
            // 保存当前上下文的this对象
            var $this = $(this)
            $this.hover(function(){
                clearTimeout(outTimer);
                hoverTimer = setTimeout(function () {
                    // 调用替换
                    sets.hoverEvent.apply($this);
                }, sets.hoverDuring);
            }, function(){
                clearTimeout(hoverTimer);
                outTimer = setTimeout(function () {
                    sets.outEvent.apply($this);
                }, sets.outDuring);
            });
        });
    };
    // 具体使用，给id为“#test”的元素添加hoverEvent事件
    nav_li.hoverDelay({
        // 自定义，outEvent同
        hoverEvent: function(){
           $(this).addClass('open');
        },
                outEvent: function(){
                   $(this).removeClass('open');
                }
    });
    // 导航下拉菜单三级栏目展开处理
    $met_navlist=$('.met-nav .navlist');
    if(M['device_type']=='d'){
        if($met_navlist.find('.dropdown-submenu').length){
            $met_navlist.find('.dropdown-submenu').hover(function(){
                $(this).parent('.dropdown-menu').addClass('overflow-visible');
            },function(){
                $(this).parent('.dropdown-menu').removeClass('overflow-visible');
            });
        }
    }else{
        if($met_navlist.find('.dropdown-submenu').length){
            setTimeout(function(){
                $met_navlist.find('.dropdown-submenu .dropdown-menu').addClass('block box-shadow-none').prev('.dropdown-item').addClass('dropdown-a');
            },0)
        }
    }
    /*banner只有一张的时候*/
    var bannerlen=$("#exampleCarouselDefault").find('.carousel-item').length;
    if(bannerlen<=1){
        $(".carousel-control").hide();
        $(".carousel-indicators").hide();
    }
    /*banner 自定义高度*/
    var img = $(".met-banner").find('img').eq(0);
    function imgh(){
        img.imageloadFun(function() {
            Breakpoints.on('md lg', {
                enter: function() {
                     $(".carousel-item").each(function(){
                        var ph=$(this).find('img').attr('pch');//pc端
                        if(ph!=0){
                            $(this).find('img').height(ph);
                        }
                    });
                }
            })
            Breakpoints.on('sm', {
                enter: function() {
                     $(".carousel-item").each(function(){
                        var ah=$(this).find('img').attr('adh');//平板
                        if(ah!=0){
                            $(this).find('img').height(ah);
                        }
                    });
                }
            })
            Breakpoints.on('xs', {
                enter: function() {
                     $(".carousel-item").each(function(){
                        var ih=$(this).find('img').attr('iph');//手机端
                        if(ih!=0){
                            $(this).find('img').height(ih);
                        }
                    });
                }
            })
        })
    }
    imgh();
    $(window).resize(function() {
        imgh();
    });
    //简体繁体互换
    var isSimplified = true;
    $('#btn-convert').click(function() {
        if (isSimplified) {
            $('body').s2t();
            isSimplified = false;
            $(this).text('简体');
        } else {
            $('body').t2s();
            isSimplified = true;
            $(this).text('繁體');
        }
    });
    // 底部微信
    if($('#met-weixin').length){
        var $met_weixin=$('#met-weixin');
        Breakpoints.on('xs',{
            enter:function(){
                if($met_weixin.offset().left < 80) $met_weixin.attr({'data-placement':'right'});
                if($(window).width()-$met_weixin.offset().left-$met_weixin.outerWidth() < 80) $met_weixin.attr({'data-placement':'left'});
            }
        })
        if($met_weixin.data('trigger')=='click'){
            $met_weixin.mouseup(function(){
                $(this).click();
            });
        }
    }
    // 底部导航手机端处理
    if($('.met-footnav .mob-masonry .masonry-item').length){
        Breakpoints.get('xs').on({
            enter:function(){
                $('.met-footnav .mob-masonry').masonry({itemSelector:".masonry-item"});
            }
        });
    }
});