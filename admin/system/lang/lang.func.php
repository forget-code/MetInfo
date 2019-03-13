<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
function copyconfig(){
	global $db,$met_config,$langfile,$langmark,$thisurl,$lang_langcopyfile,$met_skin_user,$depth;
	$oldfile      =$depth."../../lang/language_$langfile.ini";   
	$newfile      =$depth."../../lang/language_$langmark.ini";  
	if(!file_exists($newfile)){  
		if (!copy($oldfile,   $newfile))metsave('-1',$lang_langcopyfile);
	}
	$query = "insert into {$met_config} select '',name,value,columnid,flashid,'{$langmark}' from {$met_config} where lang='{$langfile}' and columnid=0";
	$db->query($query);
	$oldfile      =$depth."../../templates/$met_skin_user/lang/language_$langfile.ini";   
	$newfile      =$depth."../../templates/$met_skin_user/lang/language_$langmark.ini"; 
	//if(!is_writable($depth."../../templates/".$met_skin_user."/lang/"))@chmod($depth."../../templates/".$met_skin_user."/lang/", 0777); 
	if(!file_exists($newfile)){  
		if (!copy($oldfile,   $newfile))metsave('-1',$lang_langcopyfile);
	}
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>