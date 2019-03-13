<?php
$goods['price'] = $goods['price'] ? number_format($goods['price'], 2, '.', ''): '0.00';
// 原价
if($goods['original']) $goods['original_html'] = "<del class='m-l-20'>{$_M['word']['app_shop_original']}{$goods['original_str']}</del>";
echo <<<EOT
-->
<div class="shop-product-intro grey-500">
	<div class="p-20 bg-grey-100 red-600 price">
		<span class='font-size-18'>{$_M['config']['shopv2_price_str_prefix']} </span><span id="price" class="font-size-30">{$goods['price']}</span>{$goods['original_html']}
	</div>
<!--
EOT;
if($is_shopv3) require_once PATH_WEB.'app/app/shop/web/templates/met/module/md/shop_discount_receive.php';// 优惠券
// 规格
if($goods['selectpara']){
echo <<<EOT
-->
	<div class="shop-product-para">
<!--
EOT;
	foreach($goods['selectpara'] as $valselect){
echo <<<EOT
-->
		<div class="row m-t-15">
			<label class='form-control-label col-sm-2'>{$valselect['name']}</label>
			<div class="selectpara-list col-sm-10">
<!--
EOT;
		foreach($valselect['value'] as $valvalue){
echo <<<EOT
-->
				<a href="javascript:;" title='{$valvalue}' data-val="{$valvalue}" class="selectpara text-truncate btn btn-squared btn-outline btn-default m-r-10{$para_class}">{$para_img}{$valvalue}</a>
<!--
EOT;
		}
echo <<<EOT
-->
			</div>
		</div>
<!--
EOT;
	}
echo <<<EOT
-->
	</div>
<!--
EOT;
}
// 可购买数量
$shopmax = $goods['stock'];// 总量
// 限购
if($goods['purchase']){
	$goods['purchase_html'] = "<span class=\"tag tag-round tag-default m-r-10\">{$_M['word']['app_shop_purchase']} {$goods['purchase']} {$_M['word']['app_shop_piece']}</span>";
	$shopmax = $goods['purchase'];
}
// 最少可购
$shopmin=$shopmax?1:0;
echo <<<EOT
-->
	<div class="row m-t-15">
		<label class='form-control-label col-sm-2'>{$_M['word']['app_shop_number']}</label>
		<div class="col-sm-10">
			<div class="w-150 inline-block m-r-10">
				<input type="text" class="form-control text-xs-center" data-min="{$shopmin}" data-max="{$shopmax}" data-plugin="touchSpin" name="buynum" id="buynum" autocomplete="off" value="{$shopmin}">
			</div>
<!--
EOT;
// 库存
if($goods['stock_show']) $goods['stock_html'] = "<div class='inline-block m-r-10'>{$_M['word']['app_shop_stock']} <span id='stock-num' data-stock='{$goods['stock']}'>{$goods['stock']}</span> {$_M['word']['app_shop_piece']}</div>";
if($goods['stock_html'] || $goods['purchase_html']){
echo <<<EOT
-->
			<div class='m-t-5 stock-purchase'>{$goods['stock_html']}{$goods['purchase_html']}</div>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
	</div>
<!--
EOT;
if($is_shopv3){
	$favorite_href=$metinfo_member_name?$_M['url']['shop_favorite_do']:$_M['url']['shop_member_login'];
	if($is_favorite){
		$favorite_class1='success';
		$favorite_class2='fa-heart';
		$favorite_text=$_M['word']['app_shop_favorited'];
	}else{
		$favorite_class1='warning';
		$favorite_class2='fa-heart-o';
		$favorite_text=$_M['word']['app_shop_favorite_add'];
	}
	$cart_favorite_class=$met_langok[$_M[lang]][synchronous]=='cn'?'':' no-cn';
}
echo <<<EOT
-->
	<div class="m-t-20 clearfix{$cart_favorite_class} cart-favorite">
<!--
EOT;
if($is_shopv3){
echo <<<EOT
-->
		<a href="{$favorite_href}" data-pid='{$goods['pid']}' class='btn btn-squared btn-lg btn-{$favorite_class1} pull-sm-right product-favorite'><i class="icon {$favorite_class2} m-r-5"></i><span>{$favorite_text}</span></a>
<!--
EOT;
}else{
echo <<<EOT
-->
		<a href="{$_M['url']['shop_tocart_now']}&pid={$goods['pid']}" class="btn btn-lg btn-squared btn-danger m-r-20 product-buynow">{$_M['word']['app_shop_buyimmediately']}</a>
<!--
EOT;
}
$product_tocart_class=$is_shopv3?'danger':'warning';
echo <<<EOT
-->
		<a href="{$_M['url']['shop_tocart']}&pid={$goods['pid']}" data-pid='{$goods['pid']}' class="btn btn-lg btn-squared btn-{$product_tocart_class} m-r-20 product-tocart"><i class="icon fa-cart-plus m-r-5 font-size-20" aria-hidden="true"></i>{$_M['word']['app_shop_tocart']}</a>
	</div>
</div>
<script>
var stockjson = {$stockjson};
</script>
<!--
EOT;
?>