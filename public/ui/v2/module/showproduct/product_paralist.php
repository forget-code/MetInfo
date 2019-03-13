<?php
if(count($product_paralist)){
	$blocks=$_M['url']['shop'] || $lang_product_pagetype ==2?' blocks-100 blocks-sm-2 blocks-md-3 blocks-xl-4':' blocks-100 blocks-sm-2 blocks-md-3 blocks-lg-2';
echo <<<EOT
-->
<ul class="product-para paralist{$blocks}">
<!--
EOT;
    foreach($product_paralist as $val){
		if($product[$val[para]]){
echo <<<EOT
-->
	<li><span>{$val[name]}：</span>{$product[$val[para]]}</li>
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
?>