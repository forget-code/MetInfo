<?php
# 文件名称:save.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
$admin_power="metinfo";
require_once '../login/login_check.php';
$admin_ok = 1;
$admin_issueok=0;
if($admin_issue=="yes")$admin_issueok=1;
$admin_op=$admin_op0."-".$admin_op1."-".$admin_op2."-".$admin_op3;
if($admin_pop=="yes"){
$admin_type="metinfo";}
else{

 for($i=1001;$i<=1007;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
 for($i=1101;$i<=1105;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
  for($i=1201;$i<=1205;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
  for($i=1301;$i<=1301;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
  for($i=1401;$i<=1404;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
  for($i=1601;$i<=1603;$i++){
  $admin_pop="admin_pop".$i;
  if($$admin_pop!="")$admin_type.=$$admin_pop."-";
  }
  
  
$query = "select * from $met_column where bigclass=0 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){$column_list[]=$list;}
foreach($column_list as $key=>$val){
$column_pop="admin_pop".$val[id];
if($$column_pop!="")$admin_type=$admin_type."-".$$column_pop;
}
}
if($action=="add"){
$admin_if=$db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$useid'");
if($admin_if){
okinfo('javascript:history.back();',$lang_loginUserMudb1);
}
$pass1=md5($pass1);
 $query = "INSERT INTO $met_admin_table SET
                      admin_id           = '$useid',
                      admin_pass         = '$pass1',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction  = '$admin_introduction',
				      admin_type          = '$admin_type',
					  admin_register_date= '$m_now_date',
					  admin_approval_date= '$m_now_date',
					  admin_issueok      = '$admin_issueok',
					  admin_op           = '$admin_op',
					  usertype           = '3',
					  admin_ok           = '$admin_ok'";
         $db->query($query);
okinfo('index.php',$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "update $met_admin_table SET
                      admin_id           = '$useid',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction    = '$admin_introduction',
					  admin_register_date= '$m_now_date',
					  admin_approval_date= '$m_now_date',
					  admin_ok           = '$admin_ok'";
if($editorpass!=1){
$query .=", admin_type          = '$admin_type'";
$query .=", admin_issueok      = '$admin_issueok'";
$query .=", admin_op           = '$admin_op'";
}
if($pass1){
$pass1=md5($pass1);
$query .=", admin_pass         = '$pass1'";
}
$query .="  where id='$id'";
$db->query($query);
if($editorpass!=1){
okinfo('index.php',$lang_loginUserAdmin);
}
else
{
okinfo('editor_pass.php?id='.$id,$lang_loginUserAdmin);
}
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
