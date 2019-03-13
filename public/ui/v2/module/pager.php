<?php
// 无刷新翻页加载url
if(!$foldername) $foldername=$class_list[$classnow][foldername];
$page_ajax_url = "{$_M[url][site]}{$foldername}/?lang={$_M[lang]}&class1={$classphp[class1]}&class2={$classphp[class2]}&class3={$classphp[class3]}&mbpagelist=1";
if($search='search' && $content) $page_ajax_url.="&search=search&content={$content}";
if($searchword) $page_ajax_url.="&searchword={$searchword}";
// 无刷新翻页条件判断
$metpage_click_vis = ' hidden-sm-down';
$metpage_ajax_vis = ' hidden-md-up';
if($page_ajax_open){
	$metpage_click_vis = ' hidden-xs-up';
	$metpage_ajax_vis = '';
}
echo <<<EOT
-->
<div class='m-t-20 text-xs-center{$metpage_click_vis}'>{$page_list}</div>
<div class="met-pager-ajax-link{$metpage_ajax_vis} invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
	<button type="button" class="btn btn-primary btn-block btn-squared ladda-button" id="met-pager-btn" data-plugin="ladda" data-style="slide-left" data-url="{$page_ajax_url}" data-page="{$page}"><i class="icon wb-chevron-down m-r-5" aria-hidden="true"></i>{$lang_page_ajax_next}</button>
</div>
<!--
EOT;
?>