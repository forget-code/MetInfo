/*!
 * M['weburl']      网站网址
 * M['lang']        网站语言
 * M['tem']         模板目录路径
 * M['classnow']    当前栏目ID
 * M['id']          当前页面ID
 * M['module']      当前页面所属模块
 * M['metinfo_version'] 系统当前版本
 * M['user_name']   当前页面登录用户名
 * met_prevarrow,met_nextarrow slick插件翻页按钮自定义html
 * device_type      客户端判断（d：PC端，t：平板端，m：手机端）
 */
// 网站参数
window.MSTR=$('meta[name=generator]').data('variable').split('|'),
    M=[];
M['weburl']=MSTR[0];
M['lang']=MSTR[1];
M['classnow']=MSTR[2]==''?MSTR[2]:parseInt(MSTR[2]);
M['id']=MSTR[3]==''?MSTR[3]:parseInt(MSTR[3]);
M['module']=MSTR[4]==''?MSTR[4]:parseInt(MSTR[4]);
M['tem']=MSTR[0]+'templates/'+MSTR[5]+'/';
M['metinfo_version']=$('meta[name=generator]').length?$('meta[name=generator]').attr('content').replace('MetInfo ','').replace(/\./g,''):'metinfo';
M['user_name']=$('meta[name=generator]').data('user_name')||'';
// 客户端判断
window.useragent=navigator.userAgent,
    useragent_tlc=useragent.toLowerCase(),
    device_type = /iPad/.test(useragent) ? 't' : /Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Silk/.test(useragent) ? 'm' : 'd',
    is_ucbro=/UC/.test(useragent),
    is_lteie9=is_ie10=false;
// lte IE9、IE10浏览器判断
if(new RegExp('msie').test(useragent_tlc)){
    var iebrowser_ver=(useragent_tlc.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
    if(iebrowser_ver==10) is_ie10=true;
    if(iebrowser_ver<10) is_lteie9=true;
}
// 延迟加载参数(模板前台用户设置)
window.met_lazyloadbg=$('input[name=met_lazyloadbg]').val()||M['weburl'] +'public/ui/v2/static/img/loading.gif',
met_lazyloadbg_base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC';
if(met_lazyloadbg.indexOf(M['weburl'])<0 && met_lazyloadbg.indexOf('http')<0 && met_lazyloadbg.indexOf('../')<0) met_lazyloadbg=M['weburl']+met_lazyloadbg;
if(met_lazyloadbg==M['weburl'] || (met_lazyloadbg.indexOf('.png')<0 && met_lazyloadbg.indexOf('.gif')<0 && met_lazyloadbg.indexOf('.jpg')<0)) met_lazyloadbg=M['weburl'] +'public/ui/v2/static/img/loading.gif';
if (!!window.ActiveXObject || 'ActiveXObject' in window || is_ucbro) met_lazyloadbg=met_lazyloadbg_base64;
if(typeof Breakpoints != 'undefined') Breakpoints();// 窗口宽度断点函数
// js严格模式
(function(document, window, $) {
    'use strict';
    var Site=window.Site;
    $(function(){
        Site.run();
        // 中间弹窗隐藏效果优化（点击弹窗框外上下方隐藏弹窗）
        $(document).on('click', '.modal-dialog.modal-center', function(e) {
            if(!$(e.target).closest(".modal-dialog.modal-center .modal-content").length) $(this).parents('.modal:eq(0)').modal('hide');
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
window.includeFile=[];
window.includeFileIndex=0;
window.includeFileNum=0;
$.extend({
    /**
     * 异步加载文件
     * @param String   file      文件路径
     * @param Number   num_start 文件加载排序开始值
     * @param Number   num_end   文件加载排序结束值
     * @param Function fun       回调函数
     */
    includeFile:function(file,num_start,num_end,fun,special){
        var name=file.replace(/^\s|\s$/g,""),
            att=name.split('.'),
            ext=att[att.length - 1].toLowerCase().split('?'),
            loadFun=function(){
                includeFileIndex++;
                if(includeFileIndex<num_end){
                    $.includeFile(includeFile[includeFileIndex],num_start,num_end,fun,special);
                }else{
                    if(special=='siterun') Site.run();
                    if(typeof fun === "function") fun();
                }
            };
        if(includeFileIndex>=num_start && includeFileIndex<num_end){
            if(ext[0]=='js'){
                var filesi=document.createElement('script'),
                    src=name+'?'+M['metinfo_version'];
                filesi.src=src;
                filesi.type="text/javascript",
                file_index=$.inArray(name,includeFile);
                if(includeFileIndex>file_index){
                    loadFun();
                }else{
                    if(($('script[src="'+src+'"]').length && includeFileIndex==file_index) || (!$('script[src="'+src+'"]').length && typeof filesi !="undefined")){
                        document.getElementsByTagName('html')[0].appendChild(filesi);
                    }else{
                        setTimeout(function(){
                            $.includeFile(file,num_start,num_end,fun,special);
                        },10)
                        return false;
                    }
                    // 文件加载完成回调
                    filesi.onload=filesi.onreadystatechange=function(){
                        var r=filesi.readyState;
                        if (!r || r==='loaded' || r==='complete'){
                            filesi.onload=filesi.onreadystatechange=null;
                            loadFun();
                        }
                    };
                }
            }else if(ext[0]=='css'){
                var filesi=document.createElement('link'),
                    href=name+'?'+M['metinfo_version'];
                filesi.href=href;
                filesi.type='text/css';
                filesi.rel="stylesheet";
                if(!$('link[href="'+href+'"]').length && typeof filesi !="undefined") document.getElementsByTagName('head')[0].appendChild(filesi);
                if($('link[href="'+href+'"]').length) loadFun();// 文件加载完成回调
            }
        }else if(includeFileIndex<num_start){
            setTimeout(function(){
                if(includeFileIndex<num_end) $.includeFile(includeFile[includeFileIndex],num_start,num_end,fun,special);
            },10)
        }
    },
    /**
     * include 异步加载文件集合
     * @param  {String}   file 文件路径
     * @param  {function} fun  文件加载完成回调
     */
    include:function(file,fun,special){
        var files=typeof file=="string" ? [file]:file,
            fileallnum=typeof file=="string" ?1:files.length,
            num_start=includeFileNum,
            num_end=num_start+fileallnum;
        includeFileNum+=fileallnum;
        includeFile=includeFile.concat(files);
        $.includeFile(includeFile[num_start],num_start,num_end,fun,special);
    }
});
// ajax多次加载相同文件判断，定义一个全局script的标记数组，用来标记是否某个script已经下载到本地
window.scriptsArray = [];
$.cachedScript = function(url, options) {
    // 循环script标记数组
    for (var s in scriptsArray) {
        // 如果某个数组已经下载到了本地
        if (scriptsArray[s] == url) {
            return { // 则返回一个对象字面量，其中的done之所以叫做done是为了与下面$.ajax中的done相对应
                done: function(method) {
                    if (typeof method == 'function') { // 如果传入参数为一个方法
                        method();
                    }
                }
            };
        }
    }
    // 这里是jquery官方提供类似getScript实现的方法，也就是说getScript其实也就是对ajax方法的一个拓展
    options = $.extend(options || {}, {
        dataType: "script",
        url: url,
        cache: true // 其实现在这缓存加与不加没多大区别
    });
    scriptsArray.push(url); // 将url地址放入script标记数组中
    return $.ajax(options);
};