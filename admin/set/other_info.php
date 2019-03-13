<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="modify"){
if($met_en_lang==1){
$query = "update $met_otherinfo SET
                      c_info1       = '$c_info1',
					  c_info2       = '$c_info2',
					  c_info3       = '$c_info3',
					  c_info4       = '$c_info4',
					  c_info5       = '$c_info5',
					  c_info6       = '$c_info6',
					  c_info7       = '$c_info7',
					  c_info8       = '$c_info8',
					  c_info9       = '$c_info9',
					  c_info10      = '$c_info10',
					  c_imgurl1     = '$c_imgurl1',
					  c_imgurl2     = '$c_imgurl2',
					  e_info1       = '$e_info1',
					  e_info2       = '$e_info2',
					  e_info3       = '$e_info3',
					  e_info4       = '$e_info4',
					  e_info5       = '$e_info5',
					  e_info6       = '$e_info6',
					  e_info7       = '$e_info7',
					  e_info8       = '$e_info8',
					  e_info9       = '$e_info9',
					  e_info10      = '$e_info10',
					  e_imgurl1     = '$e_imgurl1',
					  e_imgurl2     = '$e_imgurl2'
					  where id='$id'";}
else{
$query = "update $met_otherinfo SET
                      c_info1       = '$c_info1',
					  c_info2       = '$c_info2',
					  c_info3       = '$c_info3',
					  c_info4       = '$c_info4',
					  c_info5       = '$c_info5',
					  c_info6       = '$c_info6',
					  c_info7       = '$c_info7',
					  c_info8       = '$c_info8',
					  c_info9       = '$c_info9',
					  c_info10      = '$c_info10',
					  c_imgurl1     = '$c_imgurl1',
					  c_imgurl2     = '$c_imgurl2'
					  where id='$id'";
}
$db->query($query);
okinfo('other_info.php',$lang[user_admin]);

}
else
{
$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if(!$otherinfo){
okinfo('../site/sysadmin.php',$lang[noid]);
}
}
$infofile="../../templates/".$met_skin_user."/otherinfo.inc.php";
if(!file_exists($infofile)){
$infoname1=array('该字段没有启用','');
$infoname2=array('该字段没有启用','');
$infoname3=array('该字段没有启用','');
$infoname4=array('该字段没有启用','');
$infoname5=array('该字段没有启用','');
$infoname6=array('该字段没有启用','');
$infoname7=array('该字段没有启用','');
$infoname8=array('该字段没有启用','');
$infoname9=array('该字段没有启用','');
$infoname10=array('该字段没有启用','');
$imgurlname1=array('该字段没有启用','');
$imgurlname2=array('该字段没有启用','');
}else{
require_once($infofile);
}
$rooturl="..";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('otherinfo');
footer();
?>