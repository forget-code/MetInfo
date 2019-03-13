<?php
echo <<<EOT
-->
<div class='sidebar-piclist'>
	<h3 class='m-0 font-size-16 font-weight-300'>热门推荐：</h3>
	<ul class='blocks-2 blocks-md-3 blocks-lg-100 m-t-20 text-xs-center imagesize sidebar-piclist-ul' data-scale='{$met_productimg_y}x{$met_productimg_x}'>
<!--
EOT;
$sidebar_piclist=methtml_getarray($class1,'','','product',5,'','',1);
foreach($sidebar_piclist as $val){
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$val[img_x]}&y={$val[img_y]}";
	if($_M['url']['shop']){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='m-b-0 red-600'>{$val['shopinfo']['price_str']}</p>";
	}
echo <<<EOT
-->
		<li class='masonry-child'>
			<a href='{$val[url]}' title='{$val[title]}' class='block m-b-0' target='_blank'>
				<img data-original='{$val[imgurls]}' class='cover-image' alt='{$val[title]}' height='100'>
			</a>
			<h4 class='m-t-10 m-b-0 font-size-14'><a href='{$val[url]}' title='{$val[title]}' target='_blank'>{$val[title]}</a></h4>
			{$val['price_str_html']}
		</li>
<!--
EOT;
}
echo <<<EOT
-->
	</ul>
</div>
<!--
EOT;
?>