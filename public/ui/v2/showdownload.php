<?php
$border_section=1;
require_once template('head');
$download['content'] = $metresclass->lazyload($download['content']);// 内容图片懒加载设置
if(!$download['issue'])$download['issue'] = $met_webname;// 发布者判断
echo <<<EOT
-->
<section class="met-download met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 met-download-body met-page-content box-shadow1{$content_position}" boxmh-mh>
				<div class="met-download-header details-title border-bottom1">
					<h1 class='m-t-10 m-b-5'>{$download[title]}</h1>
					<div class="info">
						<span>{$download['updatetime']}</span>
						<span>{$download['issue']}</span>
						<span><i class="icon wb-eye m-r-5" aria-hidden="true"></i>{$download['hits']}</span>
					</div>
				</div>
<!--
EOT;
if($download_paralist){
echo <<<EOT
-->
				<div class="download-paralist m-t-20 p-b-20 border-bottom1">
					<dl class="dl-horizontal clearfix blocks font-size-16">
<!--
EOT;
	foreach($download_paralist as $key=>$val){
echo <<<EOT
-->
						<dt class='col-sm-3 col-xs-12 font-weight-300'>{$val[name]} :</dt>
						<dd class="col-sm-9 col-xs-12 blue-grey-500">{$download[$val[para]]}</dd>
<!--
EOT;
	}
echo <<<EOT
-->
					</dl>
				</div>
<!--
EOT;
}
echo <<<EOT
-->
				<a class="btn btn-outline btn-primary btn-squared met-download-btn m-t-20" href="{$download[downloadurl]}" title="{$download[title]}">{$lang_download}</a>
<!--
EOT;
if($download[content]){
echo <<<EOT
-->
				<div class="met-editor clearfix p-x-0 p-b-0">
					{$download[content]}
				</div>
<!--
EOT;
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
?>