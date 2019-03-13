<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
require_once '../../config/flash_'.$lang.'.inc.php';

if($met_flash_ok==1)$met_flash_ok1="checked='checked'";
if($met_flash_type==0){
$met_flash_type0="checked='checked'";

}else{
$met_flash_type1="checked='checked'";
}

if($flashmode==1)
{

$style1='';
$style2='style="display:none"';
$lang_setflashTitle=$lang_setflashTitle1;
}else if(($flashmode==2))
{
$style1='style="display:none"';
$style2='';
$lang_setflashTitle=$lang_setflashTitle2;
}
$flashrec1=$db->get_one("SELECT * FROM $met_flash where id='$id'");

$query="select * from $met_column where lang='$lang' and if_in='0' order by no_order";
	$result= $db->query($query);
	$mod1[0]=$mod[10000]=array(
				id=>10000,
				name=>"$lang_flashGlobal",
				bigclass=>0
			);
	$mod1[1]=$mod[10001]=array(
				id=>10001,
				name=>"$lang_flashHome",
				bigclass=>0
			);
	$i=2;
	while($list = $db->fetch_array($result)){
	if($list[classtype]==1){
	                        $mod1[$i]=$list;
							$i++;
							}
	if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
	if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
	$mod[$list['id']]=$list;
	}
$met_flash_module[$flashrec1[module]]="selected='selected'";
$met_flash_type[$met_flasharray[$flashrec1[module]][type]]="checked='checked'";	
$selected[$flashrec1['module']]='selected="selected"';
if($met_flasharray[$flashrec1[module]][type]==0){
   okinfo('flash.php?lang='.$lang,$lang_flashclosenow);
}elseif($met_flasharray[$flashrec1[module]][type]==1&&$flashmode==2){
   okinfo('flash.php?lang='.$lang,$lang_flasherrornow);
}elseif($met_flasharray[$flashrec1[module]][type]==2&&$flashmode==1){
   okinfo('flash.php?lang='.$lang,$lang_flasherrornow);
}elseif($met_flasharray[$flashrec1[module]][type]==3){
   $style3="style='display:none;'";
   if($flashmode==2)okinfo('flash.php?lang='.$lang,$lang_flasherrornow);
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('flashedit');
footer();

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>