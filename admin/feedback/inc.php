<?php
# 文件名称:inc.php 2009-08-12 10:15:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
onepagehtm('feedback','index');
okinfo('inc.php',$lang_loginUserAdmin);
}
else{
$settings = parse_ini_file('../../feedback/config.inc.php');
@extract($settings);
$met_weburl=substr($met_weburl, 0, -1);
$met_fd_type1[$met_fd_type]="checked='checked'";
$met_fd_back1=($met_fd_back)?"checked='checked'":"";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_inc');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>