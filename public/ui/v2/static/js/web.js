/*
应用前台通用功能
 */
$(function(){
    var wh=$(window).height(),
        $met_navlist=$('.met-nav .navlist');
    if($met_navlist.length){
        // 导航点击跳转处理
        $met_navlist.find('.nav-link').click(function(){
            if(M['device_type']=='d' && !Breakpoints.is('xs') && $(this).data("hover")) location=$(this).attr('href');
        });
        // 导航下拉菜单三级栏目展开处理
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
        // 导航顶级栏目过多时换行处理
        var met_navlist_position=function(){
            if(!Breakpoints.is('xs') && $met_navlist.position().top>20){
                $met_navlist.addClass('flex').parent().addClass('flex-navlist');
            }else{
                $met_navlist.removeClass('flex').parent().removeClass('flex-navlist');
            }
        };
        met_navlist_position();
        $(window).resize(function(){
            met_navlist_position();
        });
    }
    // 手机端头部会员中心与导航下拉菜单切换
    $('.met-nav .navbar-toggler').click(function() {
        $(this).toggleClass('active');
        $(this).siblings('.navbar-toggler').removeClass('active');
        var $other_collapse=$($(this).siblings('.navbar-toggler').data('target'));
        if($other_collapse.is(':visible')) $other_collapse.collapse('hide');
    });
    // 加载系统功能
    if(M['classnow']) $.include(M['url']['uiv2_js']+'sys.js');
});