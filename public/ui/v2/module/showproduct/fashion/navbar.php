<?php
if($_M['url']['shop']) require_once template('module/shop/shop_fashion_modal');
echo <<<EOT
-->
<div>
	<nav class="navbar navbar-default bg-navhvbg box-shadow-none radius0">
		<div class="container">
<!--
EOT;
if($_M['url']['shop']) require_once template('module/shop/shop_fashion_btn');
echo <<<EOT
-->
			<div class="navbar-header row">
				<button type="button" class="navbar-toggler h-50 p-0 collapsed" data-target="#navbar-showproduct-pagetype2"
				data-toggle="collapse">
					<i class="icon wb-chevron-down" aria-hidden="true"></i>
				</button>
				<h1 class="navbar-brand m-0 p-y-0">{$product['title']}</h1>
			</div>
			<div class="navbar-collapse navbar-collapse-toolbar row collapse" id="navbar-showproduct-pagetype2">
				<ul class="nav navbar-toolbar pull-md-right met-showproduct-navtabs">
<!--
EOT;
$i=0;
if(count($product_paralist)){
echo <<<EOT
-->
					<li class='nav-item'><a href="#content-{$i}" class='nav-link'>{$lang_specpara}</a></li>
<!--
EOT;
	$i++;
}
if($product[content]){
echo <<<EOT
-->
					<li class="nav-item"><a href="#content-{$i}" class='nav-link'>{$met_productTabname}</a></li>
<!--
EOT;
	$i++;
}
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
					<li class='nav-item'><a href="#content-{$i}" class='nav-link'>{$val['title']}</a></li>
<!--
EOT;
		$i++;
	}
}
echo <<<EOT
-->
				</ul>
			</div>
		</div>
	</nav>
</div>
<!--
EOT;
?>