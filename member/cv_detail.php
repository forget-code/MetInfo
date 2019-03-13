<?php
# 文件名称:cv_detail.php 2009-08-13 14:13:13
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';

$query = "update $met_cv SET
					  readok             = '1'
					  where id='$id'";
$db->query($query);
$cv_list=$db->get_one("select * from $met_cv where id='$id'");
if(!$cv_list){
okinfo('cv.php',$lang_loginNoid);
}
$query = "SELECT * FROM $met_parameter where use_ok='1' and type=10000 order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$tmp=intval($list[id])-46;
$para="para".$tmp;
if($list[maxsize]==255)
{
	$cv_list[$para]="<a href='../upload/file/$cv_list[$para]'>$cv_list[$para]</a>";
}

$list[content]=$cv_list[$para];
$list[mark]=$lang=="en"?$list['e_mark']:($lang=="other"?$list['o_mark']:$list['c_mark']);
$cv_para[]=$list;
}

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('cv_detail');
footermember();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>