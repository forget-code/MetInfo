/*
应用通用功能
 */
// 判断地址栏是否有lang参数，没有则跳转到带lang参数的地址
if(typeof MET !='undefined' && MET['url']['basepath'] !='undefined'){
    var str=window.parent.document.URL,
        s=str.indexOf("lang="+M['lang']),
        z=str.indexOf("lang");
    if (s=='-1' && z!='-1') {
        var s1=str.indexOf('#');
        if (s1=='-1') {
            str=str.replace(/(lang=[^#]*)/g, "lang="+M['lang']+"#");
        }
        str=str.replace(/(lang=[^#]*#)/g, "lang="+lang+"#");
        parent.location.href=str;
    }
}
// 获取地址栏参数
function getQueryString(name) {
    var reg=new RegExp("(^|&)"+name+"=([^&]*)(&|$)", "i");
    var r=window.location.search.substr(1).match(reg);
    if (r!=null) return unescape(decodeURIComponent(r[2]));
    return null;
}
// 修改、添加、删除地址栏参数
function replaceParamVal(paramName,replaceWith) {
    var newUrl=oldUrl=window.location.href,
        paramNames='&' + paramName + '=';
        re = eval('/('+paramNames+')([^&]*)/gi');
    if(replaceWith){
        if(oldUrl.indexOf(paramNames)>=0){
            newUrl = oldUrl.replace(re, paramNames + replaceWith);
        }else{
            newUrl = oldUrl+ paramNames + replaceWith;
        }
    }else if(oldUrl.indexOf(paramNames)>=0){
        newUrl = oldUrl.replace(re, '');
    }
    history.pushState('','',newUrl);
}
// 可视化弹框中页面隐藏头部
if (parent.window.location.search.indexOf('pageset=1') >= 0) $('.metadmin-head').hide();
// 操作成功、失败提示信息
if(top.location!=location) $("html",parent.document).find('.turnovertext').remove();
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
// 弹出页面返回的提示信息
var turnover=[];
turnover['text']=getQueryString('turnovertext');
turnover['type']=parseInt(getQueryString('turnovertype'));
turnover['delay']=turnover['type']?undefined:0;
if(turnover['text']) metAlert(turnover['text'],turnover['delay'],!turnover['type'],turnover['type']);
// 系统参数
var lang=M['lang'],
    siteurl=M['weburl'],
    basepath=(typeof MET!='undefined' && MET['url']['basepath'])?MET['url']['basepath']:'';
if(typeof MET != 'undefined'){
    for(var name in MET){
        if(!M[name]) M[name]=MET[name];
    }
}
M['n']=getQueryString('n'),
M['c']=getQueryString('c'),
M['a']=getQueryString('a');
if(!M['url']) M['url']=[];
M['url']['system']=M['weburl']+'app/system/';
M['url']['static']=M['url']['system']+'include/static/';
M['url']['static_vendor']=M['url']['static']+'vendor/';
M['url']['static2']=M['url']['system']+'include/static2/';
M['url']['static2_vendor']=M['url']['static2']+'vendor/';
M['url']['static2_plugin']=M['url']['static2']+'js/Plugin/';
M['url']['uiv2']=M['weburl']+'public/ui/v2/';
M['url']['uiv2_css']=M['url']['uiv2']+'static/css/';
M['url']['uiv2_js']=M['url']['uiv2']+'static/js/';
M['url']['uiv2_plugin']=M['url']['uiv2']+'static/plugin/';
M['url']['app']=M['weburl']+'app/app/';
M['url']['pub']=M['weburl']+'app/system/include/public/';
M['url']['epl']=M['url']['pub']+'js/examples/';
M['url']['editor']=M['url']['app']+(typeof MET !='undefined'?MET['met_editor']:'')+'/';
// 插件路径
M['plugin']=[];
M['plugin']['formvalidation']=[
    M['url']['static2_vendor']+'formvalidation/formValidation.min.css',
    M['url']['static2_vendor']+'formvalidation/formValidation.min.js',
    M['url']['static2_vendor']+'formvalidation/language/zh_CN.js',
    M['url']['static2_vendor']+'formvalidation/framework/bootstrap4.min.js',
    M['url']['static2_vendor']+'jquery-enplaceholder/jquery.enplaceholder.min.js',
    M['url']['uiv2_js']+'form.js'
];
M['plugin']['datatables']=[
    M['url']['static2_vendor']+'datatables-bootstrap/dataTables.bootstrap.min.css',
    M['url']['static2_vendor']+'datatables-responsive/dataTables.responsive.min.css',
    M['url']['static2_vendor']+'datatables/jquery.dataTables.min.js',
    M['url']['static2_vendor']+'datatables-bootstrap/dataTables.bootstrap.min.js',
    M['url']['static2_vendor']+'datatables-responsive/dataTables.responsive.min.js',
    M['url']['uiv2_js']+'datatable.js'
];
M['plugin']['ueditor']=[
    M['weburl']+'app/app/ueditor/ueditor.config.js',
    M['weburl']+'app/app/ueditor/ueditor.all.min.js'
];
M['plugin']['minicolors']=[
    M['url']['epl']+'color/jquery.minicolors.css',
    M['url']['epl']+'color/jquery.minicolors.min.js'
];
M['plugin']['tokenfield']=[
    M['url']['static2_vendor']+'bootstrap-tokenfield/bootstrap-tokenfield.min.css',
    M['url']['static2_vendor']+'bootstrap-tokenfield/bootstrap-tokenfield.min.js',
    M['url']['static2_plugin']+'bootstrap-tokenfield.min.js'
];
M['plugin']['ionrangeslider']=[
    M['url']['static2_vendor']+'ionrangeslider/ionrangeslider.min.css',
    M['url']['static2_vendor']+'ionrangeslider/ion.rangeSlider.min.js'
];
M['plugin']['datetimepicker']=[
    M['url']['epl']+'time/jquery.datetimepicker.css',
    M['url']['epl']+'time/jquery.datetimepicker.js'
];
M['plugin']['select-linkage']=M['url']['static_vendor']+'select-linkage/jquery.cityselect.js';
M['plugin']['alertify']=[
    M['url']['static2_vendor']+'alertify/alertify.min.css',
    M['url']['static2_vendor']+'alertify/alertify.js',
    M['url']['static2_plugin']+'alertify.min.js'
];
M['plugin']['selectable']=[
    M['url']['static2_plugin']+'asselectable.min.js',
    M['url']['static2_plugin']+'selectable.min.js'
];
M['plugin']['fileinput']=[
    M['url']['static2']+'fonts/glyphicons/glyphicons.min.css',
    M['url']['pub']+'bootstrap/fileinput/css/fileinput.min.css',
    M['url']['static2_vendor']+'fileinput/fileinput.min.js',
    M['url']['static2_vendor']+'fileinput/fileinput_locale_zh.js'
];
M['plugin']['lazyload']=M['weburl']+'public/ui/v2/static/plugin/jquery.lazyload.min.js';
M['plugin']['hover-dropdown']=M['url']['static_vendor']+'bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js';
M['plugin']['asscrollable']=[
    M['url']['static2_vendor']+'asscrollable/asScrollable.min.css',
    M['url']['static2_vendor']+'asscrollbar/jquery-asScrollbar.min.js',
    M['url']['static2_vendor']+'asscrollable/jquery-asScrollable.min.js',
    M['url']['static2_plugin']+'asscrollable.min.js'
]
M['plugin']['touchspin']=[
    M['url']['static2_vendor']+'bootstrap-touchspin/bootstrap-touchspin.min.css',
    M['url']['static2_vendor']+'bootstrap-touchspin/bootstrap-touchspin.min.js'
]
M['plugin']['masonry']=M['url']['static2_vendor']+'masonry/masonry.pkgd.min.js';
M['plugin']['appear']=[
    M['url']['static2_vendor']+'jquery-appear/jquery.appear.min.js',
    M['url']['static2_plugin']+'jquery-appear.min.js'
];
M['plugin']['ladda']=[
    M['url']['static2_vendor']+'ladda/ladda.min.css',
    M['url']['static2_vendor']+'ladda/spin.min.js',
    M['url']['static2_vendor']+'ladda/ladda.min.js',
    M['url']['static2_plugin']+'ladda.min.js'
];
M['plugin']['webui-popover']=[
    M['url']['static2_vendor']+'webui-popover/webui-popover.min.css',
    M['url']['static2_vendor']+'webui-popover/jquery.webui-popover.min.js'
];
// 系统功能
$.fn.extend({
    // 编辑器
    metEditor:function(){
        if(!$(this).length) return;
        if(M['met_editor']=='ueditor'){// 百度编辑器
            if(typeof textarea_editor_val =='undefined') window.textarea_editor_val=[];
            var $self=$(this);
            $.include(M['plugin']['ueditor'],function(){
                $self.each(function(index, val) {
                    var index1=$(this).index('textarea[data-plugin="editor"]');
                    if(!$(this).attr('id')) $(this).attr({id:'textarea-editor'+index1});
                    textarea_editor_val[index1]=UE.getEditor(val.id,{
                        scaleEnabled:true, // 是否可以拉伸长高,默认false(当开启时，自动长高失效)
                        autoFloatEnabled:false, // 是否保持toolbar的位置不动，默认true
                        initialFrameWidth : $(this).data('editor-x')||'100%',
                        initialFrameHeight : $(this).data('editor-y')||400,
                    });
                });
            });
        }else if(M['met_editor']=='editormd'){// markdown编辑器

        }
    },
    // 颜色选择器
    metDatetimepicker:function(){
        if(!$(this).length) return;
        $(this).each(function(index, el) {
            var $self=$(this);
            $(this).datetimepicker({
                lang:M.synchronous=='cn'?'ch':'en',
                timepicker:$self.attr("data-day-type")==2?true:false,
                format:$self.attr("data-day-type")==2?'Y-m-d H:i:s':'Y-m-d'
            });
        });
    },
    // 联动菜单
    metCitySelect:function(){
        if(!$(this).length) return;
        if(typeof citySelect =='undefined') window.citySelect=[];
        $(this).each(function(index){
            var option = {
                    url: $(this).attr('data-select-url')?$(this).attr('data-select-url'):M['url']['static2_vendor']+'select-linkage/citydata.min.json',
                    prov: $(this).find(".prov").attr("data-checked"),
                    city: $(this).find(".city").attr("data-checked"),
                    dist: $(this).find(".dist").attr("data-checked"),
                    value_key: 'id',
                    nodata: 'none'
                };
            if($(this).hasClass('shop-address-select')){
                option=$.extend({
                    country:$(this).find(".country").attr("data-checked"),
                    required:false,
                    country_name_key:'name',
                    p_name_key:'name',
                    n_name_key:'name',
                    s_name_key:'name',
                    p_children_key:'children',
                    n_children_key:'children',
                    getCityjson:function(json,key){
                        key=key||0;
                        return json[key]['children'];
                    }
                },option);
            }
            citySelect[index]=$(this).citySelect(option);
        });
    },
    // 上传文件
    metFileInput:function(){
        if(!$(this).length) return;
        var errorFun=function(obj,data){
                obj.find('.file-preview-thumbnails .file-preview-frame.disabled').remove();
                // 显示报错文字
                // obj.removeClass('has-success').addClass('has-danger');
                // if(!obj.find('small.form-control-label').length) obj.append('<small class="form-control-label"></small>');
                // obj.find('small.form-control-label').text(data.response.error);
            },
            successFun=function(obj1,obj2,data,multiple){
                var $obj1=obj1.parents('.input-group').find('input[type="hidden"][name="'+obj1.attr('name')+'"]'),
                    path='';
                if(multiple){
                    path=$obj1.val()?$obj1.val()+','+data.response.path:data.response.path;
                }else{
                    path=data.response.path;
                    obj2.find('.file-preview-thumbnails .file-preview-frame:last-child').prev().remove();
                }
                $obj1.val(path); // input值更新
                // 显示上传成功文字
                obj2.find('.file-input .input-group .file-caption-name').html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>'+path);
                obj2.removeClass('has-danger').addClass('has-success');
                if(!obj2.find('small.form-control-label').length) obj2.append('<small class="form-control-label"></small>');
                var tips=M['langtxt'].jsx17||M['langtxt'].fileOK;
                obj2.find('small.form-control-label').text(tips);
            };
        $(this).each(function(index, el) {
            if(!(typeof MET['url']['basepath']!='undefined' || (typeof $(this).data('url')!='undefined' && $(this).data('url').indexOf('app/system/entrance.php?lang=cn&c=uploadify&m=include&a=dohead')>=0))) return;
            var $self=$(this),
                $form_group=$(this).parents('.form-group:eq(0)'),
                name=$(this).attr('name'),
                url=$(this).data('url')||M['url']['system']+'entrance.php?lang='+M['lang']+'&c=uploadify&m=include&a=doupfile&type=1',
                multiple=typeof $(this).attr('multiple') !='undefined'?true:false,
                minFileCount=$(this).data('fileinput-minfilecount')||1,
                maxFileCount=$(this).data('fileinput-maxfilecount')||20,
                maxFileSize=$(this).data('fileinput-maxfilesize')||0,
                accept=$(this).attr('accept')||'',
                format='',
                initialPreview=[],
                dropZoneEnabled=$(this).data('drop-zone-enabled')=='false'?false:true,
                value=$(this).attr('value');
            if(typeof value !='undefined' && value!='' && (value.indexOf('.png')>=0||value.indexOf('.jpg')>=0||value.indexOf('.bmp')>=0||value.indexOf('.gif')>=0||value.indexOf('.ico')>=0)){
                if(value.indexOf(',')>=0){
                    value=value.split(',');
                }else{
                    value=[value];
                }
                $.each(value, function(index, val) {
                    var html='<a href="'+val+'" target="_blank"><img src="'+val+'" class="file-preview-image"></a>'
                            +'<div class="file-thumbnail-footer">'
                                +'<div class="file-caption-name" title="'+val+'">'+val+'</div>'
                                    +'<div class="file-actions">'
                                    +'<div class="file-footer-buttons">'
                                        +'<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file"><i class="glyphicon glyphicon-trash text-danger"></i></button>'
                                    +'</div>'
                                    +'<div class="clearfix"></div>'
                                +'</div>'
                            +'</div>';
                    initialPreview.push(html);
                });
            }
            if(accept){
                if(accept.indexOf(',')>=0){
                    accept=accept.split(',');
                }else{
                    accept=[accept];
                }
                $.each(accept, function(index, val) {
                    val=val.indexOf('/')>=0?val.split('/')[1]:'';
                    if(val=='*') val='';
                    if(val){
                        if(format) format+='|';
                        format+=val;
                    }
                });
                if(accept=='image/*') format='jpg|png|bmp|gif|webp';
            }
            if(format) url+='&format='+format;
            var allowedFileExtensions=format?(format.indexOf('|')?format.split('|'):[format]):'';
            $(this).removeAttr('hidden').fileinput({// fileinput插件
                uploadUrl: url,            // 处理上传
                uploadAsync:multiple,      // 异步批量上传
                allowedFileExtensions:allowedFileExtensions,// 接收的文件后缀
                minFileCount:minFileCount,
                maxFileCount:maxFileCount,
                maxFileSize:maxFileSize,
                language:typeof M.synchronous!='undefined'?(M.synchronous=='cn'?'zh':'en'):'zh',// 语言文字
                initialPreview:initialPreview,
                initialCaption:value,         // 初始化输入框值
                // showCaption:false,         // 输入框
                // showRemove:false,          // 删除按钮
                // browseLabel:'',            // 按钮文字
                showUpload:false,             // 上传按钮
                dropZoneEnabled:dropZoneEnabled,// 是否显示拖拽区域
                // browseClass:"btn btn-primary", //按钮样式
            }).on("filebatchselected", function(event, files) {
                $(this).fileinput("upload");
            }).on('filebatchuploadsuccess', function(event, data, previewId, index) {// 同步上传成功结果处理
                successFun($(this),$form_group,data,multiple);
            }).on('fileuploaded', function(event, data, previewId, index) {// 异步上传成功结果处理
                successFun($(this),$form_group,data,multiple);
            }).on('filebatchuploaderror', function(event, data, previewId, index) {// 同步上传错误结果处理
                errorFun($form_group,data);
            }).on('fileuploaderror', function(event, data, previewId, index) {// 异步上传错误结果处理
                errorFun($form_group,data);
            });
            if(!$(this).parents('form').find('input[type="hidden"][name="'+name+'"]').length) $(this).after('<input type="hidden" name="'+name+'" value="'+value+'">');
            // $(this).siblings('i').attr({class:'icon wb-upload'}).parents('.btn-file').insertAfter($(this).parents('.file-input'));
            // 删除图片后图片路径数据更新
            $form_group.on('click', '.file-preview-thumbnails .file-preview-frame .kv-file-remove,.fileinput-remove', function(event) {
                event.preventDefault();
                var $input_name=$form_group.find('input[type="hidden"][name="'+name+'"]'),
                    $caption_name=$form_group.find('.file-input .input-group .file-caption-name');
                if($(this).hasClass('kv-file-remove')){
                    var active=$(this).parents('.file-preview-frame').index(),
                        input_value=$input_name.val(),
                        path='';
                    setTimeout(function(){
                        if(multiple){
                            if(input_value){
                                if(input_value.indexOf(',')>=0){
                                    input_value=input_value.split(',');
                                }else{
                                    input_value=[input_value];
                                }
                                $.each(input_value, function(index, val) {
                                    if(index!=active) path=path?path+','+val:val;
                                });
                            }
                        }else{
                            var $file_preview_frame=$form_group.find('.file-preview-thumbnails .file-preview-frame');
                            path=$file_preview_frame.length?$file_preview_frame.find('img').attr('src'):'';
                        }
                        $input_name.val(path); // input值更新
                        $caption_name.html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>'+path);
                    },1000)
                }else{
                    $input_name.val(''); // input值更新
                    $caption_name.html('<span class="glyphicon glyphicon-file kv-caption-icon"></span>');
                }
                $form_group.removeClass('has-success').find('small.form-control-label').remove();
            });
        });
    },
    // 单选、多选默认选中
    metRadioCheckboxChecked:function(){
        if(!$(this).length) return;
        $(this).each(function(index, el) {
            var checked=String($(this).data('checked')),
                delimiter=$(this).data('delimiter')||'#@met@#';
            if(checked!=''){
               checked=checked.indexOf(delimiter)>=0?checked.split(delimiter):[checked];
                var name=$(this).attr('name');
                for (var i=0; i < checked.length; i++) {
                    $('input[name="'+name+'"][value="'+checked[i]+'"]').attr('checked', true);
                }
            }
        });
    },
    // 下拉菜单默认选中
    metSelectChecked:function(){
        if(!$(this).length) return;
        $(this).each(function(index, el) {
            $('option[value="'+$(this).data('checked')+'"]',this).attr({selected:true});
        });
    },
    // 图片延迟加载
    metLazyLoad:function(){
        if(!$(this).length) return;
        var $self=$(this);
        metFileLoadFun(M['plugin']['lazyload'],function(){
            return typeof $.fn.lazyload=='function';
        },function(){
            $self.lazyload();
        });
    },
    // 表单删除按钮ajax提交
    metFormAjaxDel:function(url){
        var $form=$(this).parents('form'),
            del_id=$form.find('[name="all_id"]')?$form.find('[name="all_id"]').val():'';
        if(del_id!=''){
            $.ajax({
                url: $(this).data('url')||$form.attr('action'),
                type: "POST",
                dataType:'json',
                data:{del_id:del_id},
                success: function(result){
                    metAjaxFun({result:result});
                }
            });
        }else{
            metAlert(METLANG.jslang3,'','bgshow',0);
        }
    },
    // 表单两种类型提交前的处理（保存、删除）
    metSubmit:function(type){
        // 插入submit_type字段
        var type=typeof type!='undefined'?type:1,
            type_str=type?'save':'delet';
        if($(this).find('[name="submit_type"]').length){
            $(this).find('[name="submit_type"]').val(type_str);
        }else $(this).append('<input type="hidden" name="submit_type" value="'+type_str+'"/>');
        // 插入表格的all_id字段
        if($(this).find('.dataTable').length){
            var $table=$(this).find('.dataTable'),
                checked_str=type?'':':checked',
                $checkbox=$table.find('tbody input[type="checkbox"][name="id"]'+checked_str),
                all_id='';
            $checkbox.each(function(index, el) {
                all_id+=all_id?','+$(this).val():$(this).val();
            })
            if(!$(this).find('[name="all_id"]').length) $(this).append('<input type="hidden" name="all_id"/>');
            $(this).find('[name="all_id"]').val(all_id);
        }
    },
    // 表单更新验证
    metFormAddField:function(name){
        var $form=$(this)[0].tagName=='FORM'?$(this):$(this).parents('form');
        if($form.length){
            if(name){
                if(!$.isArray(name)){
                    if(name.indexOf(',')>=0){
                        name=name.split(',');
                    }else name=[name];
                }
                $.each(name, function(index, val) {
                    $form.data('formValidation').addField(val);
                })
            }else{
                var name_array=[];
                $('[name]',this).each(function(index, el) {
                    var name=$(this).attr('name');
                    if($.inArray(name, name_array)<=0){
                        name_array.push(name);
                        if(typeof $(this).attr('required') !='undefined'){
                            $form.data('formValidation').addField(name);
                        }else{
                            $.each($(this).data(), function(index, val) {
                                var third_str=index.substr(2,1);
                                if(index.substr(0,2)=='fv' && index.length>2 && third_str >= 'A' && third_str <= 'Z'){
                                    $form.data('formValidation').addField(name);
                                    return false;
                                }
                            });
                        }
                    }
                });
            }
        }
    },
    // 点击ajax请求弹出确认框后以及返回结果通用处理
    metClickConfirmAjax:function(default_options){
        var default_options = $.extend({
                ajax_data:'',
                true_text:METLANG.confirm,
                false_text:METLANG.cancel,
                confirm_text:METLANG.delete_information,
                true_fun:function(){
                    var url=typeof this.url=='function'?this.url():this.url,
                        ajax_data=typeof this.ajax_data=='function'?this.ajax_data():this.ajax_data,
                        options_this=this;
                    $.ajax({
                        url: url,
                        type: ajax_data?'POST':'GET',
                        dataType: 'json',
                        data:ajax_data,
                        success:function(result){
                            options_this.ajax_fun(result);
                        }
                    });
                },
                false_fun:'',
                ajax_fun:function(result){
                    metAjaxFun({result:result});
                }
            },default_options);
        $(document).on('click', this.selector, function(event) {
            var options = $.extend({
                    el:$(this),
                    url:$(this).data('url')
                },default_options);
            metAlertifyLoadFun(function(){
                var confirm_text=typeof options.confirm_text=='function'?options.confirm_text():options.confirm_text;
                alertify.okBtn(options.true_text).cancelBtn(options.false_text).confirm(confirm_text, function (ev) {
                    options.true_fun();
                },function(){
                    if(typeof options.false_fun=='function') options.false_fun();
                });
            })
        });
    },
    // 通用功能开启
    metCommon:function(){
        var dom=this;
        // 表单验证
        if($('form',dom).length){
            if(typeof validate =='undefined'){
                $.include(M['plugin']['formvalidation']);
            }else{
                $(dom).metValidate();
            }
        }
        // ajax表格
        if($('.dataTable',dom).length){
            if(typeof datatableOption =='undefined'){
                $.include(M['plugin']['datatables']);
            }else{
                $(dom).metDataTable();
            }
        }
        // 编辑器
        if($('textarea[data-plugin="editor"]',dom).length && typeof MET['url']['basepath']!='undefined') $('textarea[data-plugin="editor"]',dom).metEditor();
        // 颜色选择器
        if($('input[data-plugin="minicolors"]',dom).length) $.include(M['plugin']['minicolors'],function(){
            $('input[data-plugin="minicolors"]',dom).minicolors();
        });
        // 标签
        if($('input[data-plugin="tokenfield"]',dom).length) $.include(M['plugin']['tokenfield'],'','siterun');
        // 滑块
        if($('input[type="text"][data-plugin="ionRangeSlider"]',dom).length) $.include(M['plugin']['ionrangeslider'],'','siterun');
        // 日期选择器
        if($('input[data-plugin="datetimepicker"]',dom).length) $.include(M['plugin']['datetimepicker'],function(){
            $('input[data-plugin="datetimepicker"]',dom).metDatetimepicker();
        });
        // 联动菜单
        if($('[data-plugin="select-linkage"]',dom).length) $.include(M['plugin']['select-linkage'],function(){
            $('[data-plugin="select-linkage"]',dom).metCitySelect();
        });
        // 模态对话框
        if($('[data-plugin="alertify"]',dom).length) $.include(M['plugin']['alertify'],'','siterun');
        // 全选、全不选
        if($('[data-plugin="selectable"]',dom).length) $.include(M['plugin']['selectable'],'','siterun');
        // 上传文件
        if($('input[type="file"][data-plugin="fileinput"]',dom).length) $.include(M['plugin']['fileinput'],function(){
            $('input[type="file"][data-plugin="fileinput"]',dom).metFileInput();
        })
        // 滚动条
        if($('[data-plugin="scrollable"]',dom).length) $.include(M['plugin']['asscrollable'],'','siterun');
        // 单选、多选默认选中
        if($('input[data-checked]',dom).length) $('input[data-checked]',dom).metRadioCheckboxChecked();
        // 下拉菜单默认选中
        if($('select[data-checked]',dom).length) $('select[data-checked]',dom).metSelectChecked();
        // 数量改变
        if($('[data-plugin="touchSpin"]',dom).length && typeof $.fn.TouchSpin =='undefined') $.include(M['plugin']['touchspin'],function(){
            $('[data-plugin="touchSpin"]',dom).TouchSpin();
        });
        // 图片延迟加载
        if($('[data-original]',dom).length && dom!=document) $('[data-original]',dom).metLazyLoad();
    }
});
// 通用功能开启
$(document).metCommon();
// 勾选开关
$(document).on('change', 'input[type="checkbox"][data-plugin="switchery"]', function(event) {
    var val=$(this).is(':checked')?1:0;
    $(this).val(val);
});
$(function(){
    // 非前台模板页面-兼容老模板
    if(M['url']['basepath'] || $('script[src*="js/basic_web.js"]').length){
        // 返回顶部
        $(".met-scroll-top").click(function(){
            $('html,body').animate({scrollTop:0},300);
        });
        // 返回顶部按钮显示/隐藏
        var wh=$(window).height();
        $(window).scroll(function(){
            if($(this).scrollTop()>wh){
                $(".met-scroll-top").removeAttr('hidden').addClass("animation-slide-bottom");
            }else{
                $(".met-scroll-top").attr({hidden:''}).removeClass('animation-slide-bottom');
            }
        });
    }
    // 会员侧栏手机端当前页面标题显示在导航徒步
    Breakpoints.on('xs',{
        enter:function(){
            if($('.met-sidebar-nav-active-name').length) $('.met-sidebar-nav-active-name').html($('.met-sidebar-nav-mobile .dropdown-menu .dropdown-item.active').text());
        }
    })
    // 在&pageset=1弹窗中时，页面的表单提交地址添加参数pageset=1
    if(getQueryString('pageset')) $('form').each(function(index, el) {
        if($(this).attr('action')) $(this).attr({action:$(this).attr('action')+'&pageset=1'});
    });
    // 下拉展开时下拉图标旋转
    $(document).on('click', '[data-toggle="collapse"]', function(event) {
        var $icon=$('.icon[class*="fa-angle-"]',this);
        if($icon.length){
            if(!$icon.hasClass('transition500')) $icon.addClass('transition500');
            if($($(this).data('target')).height()){
                $icon.removeClass('rotate90');
            }else{
                $icon.addClass('rotate90');
            }
        }
    });
    // 表单功能
    // 添加项
    $(document).on('click', '[table-addlist]', function(event) {
        var $self=$(this),
            $table=$(this).parents('table').length?$(this).parents('table'):$($(this).data('table-id')),
            addlist=function(data){
                $table.find('tbody').append(data);
                var $new_tr=$table.find('tbody tr:last-child');
                if(!$new_tr.find('[table-cancel]').length && typeof $self.data('nocancel')=='undefined') $new_tr.find('td:last-child').append('<button type="button" class="btn btn-default btn-outline m-l-5" table-cancel>'+METLANG.js49+'</button>');
                // 添加表单验证
                $new_tr.metFormAddField();
            };
        if($table.find('[table-addlist-data]').length){
            var html=$table.find('[table-addlist-data]').val();
            addlist(html);
        }else{
            if(typeof datatable_option=='undefined') datatable_option=[];
            if(typeof datatable_option[datatable_index]=='undefined'){
                var datatable_index=$table.index('.dataTable');
                datatable_option[datatable_index]=[];
            }
            if(typeof datatable_option[datatable_index]['new_id']=='undefined'){
                datatable_option[datatable_index]['new_id']=0;
            }else{
                datatable_option[datatable_index]['new_id']++;
            }
            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data:{new_id:datatable_option[datatable_index]['new_id']},
                success:function(result){
                    addlist(result);
                }
            });
        }
    });
    // 撤销项
    $(document).on('click', '[table-cancel]', function(event) {
        $(this).parents('tr').remove();
    })
    // 删除项-不提交
    $(document).on('click', '[table-del]', function(event) {
        var $self=$(this),
            remove=function(){
                alertify.theme('bootstrap').okBtn(METLANG.confirm).cancelBtn(METLANG.cancel).confirm(METLANG.delete_information, function (ev) {
                    $self.parents('tr').remove();
                })
            };
        metAlertifyLoadFun(function(){
            remove();
        });
    })
    // 点击保存按钮
    $(document).on('click', 'form .btn[type="submit"]', function(event) {
        if($(this).data('plugin')=='alertify' && $(this).data('type')=='confirm') event.preventDefault();
        $(this).parents('form').metSubmit();
    })
    // 删除多项提交
    $(document).on('click', '[table-delet]', function(event) {
        event.preventDefault();
        var $form=$(this).parents('form');
        $form.metSubmit(0);
        if($(this).data('plugin')!='alertify'){
            if($(this).data('url')){
                $(this).metFormAjaxDel();
            }else $form.submit();
        }
    })
    // 表单输入框回车时，触发提交按钮
    $(document).on('keydown', 'form input[type="text"]', function(event) {
        if(event.keyCode==13){
            event.preventDefault();
            $(this).parents('form').find('.btn[type="submit"]').click();
        }
    });
    // 表单提交
    $(document).on('submit', 'form', function(event) {
        // 提交删除时没有勾选时提示
        if($(this).find('[name="submit_type"]').length && $(this).find('[name="submit_type"]').val()=='delet' && $(this).find('[name="all_id"]').val()==''){
            event.preventDefault();
            metAlert(METLANG.jslang3,'','bgshow',0);
        }
    });
});
// 判断是否加载了formvalidation后回调
function metFormvalidationLoadFun(fun){
    metFileLoadFun(M['plugin']['formvalidation'],function(){
        return typeof $.fn.formValidation=='function';
    },function(){
        if(typeof fun=='function') fun();
    });
}
// 判断是否加载了alertify后回调
function metAlertifyLoadFun(fun){
    metFileLoadFun(M['plugin']['alertify'],function(){
        return typeof alertify!='undefined';
    },function(){
        if(typeof fun=='function') fun();
    });
}
// ajax请求返回后通用处理
function metAjaxFun(options){
    options = $.extend({
        result:'',
        false_fun:'',
        true_fun:'',
        status_key:'status',
        msg_key:'msg',
        true_val:function(){
            return parseInt(options.result[options.status_key]);
        }
    },options);
    metAlertifyLoadFun(function(){
        if(options.true_val()){
            if(typeof options.result[options.msg_key]!='undefined' && options.result[options.msg_key]!='') alertify.success(options.result[options.msg_key]);
            if(typeof options.true_fun=='function'){
                options.true_fun();
            }else{
                setTimeout(function(){
                    location.reload();
                },1000);
            }
        }else{
            if(typeof options.result[options.msg_key]!='undefined' && options.result[options.msg_key]!='') alertify.error(options.result[options.msg_key]);
            if(typeof options.false_fun=='function') options.false_fun();
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
// 获取指定名称的cookie的值
function getCookie(name) {
    var cookie_str = document.cookie.split(";");
    for (var i = 0; i < cookie_str.length; i++) {
        cookie_str[i]=$.trim(cookie_str[i]);
        var index = cookie_str[i].indexOf("="),
            cookie_name = cookie_str[i].substring(0, index);
        if (cookie_name == name) {
            var temp = cookie_str[i].substring(index + 1);
            return decodeURIComponent(temp);
        }
    }
}