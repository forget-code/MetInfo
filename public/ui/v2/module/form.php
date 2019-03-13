<?php
$simplify=0;
foreach($fromarray as $key=>$val){
echo <<<EOT
-->
<div class="form-group">
<!--
EOT;
	if(!$val['simplify']){
		if($val['type']<4)$simplify=1;
echo <<<EOT
-->
	<label class="control-label">{$val[name]}</label>
<!--
EOT;
	}
echo <<<EOT
-->
	{$val[type_html]}
</div>
<!--
EOT;
}
if($met_memberlogin_code==1){
echo <<<EOT
-->
<div class="form-group">
<!--
EOT;
	if($simplify){
echo <<<EOT
-->
	<label class="control-label">{$lang_memberImgCode}</label>
<!--
EOT;
	}
echo <<<EOT
-->
	<div class="input-group input-group-icon">
		<input
			name='code'
			type="text"
			class="form-control input-codeimg"
			placeholder = "{$lang_memberImgCode}"
			required
			data-fv-message = "{$lang_Empty}"
		>
		<span class="input-group-addon">
			<img
				src="{$navurl}member/ajax.php?action=code"
				alt="{$lang_memberTip1}"
				title="{$lang_memberTip1}"
				class="met-form-codeimg"
				data-src="{$navurl}member/ajax.php?action=code"
				role='button'
			/>
		</span>
	</div>
</div>
<!--
EOT;
}
?>