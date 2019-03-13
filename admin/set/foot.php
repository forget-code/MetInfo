<?php
# 文件名称:foot.php 2009-08-01 23:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('foot.php',$lang_loginUserAdmin);
}
else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_foot');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>