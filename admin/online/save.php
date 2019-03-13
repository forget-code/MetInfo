<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="add"){
$query = "INSERT INTO $met_online SET
                      name           = '$name',
					  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype',
					  lang           = '$lang'";
         $db->query($query);
okinfo('index.php?lang='.$lang,$lang_jsok);
}

if($action=="editor"){
$query = "update $met_online SET 
                      name           = '$name',
     				  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'
					  where id='$id'";

$db->query($query);
okinfo('index.php?lang='.$lang,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>