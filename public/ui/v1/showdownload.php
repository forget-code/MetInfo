<!--<?php
require_once template('head'); 
require_once template('sidebar');
echo <<<EOT
-->
        <div id="showdownload">
			<h1 class="title">{$download[title]}</h1>
            <ul class="paralist">
                <li><span>{$lang_showdownload1}</span>{$download[updatetime]}</li>
<!--
EOT;
foreach($download_paralist as $key=>$val){
echo <<<EOT
-->
                <li><span>{$val[name]}</span>{$download[$val[para]]}</li>
<!--
EOT;
}
echo <<<EOT
-->
			</ul>
			<div class="downloadbox">
				<a href="{$download[downloadurl]}" target="_blank" title="{$lang_showdownload3}">
					{$lang_showdownload3}
				</a>
			</div>
<!--
EOT;
if($download[content]){
echo <<<EOT
-->
			<h3 class="ctitle"><span>{$lang_detailtxt}</span></h3>
<!--
EOT;
}
echo <<<EOT
-->
			<div class="met_editor"">
				{$download[content]}
				<div class="met_clear"></div>
			</div>
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