<?php
foreach($news_list as $key=>$val){
	if($key>=$news_firstkey){
		$val['page'] = $mbpagelist?' page'.$page:'';
		if($key<4+$news_firstkey&&!$mbpagelist){
			$original = 'src';
		}else{
			$original = 'data-original';
		}
		$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_newsimg_x}&y={$met_newsimg_y}";
		if(!$val['issue'])$val['issue'] = $met_webname;
		$val['desc']=mb_substr($val['description'],0,$lang_news_des_max,'utf-8').'...';
echo <<<EOT
-->
<li class="media media-lg border-bottom1{$val['page']}">
	<div class="media-left">
		<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
			<img class="media-object" {$original}="{$val[imgurls]}" alt="{$val[title]}">
		</a>
	</div>
	<div class="media-body">
		<h4>
			<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
				{$val['title']}
			</a>
		</h4>
		<p class="des font-weight-300">{$val['desc']}</p>
		<p class="info font-weight-300">
			<span>{$val['updatetime']}</span>
			<span>{$val['issue']}</span>
			<span><i class="icon wb-eye m-r-5 font-weight-300" aria-hidden="true"></i>{$val['hits']}  {$val['tag']}</span>
		</p>
	</div>
</li>
<!--
EOT;
	}
}
?>