<?php
# 文件名称:skin.php 2009-08-03 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('online.php',$lang_loginUserAdmin);
}
else{
$met_online_skinarray[]=array(1,$lang_onlineblue,1);
$met_online_skinarray[]=array(1,$lang_onlinered,2);
$met_online_skinarray[]=array(1,$lang_onlinepurple,3);
$met_online_skinarray[]=array(1,$lang_onlinegreen,4);
$met_online_skinarray[]=array(1,$lang_onlinegray,5);
$met_online_skinarray[]=array(2,$lang_onlineblue,1);
$met_online_skinarray[]=array(2,$lang_onlinered,2);
$met_online_skinarray[]=array(2,$lang_onlinepurple,3);
$met_online_skinarray[]=array(2,$lang_onlinegreen,4);
$met_online_skinarray[]=array(2,$lang_onlinegray,5);
$met_online_skinarray[]=array(3,$lang_onlineblue,1);
$met_online_skinarray[]=array(3,$lang_onlinered,2);
$met_online_skinarray[]=array(3,$lang_onlinepurple,3);
$met_online_skinarray[]=array(3,$lang_onlinegreen,4);
$met_online_skinarray[]=array(3,$lang_onlinegray,5);
$met_online_skinarray[]=array(4,$lang_onlineblue,1);
$met_online_skinarray[]=array(4,$lang_onlinered,2);
$met_online_skinarray[]=array(4,$lang_onlinepurple,3);
$met_online_skinarray[]=array(4,$lang_onlinegreen,4);
$met_online_skinarray[]=array(4,$lang_onlinegray,5);
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
$i=0;
foreach($met_online_skinarray as $key=>$val){
echo "subcat[".$i."] = new Array('".$val[0]."','".$val[1]."','".$val[2]."');\n";
if($val[0]==$met_online_skin)$met_online_skinarray1[]=$val;
$met_online_count[$val[0]]=$val[0];
$i++;
}

echo "onecount=".$i.";\n";
echo "</script>";

$met_online_type1[$met_online_type]="checked='checked'";
$met_online_skin1[$met_online_skin]="selected='selected'";
$met_online_color1[$met_online_color]="selected='selected'";
$met_qq_type1[$met_qq_type]="selected='selected'";
$met_msn_type1[$met_msn_type]="selected='selected'";
$met_taobao_type1[$met_taobao_type]="selected='selected'";
$met_alibaba_type1[$met_alibaba_type]="selected='selected'";
$met_skype_type1[$met_skype_type]="selected='selected'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_online');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>