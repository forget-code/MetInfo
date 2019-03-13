<?php
foreach($news_list as $key=>$val){
	if($key>=$news_firstkey){
		if(!$val['issue']) $val['issue'] = $met_webname;
		$val['desc']=mb_substr($val['description'],0,$lang_news_des_max,'utf-8').'...';
echo <<<EOT
-->
<li class='border-bottom1'>
	<h4>
		<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
			{$val['title']}
		</a>
	</h4>
	<p class="des font-weight-300">{$val['desc']}</p>
	<p class="info font-weight-300">
		<span>{$val['updatetime']}</span>
		<span>{$val['issue']}</span>
		<span><i class="icon wb-eye m-r-5 font-weight-300" aria-hidden="true"></i>{$val['hits']}</span>
	</p>
</li>
<!--
EOT;
	}
}
?>