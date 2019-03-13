<!--<?php
require_once template('head'); 
require_once template('sidebar'); 
echo <<<EOT
-->
        <div id="showimg">
		
						<div class="am-slider met_imgshowbox">
							<ul class="am-slides my-simple-gallery am-gallery" data-am-widget="gallery" data-am-gallery="{pureview: 1}">
							<li>
								<div class="am-gallery-item">
									<img src="{$thumb_src}dir={$img[imgurl]}&x=480&y=480" data-rel="{$img[imgurl]}" alt="{$img[title]}" />
									<h3 class="am-gallery-title">{$img[title]}</h3>
								</div>
							</li>
<!--
EOT;
if(count($displaylist)>0){
foreach($displaylist as $key=>$val){
echo <<<EOT
-->
							<li>
								<div class="am-gallery-item">
									<img src="{$thumb_src}dir={$val[imgurl]}&x=480&y=480" data-rel="{$val[imgurl]}" alt="{$val[title]}" />
									<h3 class="am-gallery-title">{$val[title]}</h3>
								</div>
							</li>
<!--
EOT;
}
}
echo <<<EOT
-->
							</ul>
						</div>
	<div class="met_clear"></div>
	 <h1 class="met_title">{$img[title]}</h1>
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