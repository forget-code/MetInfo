<?php
# 文件名称:parameter.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
switch($type){
case "3";
$p_title=$lang_parameterName1;
$k=25;
break;
case "4";
$p_title=$lang_parameterName2;
$k=11;
break;
case "5";
$p_title=$lang_parameterName3;
$k=25;
break;
case "10000";
$p_title=$lang_parameterName4;
$k=31;
break;
}
if($action=="Modify"){

for($i=1;$i<$k;$i++){
	$id="id_para".$i;
	$c_mark="c_mark_para".$i;
	$e_mark="e_mark_para".$i;
	$o_mark="o_mark_para".$i;
	$access="access_para".$i;
	$use_ok="use_ok_para".$i;
	$wr_ok = "wr_ok_para".$i;
	$no_order="no_order_para".$i;
	$id=$$id;
	$c_mark=$$c_mark;
	$e_mark=$$e_mark;
	$o_mark=$$o_mark;
	$access=$$access;
	$use_ok=$$use_ok==1?1:0;
	$wr_ok=$$wr_ok==1?1:0;
	$no_order=$$no_order;

if($use_ok==1&&$met_c_lang_ok==1&&$c_mark==""){
okinfo("javascript:history.go(-1)",$lang_parameterTip5.'['.$met_c_lang.']');
}
if($use_ok==1&&$met_c_lang_ok!=1&&$met_e_lang_ok==1&&$e_mark==""){
okinfo("javascript:history.go(-1)",$lang_parameterTip5.'['.$met_e_lang.']');
}
if($use_ok==1&&$met_c_lang_ok!=1&&$met_e_lang_ok!=1&&$met_o_lang_ok==1&&$o_mark==""){
okinfo("javascript:history.go(-1)",$lang_parameterTip5.'['.$met_o_lang.']');
}
$query = "update $met_parameter SET ";
if($met_c_lang_ok==1)  $query =$query. "c_mark='$c_mark',";
if($met_e_lang_ok==1)  $query =$query. "e_mark='$e_mark',";
if($met_o_lang_ok==1)  $query =$query. "o_mark='$o_mark',";

if($type!=10000) $query=$query.  " access = '$access',";
else	$query=$query.  " wr_ok = '$wr_ok',";
$query=$query.  "
			  	 use_ok = '$use_ok',
			  	 no_order = '$no_order',
			  	 type = '$type'
			  	 where id='$id'";
		


$db->query($query);
}

okinfo('parameter.php?type='.$type,$lang_loginUserAdmin);
}
else{
    $query="select * from $met_parameter where type='$type'  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$list1[wr_ok]=($list1[wr_ok]==1)?"checked='checked'":"";
	switch($list1['access'])
	{
		case '1':$list1['access1']="selected='selected'";break;
		case '2':$list1['access2']="selected='selected'";break;
		case '3':$list1['access3']="selected='selected'";break;
		default:$list1['access0']="selected='selected'";break;
	}
	$list1[use_ok]=($list1[use_ok]==1)?"checked='checked'":"";
	$list1[c_mark1]=$list1[c_mark];
	$list1[e_mark1]=$list1[e_mark];
	$list1[o_mark1]=$list1[o_mark];
	if($met_c_lang_ok!=1){
	$c_markok="disabled='disabled'";
	$list1[c_mark1]=$met_c_lang.$lang_parameterTip1;
	}
	if($met_e_lang_ok!=1){
	$e_markok="disabled='disabled'";
	$list1[e_mark1]=$met_e_lang.$lang_parameterTip1;
	}
	if($met_o_lang_ok!=1){
	$o_markok="disabled='disabled'";
	$list1[o_mark1]=$met_o_lang.$lang_parameterTip1;
	}
	$list1[maxsize]=$list1[maxsize]==200?$lang_parameterTip2:($list1[maxsize]==255?$lang_parameterTip4:$lang_parameterTip3);
	if(80<$list1[id] && $list1[id]<89) $list1[maxsize]="<font color='#ff0000'>$lang_parameterType1</font> <a href='list.php?bigid=$list1[id]'>$lang_parameterSet</a>";
	$list[]=$list1;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>