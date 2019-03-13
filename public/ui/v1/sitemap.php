<!--<?php
require_once template('head'); 
require_once template('sidebar');
echo <<<EOT
-->
        <div id="sitemaplist">
<!--
EOT;
foreach($nav_list_1 as $key=>$val){
echo <<<EOT
-->	
			<dl>
				<dt><h2><a href='{$val[url]}' title='{$val[name]}' >{$val[name]}</a><i class="fa fa-angle-right"></i></h2></dt>
				<dd>
<!--
EOT;
foreach($nav_list2[$val[id]] as $key=>$val2){
echo <<<EOT
-->	
					<ul>
						<li class="top"><h3><a href='{$val2[url]}' title='{$val2[name]}' >{$val2[name]}</a></h3></li>
<!--
EOT;
foreach($nav_list3[$val2[id]] as $key=>$val3){
echo <<<EOT
-->	
						<li><h4><a href='{$val3[url]}' title='{$val3[name]}' >{$val3[name]}</a></h4></li>
<!--
EOT;
}
echo <<<EOT
-->						
					</ul>
<!--
EOT;
}
echo <<<EOT
-->
					<div class="met_clear"></div>
				</dd>
			</dl>
<!--
EOT;
}
echo <<<EOT
-->
        </div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>