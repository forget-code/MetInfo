<!--<?php
require_once template('head'); 
require_once template('sidebar');
echo <<<EOT
-->
        <div class="met_module2_list">
			<ul>
<!--
EOT;
foreach($news_list as $key=>$val){
$val['imghtml']     = $lang_met_module2_type==3?"<img src=\"{$thumb_src}dir={$val[imgurl]}&x=90&y=90\" />":'';
$val['i']           = $lang_met_module2_type==1?'<i class="fa fa-caret-right"></i>':'';
$val['description'] = $lang_met_module2_type >1?'<p>'.utf8substr($val['description'],0,200).'</p>':'';
echo <<<EOT
-->
				<li class="list_{$lang_met_module2_type}">
					{$val['imghtml']}
					<h2><a href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val['i']}{$val['title']}</a></h2>
					{$val['description']}
					<span class='time'>{$val['updatetime']}</span>
				</li>
<!--
EOT;
}
echo <<<EOT
--> 
			</ul>
			{$page_list}
		</div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>