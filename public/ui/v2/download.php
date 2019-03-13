<!--<?php
if($mbpagelist){
	require_once template('module/download/ajax');// 无刷新翻页获取数据
}else{
	$paths[lazyload]=1;
	$paths[pager]=1;
	$page_type='download';
	require_once template('head');
echo <<<EOT
-->
<main class="met-download page-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 met-download-body panel panel-body m-b-0{$content_position}" boxmh-mh>
				<ul class="list-group list-group-dividered list-group-full met-pager-ajax met-download-list">
<!--
EOT;
	if($download_list) {
		require_once template('module/download/ajax');
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
	if($download_list) require_once template('module/pager');// 分页
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
</main>
<!--
EOT;
	require_once template('foot');
}
?>