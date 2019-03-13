<?php
require_once template('head');
$show['content'] = $metresclass->lazyload($show['content']);// 内容图片懒加载设置
if($lang_show_sidebar_ok){
    $show_body_w=' col-lg-9';// 侧栏显示宽度
}else{
    $content_position='';
}
echo <<<EOT
-->
<section class="met-show met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
            <div class="met-show-body met-page-content box-shadow1{$show_body_w}{$content_position}" boxmh-mh>
    			<div class="met-editor p-0 clearfix">
<!--
EOT;
if($show[content]=='<div></div>'){
echo <<<EOT
-->
                    <div class='h-100 text-xs-center font-size-20 vertical-align'>暂无内容</div>
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
    			</div>
            </div>
<!--
EOT;
if($lang_show_sidebar_ok){
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
</section>
<!--
EOT;
require_once template('foot');
?>