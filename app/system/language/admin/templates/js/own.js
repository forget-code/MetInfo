define(function(require, exports, module) {
	var $ = jQuery = require('jquery');
	var common = require('common');

	if($(".content_add").length)require.async('own_tem/js/content_add');
	if($(".product_index").length)require.async('own_tem/js/product_index');
	if($(".product_add").length)require.async('own_tem/js/product_add');
	if($(".product_para").length)require.async('own_tem/js/product_para');
	//if($(".product_shop").length)require.async('own_tem/js/product_shop');
	if($(".product_shop").length)require.async($(".product_shop").attr('data-url'));
	if($(".article_add").length)require.async('own_tem/js/article_add');


	$(function () {
		if($("#adminlangset").length){
			$("[name=langautor]").change(function () {
                if($(this).val()=='' || $(this).val()==0){
                    $('[name=langname]').val('');
                    $('[name=langmark]').val('');
                    $('[name=langmark]').parent().parent().parent().show('fast');
                    $("input:radio[name=langdlok]").eq(0).attr("disabled",true);
                    $("input:radio[name=langdlok]").eq(1).attr("checked",'checked');
				}else{
                    $('[name=langname]').val($("#adminlangset option:selected").html());
                    $('[name=langmark]').val($("#adminlangset option:selected").val());
                    $('[name=langmark]').parent().parent().parent().hide('fast');
                    $("input:radio[name=langdlok]").eq(0).attr("disabled",false);
                    $("input:radio[name=langdlok]").eq(0).attr("checked",'checked');
                }
            })

			$("[name=langdlok]").change(function(){
				console.log($(this).val())
				if($("[name=langdlok]:checked").val()=='0'){
                    $('[name=ftype_select]').parent().parent().parent().show('fast');
                    $('[name=ftype_select]').val($('[name=ftype_select]').attr('data-checked'));
                }else{
                    $('[name=ftype_select]').parent().parent().parent().hide('fast');
                    $('[name=ftype_select]').val('');
				}
			})
		}
    })

    $(function () {
        if(("#wordsearch").length){
            $('#wordsearch').click(function(){
                var data = $('[name=admin_metinfo]').val();
                var url  = $('#wordsearch').attr('data-url');
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: url ,
                    data:{word:data},
                    success: function(data) {
                        if(data.msg=='showlist'){
                            console.log(data.langlist)
                            $('#langsection').html('');
                            for(var lang in data.langlist){
                                var langname = lang;
                                var langval = data.langlist[lang];
                                var $dom = $('<dl>\n' +
                                    '\t\t\t<dt></dt>\n' +
                                    '\t\t\t<dd class="ftype_input">\n' +
                                    '\t\t\t\t<div class="fbox">\n' +
                                    '\t\t\t\t\t<input type="input" name="change_'+ langname+'"  value="'+langval+'"  />\n' +
                                    '\t\t\t\t</div>\n' +
                                    '\t\t\t\t<span class="tips">{$'+langname+'}</span>\n' +
                                    '\t\t\t</dd>\n' +
                                    '\t\t</dl>');
                                $dom.appendTo($('#langsection'));
                           }
                            $('#langlist').show('fast');
                        }else if(data.msg=='empty'){
                            $('#langlist').hide('fast');
                            $('#langsection').html('');
                        }
                    }
                });
            })
        }
    })


});