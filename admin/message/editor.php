<?php
# 文件名称:editor 2009-08-13 08:54:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="editor"){
$query = "update $met_message SET
                      info               = '$info',
					  useinfo            = '$useinfo',
					  readok             = '$readok',
					  access			 = '$access'
					  where id='$id'";
$db->query($query);
classhtm('message',0,0);
okinfo('index.php',$lang_loginUserAdmin);
}
else
{
$message_list1=$db->get_one("SELECT * FROM $met_column where id=22 order by no_order");
$lev=$message_list1[access];
$message_list=$db->get_one("select * from $met_message where id='$id'");
$message_list['customerid']=$message_list['customerid']==0?$lang_messageAccessy:$list['customerid'];
switch($message_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
if(!$message_list){
okinfo('index.php',$lang_loginNoid);
}


$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}



$met_readok=($message_list[readok])?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message_editor');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>