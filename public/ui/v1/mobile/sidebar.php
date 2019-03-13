<!--<?php
$sidebar=metlabel_sidebar(0);//内页侧栏标签
$sidebar_title=metlabel_sidebar(1);//内页侧栏标题
echo <<<EOT
-->
<section class="met_section">
<!--
EOT;
if(!$id||$class_list[$classnow][module]==1){
echo <<<EOT
-->
    <aside class="am-offcanvas">
<div class="am-offcanvas-bar">
    <div class="am-offcanvas-content">
<!--
EOT;
if($sidebar){
echo <<<EOT
-->
		<section class="met_aside">
			<div class="met_aside_list">
				{$sidebar}
				<div class="met_clear"></div>
			</div>
		</section>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
		</div>
    </aside>
<!--
EOT;
}
echo <<<EOT
-->
    <article>
		<div class="met_article">
<!--
EOT;
if(!$id||$class_list[$classnow][module]==1){
echo <<<EOT
-->
		<section class="met_article_head">
			<h1>{$class_list[$classnow][name]}</h1>
<!--
EOT;
if($sidebar){
echo <<<EOT
-->
			<h3 data-am-offcanvas="{target: '.met_section aside'}"><i class="am-icon-bars"></i>{$_M['word']['switching_category']}</h3>
<!--
EOT;
}
echo <<<EOT
-->
		</section>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
?>