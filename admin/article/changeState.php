<?php
# 文件名称:changeState.php 2009-08-10 10:57:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
$backurl="index.php?class1=$class1&class2=$class2&class3=$class3";
if($action=="moveto")
{
	$allidlist=explode(',',$allid);
	$k=count($allidlist)-1;

	$query= "select * from $met_column where id='$class1' and classtype=1 ";
	$result1=$db->get_one($query);
	
	$query= "select * from $met_column where bigclass='$class1' and classtype=2 ";
	$result2=$db->get_one($query);
	
	$query= "select * from $met_column where bigclass='$class2' and classtype=3 ";
	$result3=$db->get_one($query);
	
	if(!$result1 || ($result2 && $class2==0) || ($result3 && $class3==0)) 
	
	{
		okinfo($backurl,$lang_loginFail);
		exit();
	}
	for($i=0;$i<$k; $i++){
	$query = "update $met_news SET";
	$query = $query."
                      class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3'";
	$query = $query." where id='$allidlist[$i]'";
	$db->query($query);
	}
okinfo($backurl,$lang_loginUserAdmin);
}else
{
$admin_list = $db->get_one("SELECT * FROM $met_news WHERE id='$id'");
if(!$admin_list){
okinfo($backurl,$lang_loginNoid);
}
$query = "update $met_news SET ";
if(isset($img_ok))
{
	$img_ok=$img_ok==1?0:1;
	$query = $query."img_ok             = '$img_ok',";
}
if(isset($com_ok))
{
	$com_ok=$com_ok==1?0:1;
	$query = $query."com_ok             = '$com_ok',";
}
if(isset($top_ok))
{
	$top_ok=$top_ok==1?0:1;
	$query = $query."top_ok             = '$top_ok',";
}

$query = $query."id='$id' where id='$id'";

$db->query($query);

okinfo($backurl,$lang_loginUserAdmin);
}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
