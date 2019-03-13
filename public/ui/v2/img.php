<!--<?php
if($mbpagelist){
    require_once template('static/metresclass.class');// 模板处理方法
    require_once template('module/img/ajax');// 无刷新翻页获取数据
}else{
    $subcolumn_no = 1;
    require_once template('head');
    if($lang_img_listtype){// 列表显示模式判断
        $page_body=' met-page-body';
    }else{
        $fluid='-fluid';
        $nospace='no-space';
    }
    $img_column_res=$metresclass->listColumnRes($lang_img_column_xs,$lang_img_column_md,$lang_img_column_lg,$lang_img_column_xxl);//列表响应式样式
    $scale=$met_imgs_y/$met_imgs_x;
echo <<<EOT
-->
<div class="met-img border-top1{$page_body}">
    <div class="container{$fluid}">
        <div class="row">
            <ul class="{$img_column_res}{$nospace} met-pager-ajax imagesize met-img-list" data-scale='{$scale}'>
<!--
EOT;
    if($img_list) {
        require_once template('module/img/ajax');
    }else{// 列表没有内容时
echo <<<EOT
-->
                <div class='h-100 text-xs-center font-size-20 vertical-align'>暂无内容</div>
<!--
EOT;
    }
echo <<<EOT
-->
            </ul>
<!--
EOT;
    if($img_list) {
        $pagenorerresh =$lang_img_listtype==0?true:false;// 分页样式判断
        require_once template('module/pager');// 分页
    }
echo <<<EOT
-->
        </div>
    </div>
</div>
<!--
EOT;
    require_once template('foot');
}
?>