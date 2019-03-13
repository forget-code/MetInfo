<?php
global $metui;
require_once PATH_WEB.'public/ui/v2/static/metresclass.class.php';// 自定义类
require_once PATH_WEB.'public/ui/v2/static/metuipack.class.php';// UI打包
// 模板引擎url
$metui[url][static2]="{$_M[url][site]}app/system/include/static2/";
$metui[url][static2_vendor]="{$metui[url][static2]}vendor/";
$metui[url][static2_js]="{$metui[url][static2]}js/";
$metui[url][static2_plugin]="{$metui[url][static2_js]}Plugin/";
$metui[url][static2_fonts]="{$metui[url][static2]}fonts/";
$metui[url][uiv2]="{$_M[url][site]}public/ui/v2/";
$metui[url][uiv2_css]="{$metui[url][uiv2]}static/css/";
$metui[url][uiv2_js]="{$metui[url][uiv2]}static/js/";
$metui[url][uiv2_plugin]="{$metui[url][uiv2]}static/plugin/";
$metui[url][tem]="{$_M[url][site]}{$met_skin_url}";
$metui[url][tem_js]="{$metui[url][tem]}static/js/";
$metui[url][tem_css]="{$metui[url][tem]}static/css/";
$metui[url][tem_plugin]="{$metui[url][tem]}static/plugin/";
// 模板框架UI
$metui[paths]=array(
    // 模板框架基础UI
    basic=>array(
        // UI框架基础CSS
        "{$metui[url][static2]}css/bootstrap.min.css",
        "{$metui[url][static2]}css/bootstrap-extend.min.css",
        "{$metui[url][static2]}assets/css/site.min.css",
        // UI框架基础JS
        "{$metui[url][static2_vendor]}babel-external-helpers/babel-external-helpers.min.js",
        "{$metui[url][static2_vendor]}jquery/jquery.min.js",
        "{$metui[url][static2_vendor]}tether/tether.min.js",
        "{$metui[url][static2_vendor]}bootstrap/bootstrap.min.js",
        "{$metui[url][static2_js]}State.min.js",
        "{$metui[url][static2_js]}Component.min.js",
        "{$metui[url][static2_js]}Plugin.min.js",
        "{$metui[url][static2_js]}Base.min.js",
        "{$metui[url][static2_js]}Config.min.js",
        "{$metui[url][static2]}assets/js/Site.min.js",
        // UI框架插件
        "{$metui[url][static2_vendor]}breakpoints/breakpoints.min.js",// 媒体查询
        "{$metui[url][static2_vendor]}modernizr/modernizr.min.js",// 监测浏览器支持
        "{$metui[url][uiv2_js]}ini.js",// 基础配置
    ),
    // IE9兼容
    lteie9=>array(
        "{$metui[url][static2_vendor]}media-match/media.match.min.js",
        "{$metui[url][static2_vendor]}respond/respond.min.js",
        "{$_M['url']['static']}js/classList.min.js",
        url=>$metui[url][uiv2_js],
        name=>'lteie9'
    ),
    // UI框架插件
    // 字体
    web_icons=>"{$metui[url][static2_fonts]}web-icons/web-icons.min.css",
    font_awesome=>"{$metui[url][static2_fonts]}font-awesome/font-awesome.min.css",
    glyphicons=>"{$metui[url][static2_fonts]}glyphicons/glyphicons.min.css",
    stroke=>"{$metui[url][static2_fonts]}7-stroke/7-stroke.min.css",
    // 国旗图标
    flag_icon=>"{$_M['url']['static']}vendor/flag-icon-css/flag-icon.min.css",
    // ajax数据表格
    datatables=>array(
        "{$metui[url][static2_vendor]}datatables/jquery.dataTables.min.js",
        "{$metui[url][static2_vendor]}datatables-bootstrap/dataTables.bootstrap.min.css",
        "{$metui[url][static2_vendor]}datatables-bootstrap/dataTables.bootstrap.min.js",
        "{$metui[url][static2_vendor]}datatables-responsive/dataTables.responsive.min.css",
        "{$metui[url][static2_vendor]}datatables-responsive/dataTables.responsive.min.js"
    ),
    // 响应式表格
    tablesaw=>array(
        "{$metui[url][static2_vendor]}filament-tablesaw/tablesaw.min.css",
        "{$metui[url][static2_vendor]}filament-tablesaw/tablesaw.min.js",
        "{$metui[url][static2_vendor]}filament-tablesaw/tablesaw-init.js"
    ),
    // 弹窗
    bootbox=>array(
        "{$metui[url][static2_vendor]}bootbox/bootbox.min.js",
        "{$metui[url][static2_plugin]}bootbox.min.js"
    ),
    // 弹框
    webuipopover=>array(
        "{$metui[url][static2_vendor]}webui-popover/webui-popover.min.css",
        "{$metui[url][static2_vendor]}webui-popover/jquery.webui-popover.min.js",
        "{$metui[url][static2_plugin]}webui-popover.min.js"
    ),
    // 提示
    alertify=>array(
        "{$metui[url][static2_vendor]}alertify/alertify.min.css",
        "{$metui[url][static2_vendor]}alertify/alertify.js",
        "{$metui[url][static2_plugin]}alertify.min.js"
    ),
    // 显现动画
    appear=>array(
        "{$metui[url][static2_vendor]}jquery-appear/jquery.appear.min.js",
        "{$metui[url][static2_plugin]}jquery-appear.min.js"
    ),
    // 页面动画
    animsition=>array(
        "{$metui[url][static2_vendor]}animsition/animsition.min.css",
        "{$metui[url][static2_vendor]}animsition/animsition.min.js",
        "{$metui[url][static2_plugin]}animsition.min.js"
    ),
    // 按钮加载进度
    ladda=>array(
        "{$metui[url][static2_vendor]}ladda/ladda.min.css",
        "{$metui[url][static2_vendor]}ladda/spin.min.js",
        "{$metui[url][static2_vendor]}ladda/ladda.min.js",
        "{$metui[url][static2_plugin]}ladda.min.js"
    ),
    // 按钮开关
    switchery=>array(
        "{$metui[url][static2_vendor]}switchery/switchery.min.css",
        "{$metui[url][static2_vendor]}switchery/switchery.min.js",
        "{$metui[url][static2_plugin]}switchery.min.js"
    ),
    // 全选、全不选
    selectable=>array(
        "{$metui[url][static2_plugin]}asselectable.min.js",
        "{$metui[url][static2_plugin]}selectable.min.js"
    ),
    // 单选框/复选框
    labelauty=>array(
        "{$metui[url][static2_vendor]}jquery-labelauty/jquery-labelauty.min.css",
        "{$metui[url][static2_vendor]}jquery-labelauty/jquery-labelauty.min.js"
    ),
    // selection下拉框
    select_2=>array(
        "{$metui[url][static2_vendor]}select2/select2.min.css",
        "{$metui[url][static2_vendor]}select2/select2.full.min.js",
        "{$metui[url][static2_plugin]}select2.min.js"
    ),
    // 多选下拉框
    multi_select=>array(
        "{$metui[url][static2_vendor]}multi-select/multi-select.min.css",
        "{$metui[url][static2_vendor]}multi-select/jquery.multi-select.min.js",
        "{$metui[url][static2_plugin]}multi-select.min.js"
    ),
    // 标签输入
    tokenfield=>array(
        "{$metui[url][static2_vendor]}bootstrap-tokenfield/bootstrap-tokenfield.min.css",
        "{$metui[url][static2_vendor]}bootstrap-tokenfield/bootstrap-tokenfield.min.js",
        "{$metui[url][static2_plugin]}bootstrap-tokenfield.min.js"
    ),
    // 点击行内编辑
    x_editable=>array(
        "{$metui[url][static2_vendor]}x-editable/x-editable.min.css",
        "{$metui[url][static2_vendor]}x-editable/bootstrap-editable.min.js",
        "{$metui[url][static2_vendor]}x-editable/address.min.js"
    ),
    // 数量调整
    touchspin=>array(
        "{$metui[url][static2_vendor]}bootstrap-touchspin/bootstrap-touchspin.min.css",
        "{$metui[url][static2_vendor]}bootstrap-touchspin/bootstrap-touchspin.min.js"
    ),
    // 数字微调
    asspinner=>array(
        "{$metui[url][static2_vendor]}asspinner/asSpinner.min.css",
        "{$metui[url][static2_vendor]}asspinner/jquery-asSpinner.min.js",
        "{$metui[url][static2_plugin]}asspinner.min.js"
    ),
    // 日期
    datepicker=>array(
        "{$metui[url][static2_vendor]}bootstrap-datepicker/bootstrap-datepicker.min.css",
        "{$metui[url][static2_vendor]}bootstrap-datepicker/bootstrap-datepicker.min.js",
        "{$metui[url][static2_plugin]}bootstrap-datepicker.min.js"
    ),
    // 时钟
    clockpicker=>array(
        "{$metui[url][static2_vendor]}clockpicker/clockpicker.min.css",
        "{$metui[url][static2_vendor]}clockpicker/bootstrap-clockpicker.min.js",
        "{$metui[url][static2_plugin]}clockpicker.min.js"
    ),
    // 表单验证
    formvalidation=>array(
        "{$metui[url][static2_vendor]}formvalidation/formValidation.min.css",
        "{$metui[url][static2_vendor]}formvalidation/formValidation.min.js",
        "{$metui[url][static2_vendor]}formvalidation/language/zh_CN.js",
        "{$metui[url][static2_vendor]}formvalidation/framework/bootstrap4.min.js",
        "{$metui[url][static2_vendor]}jquery-enplaceholder/jquery.enplaceholder.min.js"
    ),
    // 滚动条
    asscrollable=>array(
        "{$metui[url][static2_vendor]}asscrollable/asScrollable.min.css",
        "{$metui[url][static2_vendor]}asscrollbar/jquery-asScrollbar.min.js",
        "{$metui[url][static2_vendor]}asscrollable/jquery-asScrollable.min.js"
        // "{$metui[url][static2_plugin]}asscrollable.min.js"
    ),
    // 滑动面板
    slidepanel=>array(
        "{$metui[url][static2_vendor]}slidepanel/slidePanel.min.css",
        "{$metui[url][static2_vendor]}slidepanel/jquery-slidePanel.min.js",
        "{$metui[url][static2_plugin]}slidepanel.min.js"
    ),
    // 上传文件
    dropify=>array(
        "{$metui[url][static2_vendor]}dropify/dropify.min.css",
        "{$metui[url][static2_vendor]}dropify/dropify.min.js",
        "{$metui[url][static2_plugin]}dropify.min.js"
    ),
    // 响应式图表
    chartist=>array(
        "{$metui[url][static2_vendor]}chartist/chartist.min.css",
        "{$metui[url][static2_vendor]}chartist/chartist.min.js",
        "{$metui[url][static2_vendor]}chartist-plugin-tooltip/chartist-plugin-tooltip.min.css",
        "{$metui[url][static2_vendor]}chartist-plugin-tooltip/chartist-plugin-tooltip.min.js"
    ),
    // 瀑布流
    masonry=>"{$metui[url][static2_vendor]}masonry/masonry.pkgd.min.js",
    // 导航下拉菜单鼠标经过
    hover_dropdown=>"{$metui[url][static2_vendor]}bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js",
    // 拖动
    jquery_ui=>"{$metui[url][static2_vendor]}jquery-ui/jquery-ui.min.js",
    // 百度编辑器
    ueditor=>array(
        "{$_M[url][site]}app/app/ueditor/ueditor.config.js",
        "{$_M[url][site]}app/app/ueditor/ueditor.all.min.js"
    ),
    // 移动Web界面库
    app=>"{$_M['url']['static']}assets/js/app.min.js",
    // 省市区三级联动
    cityselect=>"{$_M['url']['static']}vendor/select-linkage/jquery.cityselect.js",
    // 外部插件
    // 瀑布流增强
    masonry_extend=>array(
        "{$metui[url][uiv2_plugin]}masonry-extend/imagesloaded.pkgd.min.js",
        "{$metui[url][uiv2_plugin]}masonry-extend/classie.min.js",
        "{$metui[url][uiv2_plugin]}masonry-extend/AnimOnScroll.min.js"
    ),
    // 图片懒加载
    lazyload=>array(
        "{$metui[url][uiv2_plugin]}StackBlur.js",
        "{$metui[url][uiv2_plugin]}lazyload/jquery.lazyload.min.js"
    ),
    // 相册1
    lightgallery=>array(
        "{$metui[url][uiv2]}static/fonts/iconfont/iconfont.css",
        "{$metui[url][uiv2_plugin]}lightGallery/css/lightgallery.min.css",
        "{$metui[url][uiv2_plugin]}lightGallery/js/lightgallery.min.js",
        "{$metui[url][uiv2_plugin]}lightGallery/js/lg-fullscreen.min.js",
        "{$metui[url][uiv2_plugin]}lightGallery/js/lg-thumbnail.min.js",
        "{$metui[url][uiv2_plugin]}lightGallery/js/lg-zoom.min.js"
    ),
    // 相册2
    photoswipe=>array(
        "{$metui[url][uiv2_plugin]}PhotoSwipe/photoswipe.min.css",
        "{$metui[url][uiv2_plugin]}PhotoSwipe/default-skin/default-skin.min.css",
        "{$metui[url][uiv2_plugin]}PhotoSwipe/photoswipe.min.js",
        "{$metui[url][uiv2_plugin]}PhotoSwipe/photoswipe-ui-default.min.js",
        "{$metui[url][uiv2_plugin]}PhotoSwipe/photoswipe-plugin.js"
    ),
    // 触摸滑动
    swiper=>array(
        "{$metui[url][uiv2_plugin]}swiper/swiper-3.3.1.min.css",
        "{$metui[url][uiv2_plugin]}swiper/swiper-3.3.1.jquery.min.js"
    ),
    // 响应式图片切换、旋转木马
    slick=>array(
        "{$metui[url][uiv2_plugin]}slick/slick.min.css",
        "{$metui[url][uiv2_plugin]}slick/slick-theme.min.css",
        "{$metui[url][uiv2_plugin]}slick/slick.min.js"
    ),
    // 页面加载进度条
    nprogress=>array(
        "{$metui[url][uiv2_plugin]}NProgress/nprogress.min.css",
        "{$metui[url][uiv2_plugin]}NProgress/nprogress.min.js"
    ),
    // 上传文件
    // fileinput=>"{$_M[url][site]}app/system/web/user/templates/met/static/plugin/fileinput.min.js",
    // 模板框架公共UI
    common_js=>"{$metui[url][uiv2_js]}common.js",
    common_css=>"{$metui[url][uiv2_css]}common.css",
    form=>"{$metui[url][uiv2_js]}form.js",
    datatable=>"{$metui[url][uiv2_js]}datatable.js"
);
if($metuipack->isLteIe9) $resui_lteie9=$metuipack->getUi($metui[paths][lteie9],'','',true);// IE9兼容JS打包生成文件，返回文件路径
?>