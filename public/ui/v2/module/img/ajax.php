<?php
foreach($img_list as $key=>$val){
	$val['page'] = $mbpagelist?' page'.$page:'';
	if($key<8&&!$mbpagelist){
		$original = 'src';
	}else{
		$original = 'data-original';
	}
	$val[imgurls]="{$thumb_src}dir={$val[imgurl]}&x={$met_imgs_x}&y={$met_imgs_y}";
	if(!$lang_img_listlook_style || ($met_img_page && $val[foldername])){
		$imglist_href=$val[url];
		$imglist_metblank=" {$metblank}";
	}else{
		$imglist_href='javascript:;';
		$img_showbtn=' met-img-showbtn';
		if(!$val[imgsize]) $val[imgsize]="{$met_imgs_x}x{$met_imgs_y}";
		$displayimg_urls="{$val[title]}*{$val[imgurl]}*{$val[imgsize]}";
		if($val[displayimg]){
			$val_displayimg=explode('|', $val[displayimg]);
			$val[displayimg]='';
			foreach ($val_displayimg as $key=> $value) {
				$imgarray=explode('*', $value);
				if(!$imgarray[2]){
					$imgarray[2]="{$met_imgs_x}x{$met_imgs_y}";
					$value='';
					foreach ($imgarray as $keys=> $value2) {
						if($keys>0) $value.='*';
						$value.=$value2;
					}
				}
				if($key>0) $val[displayimg].='|';
				$val[displayimg].=$value;
			}
			$displayimg_urls.="|{$val[displayimg]}";
		}
		$data_displayimg=" data-displayimg='{$displayimg_urls}'";
	}
echo <<<EOT
-->
<li class="card radius0{$val['page']}">
	<div class="cover overlay overlay-hover">
		<img class="cover-image overlay-scale" {$original}="{$val[imgurls]}" alt="{$val[title]}" style='height:300px;'/>
		<div class="overlay-panel overlay-fade overlay-background overlay-background-fixed text-xs-center vertical-align">
			<div class="vertical-align-middle">
				<div class="card-time card-divider">
					<span>{$val['updatetime']}</span>
				</div>
				<h3 class="card-title m-b-20">{$val[title]}</h3>
				<a href='{$imglist_href}' title='{$val[title]}' class="btn btn-outline btn-squared btn-inverse{$img_showbtn}"{$data_displayimg}{$imglist_metblank}>{$lang_img_listlook}</a>
			</div>
		</div>
	</div>
</li>
<!--
EOT;
}
?>