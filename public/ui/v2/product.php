<!--<?php
if($mbpagelist){
    require_once template('static/metresclass.class');//模板处理方法
    require_once template('module/product/ajax_'.$lang_product_listtype);// 无刷新翻页获取数据
}else{
    $bordernone=1;
    $product_search = $lang_product_search;
    require_once template('head');
    $fluid = $lang_product_listtype>1?'-fluid':'';
    $nospace=$lang_product_listtype==2?'no-space':'';
    $scale=$met_productimg_y/$met_productimg_x;
    $pro_column_res=$metresclass->listColumnRes($lang_pro_column_xs,$lang_pro_column_md,$lang_pro_column_lg,$lang_pro_column_xxl);//列表响应式样式
echo <<<EOT
-->
<div class="met-product type-{$lang_product_listtype} met-page-body bg-pagebg1">
	<div class="container{$fluid}">
        <ul class="{$pro_column_res}{$nospace} met-pager-ajax met-grid imagesize cover" id="met-grid" data-scale='{$scale}'>
<!--
EOT;
    if($product_list) require_once template('module/product/ajax_'.$lang_product_listtype);
echo <<<EOT
-->
        </ul>
<!--
EOT;
    // 搜索结果为空的情况
    if(!$product_list){
        if($content && $search=='search'){
echo <<<EOT
-->
        <div class='h-400 p-t-80 bg-pageeditbg text-xs-center'>
            <h4 class="page-search-title">
                {$lang_SearchInfo3} "{$content}" {$lang_SearchInfo4}
            </h4>
        </div>
<!--
EOT;
        }else{// 列表没有内容时
echo <<<EOT
-->
        <div class='h-100 bg-pageeditbg text-xs-center font-size-20 vertical-align'>暂无内容</div>
<!--
EOT;
        }
    }else{
        // 分页
        $pagetxt = $lang_product_moretxt;//无刷新分页文字特殊定义
        require_once template('module/pager');
    }
echo <<<EOT
-->
	</div>
</div>
<!--
EOT;
    require_once template('foot');
}
?>