<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
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
okinfo('index.php?lang='.$lang,$lang_jsok);
}
else
{
$message_list=$db->get_one("select * from $met_message where id='$id'");
$message_list['customerid']=$message_list['customerid']==0?$lang_feedbackAccess0:$list['customerid'];
switch($message_list['access'])
{
	case '1':$access1="selected='selected'";break;
	case '2':$access2="selected='selected'";break;
	case '3':$access3="selected='selected'";break;
	default:$access0="selected='selected'";break;
}
if(!$message_list){
okinfo('index.php?lang='.$lang,$lang_dataerror);
}

if($met_member_use){
$lev=$met_module[7][0][access];
$level="";
switch(intval($lev))
{
	case 0:$level.="<option value='all' $access0>$lang_access0</option>";
	case 1:$level.="<option value='1' $access1>$lang_access1</option>";
	case 2:$level.="<option value='2' $access2>$lang_access2</option>";
	case 3:$level.="<option value='3' $access3>$lang_access3</option>";
}
}

$met_readok=($message_list[readok])?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('message_editor');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>