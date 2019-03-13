<?php
require_once template('head');
echo <<<EOT
-->
<section class="met-sitemap met-page-body bg-pagebg1">
	<div class="container met-sitemap-body met-page-content box-shadow1">
		<ul class="sitemap-list m-0 met-uldestyle blue-grey-500">
<!--
EOT;
foreach($nav_list_1 as $key=>$val){
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
		foreach($nav_list2[$val[id]] as $key=>$val2){
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
				foreach($nav_list3[$val2[id]] as $key=>$val3){
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
</section>
<!--
EOT;
require_once template('foot');
?>