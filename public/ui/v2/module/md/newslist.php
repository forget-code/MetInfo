<?php
$classnow_modulename=metmodname($class_list[$classnow][module]);
$sidebar_newslist[id]=$GLOBALS["lang_{$classnow_modulename}_sidebar_newslist_id"];
$sidebar_newslist[title]=$GLOBALS["lang_{$classnow_modulename}_sidebar_newslist_title"];
$sidebar_newslist[type]=$GLOBALS["lang_{$classnow_modulename}_sidebar_newslist_type"];
if(!$sidebar_newslist[id]) $sidebar_newslist[id]=$class1;
$sidebar_newslist['list']=methtml_getarray($sidebar_newslist[id],$sidebar_newslist[type],'','',$lang_sidebar_newslist_num,'','',1);
echo <<<EOT
-->
<div class="sidebar-news-list recommend">
	<h3 class='font-size-16 font-weight-300 m-0'>{$sidebar_newslist[title]}</h3>
	<ul class="list-group list-group-bordered m-t-10 m-b-0">
<!--
EOT;
foreach($sidebar_newslist['list'] as $val){
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