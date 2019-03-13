<?php
# 文件名称:ajax.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
require_once '../include/common.inc.php';
if($action=='admin'){
    if (isblank($id)) {
        echo $lang_loginIntput;
        exit;
    } 
    $id = dhtmlchars(trim($id));
    foreach($char_key as $value){
		if(strpos($id,$value)!==false){
			echo $lang_loginUserErr;
			exit;
		}
	}
	unset($id_list);
    $id_list = $db->get_one("select admin_id from $met_admin_table where admin_id = '$id'");
    if ($id_list[admin_id]) {
        echo $lang_loginUserMudb;
        exit;
    } else {
        echo $lang_loginRegok;
        exit;
    }
} 

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>