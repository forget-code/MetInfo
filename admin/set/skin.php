<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('skin.php?lang='.$lang,$lang_jsok);
}
else{
$query="select * from $met_skin_table order by id";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$cssfile="../../templates/".$list[skin_file]."/images/css/css.inc.php";
if(file_exists($cssfile)){
require_once $cssfile;
$list[cssname]=$cssnum; 
}else{
$list[cssname][0]=array($lang_setskinDefault,'metinfo.css');
}
     $skin_list[]=$list;
if($met_skin_user==$list[skin_file])$cssnumnow=$list[cssname];
unset($cssnum);
}

echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
$i=0;
foreach($skin_list as $key=>$val){
for($j=0; $j<count($val[cssname]); $j++){
echo "subcat[".$i."] = new Array('".$val[skin_file]."','".$val[cssname][$j][0]."','".$val[cssname][$j][1]."');\n";
$i++;
}

}
echo "onecount=".$i.";\n";
echo "</script>";

$met_timetype[0]=array(0=>"selected='selected'",1=>'Y-m-d H:i:s',2=>date('Y-m-d H:i:s',$m_now_time));
$met_timetype[1]=array(0=>"selected='selected'",1=>'Y-m-d',2=>date('Y-m-d',$m_now_time));
$met_timetype[2]=array(0=>"selected='selected'",1=>'Y/m/d',2=>date('Y/m/d',$m_now_time));
$met_timetype[3]=array(0=>"selected='selected'",1=>'Ymd',2=>date('Ymd',$m_now_time));
$met_timetype[4]=array(0=>"selected='selected'",1=>'Y-m',2=>date('Y-m',$m_now_time));
$met_timetype[5]=array(0=>"selected='selected'",1=>'Y/m',2=>date('Y/m',$m_now_time));
$met_timetype[6]=array(0=>"selected='selected'",1=>'Ym',2=>date('Ym',$m_now_time));
$met_timetype[6]=array(0=>"selected='selected'",1=>'m-d',2=>date('m-d',$m_now_time));
$met_timetype[7]=array(0=>"selected='selected'",1=>'m/d',2=>date('m/d',$m_now_time));
$met_timetype[8]=array(0=>"selected='selected'",1=>'md',2=>date('md',$m_now_time));
for($i=0;$i<9;$i++){
if($met_timetype[$i][1]==$met_listtime)$met_listtime1[$i]=$met_timetype[$i][0];
if($met_timetype[$i][1]==$met_contenttime)$met_contenttime1[$i]=$met_timetype[$i][0];
}
$met_pageskin1[$met_pageskin]="selected='selected'";
$met_product_page1[$met_product_page]="checked='checked'";
$met_img_page1[$met_img_page]="checked='checked'";
$met_product_detail1[$met_product_detail]="selected='selected'";
$met_img_detail1[$met_img_detail]="selected='selected'";

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_skin');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>