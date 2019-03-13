<?php
# 文件名称:detail.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
$query = "select * from $met_column where bigclass=0 and if_in='0' order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){$column_list[]=$list;}

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang_loginNoid);
}
if($admin_list[admin_issueok]==1)$admin_issue_ok="checked";
$admin_op=explode('-',$admin_list[admin_op]);
if($admin_op[0]=="metinfo"||$admin_list[admin_op]=="metinfo"){
$admin_op_0="checked";
}else{
if($admin_op[1]=="add")$admin_op_1="checked";
if($admin_op[2]=="editor")$admin_op_2="checked";
if($admin_op[3]=="del")$admin_op_3="checked";
}
if($admin_list[admin_type]=="metinfo"){
$admin_pop="checked";
}else{
$admin_pop=explode('-',$admin_list[admin_type]);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1=$admin_poptext.$val=$val;
$$admin_poptext1="checked";
}
$admin_pop="";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin_detail');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>