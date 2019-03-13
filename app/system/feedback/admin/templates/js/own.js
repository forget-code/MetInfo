define(function(require, exports, module) {
    var $ = jQuery = require('jquery');
    var common = require('common');

    if ($(".content_add").length) require.async('own_tem/js/content_add');
    if ($(".product_index").length) require.async('own_tem/js/product_index');
    if ($(".product_add").length) require.async('own_tem/js/product_add');
    if ($(".product_para").length) require.async('own_tem/js/product_para');
    if ($(".product_shop").length) require.async($(".product_shop").attr('data-url'));
    if ($(".article_add").length) require.async('own_tem/js/article_add');

    /*var $feedbtn1=$('.stat_list a:nth-child(1)'),
        $feedbtn2=$('.stat_list a:nth-child(2)'),
        $feedbtn3=$('.stat_list a:nth-child(3)'),
        $export=$(".export-feedback");
    console.log($feedbtn1.attr('class'));
    $(function(){
        if($feedbtn1.attr('class')=='now'){
            classSelect();
        }
        if($('input[name=met_fdtable]').length){
            $feedbtn2.show();
            $feedbtn3.html($('input[name=met_fdtable]').val()+$('.stat_list a:nth-child(3)').attr('title')).show();
        }
    })
    classSelect=function(){
            //console.log($("[name=class1_select]").val());
            //console.log( $("[name=class1_select] option:checked").html());
            var class1 = $("select[name=class1_select]").val(),
                //fname = $("[name=class1_select] option:checked").html()+$('.stat_list a:nth-child(2)').attr('title'),
                fsetname = $("[name=class1_select] option:checked").html()+$('.stat_list a:nth-child(3)').attr('title'),
                url0 = $feedbtn1.attr('href').split('class1=')[0]+'class1='+class1,
                url1 = $feedbtn2.attr('href').split('class1=')[0]+'class1='+class1,
                url2 = $feedbtn3.attr('href').split('class1=')[0]+'class1='+class1,
                url_export = $export.attr('href').split('&class1=')[0]+'&class1='+class1+'&met_fd_export=-1';

            if ($("[name=class1_select]").val()=='') {
                $feedbtn2.html('').hide();
                $feedbtn3.html('').hide();
            } else {
                $export.attr('href', url_export);
                $feedbtn1.html(fsetname);
                $feedbtn2.show();
                $feedbtn3.html(fsetname).show();
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

        var showclass = $(".ftype_select-linkage").attr('pclass');
        var nowclass = $("[name=class1_select] option:checked").val();
        var purl = $(".ftype_select-linkage").attr('purl');
        if(showclass != nowclass && !showclass){
            location.href = purl+'&class1='+nowclass;
        }
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
    })*/

    if($('.export-feedback').length){

        $('.export-feedback').click(function(){
            var url = $('select[name=met_fd_export] option:checked').val();
            window.open(url);
        })
    }
});