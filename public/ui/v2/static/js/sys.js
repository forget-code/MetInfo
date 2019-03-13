/*
系统功能
 */
$(function() {
    // 在线客服
    $.ajax({
        type: "POST",
        url: M['weburl'] + "online/?lang="+M['lang'],
        dataType: "json",
        success: function(result) {
            result.t=parseInt(result.t);
            if(result.t){
                // 插入在线客服弹框html
                $.include(M['weburl'] + "public/css/online.css");
                result.html=result.html.replace(" onclick='return onlineclose();'",'').replace(" onclick='return onlinemin();'",'');
                $('body').append(result.html);
                // 弹框定位
                var $onlinebox=$('#onlinebox'),
                    position=result.t>2?'fixed':'absolute';
                result.x=parseInt(result.x);
                result.y=parseInt(result.y);
                $onlinebox.css({position:position,top:result.y,bottom:'auto'});
                if(result.t%2){
                    $onlinebox.css({left:result.x,right:'auto'});
                }else{
                    $onlinebox.css({right:result.x,left:'auto'});
                }
                if(Breakpoints.is('xs')) $onlinebox.addClass('min');
                setTimeout(function(){
                    $onlinebox.show();
                    // 窗口随屏幕滚动
                    if(result.t<3){
                        var onlineboxTop=function(){
                                var oy = ($(window).scrollTop()+result.y - parseInt($onlinebox.offset().top)) * 0.08;
                                oy = (oy > 0 ? 1 : -1) * Math.ceil(Math.abs(oy));
                                var top=parseInt($onlinebox.offset().top+oy);
                                $onlinebox.css({top:top});
                            };
                        $onlinebox.css({top:$(window).scrollTop()+result.y});
                        setInterval(function() {
                            onlineboxTop();
                        }, 10)
                    }
                },100)
                // 展开悬浮框
                $(document).on("click",".onlinebox-open",function(e){
                    e.preventDefault();
                    $onlinebox.removeClass('min');
                    $(this).hide();
                })
                // 最小化悬浮框
                $(document).on("click",".onlinebox-min",function(e){
                    e.preventDefault();
                    $onlinebox.addClass('min');
                    $('.onlinebox-open').show();
                })
                // 关闭悬浮框
                $(document).on("click",".onlinebox-close",function(e){
                    e.preventDefault();
                    $onlinebox.hide();
                })
            }
        }
    })
})