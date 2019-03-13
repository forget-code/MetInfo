<?php
foreach($product_list as $key=>$val){
	$val['page'] = $mbpagelist?'page'.$page:'';
	if($_M['url']['shop']){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='red-600 font-size-20'>{$val['shopinfo']['price_str']}</p>";
	}
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_imgs_x}&y={$met_imgs_y}";
	if($key<4&&!$mbpagelist){
		$shown=' shown';
		$original = 'src';
	}else{
		$shown='';
		$original = 'data-original';
	}
echo <<<EOT
-->
<li class="{$val['page']}{$shown}">
	<div class="card card-shadow radius0">
		<figure class="card-header cover radius0">
			<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
				<img class="cover-image" {$original}="{$val['imgurls']}" alt="{$val[title]}" style='height:200px;'>
			</a>
		</figure>
		<div class="card-body">
			<h4 class='card-title p-0 font-size-24'>{$val['title']}</h4>
			{$val['price_str_html']}
<!--
EOT;
	foreach($product_paralist as $key=>$val2){
		// 为了避免手机端无刷新分页出现白屏问题，不显示有权限参数
		if(!strstr($val[$val2[para]],'../include/access.php?metmemberforce=') && $val[$val2[para]]){
echo <<<EOT
-->
			<p class="card-metas font-size-12 blue-grey-400"><span>{$val2[name]} : {$val[$val2[para]]}</span></p>
<!--
EOT;
		}
	}
	if($val['description']){
echo <<<EOT
-->
			<p>{$val['description']}</p>
<!--
EOT;
	}
echo <<<EOT
-->
			<div class="card-body-footer">
				<div class="card-actions pull-xs-right">
					<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
						<i class="icon wb-eye" aria-hidden="true"></i>
						<span>{$val[hits]}</span>
					</a>
				</div>
				<a href="{$val[url]}" title="{$val[title]}" class="btn btn-outline btn-primary btn-squared" {$metblank}>{$lang_product_listlook}</a>
			</div>
		</div>
	</div>
</li>
<!--
EOT;
}
?>