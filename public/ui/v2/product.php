<!--<?php
if($mbpagelist){
    require_once template('module/product/ajax_'.$lang_product_listtype);// 无刷新翻页获取数据
}else{
    $paths[lazyload]=1;
    $paths[masonry_extend]=1;
    $paths[pager]=1;
    $paths[product]=1;
    $page_type='product';
    $subcolumn_search = $lang_product_search;
    require_once template('head');
    $fluid = $lang_product_listtype>1?'-fluid':'';
    $nospace=$lang_product_listtype==2?'no-space':'';
    $masonry_class=$lang_product_listmasonry_ok?'met-grid':'';
    $scale=$met_productimg_y/$met_productimg_x;
    $pro_column_res=$metresclass->listColumnRes($lang_pro_column_xs,$lang_pro_column_md,$lang_pro_column_lg,$lang_pro_column_xxl);// 列表响应式布局类名
echo <<<EOT
-->
<main class="met-product type-{$lang_product_listtype} page-content">
	<div class="container{$fluid}">
        <ul class="{$pro_column_res}{$nospace} met-pager-ajax imagesize cover met-product-list {$masonry_class}" id="{$masonry_class}" data-scale='{$scale}'>
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
        <div class='h-400 p-t-80 block-bg text-xs-center'>
            <h4 class="page-search-title">{$lang_SearchInfo3} " <span class='blue-600'>{$content}</span> " {$lang_SearchInfo4}</h4>
        </div>
<!--
EOT;
        }else{// 列表没有内容时
echo <<<EOT
-->
        <div class='h-100 block-bg text-xs-center font-size-20 vertical-align'>{$lang_nodata}</div>
<!--
EOT;
        }
    }else{
        // 分页
        $lang_page_ajax_next = $lang_product_ajax_next;// 自定义无刷新翻页文字
        require_once template('module/pager');
    }
echo <<<EOT
-->
	</div>
</main>
<!--
EOT;
    require_once template('foot');
}
?>