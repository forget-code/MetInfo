<?php
# 文件名称:parameter.php 2009-08-12 10:15:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';

if($action=="Modify"){
for($i=1;$i<28;$i=$i+1){
$c_name="c_name".$i;
$e_name="e_name".$i;
$o_name="o_name".$i;
$use_ok="use_ok".$i;
$wr_ok = "wr_ok".$i;
$no_order="no_order".$i;
$c_name=$$c_name;
$e_name=$$e_name;
$o_name=$$o_name;
$use_ok=$$use_ok;
$wr_ok =$$wr_ok;
$no_order=$$no_order;
if($use_ok==1&&$met_c_lang_ok==1&&$c_name==""){
okinfo("javascript:history.go(-1)",$lang_modmark.'['.$met_c_lang.']');
}
if($use_ok==1&&$met_c_lang_ok!=1&&$met_e_lang_ok==1&&$e_name==""){
okinfo("javascript:history.go(-1)",$lang_modmark.'['.$met_e_lang.']');
}
if($use_ok==1&&$met_c_lang_ok!=1&&$met_e_lang_ok!=1&&$met_o_lang_ok==1&&$o_name==""){
okinfo("javascript:history.go(-1)",$lang_modmark.'['.$met_o_lang.']');
}
$query = "update $met_fdparameter SET ";
if($met_c_lang_ok==1)  $query =$query. "c_name='$c_name',";
if($met_e_lang_ok==1)  $query =$query. "e_name='$e_name',";
if($met_o_lang_ok==1)  $query =$query. "o_name='$o_name',";
$query=$query.  "                               
		use_ok = '$use_ok',
		wr_ok  = '$wr_ok',
		no_order = '$no_order'
        where id='$i'";

$db->query($query);
$e_mark="";
}
onepagehtm('feedback','index');
okinfo('parameter.php',$lang_loginUserAdmin);
}
else{
    $query="select * from $met_fdparameter order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$list1[use_ok]=($list1[use_ok]==1)?"checked='checked'":"";
	$list1[wr_ok]=($list1[wr_ok]==1)?"checked='checked'":"";
	
switch($list1[type]){
case "1";
$list1[type]=$lang_fdparameterType1;
break;
case "2";
$list1[type]="<font color='#ff0000'>$lang_fdparameterType2</font> <a href='list.php?bigid=$list1[id]'>$lang_fdparameterSet</a>";
break;
case "3";
$list1[type]=$lang_fdparameterType3;
break;
case "4";
$list1[type]="<font color='#ff0000'>$lang_fdparameterType4</font> <a href='list.php?bigid=$list1[id]&listtype=2'>$lang_fdparameterSet</a>";
break;
case "5";
$list1[type]=$lang_fdparameterType5;
break;
}
	
	if($met_c_lang_ok!=1){
	$c_nameok="disabled='disabled'";
	$list1[c_name1]=$met_c_lang.$lang_fdparameterTip1;
	}
	else{
	$list1[c_name1]=$list1[c_name];
	}
	if($met_e_lang_ok!=1){
	$e_nameok="disabled='disabled'";
	$list1[e_name1]=$met_e_lang.$lang_fdparameterTip1;
	}
	else{
	$list1[e_name1]=$list1[e_name];
	}
	if($met_o_lang_ok!=1){
	$o_nameok="disabled='disabled'";
	$list1[o_name1]=$met_o_lang.$lang_fdparameterTip1;
	}
	else{
	$list1[o_name1]=$list1[o_name];
	}
	$list[]=$list1;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_parameter');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>