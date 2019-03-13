<!--<?php
require_once template('head'); 
require_once template('sidebar'); 
echo <<<EOT
-->
        <div id="showimg">
		    <h1 class="met_title">{$img[title]}</h1>
			

		<div class="met_slide_box" data-sidewidth="{$met_imgdetail_x}" data-sideheight="{$met_imgdetail_y}">
			<div id="exposure"></div>
			<div class="clear"></div>	
			<div class="left"><a href="javascript:void(0);" onclick="$.exposure.prevImage();return true;"></a></div>
			<div class="right"><a href="javascript:void(0);" onclick="$.exposure.nextImage();return true;"></a></div>
			
		<div class="met_slide_list">
			<div class="panel">					
				<ul>
					<li><a href="{$thumb_src}dir={$img[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}"><img src="{$thumb_src}dir={$img[imgurl]}&x=150&y=79" title="{$img[title]}" /></a></li>
<!--
EOT;
foreach($displaylist as $key=>$val){
echo <<<EOT
-->
					<li><a href="{$thumb_src}dir={$val[imgurl]}&x={$met_imgdetail_x}&y={$met_imgdetail_y}"><img src="{$thumb_src}dir={$val[imgurl]}&x=150&y=79" title="{$val[title]}" /></a></li>
<!--
EOT;
}
echo <<<EOT
-->
				</ul>	
				<div class="clear"></div>
			</div>
		</div>
			
		</div>
	<div class="met_clear"></div>
			<ul class="imgparalist">
<!--
EOT;
foreach($img_paralist as $key=>$val2){
echo <<<EOT
-->
				<li><span>{$val2[name]}</span>{$img[$val2[para]]}</li>
<!--
EOT;
}
echo <<<EOT
-->
			</ul>
            <div class="met_editor">{$img[content]}<div class="met_clear"></div></div>
			<div class="met_tools">
				{$met_tools_code}
				<span class="met_Clicks met_none"><!--累计浏览次数--></span>
				<ul class="met_page">
					<li class="met_page_preinfo"><span>{$lang_Previous}</span><a href='{$preinfo[url]}'>{$preinfo[title]}</a></li>
					<li class="met_page_next"><span>{$lang_Next}</span><a href='{$nextinfo[url]}'>{$nextinfo[title]}</a></li>
				</ul>
			</div>
        </div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>