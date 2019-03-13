<?php
$search_list_num=0;
foreach($search_list as $val){
	if(!strstr($val['title'],$lang_SearchInfo1)){
		if($val['url']!=$_M['url']['site']){
			$val['urlhrml'] = str_replace("../",$_M['url']['site'],$val[url]);
			$search_list_num++;
echo <<<EOT
-->
<li class="list-group-item">
	<h4><a href="{$val[url]}" title='{$val[title]}' {$metblank}>{$val[title]}</a></h4>
	<a class="search-result-link" href="{$val[url]}" {$metblank}>{$val[urlhrml]}</a>
<!--
EOT;
			if($val[content]){
echo <<<EOT
-->
	<p class='search-text'>{$val[content]}</p>
<!--
EOT;
			}
echo <<<EOT
-->
</li>
<!--
EOT;
		}
	}
}
?>