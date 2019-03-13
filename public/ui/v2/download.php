<!--<?php
if($mbpagelist){
	require_once template('module/download/ajax');// 无刷新翻页获取数据
}else{
	$border_section=1;
	if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
	require_once template('head');
echo <<<EOT
-->
<section class="met-download met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 met-download-body met-page-content box-shadow1{$content_position}" boxmh-mh>
				<ul class="list-group list-group-dividered list-group-full m-b-0 met-pager-ajax met-download-list">
<!--
EOT;
	if($download_list) {
		require_once template('module/download/ajax');
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
</section>
<!--
EOT;
	require_once template('foot');
}
?>