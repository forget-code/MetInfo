<!--<?php
if($lang_news_listtype>1){// 列表图片尺寸比例判断
    if($lang_news_listtype==2){
        $scale=$met_newsimg_y/$met_newsimg_x;
    }else{
        $scale=$lang_news_type3_y/$lang_news_type3_x;
    }
    $data_scale=" data-scale='{$scale}'";
    $imagesize=' imagesize';
}
if($mbpagelist){
    if($lang_news_listtype>1) require_once template('static/metresclass.class');// 模板处理方法
    require_once template('module/news/ajax_'.$lang_news_listtype);// 无刷新翻页获取数据
}else{
    $subcolumn_no = 1;
    require_once template('head');
    $type3=$lang_news_listtype==3?' type-3':'';
echo <<<EOT
-->
<section class="met-news met-page-body bg-pagebg1">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 met-news-body met-page-content box-shadow1{$content_position}" boxmh-mh>
<!--
EOT;
    if($news_list){
        if($lang_news_listtype<3 && $lang_news_headlines_ok){
            require_once template('module/news/headlines');//头条
            $news_firstkey=$lang_news_headlines_num;// 从新闻头条数量后开始输出
        }else{
            $news_firstkey=0;
        }
    }
echo <<<EOT
-->
                <ul class="met-news-list{$type3} ulstyle met-pager-ajax{$imagesize}"{$data_scale}>
<!--
EOT;
    if($news_list){
        require_once template('module/news/ajax_'.$lang_news_listtype);
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
    if($news_list){
        // 分页
        $pagetxt = $lang_news_more_txt;// 无刷新分页文字特殊定义
        require_once template('module/pager');
    }
echo <<<EOT
-->
            </div>
            <div class="col-lg-3">
                <div class="row">
<!--
EOT;
    require_once template('module/md/sidebar');// 侧栏
echo <<<EOT
-->
                </div>
            </div>
        </div>
    </div>
</section>
<!--
EOT;
    require_once template('foot');
}
?>