<?php
$class3_ok='&class3='.$class3;
if($class_list[$classnow][module]!=$class_list[$class1][module]){
    $class1=$class2;
    $class2=$class3;
    $class3_ok='';
}
// 无刷新翻页加载url
$moreurl = "{$_M[url][site]}{$class_list[$classnow][foldername]}/?lang={$_M[lang]}&class1={$class1}&class2={$class2}{$class3_ok}&mbpagelist=1";
// 无刷新翻页条件判断
$metpage_click_vis = ' class="hidden-sm-down"';
$metpage_ajax_vis = ' hidden-md-up';
if($pagenorerresh){
	$metpage_click_vis = ' class="hidden-xs-up"';
	$metpage_ajax_vis = '';
}
$pagetxt = $pagetxt?$pagetxt:$lang_page_ajax_more;
echo <<<EOT
-->
<div{$metpage_click_vis}>{$page_list}</div>
<div class="met-pager-ajax-link{$metpage_ajax_vis} invisible" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
	<button type="button" class="btn btn-primary btn-block btn-squared ladda-button" id="met-pager-btn" data-plugin="ladda" data-style="slide-left" data-url="{$moreurl}" data-page="{$page}"><i class="icon wb-chevron-down m-r-5" aria-hidden="true"></i>{$pagetxt}</button>
</div>
<!--
EOT;
?>