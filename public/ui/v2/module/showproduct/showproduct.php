<?php
echo <<<EOT
-->
<main class="page met-showproduct pagetype1">
	<div class="met-showproduct-head page-content block-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
	                <div class="row">
<!--
EOT;
require_once template('module/showproduct/displaylist');
$prointro_class=$_M['config']['shopv2_open']?'':'<div class="h-50 hidden-md-down"></div>';
echo <<<EOT
-->
	                </div>
				</div>
				<div class="col-lg-5">
                	{$prointro_class}
                    <div class="product-intro">
    				    <h1 class='m-t-0 font-size-24'>{$product[title]}</h1>
<!--
EOT;
if($product[description] && $lang_pro_des_ok){
echo <<<EOT
-->
                    	<p class="description">{$product[description]}</p>
<!--
EOT;
}
if($_M['config']['shopv2_open']){
    require_once template('module/md/shop_option');
}else{
    require_once template('module/showproduct/product_paralist');
}
if($lang_sharecode){
echo <<<EOT
-->
                    	<div class="met-tools m-t-15">{$lang_sharecode}</div>
<!--
EOT;
}
echo <<<EOT
-->
                    </div>
				</div>
			</div>
		</div>
	</div>
	<div class="met-showproduct-body page-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-9{$content_position}">
					<div class="row">
<!--
EOT;
require_once template('module/showproduct/content');
echo <<<EOT
-->
					</div>
				</div>
				<div class="col-lg-3">
					<div class="row">
						<aside class="panel panel-body m-b-0 product-hot met-sidebar{$sidebar_position}" boxmh-h>
<!--
EOT;
require_once template('module/md/piclist');
echo <<<EOT
-->
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<!--
EOT;
?>