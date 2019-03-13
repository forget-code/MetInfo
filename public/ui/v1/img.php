<!--<?php
require_once template('head'); 
require_once template('sidebar');
echo <<<EOT
-->
        <div class="active" id="imglist">
<!--
EOT;
if(!$lang_met_module5_type) {
	$lang_met_module5_type=1;
}
if($lang_met_module5_type==1){
echo <<<EOT
-->
			<ul class="list_{$lang_met_module5_type}">
<!--
EOT;
foreach($img_list as $key=>$val){
echo <<<EOT
-->
				<li>
					<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
						<img src="{$thumb_src}dir={$val[imgurl]}&x={$met_imgs_x}&y={$met_imgs_y}"
							width ="{$met_imgs_x}" height="{$met_imgs_y}"
						/>
						<h2>{$val['title']}</h2>
					</a>
				</li>
<!--
EOT;
}
echo <<<EOT
--> 
			</ul>
<!--
EOT;
}
echo <<<EOT
-->

<!--
EOT;
if($lang_met_module5_type==2){
echo <<<EOT
-->
			<ul class="list_{$lang_met_module5_type}">
<!--
EOT;
foreach($img_list as $key=>$val){
$val['description'] = utf8substr($val['description'],0,200);
echo <<<EOT
-->
				<li>
					<dl>
						<dt>
							<a href="{$val[url]}" title="{$val[title]}" {$metblank}>
								<img src="{$thumb_src}dir={$val[imgurl]}&x={$met_imgs_x}&y={$met_imgs_y}"
									width ="{$met_imgs_x}" height="{$met_imgs_y}"
								/>
							</a>
						</dt>
						<dd>
							<div class="met_listbox">
								<h2><a href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val['title']}</a></h2>
								<p>{$val['description']}</p>
							</div>
						</dd>
					</dl>
					<div class="met_clear"></div>
				</li>
<!--
EOT;
}
echo <<<EOT
--> 
			</ul>
<!--
EOT;
}
echo <<<EOT
-->
			<div class="met_clear"></div>
			{$page_list}
		</div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>