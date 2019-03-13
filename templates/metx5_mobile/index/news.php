<!--<?php
/*四个文章列表*/
if($lang_news_list1_open){
$tem_news[1]           = tmpcentarr($lang_news_list1_id);
$tem_news[1]['name']   = $lang_news_list1_title?$lang_news_list1_title:$tem_news[1]['name'];
$tem_news[1]['imgurl'] = $lang_news_list1_img?$lang_news_list1_img:"{$img_url}newlistbg1.jpg";
$tem_news[1]['list']   = methtml_getarray($lang_news_list1_id,$lang_news_list1_type,'','',$lang_news_num);
}
if($lang_news_list2_open){
$tem_news[2]           = tmpcentarr($lang_news_list2_id);
$tem_news[2]['name']   = $lang_news_list2_title?$lang_news_list2_title:$tem_news[2]['name'];
$tem_news[2]['imgurl'] = $lang_news_list2_img?$lang_news_list2_img:"{$img_url}newlistbg2.jpg";
$tem_news[2]['list']   = methtml_getarray($lang_news_list2_id,$lang_news_list2_type,'','',$lang_news_num);
}
echo <<<EOT
-->
<section class="tem_index_news {$into}">
	<div class="tem_inner">
		<h3 class="tem_index_title">
			<span>
				{$lang_news_title}
				<p></p>
			</span>
		</h3>
		<ol class="tem_index_news_tab">
<!--
EOT;
$i=0;
foreach($tem_news as $key=>$val){
$i++;
$now = $i==1?'class="flex-active"':'';
echo <<<EOT
--> 
			<li {$now}><h3>{$val[name]}</h3></li>
<!--
EOT;
}
echo <<<EOT
--> 
		</ol>
		<div class="am-slider tem_index_news_slides">
		<ul class="am-slides">
<!--
EOT;
$i=0;
foreach($tem_news as $key=>$val){
$i++;
$none = $i>1?'met_none':'';
echo <<<EOT
--> 
		<li class="tem_index_news_list {$none}">
<!--
EOT;
$i=0;
foreach($val['list'] as $key=>$val2){
$i++;
$val2[imgurl]="{$thumb_src}dir=../{$val2[imgurl]}&x=90&y=90";
$to = $i%2==0?'class="tem_even"':'';//判断是否为偶数
$val2['description'] = utf8substr($val2['description'],0,40);
echo <<<EOT
-->
			<div>
				<a href="{$val2[url]}" title="{$val2[title]}" {$metblank}>
				<h3>{$val2['title']}</h3>
				<p>{$val2['description']}</p>
				</a>
			</div>
<!--
EOT;
}
echo <<<EOT
--> 
			<h4 class="tem_index_more"><a href="{$val[url]}" title="{$lang_news_more}" {$metblank}>{$lang_news_more}</a></h4>
		</li>
<!--
EOT;
}
echo <<<EOT
--> 
		</ul>
		</div>
		<div class="met_clear"></div>
	</div>
</section>
<!--
EOT;
?>