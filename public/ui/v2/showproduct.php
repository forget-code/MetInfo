<?php
if($lang_product_pagetype==1){
    $fname = 'showproduct';// 标准模式
    $patternshow = 1;
}else{
    $fname='fashion/fashion';// 时尚模式
    $subcolumn_no = 1;
    $lang_navfixed_ok = 0;
}
require_once template('head');
$product['content'] = $metresclass->lazyload($product['content']);// 内容图片懒加载设置
// 获取选项卡数量
for($i=1;$i<$met_productTabok;$i++){
    $ptbname = 'met_productTabname_'.$i;
    $productTablist[$i]['title']   = $$ptbname;
    $productTablist[$i]['content'] = $metresclass->lazyload($product['content'.$i]);
}
require_once template("module/showproduct/{$fname}");
require_once template('foot');
?>