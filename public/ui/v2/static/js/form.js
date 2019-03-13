$(function(){
    // 验证码输入自动转为大写
    $(document).on('change keyup','.input-codeimg',function(){
        $(this).val($(this).val().toUpperCase());
    });
    // 上传文件
    $(document).on("change keyup",".input-group-file input[type=file]",function(){
        var $self=$(this),
            $text=$(this).parents('.input-group-file').find('.form-control'),
            value="";
        if(is_lteie9) value=$(this).val();
        if(!value){
            $.each($self[0].files,function(i,file){
                if(i>0 ) value +=',';
                value +=file.name;
            });
        }
        $text.val(value);
    });
    // 验证码点击刷新
    $(document).on('click',".met-form-codeimg",function(){
        $(this).attr({src:$(this).data("src")+'&random='+Math.floor(Math.random()*9999+1)});
    });
});
// 表单验证通用
$.fn.validation=function(){
    var $self=$(this),
        self_validation=$(this).formValidation({
        locale:validation_locale,
        framework:'bootstrap4'
    });
    // 表单所处弹窗隐藏时重置验证
    $(this).parents('.modal').on('hide.bs.modal',function() {
        $self.data('formValidation').resetForm();
    });
    function success(func,afterajax_ok){
        self_validation.on('success.form.fv', function(e) {
            e.preventDefault();
            var ajax_ok=typeof afterajax_ok != "undefined" ?afterajax_ok:true;
            if(ajax_ok){
                formDataAjax(e,func);
            }else{
                $self.data('formValidation').resetForm();
                if (typeof func==="function") return func(e,$self);
            }
        })
    }
    function formDataAjax(e,func){
        var $form    = $(e.target);
        if(is_lteie9){
            $.ajax({
                url: $form.attr('action'),
                data: $form.serializeArray(),
                cache: false,
                type: 'POST',
                dataType:'json',
                success: function(result) {
                    $form.data('formValidation').resetForm();
                    if (typeof func==="function") return func(result,$form);
                }
            });
        }else{
            var formData = new FormData(),
                params   = $form.serializeArray();
            $.each(params, function(i, val) {
                formData.append(val.name, val.value);
            });
            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                dataType:'json',
                success: function(result) {
                    $form.data('formValidation').resetForm();
                    if (typeof func==="function") return func(result,$form);
                }
            });
        }
    }
    return {self_validation:self_validation,success:success,formDataAjax:formDataAjax};
}
// formValidation多语言选择
window.validation_locale='';
if("undefined" != typeof M && M['lang_pack'] && M['plugin_lang']){
    validation_locale=M['lang_pack']+'_';
    switch(M['lang_pack']){
        case 'sq':validation_locale+='AL';break;
        case 'ar':validation_locale+='MA';break;
        // case 'az':validation_locale+='az';break;
        // case 'ga':validation_locale+='ie';break;
        // case 'et':validation_locale+='ee';break;
        case 'be':validation_locale+='BE';break;
        case 'bg':validation_locale+='BG';break;
        case 'pl':validation_locale+='PL';break;
        case 'fa':validation_locale+='IR';break;
        // case 'af':validation_locale+='za';break;
        case 'da':validation_locale+='DK';break;
        case 'de':validation_locale+='DE';break;
        case 'ru':validation_locale+='RU';break;
        case 'fr':validation_locale+='FR';break;
        // case 'tl':validation_locale+='ph';break;
        case 'fi':validation_locale+='FI';break;
        // case 'ht':validation_locale+='ht';break;
        // case 'ko':validation_locale+='kr';break;
        case 'nl':validation_locale+='NL';break;
        // case 'gl':validation_locale+='es';break;
        case 'ca':validation_locale+='ES';break;
        case 'cs':validation_locale+='CZ';break;
        // case 'hr':validation_locale+='hr';break;
        // case 'la':validation_locale+='IT';break;
        // case 'lv':validation_locale+='lv';break;
        // case 'lt':validation_locale+='lt';break;
        case 'ro':validation_locale+='RO';break;
        // case 'mt':validation_locale+='mt';break;
        // case 'ms':validation_locale+='ID';break;
        // case 'mk':validation_locale+='mk';break;
        case 'no':validation_locale+='NO';break;
        case 'pt':validation_locale+='PT';break;
        case 'ja':validation_locale+='JP';break;
        case 'sv':validation_locale+='SE';break;
        case 'sr':validation_locale+='RS';break;
        case 'sk':validation_locale+='SK';break;
        // case 'sl':validation_locale+='si';break;
        // case 'sw':validation_locale+='tz';break;
        case 'th':validation_locale+='TH';break;
        // case 'cy':validation_locale+='wls';break;
        // case 'uk':validation_locale+='ua';break;
        // case 'iw':validation_locale+='';break;
        case 'el':validation_locale+='GR';break;
        case 'eu':validation_locale+='ES';break;
        case 'es':validation_locale+='ES';break;
        case 'hu':validation_locale+='HU';break;
        case 'it':validation_locale+='IT';break;
        // case 'yi':validation_locale+='de';break;
        // case 'ur':validation_locale+='pk';break;
        case 'id':validation_locale+='ID';break;
        case 'en':validation_locale+='US';break;
        case 'vi':validation_locale+='VN';break;
        case 'tc':validation_locale='zh_TW';break;
        case 'cn':validation_locale='zh_CN';break;
    }
}else{
    validation_locale='zh_CN';
}
// 表单验证初始化
if($(".met-form-validation").length) {
    window.validate=new Array();
    $(".met-form-validation").each(function(index, el) {
        validate[index]=$(el).validation();
    });
}