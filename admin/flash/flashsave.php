<?php
# 文件名称:flashsave.php 2009-08-05 11:21:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
require_once '../../config/flash.inc.php';


if($met_flasharray[$module][type]==2)$path="flash_path"; 
else $path="img_path";	

$c_path="c_".$path;$e_path="e_".$path;$o_path="o_".$path;
if($met_c_lang_ok==1 && $$c_path==''){
okinfo($redirect,$lang_js27.'['.$met_c_lang.']');
}
if($met_c_lang_ok!=1 && $met_e_lang_ok==1&& $$e_path==''){
okinfo($redirect,$lang_js27.'['.$met_e_lang.']');
}
if($met_c_lang_ok!=1 && $met_e_lang_ok!=1 && $met_o_lang_ok==1&& $$o_path==''){
okinfo($redirect,$lang_js27.'['.$met_o_lang.']');
}
$width=$met_flasharray[$module][x];
$height=$met_flasharray[$module][y];


if($action=="add"){
$query = "INSERT INTO $met_flash SET
                      module             = '$module',
                      c_img_title        = '$c_img_title',
					  c_img_path         = '$c_img_path',
					  c_img_link         = '$c_img_link',
					  e_img_title        = '$e_img_title',
					  e_img_path         = '$e_img_path',
					  e_img_link         = '$e_img_link',
					  o_img_title        = '$o_img_title',
					  o_img_path         = '$o_img_path',
					  o_img_link         = '$o_img_link',
					  c_flash_path       = '$c_flash_path',
					  c_flash_back       = '$c_flash_back',
					  e_flash_path       = '$e_flash_path',
					  e_flash_back       = '$e_flash_back',
				      o_flash_path       = '$o_flash_path',
					  o_flash_back       = '$o_flash_back',
					  no_order           = '$no_order',
					  width				 = '$width',
					  height			 = '$height'";
         $db->query($query);
okinfo('flash.php',$lang_loginUserAdmin);
}

if($action=="editor"){
$query = "update $met_flash SET
                      module             = '$module',
                      c_img_title        = '$c_img_title',
					  c_img_path         = '$c_img_path',
					  c_img_link         = '$c_img_link',
					  e_img_title        = '$e_img_title',
					  e_img_path         = '$e_img_path',
					  e_img_link         = '$e_img_link',
					  o_img_title        = '$o_img_title',
					  o_img_path         = '$o_img_path',
					  o_img_link         = '$o_img_link',
					  c_flash_path       = '$c_flash_path',
					  c_flash_back       = '$c_flash_back',
					  e_flash_path       = '$e_flash_path',
					  e_flash_back       = '$e_flash_back',
				      o_flash_path       = '$o_flash_path',
					  o_flash_back       = '$o_flash_back', 
					  no_order           = '$no_order' ,
					  width				 = '$width',
					  height			 = '$height' 
					  where id='$id'";

$db->query($query);
okinfo('flash.php',$lang_loginUserAdmin);
}


# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>
