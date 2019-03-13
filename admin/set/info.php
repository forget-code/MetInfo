<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$infofile="../../templates/".$met_skin_user."/info.html";
if(!file_exists($infofile))die($lang_infoNoTem);

$content = file_get_contents($infofile);
$content =str_replace('{$met_skin_user}',$met_skin_user,$content);
$content =str_replace('$met_skin_user',$met_skin_user,$content);

echo $content;
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>