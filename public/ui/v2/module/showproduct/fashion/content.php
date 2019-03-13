<?php
$i=0;
if($product[description] && $lang_pro_des_ok){
echo <<<EOT
-->
<div class="product-detail">
	<div class="content met-page-body">
		<div class="container">
			<p class="description m-b-0">{$product[description]}</p>
		</div>
	</div>
<!--
EOT;
}
if(count($product_paralist)){
echo <<<EOT
-->
	<div class="content met-page-body" id="content-{$i}">
		<div class="container">
<!--
EOT;
	require_once template('module/showproduct/product_paralist');
echo <<<EOT
-->
		</div>
	</div>
<!--
EOT;
	$i++;
}
if($product[content]){
echo <<<EOT
-->
	<div class="content met-page-body" id='content-{$i}'>
		<div class="container">
			<div class="row">
				<div class="met-editor clearfix">
					{$product[content]}
				</div>
			</div>
		</div>
	</div>
<!--
EOT;
	$i++;
}
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
	<div class="content met-page-body" id="content-{$i}">
		<div class="container">
			<div class="row">
				<div class="met-editor clearfix">
					{$val[content]}
				</div>
			</div>
		</div>
	</div>
<!--
EOT;
		$i++;
	}
}
if($lang_sharecode){
echo <<<EOT
-->
	<div class="tools container m-y-15">{$lang_sharecode}</div>
</div>
<!--
EOT;
}
?>