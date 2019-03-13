<?php
foreach($product_list as $key=>$val){
	$val['page'] = $mbpagelist?'page'.$page:'';
	if($_M['url']['shop']){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='red-600 font-size-20'>{$val['shopinfo']['price_str']}</p>";
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
		<div class="card-body">
			<h4 class='card-title font-size-24'>{$val['title']}</h4>
			{$val['price_str_html']}
<!--
EOT;
	foreach($product_paralist as $key=>$val2){
		// 为了避免手机端无刷新分页出现白屏问题，不显示有权限参数
		if(!strstr($val[$val2[para]],'../include/access.php?metmemberforce=') && $val[$val2[para]]){
echo <<<EOT
-->
			<p class="card-metas m-b-5 font-size-12 blue-grey-400"><span>{$val2[name]} : {$val[$val2[para]]}</span></p>
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
				<a href="{$val[url]}" title="{$val[title]}" class="btn btn-outline btn-primary btn-squared" {$metblank}>{$lang_product_listlook}</a>
				<div class="card-actions pull-xs-right m-t-5">
					<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
						<i class="icon wb-eye" aria-hidden="true"></i>
						<span>{$val[hits]}</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</li>
<!--
EOT;
}
?>