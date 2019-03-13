<!--<?php
echo <<<EOT
-->
<!--
EOT;
$tem_about = tmpcentarr($lang_about_id);
echo <<<EOT
-->
<section class="tem_index_about">
	<div class="tem_inner">
		<h3 class="tem_index_title">
			<span>
				{$lang_about_title}
			</span>
		</h3>
		<div class="met_editor">
			{$lang_about_content}<div class="met_clear"></div>
			<h4 class="tem_index_about_more"><a href="{$tem_about[url]}" title="{$lang_about_more}" {$metblank}>{$lang_about_more}</a></h4>
		</div>
	</div>
</section>
<!--
EOT;
?>