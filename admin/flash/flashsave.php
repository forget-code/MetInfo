<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
require_once '../../config/flash_'.$lang.'.inc.php';

$path=($met_flasharray[$module][type]==2)?"flash_path":"img_path"; 
if($$path=='')okinfo('javascript:history.back();',$lang_js27);
$width=$met_flasharray[$module][x];
$height=$met_flasharray[$module][y];
$flash=$met_flasharray[$module][type];
if($action=="add"){
$query = "INSERT INTO $met_flash SET
                      module             = '$module',
					  img_title          = '$img_title',
					  img_path           = '$img_path',
					  img_link           = '$img_link',
					  flash_path         = '$flash_path',
					  flash_back         = '$flash_back',
					  no_order           = '$no_order',
					  width				 = '$width',
					  height			 = '$height',
					  lang               = '$lang'";
         $db->query($query);
okinfo('flash.php?lang='.$lang.'&flashmode='.$flash,$lang_jsok);
}

if($action=="editor"){
$query = "update $met_flash SET
                      module             = '$module',
                     img_title          = '$img_title',
					  img_path           = '$img_path',
					  img_link           = '$img_link',
					  flash_path         = '$flash_path',
					  flash_back         = '$flash_back',
					  no_order           = '$no_order',
					  width				 = '$width',
					  height			 = '$height',
					  lang               = '$lang'
					  where id='$id'";

$db->query($query);
okinfo('flash.php?lang='.$lang.'&flashmode='.$flash,$lang_jsok);
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
