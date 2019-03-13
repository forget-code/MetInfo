<?php
$bordernone=1;
require_once template('head');
$fid_url=$fid?1:0;
echo <<<EOT
-->
<section class="met-feedback met-page-body bg-pagebg1">
	<div class="container">
		<div class="met-feedback-body met-page-content box-shadow1">
			<form method='POST' class="met-form met-form-validation" action='{$navurl}{$class_list[$classnow][foldername]}/index.php?lang={$lang}&action=add'>
				<input type='hidden' name='lang' value='{$lang}' />
				<input type='hidden' name='fdtitle' value='{$title}' />
				<input type='hidden' name='ip' value='{$m_user_ip}' />
				<input type='hidden' name='id' value='{$id}' />
				<input type='hidden' name='fid_url' value='{$fid_url}' />
<!--
EOT;
$fromarray = $metresclass->formSwitch(metlabel_feedback(),true);//表单转换
require_once template('module/form');
echo <<<EOT
-->
				<div class="form-group m-b-0">
					<button type="submit" class="btn btn-primary btn-lg btn-block btn-squared">{$lang_submit}</button>
				</div>
			</form>
		</div>
	</div>
</section>
<!--
EOT;
require_once template('foot');
?>