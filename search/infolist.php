<?php
# 文件名称:infolist.php 2009-08-13 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
	
	 $list[c_title]=get_keyword_str($list[c_title],$searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$searchword,68);
	 $list[e_title]=get_keyword_str($list[e_title],$searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$searchword,68);
	 $list[o_title]=get_keyword_str($list[o_title],$searchword,50);
	 $list[o_content]=get_keyword_str($list[o_content],$searchword,68);
	 
	$list[title]=($lang=="en")?$list[e_title]:(($lang=="other")?$list[o_title]:$list[c_title]);
	$list[content]=($lang=="en")?$list[e_content]:(($lang=="other")?$list[o_content]:$list[c_content]);
	$htmname=$filename."/".$filenamenow.$list[id];
	$phpname=$filename."/show".$pagename.".php?id=".$list[id];	
	$list[c_url]=$met_webhtm?$htmname.$met_c_htmtype:$phpname;
	$list[e_url]=$met_webhtm?$htmname.$met_e_htmtype:$phpname."&lang=en";
	$list[o_url]=$met_webhtm?$htmname.$met_o_htmtype:$phpname."&lang=other";
	$list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);
if($met_member_use==2){
 if(intval($metinfo_member_type)>=intval($nowaccess))$search_list[]=$list;
}else{
$search_list[]=$list;	
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>