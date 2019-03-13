$(function() {
    var video = $(".metvideobox");
    if (video.length && !$('link[href*="video-js.css"]').length && !$(".metvideobox .metvideo").length) {
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
                    if (ext[0]=='js'){
                        var filesi=document.createElement('script');
                        filesi.src=name;
                        filesi.type="text/javascript";
                        if (typeof filesi !="undefined") document.getElementsByTagName('html')[0].appendChild(filesi);
                    } else if (ext[0]=='css'){
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
        $.include('../public/ui/v1/js/effects/video-js/video-js.css');
        video.each(function() {
            var data=$(this).attr("data-metvideo").split("|"),
                width=data[0],
                height=data[1],
                poster=data[2],
                autoplay=data[3],
                src=data[4],
                vhtml='<div class="metvideobox"><video class="metvideo video-js vjs-default-skin" controls preload="none" width="'+width+'" height="'+height+'" poster="'+poster+'" data-setup=\'{\"autoplay\":'+autoplay+'}\'><source src="'+src+'" type="video/mp4" /></video></div>';
            $(this).after(vhtml).remove();
        });
        $.getScript("../public/ui/v1/js/effects/video-js/video_hack.js",function(){
            setTimeout(function(){
                $('.metvideo').videoSizeRes();
            },0)
        });
    }
    if($('.met-editor iframe,.met-editor embed').length) $('.met-editor iframe,.met-editor embed').videoSizeRes();
})
// 视频尺寸自适应
$.fn.videoSizeRes=function(){
    $(this).each(function(){
        var $self=$(this),
            scale=$(this).attr('height')/$(this).attr('width');
        if(!scale) scale=parseInt($(this).css('height'))/parseInt($(this).css('width'));
        if(scale){
            $(this).height($(this).width()*scale);
            $(window).resize(function(){
                if(!$self.hasClass('vjs-fullscreen')) $self.height($self.width()*scale);
            });
        }
    });
}