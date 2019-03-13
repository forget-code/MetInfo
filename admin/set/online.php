<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('online.php?lang='.$lang,$lang_jsok);
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
if($met_onlinenameok)$met_onlinenameok1="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_online');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>