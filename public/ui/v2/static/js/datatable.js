$(function(){
    var $datatable=$('[data-table-ajaxurl]');
    if($datatable.length){
        var datatable_langurl= M['navurl']+'app/system/include/static2/vendor/datatables/language/';
        // datatable多语言选择
        if("undefined" != typeof M && M['lang_pack'] && M['plugin_lang']){
            switch(M['lang_pack']){
                case 'sq':datatable_langurl+='AL';break;
                case 'ar':datatable_langurl+='MA';break;
                // case 'az':datatable_langurl+='az';break;
                // case 'ga':datatable_langurl+='ie';break;
                // case 'et':datatable_langurl+='ee';break;
                case 'be':datatable_langurl+='BE';break;
                case 'bg':datatable_langurl+='BG';break;
                case 'pl':datatable_langurl+='PL';break;
                case 'fa':datatable_langurl+='IR';break;
                // case 'af':datatable_langurl+='za';break;
                case 'da':datatable_langurl+='DK';break;
                case 'de':datatable_langurl+='DE';break;
                case 'ru':datatable_langurl+='RU';break;
                case 'fr':datatable_langurl+='FR';break;
                // case 'tl':datatable_langurl+='ph';break;
                case 'fi':datatable_langurl+='FI';break;
                // case 'ht':datatable_langurl+='ht';break;
                // case 'ko':datatable_langurl+='kr';break;
                case 'nl':datatable_langurl+='NL';break;
                // case 'gl':datatable_langurl+='es';break;
                case 'ca':datatable_langurl+='ES';break;
                case 'cs':datatable_langurl+='CZ';break;
                // case 'hr':datatable_langurl+='hr';break;
                // case 'la':datatable_langurl+='IT';break;
                // case 'lv':datatable_langurl+='lv';break;
                // case 'lt':datatable_langurl+='lt';break;
                case 'ro':datatable_langurl+='RO';break;
                // case 'mt':datatable_langurl+='mt';break;
                // case 'ms':datatable_langurl+='ID';break;
                // case 'mk':datatable_langurl+='mk';break;
                case 'no':datatable_langurl+='NO';break;
                case 'pt':datatable_langurl+='PT';break;
                case 'ja':datatable_langurl+='JP';break;
                case 'sv':datatable_langurl+='SE';break;
                case 'sr':datatable_langurl+='RS';break;
                case 'sk':datatable_langurl+='SK';break;
                // case 'sl':datatable_langurl+='si';break;
                // case 'sw':datatable_langurl+='tz';break;
                case 'th':datatable_langurl+='TH';break;
                // case 'cy':datatable_langurl+='wls';break;
                // case 'uk':datatable_langurl+='ua';break;
                // case 'iw':datatable_langurl+='';break;
                case 'el':datatable_langurl+='GR';break;
                case 'eu':datatable_langurl+='ES';break;
                case 'es':datatable_langurl+='ES';break;
                case 'hu':datatable_langurl+='HU';break;
                case 'it':datatable_langurl+='IT';break;
                // case 'yi':datatable_langurl+='de';break;
                // case 'ur':datatable_langurl+='pk';break;
                case 'id':datatable_langurl+='ID';break;
                case 'en':datatable_langurl+='English';break;
                case 'vi':datatable_langurl+='VN';break;
                case 'tc':datatable_langurl+='Chinese-traditional';break;
                default:datatable_langurl+='Chinese';break;
            }
        }else{
            datatable_langurl+='Chinese';
        }
        datatable_langurl+='.json';
        window.datatable_pagelength=$datatable.data('pagelength')||30,
        window.datatable_option={
            drawCallback: function(settings){
                if($(window).scrollTop()>$(this).offset().top) $(window).scrollTop($(this).offset().top);// 表单重绘后页面滚动回表单顶部
                if($('[data-original]',this).length) $('[data-original]',this).lazyload();
            },
            responsive: true,
            ordering: false, //是否支持排序
            searching: false, //搜索
            searchable: false, //让搜索支持ajax异步查询
            lengthChange: false,//让用户可以下拉无刷新设置显示条数
            pageLength:datatable_pagelength,//默认每一页的显示数量
            serverSide: true, //ajax服务开启
            stateSave:true,//状态保存 - 再次加载页面时还原表格状态
            language: {
                url:datatable_langurl
            },
            ajax: {
                url: $datatable.data('table-ajaxurl'),
                data: function ( v ) {
                     var l = $("input[data-table-search],select[data-table-search]"),vlist='{ ',i=0;
                     if(l.length>0){
                         l.each(function(){
                             i++;
                             var n  = '"'+$(this).attr("name")+'"',val = '"'+$(this).val()+'"';
                             if(val!='')vlist+=i==l.length?n+':'+val:n+':'+val+',';
                         });
                     }
                     vlist+=' }';
                     vlist=$.parseJSON(vlist);
                     return $.extend( {}, v, vlist );
                }
            }
        };
        if($datatable.hasClass('dataTable')) window.datatable=$datatable.DataTable(datatable_option);
    }
})