<!--<?php
if($mbpagelist){
	require_once template('module/message/ajax');// 无刷新翻页获取数据
}else{
	$bordernone=1;
	if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
	require_once template('head');
	$message_submit_w=$message_list?'col-lg-4':'col-lg-6 message-list-no';//有无留言内容的页面结构判断
echo <<<EOT
-->
<section class="met-message met-page-body bg-pagebg1">
	<div class="container">
		<div class="row">
<!--
EOT;
	if($message_list){
echo <<<EOT
-->
			<div class="col-lg-8 met-message-body met-page-content box-shadow1{$content_position}" boxmh-mh>
				<ul class="list-group list-group-dividered list-group-full met-pager-ajax">
<!--
EOT;
		require_once template('module/message/ajax');
echo <<<EOT
-->
				</ul>
<!--
EOT;
		$pagenorerresh = true;// 分页样式判断
		require_once template('module/pager');// 分页
echo <<<EOT
-->
			</div>
<!--
EOT;
	}
echo <<<EOT
-->
			<div class="{$message_submit_w}">
				<div class="row">
					<div class="met-message-submit{$sidebar_position} met-page-content box-shadow1" boxmh-h>
						<form method='POST' class="met-form met-form-validation" action='{$navurl}{$class_list[$classnow][foldername]}/message.php?lang={$lang}&action=add'>
							<input type='hidden' name='lang' value='{$lang}' />
<!--
EOT;
	$fromarray = $metresclass->formSwitch(metlabel_message(),true);//表单转换
	require_once template('module/form');
echo <<<EOT
-->
							<div class="form-group m-b-0">
								<button type="submit" class="btn btn-primary btn-block btn-squared">{$lang_submit}</button>
							</div>
						</form>
					</div>
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