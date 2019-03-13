<?php
require_once template('head');
echo <<<EOT
-->
<main class="met-sitemap page-content">
	<div class="container met-sitemap-body panel panel-body m-b-0">
		<ul class="sitemap-list m-0 ulstyle blue-grey-500">
<!--
EOT;
foreach($nav_list_1 as $val){
echo <<<EOT
-->
			<li>
				<a href='{$val[url]}' title='{$val[name]}' {$metblank}><i class="icon wb-menu m-r-10" aria-hidden="true"></i>{$val[name]}</a>
<!--
EOT;
	if(count($nav_list2[$val[id]])){
echo <<<EOT
-->
				<ul>
<!--
EOT;
		foreach($nav_list2[$val[id]] as $val2){
echo <<<EOT
-->
					<li><a href='{$val2[url]}' title='{$val2[name]}' {$metblank}><i class="icon wb-link pull-xs-right"></i><span>{$val2[name]}</span></a></li>
<!--
EOT;
			if(count($nav_list3[$val2[id]])){
echo <<<EOT
-->
					<ul class="sitemap-list-sub">
<!--
EOT;
				foreach($nav_list3[$val2[id]] as $val3){
echo <<<EOT
-->
						<li><a href='{$val3[url]}' title='{$val3[name]}' {$metblank}>{$val3[name]}</a></li>
<!--
EOT;
				}
echo <<<EOT
-->
					</ul>
<!--
EOT;
			}
		}
echo <<<EOT
-->
				</ul>
<!--
EOT;
	}
echo <<<EOT
-->
			</li>
<!--
EOT;
}
echo <<<EOT
-->
		</ul>
	</div>
</main>
<!--
EOT;
require_once template('foot');
?>