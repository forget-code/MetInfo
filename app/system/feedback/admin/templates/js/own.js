define(function(require, exports, module) {
    var $ = jQuery = require('jquery');
    var common = require('common');

    if ($(".content_add").length) require.async('own_tem/js/content_add');
    if ($(".product_index").length) require.async('own_tem/js/product_index');
    if ($(".product_add").length) require.async('own_tem/js/product_add');
    if ($(".product_para").length) require.async('own_tem/js/product_para');
    if ($(".product_shop").length) require.async($(".product_shop").attr('data-url'));
    if ($(".article_add").length) require.async('own_tem/js/article_add');

    var $feedbtn1=$('.stat_list a:nth-child(1)'),
        $feedbtn2=$('.stat_list a:nth-child(2)'),
        $feedbtn3=$('.stat_list a:nth-child(3)'),
        $export=$(".export-feedback"),
        classSelect=function(){
            var class1 = $("select[name=class1_select]").val(),
                html=$('select[name=class1_select] option[value='+class1+']').html(),
                url0 = $feedbtn1.attr('href').split('class1=')[0]+'class1='+class1,
                url1 = $feedbtn2.attr('href').split('class1=')[0]+'class1='+class1,
                url2 = $feedbtn3.attr('href').split('class1=')[0]+'class1='+class1,
                url_export = $export.attr('href').split('&class1=')[0]+'&class1='+class1+'&met_fd_export=-1';
            if (class1 == '所有栏目') {
                $feedbtn2.html('反馈表单设置');
                $export.attr('href', url_export);
                $feedbtn3.hide();
            } else {
                $export.attr('href', url_export);
                $feedbtn2.html(html + '表单设置');
                $feedbtn3.html(html + '系统设置').show();
            }
            $.ajax({
                url:url0+'&ajax=1',
                type:'GET',
                success:function(msg){
                    $('select.met_fd_export').html(msg);
                }
            });
            $feedbtn2.attr('href', url1);
            $feedbtn3.attr('href', url2);
        };
    // setTimeout(function(){
    //     classSelect();
    // },500);
    // 反馈信息列表切换
    $(".ftype_select-linkage select").change(function() {
        classSelect();
    })
    $('select.met_fd_export').change(function() {
        $export.attr('href', $export.attr('href').split('&met_fd_export=')[0]+'&met_fd_export=' + $(this).val());
    })
});