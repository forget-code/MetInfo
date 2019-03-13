<?php
echo <<<EOT
-->
<div class="panel panel-body m-b-0 radius0 product-detail" boxmh-mh>
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
	<div class="tab-content">
		<div class="tab-pane met-editor clearfix p-0 animation-fade active" id="product-details">
<!--
EOT;
if($_M['url']['shop']) require_once template('module/showproduct/product_paralist');
echo <<<EOT
-->
			{$product[content]}
		</div>
<!--
EOT;
$i=0;
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
		<div class="tab-pane met-editor clearfix p-0 animation-fade" id="content-{$i}">
			{$val[content]}
		</div>
<!--
EOT;
		$i++;
	}
}
echo <<<EOT
-->
	</div>
</div>
<!--
EOT;
?>