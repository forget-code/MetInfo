/*!
 * M['weburl']      网站网址
 * M['lang']        网站语言
 * M['navurl']      相对于根目录地址
 * M['tem']         模板目录路径
 * M['classnow']    当前栏目ID
 * M['id']          当前页面ID
 * M['module']      当前页面所属模块
 * default_placeholder 开发者自定义默认图片延迟加载方式，'base64'：灰色背景；自定义背景图片路径；'blur'：图片高斯模糊；默认为'blur'
 * met_prevarrow,met_nextarrow slick插件翻页按钮自定义html
 * device_type       客户端判断（d：PC端，t：平板端，m：手机端）
 */
// 网站参数
window.MSTR=document.querySelector('meta[name=\"generator\"]').getAttribute('data-variable').split('|'),
    M=new Array();
M['weburl']=MSTR[0],
M['lang']=MSTR[1],
M['navurl']=MSTR[2],
M['classnow']=parseInt(MSTR[3]),
M['id']=parseInt(MSTR[4]),
M['module']=parseInt(MSTR[5]),
M['tem']=MSTR[0]+'templates/'+MSTR[6]+'/';
M['lang_pack']=MSTR[7];
// 客户端判断
window.useragent=navigator.userAgent,
    useragent_tlc=useragent.toLowerCase(),
    device_type = /iPad/.test(useragent) ? 't' : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(useragent) ? 'm' : 'd',
    is_ucbro=/UC/.test(useragent),
    is_lteie9=false;
// lte IE9浏览器判断
if(new RegExp('msie').test(useragent_tlc)){
    var iebrowser_ver=(useragent_tlc.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
    if(iebrowser_ver<10) is_lteie9=true;
}
// 延迟加载参数(模板前台用户设置)
window.met_placeholder=$('input[name=met_placeholder]').val(),
    met_lazyloadbg_set=$('input[name=met_lazyloadbg_set]').val(),
    met_lazyloadbg=met_lazyloadbg_set||M['navurl'] +'public/ui/v2/static/img/loading.gif',
    met_lazyloadbg_base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC';
if (!!window.ActiveXObject || 'ActiveXObject' in window || is_ucbro) met_lazyloadbg=met_lazyloadbg_base64;
switch(met_placeholder){
    case 'base64':
        met_placeholder=met_lazyloadbg_base64;
        break;
    case 'met_lazyloadbg':
        met_placeholder=met_lazyloadbg;
        break;
    case 'blur':
        met_placeholder='blur';
        break;
}
if(typeof Breakpoints != 'undefined') Breakpoints();// 窗口宽度断点函数
// js严格模式
(function(document, window, $) {
    'use strict';
    var Site=window.Site;
    $(function(){
        Site.run();
        // 中间弹窗隐藏效果优化（点击弹窗框外上下方隐藏弹窗）
        $(document).on('click', '.modal-dialog.modal-center', function(e) {
            if(!$(e.target).closest(".modal-dialog.modal-center .modal-content").length) $(this).parents('.modal').modal('hide');
        });
        // 手机端弹窗位置取消垂直居中
        Breakpoints.on('xs',{
            enter:function(){
                $(document).on('show.bs.modal', '.modal', function(event) {
                    if($('.modal-dialog',this).hasClass('modal-center')) $('.modal-dialog',this).removeClass('modal-center');
                });
            }
        })
        // 弹窗高度过高时，其位置取消垂直居中
        $(document).on('shown.bs.modal', '.modal', function(event) {
            if($('.modal-dialog',this).hasClass('modal-center') && $('.modal-content',this).height()>$(window).height()) $('.modal-dialog',this).removeClass('modal-center');
        });
    })
})(document, window, jQuery);
$.extend({
    /**
     * include 异步加载文件
     * @param  {String}   file 文件路径
     * @param  {function} fun  文件加载完成回调
     */
    include:function(file,fun){
        var files=typeof file=="string" ? [file]:file,
            fileallnum=typeof file=="string" ?1:files.length,
            filenum=0;
        for (var i=0; i < fileallnum; i++){
            var name=files[i].replace(/^\s|\s$/g,""),
                att=name.split('.'),
                ext=att[att.length - 1].toLowerCase().split('?');
            if(ext[0]=='js'){
                var filesi=document.createElement('script');
                filesi.src=name;
                filesi.type="text/javascript";
                if (typeof filesi !="undefined") document.getElementsByTagName('html')[0].appendChild(filesi);
            }else if(ext[0]=='css'){
                var filesi=document.createElement('link');
                filesi.href=name;
                filesi.type='text/css';
                filesi.rel="stylesheet";
                if (typeof filesi !="undefined") document.getElementsByTagName('head')[0].appendChild(filesi);
            }
            // 文件加载完成回调
            if (typeof fun==="function"){
                filesi.onload=filesi.onreadystatechange=function(){
                    var r=filesi.readyState;
                    if (!r || r==='loaded' || r==='complete'){
                        filenum++;
                        if(filenum==fileallnum){
                             filesi.onload=filesi.onreadystatechange=null;
                             fun();
                        }
                    }
                };
            }
        }
    }
});
// ajax多次加载相同文件判断，定义一个全局script的标记数组，用来标记是否某个script已经下载到本地
window.scriptsArray = new Array();
$.cachedScript = function(url, options) {
    //循环script标记数组
    for (var s in scriptsArray) {
        //如果某个数组已经下载到了本地
        if (scriptsArray[s] == url) {
            return { //则返回一个对象字面量，其中的done之所以叫做done是为了与下面$.ajax中的done相对应
                done: function(method) {
                    if (typeof method == 'function') { //如果传入参数为一个方法
                        method();
                    }
                }
            };
        }
    }
    //这里是jquery官方提供类似getScript实现的方法，也就是说getScript其实也就是对ajax方法的一个拓展
    options = $.extend(options || {}, {
        dataType: "script",
        url: url,
        cache: true //其实现在这缓存加与不加没多大区别
    });
    scriptsArray.push(url); //将url地址放入script标记数组中
    return $.ajax(options);
};