<?php
foreach($product_list as $key=>$val){
	$val['page'] = $mbpagelist?' page'.$page:'';
	if($_M['url']['shop']){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='m-b-0 m-t-5 red-600'>{$val['shopinfo']['price_str']}</p>";
	}
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_productimg_x}&y={$met_productimg_y}";
	if($key<4&&!$mbpagelist){
		$shown=' shown';
		$original = 'src';
	}else{
		$shown='';
		$original = 'data-original';
	}
echo <<<EOT
-->
<li class="card radius0{$val['page']}{$shown}">
	<div class="cover overlay overlay-hover animation-hover">
		<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
			<img class="cover-image overlay-scale" {$original}="{$val['imgurls']}" alt="{$val[title]}" style='height:200px;'>
			<figcaption class="overlay-panel overlay-background overlay-fade text-xs-center vertical-align">
				<div class="vertical-align-middle">
					<h4 class="animation-slide-bottom m-0 font-weight-300">
						{$val[title]}
						{$val['price_str_html']}
					</h4>
				</div>
			</figcaption>
		</a>
	</div>
</li>
<!--
EOT;
}
?>