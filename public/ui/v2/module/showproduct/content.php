<?php
echo <<<EOT
-->
<div class="panel panel-body m-b-0 product-detail" boxmh-mh>
	<ul class="nav nav-tabs nav-tabs-line m-b-20 met-showproduct-navtabs">
		<li class="nav-item"><a class='nav-link active' data-toggle="tab" href="#product-details" data-get="product-details">{$met_productTabname}</a></li>
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
		<li class='nav-item'><a class='nav-link' data-toggle="tab" href="#content-{$i}" data-get="content-{$i}">{$val['title']}</a></li>
<!--
EOT;
		$i++;
	}
}
echo <<<EOT
-->
	</ul>
	<article class="tab-content">
		<section class="tab-pane met-editor clearfix animation-fade active" id="product-details">
<!--
EOT;
if($_M['url']['shop']) require_once template('module/showproduct/product_paralist');
echo <<<EOT
-->
			{$product[content]}
		</section>
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
		<section class="tab-pane met-editor clearfix animation-fade" id="content-{$i}">
			{$val[content]}
		</section>
<!--
EOT;
		$i++;
	}
}
echo <<<EOT
-->
	</article>
</div>
<!--
EOT;
?>