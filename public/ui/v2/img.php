<!--<?php
if($mbpagelist){
    require_once template('module/img/ajax');// 无刷新翻页获取数据
}else{
    $paths[lazyload]=1;
    $paths[lightgallery]=1;
    $paths[photoswipe]=1;
    $paths[pager]=1;
    $paths[img]=1;
    $page_type='img';
    require_once template('head');
    if($lang_img_listtype){// 列表显示模式判断
        $img_listtype1=' page-content';
    }else{
        $img_listtype0='-fluid';
    }
    $img_column_res=$metresclass->listColumnRes($lang_img_column_xs,$lang_img_column_md,$lang_img_column_lg,$lang_img_column_xxl);// 列表响应式布局类名
    $scale=$met_imgs_y/$met_imgs_x;
echo <<<EOT
-->
<main class="met-img border-top1{$img_listtype1}">
    <div class="container{$img_listtype0}">
        <div class="row">
            <ul class="{$img_column_res} no-space met-pager-ajax imagesize met-img-list" data-scale='{$scale}'>
<!--
EOT;
    if($img_list) {
        require_once template('module/img/ajax');
    }else{// 列表没有内容时
echo <<<EOT
-->
                <div class='h-100 text-xs-center font-size-20 vertical-align'>{$lang_nodata}</div>
<!--
EOT;
    }
echo <<<EOT
-->
            </ul>
<!--
EOT;
    if($img_list) {
        $page_ajax_open =$lang_img_listtype==0?true:false;// 分页样式判断
        require_once template('module/pager');// 分页
    }
echo <<<EOT
-->
        </div>
    </div>
</main>
<!--
EOT;
    require_once template('foot');
}
?>