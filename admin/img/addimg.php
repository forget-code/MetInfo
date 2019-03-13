<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=='add'){
$num = $lp+1;
	$newlist.= "<tr class='newlist'>";
    $newlist.= "<td class='text'><a href='javascript:;' onclick='imgnumfu();delettr($(this));' style='font-weight:normal; margin-right:5px;'>{$lang_delete}</a> {$lang_displayimg}$num</td>";
    $newlist.= "<td colspan='2' class='input upload'>";
	$newlist.= "<div style='height:30px;'><input name='displayname$lp' type='text' class='text med' value=''>{$lang_imagename}</div>";
	$newlist.= "<input name='displayimg$lp' type='text' class='text' value='' />";
	$newlist.= "<iframe id='UploadFiles' src='../include/upload_photo.php?returnid=displayimg$lp&flash=flash&met_arrayimg=1&lang=$lang' frameborder=0 scrolling=no ></iframe>";
	$newlist.= "</td>";
	$newlist.="</tr>";
	echo $newlist;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>