/**
 * 页面可视化设置
 */
// 弹框中百度编辑器插件所需变量
var siteurl=M['weburl'],
    lang = M['lang'],
    editable_ue_val=[];// 百度编辑器内容数组
// 页面弹框、iframe
var $page_iframe=$('.page-iframe'),
    $config_modal=$(".config-modal"),
    $blockset_modal=$('.blockset-modal'),
    $blockset_iframe=$('.blockset-iframe'),
    $ueeditor_modal=$('.ueeditor-modal'),
    $content_modal=$(".content-modal"),
    $content_iframe=$('.content-iframe'),
    $img_modal=$(".img-modal"),
    $img_iframe=$('.img-iframe'),
    $nav_modal=$('.nav-modal'),
    $icon_modal=$('.icon-modal');
$(function(){
    // 禁止点击背景关闭弹窗和键盘关闭弹窗
    $('.modal').attr({'data-keyboard':false,'data-backdrop':false});
    // 页面刷新时保存cookie-iframe当前url
    window.onbeforeunload = function(){
        var dynamic=$page_iframe.attr('data-dynamic');
        if(typeof dynamic != 'undefined') setCookie('page_iframe_url',dynamic);
    }
    // 页面弹框关闭后操作
    $(document).on('hide.bs.modal', '.modal', function(event) {
        // 刷新可视化窗口
        var $iframe=$('iframe:visible',this),
            $contents=$iframe.contents();
        if($iframe.length && $iframe.prop('contentWindow').location.href.indexOf('turnovertext')>=0) $page_iframe.prop('contentWindow').location.reload();
        // 弹框隐藏时隐藏弹框中iframe中的弹框
        $contents.find('.modal .close').click();
        // 隐藏图片添加组件弹框
        $contents.find('.popover .outside-cancel').click();
    });
    // 弹窗中iframe返回上一页
    $(document).on('click', '.iframe-goback', function(event) {
        $(this).parents('.modal').find('iframe:visible').prop('contentWindow').history.go(-1);
    });
    // iframe中页面跳转地址加参数pageset=1
    $('iframe').hrefPageset();
    // 页面头部
    $('.page-head-nav [data-url]').click(function(event) {
        var index=$(this).index('.page-head-nav [data-url]'),
            src=$(this).data('url')+'&pageset=1',
            $this_iframe=$('.nav-iframe[data-index='+index+']');
        if(!$('.nav-iframe[data-index='+index+']').length){
            $nav_modal.find('.modal-body').append('<iframe src="'+src+'" class="nav-iframe h-100p" data-index="'+index+'" frameborder="0" width="100%"></iframe>');
            $this_iframe=$('.nav-iframe[data-index='+index+']');
            $this_iframe.hrefPageset();
        }
        $('.nav-iframe').hide();
        $this_iframe.attr({src:src});
        $this_iframe.show();
        if($(this).hasClass('nav-tem-choose')){
            $nav_modal.addClass('tem-choose-modal');
        }else{
            $nav_modal.removeClass('tem-choose-modal');
        }
        $nav_modal.modal().find('.modal-title').html('<a href="'+src+'">'+$(this).attr('title')+'</a>');
    });
    // 页面头部弹窗-弹窗标题点击回到初始页面
    $(document).on('click', '.nav-modal .modal-title a', function(event) {
        event.preventDefault();
        $nav_modal.find('.nav-iframe:visible').prop('contentWindow').location.href=$(this).attr('href');
    });
    // 当前页面参数、风格设置参数弹框
    $('.config-page,.config-public').click(function(event) {
        var config_type='#'+$(this).attr('id'),
            $page_iframe_contents=$page_iframe.contents(),
            page_iframe_window=$page_iframe.prop('contentWindow');
        if($(this).hasClass('config-page') && page_iframe_window.M['module']=='10001') config_type='#config-index';
        $config_modal.find('input[name=config_type]').val(config_type);
        var $config_iframe=$(config_type+'-iframe');
        $('.config-iframe').hide();
        $config_iframe.show();
        if(config_type=='#config-index'){// 当前页面为首页时直接打开后台基本信息页面
            if($config_iframe.attr('src') && $config_iframe.prop('contentWindow').location.href==$config_iframe.attr('src')){
                $config_modal.modal();
            }else{
                $config_iframe.attr({src:$(this).data('index_src')+'&pageset=1'}).load(function() {
                    $config_modal.modal().find('.modal-title').html(METLANG.indexbasicinfo);
                    var $config_iframe_contents=$(this).contents(),
                        $dls=$config_iframe_contents.find('input[name=met_footright]').parents('dl').prev('h3.v52fmbx_hr').nextUntil();
                    $config_iframe_contents.find('input[name=met_logo]').parents('dl').hide();
                    $dls.hide().prev('h3.v52fmbx_hr').hide();
                });
            }
        }else if(!$config_iframe.attr('src')){
            $config_iframe.attr({src:$(this).data('src')}).load(function() {
                $config_modal.modal();
            });
        }else if(config_type=='#config-public' && $config_iframe.contents().find('[name=met_skin_user]').val() !=page_iframe_window.MSTR[5]){
            $config_iframe.prop('contentWindow').location.reload();
        }else{
            $config_modal.modal();
        }
    });
    // 当前页面参数、风格设置参数保存
    $config_modal.find('button[type=submit]').click(function(event) {
        var $config_iframe=$($config_modal.find('input[name=config_type]').val()+'-iframe'),
            $submit=$config_iframe.contents().find('.set-block-form .submit');
        if(!$submit.length) $submit=$config_iframe.contents().find('form .submit[type=submit]');
        $submit.click();
    });
    // 系统功能大全弹框
    $(document).on('show.bs.modal', '.functionEncy-modal', function(event) {
        $('.functionEncy-iframe').attr({src:$('.functionEncy-iframe').data('src')});
    })
    // 头部导航栏清除缓存按钮
    $('.clear-cache').click(function(event) {
        event.preventDefault();
        metAlert(METLANG.clearCache+'...',0);
        $.ajax({
            url: $(this).attr('href'),
            type: 'POST',
            dataType: 'json',
            success:function(result){
                if(parseInt(result.status)){
                    metAlert('',500);
                    setTimeout(function(){
                        window.location.reload();
                    },500)
                }
            }
        });
    });

    // 可视化iframe部分
    $page_iframe.load(function() {
        var $page_iframe_contents=$(this).contents(),
            page_iframe_window=$(this).prop('contentWindow'),
            page_iframe_document=page_iframe_window.document;
        if(!page_iframe_window.M){
            // 网站参数
            page_iframe_window.MSTR=$('meta[name=generator]',page_iframe_document).data('variable');
            if(page_iframe_window.MSTR && page_iframe_window.MSTR.indexOf(',')>=0) page_iframe_window.MSTR=page_iframe_window.MSTR.split(',');
            if(page_iframe_window.MSTR && page_iframe_window.MSTR.indexOf('|')>=0) page_iframe_window.MSTR=page_iframe_window.MSTR.split('|');
            if(page_iframe_window.MSTR){
                page_iframe_window.M=[];
                page_iframe_window.M['weburl']=page_iframe_window.MSTR[0];
                page_iframe_window.M['lang']=page_iframe_window.MSTR[1];
                page_iframe_window.M['classnow']=parseInt(page_iframe_window.MSTR[2]);
                page_iframe_window.M['id']=parseInt(page_iframe_window.MSTR[3]);
                page_iframe_window.M['module']=parseInt(page_iframe_window.MSTR[4]);
                page_iframe_window.M['tem']=page_iframe_window.MSTR[0]+'templates/'+page_iframe_window.MSTR[5]+'/';
            }
        }
        if(page_iframe_window.M){// 支持可视化的模板
            $page_iframe_contents.pageinfo();// 页面输出值的标签处理
            // 添加文字编辑按钮和区块设置组件
            var pageset_html="<link rel='stylesheet' type='text/css' href='"+M['weburl']+"app/system/ui_set/admin/templates/cache/page_iframe.css'>"
                +"<div class='pageset-btn'>"
                    +"<button type='button' class='btn btn-xs btn-primary m-r-5 pageset-set'>"+METLANG.unitytxt_39+"</button>"
                    +"<button type='button' class='btn btn-xs btn-warning pageset-content'>"+METLANG.content+"</button>"
                +"</div>"
                +"<div class='pageeditor-btn'>"
                    +"<span class='pageeditor-remark' hidden data-url='' data-rows='3'></span>"
                    +"<button class='btn btn-floating btn-success btn-xs p-0 pageeditor-editor' data-getcontent-url='"+basepath+"index.php?n=ui_set&c=index&a=doget_text_content&anyid=18&lang="+M['lang']+"' data-setcontent-url='"+basepath+"index.php?n=ui_set&c=index&a=doset_text_content&anyid=18&lang="+M['lang']+"'><i class='icon wb-pencil' aria-hidden='true'></i></button>"
                +"</div>";
            $page_iframe_contents.find("html").append(pageset_html);
        }
        if($('meta[name=generator]',page_iframe_document).length && $('meta[name="generator"]',page_iframe_document).attr('content').indexOf('MetInfo')>=0){
            var new_url=page_iframe_window.location.href;
            // 更新iframe的动态url信息
            $page_iframe.attr({'data-dynamic':new_url});
            // 更新预览按钮链接
            new_url=new_url.replace('&pageset=1','').replace('?pageset=1','');
            $('.pageset-view').attr({href:new_url});
        }
        // 右键菜单
        $('[met-imgmask]',page_iframe_document).contextMenu();

        // 样式、所选内容设置
        var $pageset_btn=$page_iframe_contents.find('.pageset-btn'),
            $pageset_set=$pageset_btn.find('.pageset-set'),
            $pageset_content=$pageset_btn.find('.pageset-content');
        // 鼠标经过区块显示区块设置按钮
        $(page_iframe_document).on('mouseover','*',function(e){
            var $self=$(e.target).closest("[m-id]"),
                mid=$self.attr('m-id'),
                block_change=false,
                self_info=[],
                positionFun=function(){
                    if(typeof $self!='undefined'){
                        if($self.css('position')=='fixed'){
                            self_info.left=$self.position().left,
                            self_info.top=$self.position().top,
                            self_info.position='fixed';
                        }else{
                            self_info.left=$self.offset().left,
                            self_info.top=$self.offset().top,
                            self_info.position='';
                        }
                        self_info.index=$page_iframe_contents.find('[m-id]').index($self);
                    }
                };
            if(typeof $self.prop('tagName')=='undefined') return false;
            // 判断是否切换区块框
            if(mid==$pageset_set.attr('data-mid')){
                positionFun();
                if(self_info.index!=$pageset_set.attr('data-index')) block_change=true;
            }else{
                block_change=true;
            }
            // 切换区块
            if(block_change){
                $page_iframe_contents.find('[m-id]').removeClass('set');
                $self.addClass('set');
                setTimeout(function(){
                    var type=$self.attr('m-type')||'';
                    positionFun();
                    $pageset_btn.css({position:self_info.position,left:self_info.left+$self.outerWidth()/2,top:self_info.top}).find('.btn').attr({'data-mid':mid,'data-type':type});
                    $pageset_set.attr({'data-index':self_info.index});
                    if(mid=='noset'){
                        $pageset_set.hide();
                    }else{
                        $pageset_set.show();
                    }
                    if(type=='nocontent'){
                        $pageset_content.hide();
                    }else{
                        $pageset_content.show();
                    }
                },50)
            }
        });
        // 弹出区块设置框
        $pageset_set.pagesetModal();
        // 弹出区块内容框
        $pageset_content.click(function(event) {
            var mid=$(this).attr('data-mid'),
                type=$(this).attr('data-type')||null,
                $mid=$page_iframe_contents.find('[m-id='+mid+'][m-type='+type+']');
            $content_modal.modal();
            $content_iframe.hide();
            var id=$mid.find('[name=id]').length?$mid.find('[name=id]').val():(page_iframe_window.M['id']?page_iframe_window.M['id']:''),
                classnow=$mid.find('[name=class]').length?$mid.find('[name=class]').val():($mid.find('[name=id]').length?$mid.find('[name=id]').val():page_iframe_window.M['classnow']),
                table='';
            $.ajax({
                url: $content_iframe.data('src'),
                type: 'POST',
                dataType: 'json',
                data: {
                    mid:mid,
                    type:type,
                    id:id,
                    classnow:classnow,
                    module:page_iframe_window.M['module']
                },
                success:function(result){
                    if(result.url){
                        $content_iframe.attr({src:result.url+'&pageset=1'}).show();
                        $content_modal.find('.modal-title').text('');
                    }
                }
            });
        });

        // 文字、图片编辑
        var $pageeditor_btn=$page_iframe_contents.find('.pageeditor-btn'),
            $pageeditor_editor=$pageeditor_btn.find('.pageeditor-editor'),
            $pageeditor_remark=$pageeditor_btn.find('.pageeditor-remark');
        // 鼠标经过可编辑文字、图片显示编辑按钮
        $(page_iframe_document).on('mouseover','.editable-click,img[met-id],.met-icon',function(e){
            if($pageeditor_btn.find('.editable-container').length) return false;
            var obj='';
            if($(e.target).prop('tagName')=='IMG'){
                obj='img';
            }else if($(e.target).hasClass('met-icon')){
                obj='.met-icon';
            }else{
                obj='.editable-click';
            }
            var $self=$(e.target).closest(obj);
            if($self.parents('[m-type]').attr('m-type')=='displayimgs') return false;
            if(obj=='img' && typeof $self.attr('met-id')=='undefined') return false;
            if($self.parents('.met-editor').length){
                $self=$self.parents('[met-id]:eq(0)');
                obj='.met-editor';
            }
            var left=$self.offset().left,
                top=$self.offset().top,
                position_fixed=$self.css('position')=='fixed'?true:false;
            $self.parents().each(function(index, el) {
                if($(el).css('position')=='fixed'){
                    position_fixed=true;
                    return false;
                }
            });
            if(position_fixed){
                top-=$page_iframe_contents.scrollTop();
                var position='fixed';
            }else{
                var position='';
            }
            if(obj=='img') top+=$self.outerHeight()/2-10;
            $pageeditor_btn.css({left:left+$self.outerWidth()/2,top:top,position:position});
            $pageeditor_remark.editable('hide');
            $pageeditor_editor.show().attr({'data-obj':obj,'data-index':$page_iframe_contents.find(obj).index($self)});
            $('.editable-click,img,.met-icon',page_iframe_document).removeClass('set');
            $self.addClass('set');
        })
        // 鼠标移出设置元素，隐藏设置元素外边框
        $(page_iframe_document).on('mouseout','.editable-click,img,.met-icon',function(e){
            if($pageeditor_btn.find('.editable-container').length) return false;
            var obj='';
            if($(e.target).prop('tagName')=='IMG'){
                obj='img';
            }else if($(e.target).hasClass('met-icon')){
                obj='.met-icon';
            }else{
                obj='.editable-click';
            }
            var $self=$(e.target).closest(obj);
            if($(e.target).closest(obj).parents('.met-editor').length){
                $self=$self.parents('[met-id]:eq(0)');
            }
            $self.removeClass('set');
        })
        // 鼠标移到编辑按钮，显示对应的设置元素的外边框
        $pageeditor_editor.hover(function(event) {
            $($(this).attr('data-obj'),page_iframe_document).eq($(this).attr('data-index')).addClass('set');
        },function(){
            $($(this).attr('data-obj'),page_iframe_document).eq($(this).attr('data-index')).removeClass('set');
        });
        // 编辑按钮点击显示输入框
        $pageeditor_editor.click(function(event) {
            // 计算输入框样式尺寸
            var $editable_click=$page_iframe_contents.find($(this).attr('data-obj')).eq($(this).attr('data-index'));
            if($(this).attr('data-obj')=='img'){
                // 弹出图片上传框
                $img_modal.find('input[name=obj_img]').val($(this).attr('data-index'));
                if($img_iframe.attr('src')){
                    $img_modal.modal();
                }else{
                    $img_iframe.attr({src:$img_iframe.data('src')}).load(function() {
                        $img_modal.modal();
                    })
                }
            }else if($(this).attr('data-obj')=='.met-icon'){
                // 弹出图标选择框
                $icon_modal.modal().find('button[type=submit]').attr({'data-index':$(this).attr('data-index')});
                if(!$icon_modal.find('.modal-body').html()){
                    $.ajax({
                        url: $icon_modal.find('button[type=submit]').data('get_url'),
                        type: 'POST',
                        dataType: 'html',
                        success:function(html){
                            $icon_modal.find('.modal-body').html(html);
                        }
                    });
                }
            }else{
                // 获取输入框的显示内容
                $.ajax({
                    url: $(this).data('getcontent-url'),
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        table: $editable_click.attr('met-table'),
                        field: $editable_click.attr('met-field'),
                        id: $editable_click.attr('met-id')
                    },
                    success:function(result){
                        if(parseInt(result.status)){
                            if($editable_click.hasClass('met-editor')){
                                // 显示百度编辑器
                                if($('script[src*="ueditor.config.js"]').length){
                                    editableUe($editable_click,result.text);
                                }else{
                                    $.include([M['weburl']+'app/app/ueditor/ueditor.config.js',M['weburl']+'app/app/ueditor/ueditor.all.min.js'],function(){
                                        editableUe($editable_click,result.text);
                                    })
                                }
                            }else{
                                // 显示输入框
                                var width=$editable_click.width(),
                                    height=$editable_click.height(),
                                    lh=parseInt($editable_click.css('line-height')),
                                    type=(result.type==3 || height>2*lh)?'textarea':'text',
                                    text_l=$editable_click.text().length,
                                    text_fz=$editable_click.css('font-size'),
                                    text_ls=$editable_click.css('letter-spacing');
                                // 判断文字长度是否大于文字框宽度，大于则显示多行编辑框
                                if(width>500) type='textarea';
                                width=width>500?500:width;
                                text_fz=text_fz.indexOf('px')>=0?parseInt(text_fz):14;
                                text_ls=text_ls.indexOf('px')>=0?parseInt(text_ls):0;
                                var text_w=(text_fz*0.6+text_ls)*text_l;
                                if(text_w>width) type='textarea';
                                // 弹出显示框
                                $pageeditor_remark.editable('destroy').html(result.text).editable({
                                    type: type,
                                    pk: 1,
                                    name: 'tagcontent',
                                    mode:'inline'
                                })
                                $pageeditor_remark.editableform.buttons='<button type="submit" class="btn btn-primary btn-xs editable-submit"><i class="wb-check"></i></button><button type="button" class="btn btn-default btn-xs editable-cancel"><i class="wb-close"></i></button>';
                                $pageeditor_remark.editable('show');
                                $pageeditor_btn.find('.editable-container .editable-input .form-control').width(width);
                                $pageeditor_editor.hide();
                                // 调整显示框位置
                                var top=$pageeditor_btn.offset().top,
                                    left=$pageeditor_btn.offset().left,
                                    pageeditor_btn_h=$pageeditor_btn.outerHeight(),
                                    pageeditor_btn_w=$pageeditor_btn.outerWidth(),
                                    wscroll=$(page_iframe_window).scrollTop(),
                                    window_h=$(page_iframe_window).height(),
                                    window_w=$(page_iframe_window).width(),
                                    pageeditor_btn_distance=[],
                                    pageeditor_btn_position=[];
                                    pageeditor_btn_distance['left']=left-pageeditor_btn_w/2;
                                    pageeditor_btn_distance['right']=window_w-(left+pageeditor_btn_w/2);
                                    pageeditor_btn_distance['bottom']=window_h-(top+(pageeditor_btn_h)-wscroll);
                                if(pageeditor_btn_distance['left']<0){
                                    $pageeditor_btn.css({left:pageeditor_btn_w/2});
                                }
                                if(pageeditor_btn_distance['right']<0){
                                    pageeditor_btn_position['left']=window_w-pageeditor_btn_w/2;
                                    $pageeditor_btn.css({left:pageeditor_btn_position['left']});
                                }
                                if(pageeditor_btn_distance['bottom']<0){
                                    pageeditor_btn_position['top']=wscroll+window_h-(pageeditor_btn_h);
                                    $pageeditor_btn.css({top:pageeditor_btn_position['top']});
                                }
                            }
                        }
                    }
                });
            }
        });
        // 非可编辑文字区域，隐藏输入框和文字编辑按钮
        $page_iframe_contents.find("body").mouseover(function(e) {
            if(!($(e.target).closest(".editable-click").length || $pageeditor_btn.find('.editable-container').length || $(e.target).closest(".pageeditor-btn").length)){
                // $pageeditor_remark.editable('hide');
                $pageeditor_editor.hide();
            }
        });
        // 输入框保存
        $(page_iframe_document).on('click','.editable-submit',function(){
            var text=$pageeditor_btn.find('.editable-container .editable-input .form-control').val();
            editableSave(text);
        });
        // 输入框点击取消按钮后，显示编辑按钮
        $(page_iframe_document).on('click','.editable-cancel',function(){
            setTimeout(function(){
                if($pageeditor_editor.is(':hidden')) $pageeditor_editor.show();
            },200)
        });
    });
    // 区块设置框保存
    $blockset_modal.find("button[type=submit]").click(function(event) {
        $blockset_iframe.contents().find('.set-block-form .submit').click();
    });
    // 百度编辑器内容保存
    $ueeditor_modal.find('button[type=submit]').click(function(event) {
        var $page_iframe_contents=$page_iframe.contents(),
            $pageeditor_editor=$page_iframe_contents.find('.pageeditor-btn .pageeditor-editor'),
            $editable_click=$page_iframe_contents.find($pageeditor_editor.attr('data-obj')).eq($pageeditor_editor.attr('data-index')),
            ue_id='ueditor-'+$editable_click.attr('met-table')+$editable_click.attr('met-field')+$editable_click.attr('met-id');
        editableSave(editable_ue_val[ue_id].getContent(),function(text){
            $ueeditor_modal.find('textarea[class='+ue_id+']').html(text);
            setTimeout(function(){
                $ueeditor_modal.modal('hide');
            },500)
        });
    });
    // 图片设置框弹出的触发事件
    $(document).on('show.bs.modal', '.img-modal', function(event) {
        var $img_iframe_contents=$img_iframe.contents(),
            $page_iframe_contents=$page_iframe.contents(),
            $img_iframe_upload=$img_iframe_contents.find('.set-img .ftype_upload>.fbox'),
            $obj_img=$page_iframe_contents.find('img:eq('+$('input[name=obj_img]',this).val()+')'),
            img_url=$obj_img.data('original')||$obj_img.data('lazy')||$obj_img.data('src')||$obj_img.attr('src');
        $img_iframe_upload.find('>input[name*=img]').val(img_url);
        $img_iframe_upload.find('>input[name=id]').val($obj_img.attr('met-id'));
        $img_iframe_upload.find('>input[name=table]').val($obj_img.attr('met-table'));
        $img_iframe_upload.find('>input[name=field]').val($obj_img.attr('met-field'));
        $img_iframe_upload.find('.add-outside-btn').attr({'data-outside_img':''});
        if(!$img_iframe_contents.find('.ftype_upload .js-picture-list .sort').length){
            $img_iframe_contents.find('.ftype_upload .js-picture-list').prepend('<li class="sort" style="cursor: pointer;"><a target="_blank"><img></a><span class="close hide">×</span></li>');
        }
        var $sort=$img_iframe_contents.find('.ftype_upload .js-picture-list .sort');
        $sort.find('a').attr({href:img_url});
        $sort.find('img').attr({src:img_url});
    });
    // 图片设置框保存
    $img_modal.find('button[type=submit]').click(function(event) {
        $img_iframe.contents().find('.set-block-form .submit').click();
    });
    // 图标设置框-选择图标库
    $(document).on('click', '.icon-modal .iconchoose .iconchoose-href', function(event) {
        $icon_modal.find('.icon-list').hide();
        $icon_modal.find('.icon-detail').attr({hidden:''});
        $icon_modal.find('.icon-detail[data-name='+$(this).data('icon')+']').removeAttr('hidden');
        $icon_modal.find('.back-iconlist').removeAttr('hidden');
    });
    // 返回图标列表页
    $(document).on('click', '.icon-modal .back-iconlist', function(event) {
        $(this).attr({hidden:''});
        $icon_modal.find('.icon-list').show();
        $icon_modal.find('.icon-detail').attr({hidden:''}).find('.icondemo-wrap').removeClass('checked');
    })
    // 选择图标
    $(document).on('click', '.icon-modal .icon-detail .icondemo-wrap', function(event) {
        $icon_modal.find('.icon-detail .icondemo-wrap').removeClass('checked');
        $(this).addClass('checked');
    })
    // 保存图标选择
    $(document).on('click', '.icon-modal button[type=submit]', function(event) {
        var $page_iframe_contents=$page_iframe.contents(),
            $icon=$page_iframe_contents.find('.met-icon:eq('+$(this).attr('data-index')+')'),
            $icon_checked=$icon_modal.find('.icon-detail .icondemo-wrap.checked');
        if($icon_checked.length){
            $.ajax({
                url: $(this).data('submit_url'),
                type: 'POST',
                dataType: 'json',
                data:{
                    new_img:$icon_checked.parents('.icon-detail').data('prev')+$icon_checked.find('.icon-title').html(),
                    id:$icon.attr('met-id'),
                    table:$icon.attr('met-table'),
                    field:$icon.attr('met-field')
                },
                success:function(result){
                    if(parseInt(result.status)) {
                        $page_iframe.prop('contentWindow').location.reload();
                        metAlert('',500);
                    }
                }
            });
        }
        $icon_modal.modal('hide');
    })
    // 图标设置框关闭时还原框内显示
    $(document).on('hide.bs.modal', '.icon-modal', function(event) {
        $icon_modal.find('.back-iconlist').click();
        $icon_modal.find('.icon-detail .icondemo-wrap').removeClass('checked');
    })
    // 不再提示更改后台目录名称
    $('.no-prompt').click(function(){
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data:{met_safe_prompt:'1'}
        });
    });
    // 系统消息数量
    $.ajax({
        type: "GET",
        dataType: "json",
        url: basepath + 'index.php?n=system&c=news&a=docurlnews&lang=' + lang,
        success: function(data) {
            var countNow = $('.news-count').html();
            $('.news-count').html(countNow * 1 + data.new*1);
        }
    });
});
// 页面参数弹框回调
function configModalFun(this_config_type,func){
    var config_type=$config_modal.find('input[name=config_type]').val(),
        $config_type=$(config_type),
        $config_iframe=$(config_type+'-iframe'),
        $config_iframe_contents=$config_iframe.contents(),
        this_config_type='#'+this_config_type;
    if(config_type!='#config-index' && config_type==this_config_type){
        var $page_iframe_contents=$page_iframe.contents(),
            page_iframe_window=$page_iframe.prop('contentWindow');
        $.ajax({
            url: $config_type.data('config-url'),
            type: 'POST',
            dataType: 'html',
            data:{
                module:page_iframe_window.M['module'],
                id:page_iframe_window.M['id'],
                classnow:page_iframe_window.M['classnow']
            },
            success:function(html){
                var $config_iframe_contents=$config_iframe.contents();
                $config_iframe_contents.find('html,body').scrollTop(0);
                $config_iframe_contents.find('.set-block').html(html);
                if (typeof func==="function") func();
            }
        });
    }
    $config_modal.find('.modal-title').html($config_type.attr('title'));
}
// 当前页面参数弹框回调
function configPageModalFun(this_config_type,func){
    $(document).on('show.bs.modal', '.config-modal', function(event) {
        configModalFun(this_config_type,func);
    });
}
// 区块设置框弹出
$.fn.pagesetModal=function(){
    $(this).click(function(event) {
        var mid=$(this).attr('data-mid'),
            type=$(this).attr('data-type'),
            pagesetModal=function(){
                if($blockset_iframe.attr('src') && $blockset_iframe.attr('src')==$blockset_iframe.data('src')){
                    $blockset_modal.modal();
                }else{
                    $blockset_iframe.attr({src:$blockset_iframe.data('src')}).load(function() {
                        $blockset_modal.modal();
                    })
                }
            };
        $blockset_modal.find('input[name=mid]').val(mid);
        $blockset_modal.find('input[name=type]').val(type);
        if(type && type!='nocontent'){
            // 弹出特殊指定页面
            $.ajax({
                url: $blockset_iframe.data('src'),
                type: 'POST',
                dataType: 'html',
                data: {mid:mid,type:type,classnow:$page_iframe.prop('contentWindow').M['classnow']},
                success:function(result){
                    if(result.indexOf('url=')==0){
                        result=result.split('url=')[1];
                        $content_modal.modal();
                        $content_iframe.attr({src:result+'&pageset=1'});
                    }else{
                        pagesetModal();
                    }
                }
            });
        }else{
            pagesetModal();
        }
    });
};
// 区块设置框弹出的触发事件
function pagesetModalFun(func){
    $(document).on('show.bs.modal', '.blockset-modal', function(event) {
        var $input_mid=$('input[name=mid]',this),
            mid=$input_mid.val();
        $.ajax({
            url: $blockset_iframe.attr('src'),
            type: 'POST',
            dataType: 'html',
            data: {mid:mid},
            success:function(html){
                var $blockset_iframe_contents=$blockset_iframe.contents();
                $blockset_iframe_contents.find('.set-block').html(html);
                $blockset_iframe_contents.find('.set-block-form input[name=mid]').val(mid);
                $blockset_iframe_contents.find('html,body').scrollTop(0);
                var modal_title=$blockset_iframe_contents.find('input[name=ui_title]').val(),
                    ui_description=$blockset_iframe_contents.find('input[name=ui_description]').val();
                if(ui_description) modal_title+='<span class="font-size-14">（'+ui_description+'）</span>';
                $blockset_modal.find(".modal-title").html(modal_title);
                if (typeof func==="function") func();
            }
        });
    });
}
// 添加初始化百度编辑器
function editableUe(obj,text){
    var $ueeditor_body=$ueeditor_modal.find('.modal-body');
    $ueeditor_modal.modal();
    setTimeout(function(){
        var ue_id='ueditor-'+obj.attr('met-table')+obj.attr('met-field')+obj.attr('met-id'),
            $textarea=$ueeditor_body.find('textarea[class='+ue_id+']');
        if($textarea.length){
            if($textarea.val()!=editable_ue_val[ue_id].getContent()) editable_ue_val[ue_id].setContent($textarea.val());
        }else{
            $ueeditor_body.append('<textarea class="'+ue_id+'" id="'+ue_id+'" rows="1">'+text+'</textarea>');
            editable_ue_val[ue_id]=UE.getEditor(ue_id,{
                initialFrameWidth : '100%',
                scaleEnabled: true
            });
        }
        setTimeout(function(){
            var $ue_id=$ueeditor_body.find('.'+ue_id+'.edui-default'),
                calch=$ue_id.find('.edui-editor-toolbarbox').height()+$ue_id.find('.edui-editor-bottomContainer').height();
            $ueeditor_body.find('>.edui-default').hide();
            $ue_id.show().find('.edui-editor-iframeholder').css({height:'calc(100% - '+calch+'px)'});
        },100)
    },100)
}
// 保存文字修改内容
function editableSave(text,func){
    var $pageeditor_editor=$page_iframe.contents().find('.pageeditor-btn .pageeditor-editor'),
        $editable_click=$page_iframe.contents().find($pageeditor_editor.attr('data-obj')).eq($pageeditor_editor.attr('data-index'));
    $.ajax({
        url: $pageeditor_editor.data('setcontent-url'),
        type: 'POST',
        dataType: 'json',
        data: {table: $editable_click.attr('met-table'),field: $editable_click.attr('met-field'),id: $editable_click.attr('met-id'),text:text},
        success:function(result){
            if(parseInt(result.status)){
                $pageeditor_editor.show();
                $page_iframe.prop('contentWindow').location.reload();
                metAlert('',500);
            }else{
                metAlert(METLANG.savefail,1,0);
            }
            if (typeof func==="function") func(text);
        }
    });
}
// 设置cookie
function setCookie(name,value,path,term){
    var exp = new Date(),
        terms =term||30,
        paths =path||'/';
    exp.setTime(exp.getTime() + terms*24*60*60*1000);
    document.cookie = name + "="+ value + ";path="+paths+";expires=" + exp.toGMTString();
}
// 页面内容转换为可视化信息
$.fn.pageinfo=function(){
    // 文字内容转换可视化信息
    $('m',this).each(function() {
        var el = $(this).parent();
        if($(this).attr('met-field') == 'content') el = $(this).parents('.met-editor');
        el.attr({'met-id':$(this).attr('met-id'),'met-table':$(this).attr('met-table'),'met-field':$(this).attr('met-field')}).addClass('editable-click');
        $(this).remove();
    });
    // 图片内容转换可视化信息
    $('img,[data-original]',this).each(function(index, el) {
        var img_url=$(this).data('original')||$(this).data('lazy')||$(this).data('src')||$(this).attr('src');
        if(img_url && img_url.indexOf('met-id=')>=0) $(this).attr({'met-id':img_url.match(/met-id=(\w+)/)[1],'met-table':img_url.match(/met-table=(\w+)/)[1],'met-field':img_url.match(/met-field=(\w+)/)[1]});
    });
    // 图标内容转换可视化信息
    $('[class*="met-icon|"]',this).each(function(index, el) {
        var self_class=$(this).attr('class').split(' ');
        self_class=$.grep(self_class, function(n) {return $.trim(n).length > 0;});
        $.each(self_class, function(index, val) {
            if(val.indexOf('met-icon')>=0){
                var icon_info=val.split('|');
                $(el).addClass('met-icon').removeClass(val).attr({'met-id':icon_info[1],'met-table':icon_info[2],'met-field':icon_info[3]});
                return false;
            }
        });
    })
    // 下拉菜单新窗口打开去除新窗口打开属性
    $('a[data-toggle="dropdown"][data-hover="dropdown"][target="_blank"]',this).removeAttr('target');
};
// 弹出提示信息
function metAlert(text,delay,bg_ok,type){
    delay=typeof delay != 'undefined'?delay:2000;
    bg_ok=bg_ok?'bgshow':'';
    if(text!=' '){
        text=text||METLANG.jsok;
        text='<div>'+text+'</div>';
        if(parseInt(type)==0) text+='<button type="button" class="close white" data-dismiss="alert"><span aria-hidden="true">×</span></button>';
        if(!$('.metalert-text').length){
            var html='<div class="metalert-text p-x-40 p-y-10 bg-purple-600 white font-size-16">'+text+'</div>';
            if(bg_ok) html='<div class="metalert-wrapper w-full alert '+bg_ok+'">'+html+'</div>';
            $('body').append(html);
        }
        var $met_alert=$('.metalert-text'),
            $obj=bg_ok?$('.metalert-wrapper'):$met_alert;
        $met_alert.html(text);
        $obj.show();
        if($met_alert.height()%2) $met_alert.height($met_alert.height()+1);
    }
    if(delay){
        setTimeout(function(){
            var $obj=bg_ok?$('.metalert-wrapper'):$('.metalert-text');
            $obj.fadeOut();
        },delay);
    }
}
// 右键菜单
$.fn.extend({
    contextMenu:function(menu_obj) {
        // 显示右键菜单
        if(!menu_obj) menu_obj='.met-menu';
        var $menu_obj=$(menu_obj),
            $self=$(this),
            menu_obj_width=$menu_obj.outerWidth(),
            menu_obj_height=$menu_obj.outerHeight(),
            onContextMenu=function(e){
                e.preventDefault();
                var left=e.clientX,
                    right='auto',
                    top=e.clientY+50,
                    bottom='auto';
                if(left+menu_obj_width>$(window).width()){
                    left='auto';
                    right=0;
                }
                if(top+menu_obj_height>$(window).height()){
                    top='auto';
                    bottom=0;
                }
                $menu_obj.addClass('show-menu').css({left:left,right:right,top:top,bottom:bottom});
                $self.bind('mousedown',onMouseDown);
                $self.parents('body').bind('mousedown', onMouseDown);
                $menu_obj.find('.obj-remove').attr({'data-index':$self.index($(e.target).closest($self.selector))});
            },
            onMouseDown=function(){
                $menu_obj.removeClass('show-menu');
                $self.unbind('mousedown',onMouseDown);
                $self.parents('body').unbind('mousedown', onMouseDown);
            };
        $self.bind('contextmenu',onContextMenu);
        // 右键菜单功能
        $menu_obj.find('.obj-remove').click(function(event) {
            $self.eq($(this).attr('data-index')).remove();
            onMouseDown();
        });
    },
    // iframe页面处理
    hrefPageset:function() {
        if($(this).attr('src').indexOf(M['weburl'])<0) return false;
        $(this).load(function() {
            if(typeof $(this).attr('src') =='undefined' || !$(this).attr('src')) return false;
            var iframe_window=$(this).prop('contentWindow'),
                iframe_document=iframe_window.document,
                $self=$(this);
            // iframe页面中表单提交地址添加参数pageset=1
            $('form',iframe_document).each(function(index, el) {
                var form_action=$(this).attr('action');
                if(form_action && form_action.indexOf('pageset=1')<0){
                    if(form_action.indexOf('?')>=0){
                        form_action+='&pageset=1';
                    }else{
                        form_action+='?pageset=1';
                    }
                }
                $(this).attr({action:form_action});
            });
            if($(this).hasClass('page-iframe')){
                // 可视化窗口页面中跳转地址加参数pageset=1
                $(iframe_document).on('click','a[href][href!=""]',function(e){
                    var url=$(this).attr('href'),
                        $self=$(this),
                        url_after='pageset=1',
                        href_control=(function(){
                            if($self.attr('data-toggle')=='dropdown' && typeof $self.attr('data-hover')=='undefined') return false;
                            if(url.substr(0,1)=='#') return false;
                            if(url.indexOf('javascript')>=0) return false;
                            if(url.indexOf('tel:')>=0) return false;
                            if(url.indexOf('.jpg')>=0) return false;
                            if(url.indexOf('.png')>=0) return false;
                            if(url.indexOf('.gif')>=0) return false;
                            return true;
                        })();
                    if(href_control){
                        if(url.indexOf(url_after)<0 || url.indexOf('lang=')<0 || (url.indexOf(M['weburl'])<0 && url.indexOf('lang=')<0)){
                            e.preventDefault();
                            if(url.length>1 && url.substr(0,1)=='#'){
                                iframe_window.location.hash=url.substr(1);
                                return false;
                            }
                            if(url.indexOf(url_after)<0){
                                if(url.indexOf('?')>=0){
                                    url_after='&'+url_after;
                                }else{
                                    url_after='?'+url_after;
                                }
                                url+=url_after;
                            }
                            if(url.indexOf(M['weburl'])>0 && url.indexOf('lang=')<0) url+='&lang='+M['lang'];
                            if(url.indexOf(M['weburl'])<0 && url.indexOf('lang=')<0 && $(this).attr('target')=='_blank'){
                                window.open(url);
                            }else{
                                iframe_window.location=url;
                            }
                        }else if($(this).attr('target')=='_blank'){
                            e.preventDefault();
                            iframe_window.location=url;
                        }
                    }
                });
            };
            // iframe页面跳转后，所在弹窗出现返回按钮
            if(!$(this).parents('.modal').length) return false;
            var $iframe_goback=$(this).parents('.modal').find('.iframe-goback'),
                href=$(this).prop('contentWindow').location.href,
                src=$(this).attr('src');
            href=href.replace('&pageset=1','').replace('?pageset=1','');
            src=src.replace('&pageset=1','').replace('?pageset=1','');
            if(src==href){
                $iframe_goback.attr({hidden:''});
            }else{
                if(!$iframe_goback.length){
                    $(this).parents('.modal').find('.modal-header .close').after("<a href='javascript:;' title='"+METLANG.backlastpage_v6+"' class='iframe-goback pull-xs-right m-r-20' style='margin-top: 1px;'><i class='icon wb-reply' aria-hidden='true'></i></a>");
                    var $iframe_goback=$(this).parents('.modal').find('.iframe-goback');
                }
                $iframe_goback.removeAttr('hidden');
            }
            // 弹窗头部加上应用首页的标题链接
            if($(this).attr('src').indexOf('n=myapp&c=myapp&&a=doindex')>=0){
                var m_type=$('meta[name=generator]',iframe_document).data('m_type');
                if(m_type=='app' && !$(this).parents('.modal').find('.modal-title .app-title').length){
                    $(this).parents('.modal').find('.modal-title').append('<span class="app-title"> - <a href="'+iframe_window.location.href+'">'+METLANG.uisetappinfo+'</a></span>');
                }else if(m_type!='app'){// 回到我的应用页面时删除当前应用链接
                    $(this).parents('.modal').find('.modal-title .app-title').remove();
                }
            }
        });
    }
});