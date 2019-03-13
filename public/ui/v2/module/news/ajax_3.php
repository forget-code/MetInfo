<?php
$news_type3_y_xs=round(400*$scale);
foreach($news_list as $key=>$val){
	$val['page'] = $mbpagelist?' page'.$page:'';
	if($key<2&&!$mbpagelist){
		$original='src';
		$srcset='srcset';
	}else{
		$original='data-original';
		$srcset='data-srcset';
	}
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$lang_news_type3_x}&y={$lang_news_type3_y}";
	$val[imgurl_xs] = "{$thumb_src}dir={$val[imgurl]}&x=400&y={$news_type3_y_xs}";
	if(!$val['issue']) $val['issue'] = $met_webname;
	$val['desc']=mb_substr($val['description'],0,$lang_news_des_max,'utf-8').'...';
echo <<<EOT
-->
<div class="card card-shadow radius0{$val['page']}">
	<div class="card-header p-0 radius0">
		<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
			<img class="cover-image" {$original}="{$val[imgurls]}" {$srcset}='{$val[imgurl_xs]} 400w,{$val[imgurls]}' sizes='(max-width:479px) 400px,{$lang_news_type3_x}px' alt="{$val[title]}">
		</a>
	</div>
	<div class="card-body">
		<h4><a href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val[title]}</a></h4>
		<p class="card-metas font-size-12 blue-grey-400 font-weight-300">
			<span>{$val['updatetime']}</span>
			<span>{$val['issue']}</span>
			<span><i class="icon wb-eye m-r-5 font-weight-300" aria-hidden="true"></i>{$val['hits']}</span>
		</p>
		<p class="m-b-0 font-weight-300">{$val['desc']}</p>
	</div>
</div>
<!--
EOT;
}
?>