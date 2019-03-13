<?php
echo <<<EOT
-->
<article class="product-detail">
<!--
EOT;
if($product[description] && $lang_pro_des_ok){
echo <<<EOT
-->
	<section class="content page-content">
		<div class="container">
			<p class="description m-b-0">{$product[description]}</p>
		</div>
	</section>
<!--
EOT;
}
$i=0;
if(count($product_paralist)){
echo <<<EOT
-->
	<section class="content page-content" id="content-{$i}">
		<div class="container">
<!--
EOT;
	require_once template('module/showproduct/product_paralist');
echo <<<EOT
-->
		</div>
	</section>
<!--
EOT;
	$i++;
}
if($product[content]){
echo <<<EOT
-->
	<section class="content page-content" id='content-{$i}'>
		<div class="container">
			<div class="met-editor clearfix">
				{$product[content]}
			</div>
		</div>
	</section>
<!--
EOT;
	$i++;
}
foreach($productTablist as $key=>$val){
	if($val[content]){
echo <<<EOT
-->
	<section class="content page-content" id="content-{$i}">
		<div class="container">
			<div class="met-editor clearfix">
				{$val[content]}
			</div>
		</div>
	</section>
<!--
EOT;
		$i++;
	}
}
if($lang_sharecode){
echo <<<EOT
-->
	<div class="met-tools tools container m-y-15">{$lang_sharecode}</div>
<!--
EOT;
}
echo <<<EOT
-->
</article>
<!--
EOT;
?>