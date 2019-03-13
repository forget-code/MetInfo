<?php
# 文件名称:hits.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'common.inc.php';
switch($type){
case 'product';
$met_hits=$met_product;
break;
case 'news';
$met_hits=$met_news;
break;
case 'download';
$met_hits=$met_download;
break;
case 'img';
$met_hits=$met_img;
break;
}
$query="select * from $met_hits where id='$id'";
$hits_list=$db->get_one($query);
$hits_list[hits]=$hits_list[hits]+1;
$query = "update $met_hits SET hits='$hits_list[hits]' where id='$id'";
$db->query($query); 
$query="select * from $met_hits where id='$id'";
$hits_list=$db->get_one($query);
$hits=$hits_list[hits];
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
$hits="<?php echo $hits; ?>";
document.write($hits) 