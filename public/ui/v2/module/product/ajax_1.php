<?php
$text_truncate=$lang_product_listmasonry_ok?'':' class="block text-truncate"';
foreach($product_list as $key=>$val){
	$val['page'] = $mbpagelist?'page'.$page:'';
	if($_M['url']['shop']){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='m-b-0 m-t-5 red-600'>{$val['shopinfo']['price_str']}</p>";
	}
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_productimg_x}&y={$met_productimg_y}";
	if($key<4&&!$mbpagelist){
		$shown=$lang_product_listmasonry_ok?' shown':'';
		$original = 'src';
	}else{
		$shown='';
		$original = 'data-original';
	}
echo <<<EOT
-->
<li class="{$val['page']}{$shown}">
	<div class="card card-shadow">
		<figure class="card-header cover">
			<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
				<img class="cover-image" {$original}="{$val['imgurls']}" alt="{$val[title]}" height='100'>
			</a>
		</figure>
		<h4 class="card-title m-0 p-x-10 font-size-16 text-xs-center">
			<a href="{$val[url]}" title="{$val[title]}"{$text_truncate} {$metblank}>{$val[title]}</a>
			{$val['price_str_html']}
		</h4>
	</div>
</li>
<!--
EOT;
}
?>