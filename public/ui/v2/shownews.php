<?php
$subcolumn_no = 1;
require_once template('head');
$news['content'] = $metresclass->lazyload($news['content']);// 内容图片懒加载设置
if(!$news['issue'])$news['issue'] = $met_webname;
echo <<<EOT
-->
<section class="met-shownews met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 met-shownews-body met-page-content box-shadow1{$content_position}" boxmh-mh>
				<div class="met-shownews-header details-title border-bottom1">
					<h1 class='m-t-10 m-b-5'>{$news[title]}</h1>
					<div class="info font-weight-300">
						<span>{$news['updatetime']}</span>
						<span>{$news['issue']}</span>
						<span><i class="icon wb-eye m-r-5" aria-hidden="true"></i>{$news['hits']}</span>
					</div>
				</div>
				<div class="met-editor clearfix p-x-0">
                	{$news[content]}
<!--
EOT;
if($lang_sharecode){// 分享代码
echo <<<EOT
-->
					<div class="met_tools_code">{$lang_sharecode}</div>
<!--
EOT;
}
echo <<<EOT
-->
				</div>
				<div class="met-shownews-footer border-top1">
<!--
EOT;
require_once template('module/page');// 翻篇
echo <<<EOT
-->
				</div>
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
?>