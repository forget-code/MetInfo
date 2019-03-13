<?php
# 文件名称:access.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
if($metinfo_member_name<>""){
   $member_title=$lang_memberIndex2.$metinfo_member_name;
   $member_loginok="<script type='text/javascript'>document.getElementById('login_x1').style.display='none';document.getElementById('login_x2').style.display='';</script>";
 }else{
   $member_title=$lang_memberIndex8;
   $member_loginok="<script type='text/javascript'>document.getElementById('login_x2').style.display='none';document.getElementById('login_x1').style.display='';</script>";
 }
 


switch($memberaction){
 case "control":
 $met_js=$member_title;
 break;
 case "login":
 $met_js=$member_loginok;
 break;
 case "membername":
 $met_js=$metinfo_member_name;
 break;
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
$met_js="<?php echo $met_js; ?>";
document.write($met_js) 