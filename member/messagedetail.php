<?php
# 文件名称:messagedetail 2009-08-20 17:29:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';

$message_list1=$db->get_one("SELECT * FROM $met_column where id=22 order by no_order");

$message_list=$db->get_one("select * from $met_message where id='$id'");


if(!$message_list){
okinfo('message.php',$lang_js1);
}

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('message_detail');
footermember();

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>