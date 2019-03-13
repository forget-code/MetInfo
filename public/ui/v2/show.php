<?php
$paths[editor]=1;
$page_type='show';
require_once template('head');
$show['content'] = $metresclass->lazyload($show['content']);// 内容图片懒加载设置
if($lang_about_sidebar_ok){
    $show_body_w=' col-lg-9';// 侧栏显示宽度
}else{
    $content_position='';
}
echo <<<EOT
-->
<main class="met-show page-content">
	<div class="container">
		<div class="row">
            <article class="met-show-body panel panel-body m-b-0{$show_body_w}{$content_position}" boxmh-mh>
    			<section class="met-editor clearfix">
<!--
EOT;
if($show[content]=='<div></div>'){
echo <<<EOT
-->
                    <div class='h-100 text-xs-center font-size-20 vertical-align'>{$lang_nodata}</div>
<!--
EOT;
}else{
echo <<<EOT
-->
                    {$show[content]}
<!--
EOT;
}
echo <<<EOT
-->
    			</section>
            </article>
<!--
EOT;
if($lang_about_sidebar_ok){
echo <<<EOT
-->

            <div class="col-lg-3">
                <div class="row">
<!--
EOT;
    require_once template('module/md/sidebar');// 侧栏
echo <<<EOT
-->
                </div>
            </div>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
	</div>
</main>
<!--
EOT;
require_once template('foot');
?>