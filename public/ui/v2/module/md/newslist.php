<?php
$sidebar_list=methtml_getarray($sidebar_list_id,$sidebar_list_type,'','',$sidebar_list_num,'','',1);
echo <<<EOT
-->
<div class="recommend sidebar-news-list">
	<h3 class='font-size-16 font-weight-300 m-0'>{$sidebar_list_title}</h3>
	<ul class="list-group list-group-bordered m-t-10 m-b-0">
<!--
EOT;
foreach($sidebar_list as $key=>$val){
echo <<<EOT
-->
		<li class="list-group-item"><a href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val[title]}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
	</ul>
</div>
<!--
EOT;
?>