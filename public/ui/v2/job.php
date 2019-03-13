<!--<?php
if($mbpagelist){
	require_once template('module/job/ajax');// 无刷新翻页获取数据
}else{
	$bordernone=1;
	if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
	require_once template('head');
echo <<<EOT
-->
<section class="met-job met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
			<div class="met-job-list met-pager-ajax">
<!--
EOT;
	if($job_list) {
		require_once template('module/job/ajax');
	}else{// 列表没有内容时
echo <<<EOT
-->
                <div class='h-100 text-xs-center font-size-20 vertical-align'>暂无内容</div>
<!--
EOT;
    }
echo <<<EOT
-->
			</div>
<!--
EOT;
	if($job_list) require_once template('module/pager');// 分页
echo <<<EOT
-->
		</div>
	</div>
</section>
<!--
EOT;
	if($job_list) require_once template('module/job/job_form');// 应聘表单
	require_once template('foot');
}
?>