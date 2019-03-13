<?php
$previousdisabled = $nextinfo['url']=='#'?' disabled':'';
$nextdisabled = $preinfo['url']=='#'?' disabled':'';
$nextinfo[url]=$nextinfo[url]=='#'?'javascript:;':$nextinfo[url];
$preinfo[url]=$preinfo[url]=='#'?'javascript:;':$preinfo[url];
echo <<<EOT
-->
<ul class="met_page pagination block blocks-2">
    <li class='page-item m-b-0{$previousdisabled}'>
        <a href="{$nextinfo[url]}" title="{$nextinfo[title]}" class='page-link text-truncate'>
            {$lang_preinfo}
            <span aria-hidden="true" class='hidden-xs-down'> : {$nextinfo[title]}</span>
        </a>
    </li>
    <li class='page-item m-b-0{$nextdisabled}'>
        <a href="{$preinfo[url]}" title="{$preinfo[title]}" class='page-link pull-xs-right text-truncate'>
            {$lang_nextinfo}
            <span aria-hidden="true" class='hidden-xs-down'> : {$preinfo[title]}</span>
        </a>
    </li>
</ul>
<!--
EOT;
?>