<!--<?php
require_once template('head'); 
require_once template('sidebar');
$met_newsnext=methtml_prenextinfo(1,1);
echo <<<EOT
-->
        <section class="met_module2">
            <h1 class="met_title">{$news[title]}</h1>
			<div class="met_infos">
				<span class="met_time">{$news[updatetime]}</span>
				<span class="met_source"><a href="{$index_url}" title="{$met_webname}">{$met_webname}</a></span>
				<span class="met_hits">{$_M['word']['read']} <span class="met_Clicks"></span></span>
			</div>
            <div class="met_editor">{$news[content]}<div class="met_clear"></div></div>
			<div class="met_tools">
				{$met_tools_code}
				<ul class="met_page">
					<li class="met_page_preinfo"><span>{$lang_Previous}</span><a href='{$preinfo[url]}'>{$preinfo[title]}</a></li>
					<li class="met_page_next"><span>{$lang_Next}</span><a href='{$nextinfo[url]}'>{$nextinfo[title]}</a></li>
				</ul>
			</div>
        </section>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>