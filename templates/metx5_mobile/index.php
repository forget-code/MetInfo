<!--<?php
require_once template('head');
echo <<<EOT
-->
<!--
EOT;
$w = 0;
if($lang_about_open){
$w++;
require_once template('index/about');
}
if($lang_product_open){
$w++;
$into = $w%2==0?'tem_index_to':'';
require_once template('index/product');
}
if($lang_news_open){
$w++;
$into = $w%2==0?'tem_index_to':'';
require_once template('index/news');
}
if($lang_case_open){
$w++;
$into = $w%2==0?'tem_index_to':'';
require_once template('index/case');
}
if($lang_footer_open){
require_once template('index/footer');
}
echo <<<EOT
-->
<!--
EOT;
require_once template('foot');
?>