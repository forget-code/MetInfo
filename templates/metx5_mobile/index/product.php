<!--<?php
$tem_product         = tmpcentarr($lang_product_id);
$tem_product['name'] = $lang_product_title?$lang_product_title:$tem_product['name'];
$tem_product['list'] = methtml_getarray($lang_product_id,$lang_product_type,'','',$lang_product_num);
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
		<ul>
<!--
EOT;
foreach($tem_product['list'] as $key=>$val){
$val[imgurl]="{$thumb_src}dir=../{$val[imgurl]}&x=300&y=300";
echo <<<EOT
-->
			<li class="tem_wp2">
				<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
				  <img src="{$val[imgurl]}" title="{$val[title]}" alt="{$val[title]}"  />
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