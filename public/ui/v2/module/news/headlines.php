<?php
if($page==1&&!$class2){
	$news_headlines_x=$lang_news_headlines_x?$lang_news_headlines_x:900;
	$news_headlines_y=$lang_news_headlines_y?$lang_news_headlines_y:300;
	$scale_headlines=$news_headlines_y/$news_headlines_x;
	$news_headlines_height_xs=round(400*$scale_headlines);
echo <<<EOT
-->
<div class="news-headlines">
	<div class="news-headlines-slick cover">
<!--
EOT;
	foreach($news_list as $key=>$val){
		if($key<1){
			$lazy='src';
			$srcset='srcset';
		}else{
			$lazy='data-lazy';
			$srcset='data-srcset';
		}
		$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$lang_news_headlines_x}&y={$lang_news_headlines_y}";
		$val[imgurl_xs] = "{$thumb_src}dir={$val[imgurl]}&x=400&y={$news_headlines_height_xs}";
echo <<<EOT
-->
		<div class='slick-slide'>
			<a href="{$val['url']}" title="{$val['title']}" {$metblank}>
				<img class="cover-image" {$lazy}="{$val[imgurls]}" {$srcset}='{$val['imgurl_xs']} 400w,{$val[imgurls]}' sizes='(max-width:479px) 400px' alt="{$val[title]}">
				<div class="headlines-text text-xs-center">
					<h4>{$val['title']}</h4>
				</div>
			</a>
		</div>
<!--
EOT;
		if($key+1>=$lang_news_headlines_num) break;
	}
echo <<<EOT
-->
	</div>
</div>
<!--
EOT;
}
?>