<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
	
	$list[title]=get_keyword_str(replaceHtmlAndJs($list[title]),$searchword,50);
	$list[content]=get_keyword_str(replaceHtmlAndJs($list[content]),$searchword,68);
	$htmname=($list[filename]<>"" and $metadmin[pagename])?$filename."/".$list[filename]:$filename."/".$filenamenow.$list[id];
	$phpname=$filename."/show".$pagename.".php?id=".$list[id];	
	$list[url]=$met_webhtm?$htmname.$met_htmtype:$phpname."&lang=".$lang;
if($met_member_use==2){
 if(intval($metinfo_member_type)>=intval($nowaccess))$search_list[]=$list;
}else{
$search_list[]=$list;	
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>