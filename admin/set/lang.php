<?php
# 文件名称:lang.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
if($met_c_lang_ok+$met_e_lang_ok+$met_o_lang_ok==0)okinfo('javascript:history.back();',$lang_skinlangselect);
$met_en_lang=($met_e_lang_ok==1)?1:0;
require_once 'configsave.php';
okinfo('lang.php',$lang_loginUserAdmin);
}
else{
if($met_c_lang_ok==1)$met_c_lang_yes="checked='checked'";
if($met_e_lang_ok==1)$met_e_lang_yes="checked='checked'";
if($met_o_lang_ok==1)$met_o_lang_yes="checked='checked'";
if($met_ch_lang==1)$met_ch_lang1="checked='checked'";
if($met_admin_type_ok==1)$met_admin_type_yes="checked='checked'";
$met_index_type1[$met_index_type]="checked='checked'";
$met_admin_type1[$met_admin_type]="checked='checked'";
$met_c_lang=($met_c_lang=="")?$lang_skinlangtpye1:$met_c_lang;
$met_e_lang=($met_e_lang=="")?$lang_skinlangtpye2:$met_e_lang;
$met_o_lang=($met_o_lang=="")?$lang_skinlangtpye3:$met_o_lang;

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('lang');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>