<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list){
okinfox('../admin/index.php?lang='.$lang,$lang_dataerror);
}
if($admin_list[admin_issueok]==1)$admin_issue_ok="checked='checked'";
$admin_op=explode('-',$admin_list[admin_op]);
if($admin_op[0]=="metinfo"||$admin_list[admin_op]=="metinfo"){
$admin_op_0="checked='checked'";
$admin_op_1="checked='checked'";
$admin_op_2="checked='checked'";
$admin_op_3="checked='checked'";
}else{
if($admin_op[1]=="add")$admin_op_1="checked='checked'";
if($admin_op[2]=="editor")$admin_op_2="checked='checked'";
if($admin_op[3]=="del")$admin_op_3="checked='checked'";
}
if($admin_list[langok]=="metinfo"){
$langok1="checked='checked'";
 foreach($met_langok as $key=>$val){
 $langok2[$val[mark]]="checked='checked'";
 }
}else{
$langoka=explode('-',$admin_list[langok]);
 foreach($langoka as $key=>$val){
 $langok2[$val]="checked='checked'";
 }
}
$nolang=admin_popes($admin_list['admin_type'],$lang,1);
$admin_list['admin_type']=admin_popes($admin_list['admin_type'],$lang);
if($admin_list[admin_type]=="metinfo"){
$admin_pop="checked='checked'";
$admin_poptext1[1001]="checked='checked'";
$admin_poptext1[1002]="checked='checked'";
$admin_poptext1[1003]="checked='checked'";
$admin_poptext1[1004]="checked='checked'";
$admin_poptext1[1005]="checked='checked'";
$admin_poptext1[1006]="checked='checked'";
$admin_poptext1[1007]="checked='checked'";
$admin_poptext1[1101]="checked='checked'";
$admin_poptext1[1102]="checked='checked'";
$admin_poptext1[1103]="checked='checked'";
$admin_poptext1[1104]="checked='checked'";
$admin_poptext1[1105]="checked='checked'";
$admin_poptext1[1201]="checked='checked'";
$admin_poptext1[1202]="checked='checked'";
$admin_poptext1[1203]="checked='checked'";
$admin_poptext1[1204]="checked='checked'";
$admin_poptext1[1205]="checked='checked'";
$admin_poptext1[1301]="checked='checked'";
$admin_poptext1[1401]="checked='checked'";
$admin_poptext1[1402]="checked='checked'";
$admin_poptext1[1403]="checked='checked'";
$admin_poptext1[1404]="checked='checked'";
$admin_poptext1[1405]="checked='checked'";
$admin_poptext1[1601]="checked='checked'";
$admin_poptext1[1602]="checked='checked'";
$admin_poptext1[1603]="checked='checked'";
$admin_poptext1[$met_module[7][0][id]]="checked='checked'";
foreach($met_classindex as $key=>$val){
 foreach($val as $key=>$val1){
 if($val1[module]<7){
$admin_poptext1[$val1[id]]="checked='checked'";
}}}
foreach($met_module[8] as $key=>$val){
$admin_poptext1[$val[id]]="checked='checked'";
}
 
}else{
$admin_pop=explode('-',$admin_list['admin_type']);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1[$val]="checked='checked'";
}
$admin_pop="";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin_editor');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>