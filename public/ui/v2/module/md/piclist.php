<?php
$sidebar_piclist_module=3;
if($_M[config][shopv2_open]){
	$sidebar_piclist_title=$_M['word']['app_shop_recommend'];
	switch (intval($_M['config']['shopv2_recommend'])) {
		case 0:
			$sidebar_piclist_id=$classnow;
			$sidebar_piclist_type='';
			break;
		case 1:
			$sidebar_piclist_id=$class1;
			$sidebar_piclist_type='com';
			break;
		default:
			$sidebar_piclist_id=$classnow;
			$sidebar_piclist_type='com';
			break;
	}
	$data_scale=$met_productimg_y/$met_productimg_x;
	$sidebar_piclist_order=$_M['config']['shopv2_recommend_order'];
	$sidebar_piclist_module_str='product';
	$sidebar_piclist_num=$_M['config']['shopv2_recommend_num'];
}else{
	$sidebar_piclist_title=$lang_product_recommend;
	$sidebar_piclist_type=$lang_product_hot_type;
	$sidebar_piclist_num=$lang_product_hot_num;
	if($class_list[$classnow][module]!=3){
		$sidebar_piclist_title=$lang_sidebar_piclist_title;
		$sidebar_pic=tmpcentarr($lang_sidebar_piclist_id);
		$sidebar_piclist_id=$sidebar_pic[id]?$sidebar_pic[id]:$class1;
		$sidebar_piclist_type=$lang_sidebar_piclist_type;
		$sidebar_piclist_module=$class_list[$sidebar_pic[id]][module];
		$sidebar_piclist_num=$lang_sidebar_piclist_num;
	}
	$module_img_size=$metresclass->moduleImgSize($sidebar_piclist_module);
	$data_scale=$module_img_size[y]/$module_img_size[x];
	$sidebar_piclist_module_str=metmodname($sidebar_piclist_module);
	$sidebar_piclist_order='';
}
echo <<<EOT
-->
<div class="sidebar-piclist">
	<h3 class="m-0 font-size-16 font-weight-300">{$sidebar_piclist_title}</h3>
	<ul class="blocks-2 blocks-md-3 blocks-lg-100 m-t-20 text-xs-center imagesize sidebar-piclist-ul" data-scale='{$data_scale}'>
<!--
EOT;
$sidebar_piclist=methtml_getarray($sidebar_piclist_id,$sidebar_piclist_type,$sidebar_piclist_order,$sidebar_piclist_module_str,$lang_product_hot_num,'','',1);
foreach($sidebar_piclist as $val){
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$val[img_x]}&y={$val[img_y]}";
	if($_M['url']['shop'] && $sidebar_piclist_module==3){
		$val['shopinfo'] = get_goods($val['id']);
		$val['price_str_html'] = "<p class='m-b-0 red-600'>{$val['shopinfo']['price_str']}</p>";
	}
echo <<<EOT
-->
		<li class='masonry-child'>
			<a href="{$val[url]}" title="{$val[title]}" class="block m-b-0" target="_blank">
				<img data-original="{$val[imgurls]}" class="cover-image" alt="{$val[title]}">
			</a>
			<h4 class="m-t-10 m-b-0 font-size-14"><a href="{$val[url]}" title="{$val[title]}" target="_blank">{$val[title]}</a></h4>
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