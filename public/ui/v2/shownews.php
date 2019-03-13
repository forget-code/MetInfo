<?php
$paths[editor]=1;
$page_type='show';
require_once template('head');
$news['content'] = $metresclass->lazyload($news['content']);// 内容图片懒加载设置
if(!$news['issue']) $news['issue'] = $met_webname;
echo <<<EOT
-->
<main class="met-shownews page-content">
	<div class="container">
		<div class="row">
			<article class="col-lg-9 met-shownews-body panel panel-body m-b-0{$content_position}" boxmh-mh>
				<section class="details-title border-bottom1">
					<h1 class='m-t-10 m-b-5'>{$news[title]}</h1>
					<div class="info font-weight-300">
						<span>{$news['updatetime']}</span>
						<span>{$news['issue']}</span>
						<span><i class="icon wb-eye m-r-5" aria-hidden="true"></i>{$news['hits']}</span>
					</div>
				</section>
				<section class="met-editor clearfix m-t-20">
                	{$news[content]}
<!--
EOT;
if($lang_sharecode){// 分享代码
echo <<<EOT
-->
					<div class="met-tools">{$lang_sharecode}</div>
<!--
EOT;
}
echo <<<EOT
-->
				</section>
<!--
EOT;
require_once template('module/page');// 翻篇
echo <<<EOT
-->
			</article>
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
</main>
<!--
EOT;
require_once template('foot');
?>