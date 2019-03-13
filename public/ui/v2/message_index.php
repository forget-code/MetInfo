<!--<?php
if($mbpagelist){
	require_once template('module/message/ajax');// 无刷新翻页获取数据
}else{
	$paths[form]=1;
	$paths[pager]=1;
	$page_type='message';
	if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
	require_once template('head');
	$message_submit_w=$message_list?'col-lg-4':'col-md-8 col-lg-6 offset-md-2 offset-lg-3 message-list-no';//有无留言内容的页面结构判断
echo <<<EOT
-->
<main class="met-message page-content">
	<div class="container">
		<div class="row">
<!--
EOT;
	if($message_list){
echo <<<EOT
-->
			<div class="col-lg-8 met-message-body panel panel-body m-b-0{$content_position}" boxmh-mh>
				<ul class="list-group list-group-dividered list-group-full met-pager-ajax met-message-list">
<!--
EOT;
		require_once template('module/message/ajax');
echo <<<EOT
-->
				</ul>
<!--
EOT;
		$page_ajax_open = true;// 分页样式判断
		if($message_list) require_once template('module/pager');// 分页
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
					<div class="met-message-submit{$sidebar_position} panel panel-body m-b-0" boxmh-h>
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
</main>
<!--
EOT;
	require_once template('foot');
}
?>