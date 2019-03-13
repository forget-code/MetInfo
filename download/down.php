<?php
# 文件名称:down.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$download=$db->get_one("select * from $met_download where id='$id'");
	if(!$download){
	okinfo('../',$lang_error);
	}
if(intval($metinfo_member_type)>=intval($download[downloadaccess])){
    header("location:$download[downloadurl]");exit;
	}else{
	session_unset();
$_SESSION['metinfo_member_name']=$metinfo_member_name;
$_SESSION['metinfo_member_pass']=$metinfo_member_pass;
$_SESSION['metinfo_member_type']=$metinfo_member_type;
$_SESSION['metinfo_admin_name']=$metinfo_admin_name;
	okinfo('../member/'.$member_index_url,$lang_downloadaccess);
	}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
