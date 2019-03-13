<!--<?php
$tem_product         = tmpcentarr($lang_product_id);
$tem_product['name'] = $lang_product_title?$lang_product_title:$tem_product['name'];
$promd = $lang_product_id?'':'product';
$tem_product['list'] = methtml_getarray($lang_product_id,$lang_product_type,'',$promd,$lang_product_num);
$tem_wp2 = $lang_waypointsok==1?'tem_wp2':'';
echo <<<EOT
-->
<section class="tem_index_product {$into}">
	<div class="tem_inner">
		<h3 class="tem_index_title">
			<span>
				{$tem_product[name]}
				<p></p>
			</span>
		</h3>
		<ul data-product_x="{$lang_product_x}">
<!--
EOT;
foreach($tem_product['list'] as $key=>$val){
$val[imgurl]="{$thumb_src}dir=../{$val[imgurl]}&x={$lang_product_x}&y={$lang_product_y}";
echo <<<EOT
-->
			<li class="{$tem_wp2}">
				<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
				  <img src="{$val[imgurl]}" title="{$val[title]}" alt="{$val[title]}" width ="{$lang_product_x}" height="{$lang_product_y}" />
				  <h2>{$val[title]}</h2>
				</a>
			</li>
<!--
EOT;
}
echo <<<EOT
--> 
		</ul>
		<div class="met_clear"></div>
		<h4 class="tem_index_more"><a href="{$tem_product[url]}" title="{$lang_product_more}" {$metblank}>{$lang_product_more}</a></h4>
	</div>
</section>
<!--
EOT;
?>