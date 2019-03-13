<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
$query="select * from $met_column where lang='$lang' order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
if($met_member_use){
	 switch($list['access'])
     {
    	case '1':$list['access1']=$lang_access1;break;
    	case '2':$list['access1']=$lang_access2;break;
    	case '3':$list['access1']=$lang_access3;break;
		default:$list['access1']=$lang_access0;break;
	 }	
	 }
if($list[classtype]==1){
$met_class1[$list['id']]=$list;
	 }
if(($list[classtype]==1 or ($list[releclass]>0 and $list[module]<7)) and $list[if_in]==0)$met_classindex[$list[module]][]=$list;
if($list[releclass])$met_classrele[$list['id']]=$list;
if($list[classtype]==2)$met_class2[$list[bigclass]][]=$list;
if($list[classtype]==2 and $list[releclass]==0  and $list[if_in]==0 )$met_class22[$list[bigclass]][]=$list;
if($list[classtype]==3)$met_class3[$list[bigclass]][]=$list;
$met_class[$list['id']]=$list;
$met_module[$list['module']][]=$list;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>