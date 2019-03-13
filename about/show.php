<?php
# 文件名称:show.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';

$show = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$show){
okinfo('../',$lang_error);
}
    $show[name]=($lang=="en")?$show[e_name]:(($lang=="other")?$show[o_name]:$show[c_name]);
	$show[keywords]=($lang=="en")?$show[e_keywords]:(($lang=="other")?$show[o_keywords]:$show[c_keywords]);
	$show[content]=($lang=="en")?$show[e_content]:(($lang=="other")?$show[o_content]:$show[c_content]);
	$show[description]=($lang=="en")?$show[e_description]:(($lang=="other")?$show[o_description]:$show[c_description]);
	$show[out_url]=($lang=="en")?$show[e_out_url]:(($lang=="other")?$show[o_out_url]:$show[c_out_url]);

$metaccess=$show[access];
if($show[classtype]==3){
$show3 = $db->get_one("SELECT * FROM $met_column WHERE id='$show[bigclass]'");
$class1=$show3[bigclass];
$class2=$show[bigclass];
$class3=$show[id];
}else{
$class1=$show[bigclass]?$show[bigclass]:$id;
$class2=$show[bigclass]?$id:"0";
$class3=0;
}

require_once '../include/head.php';
$class1_info=$class1_list[$class1];
$class1_list=$class1_info;
$class2_info=$class2_list[$class2];
$class3_info=$class3_list[$class3];
$show[content]=contentshow($show[content]);
$show[description]=$show[description]?$show[description]:$met_keywords;
$show[keywords]=$show[keywords]?$show[keywords]:$met_keywords;
$met_title=$show[name]."--".$met_title;
require_once '../public/php/methtml.inc.php';

if(file_exists("../templates/".$met_skin_user."/e_show.html")){
   if($lang=="en"){
     $show[e_content]=contentshow($show[e_content]);
     $show[e_description]=$show[e_description]?$show[e_description]:$met_e_keywords;
     $show[e_keywords]=$show[e_keywords]?$show[e_keywords]:$met_e_keywords;
     $e_title_keywords=$show[e_name]."--".$met_e_webname;
     include template('e_show');
	}else{
	 $show[c_content]=contentshow($show[c_content]);
     $show[c_description]=$show[c_description]?$show[c_description]:$met_c_keywords;
     $show[c_keywords]=$show[c_keywords]?$show[c_keywords]:$met_c_keywords;
     $c_title_keywords=$show[c_name]."--".$met_c_webname;
	 include template('show');
	 }
}else{
include template('show');
}
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>