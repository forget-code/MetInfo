<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
require_once '../../config/flash_'.$lang.'.inc.php';

$query="select * from $met_column where if_in='0' and lang='$lang' order by no_order";
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

$met_flash_type[$met_flasharray[10000][type]]="checked='checked'";
if($met_flasharray[10000][type]==2){
$style1="style='display:none;'";
$style2="style='display:block;'";
}elseif($met_flasharray[10000][type]==0){
$style2="style='display:none;'";
$style1="style='display:none;'";
}elseif($met_flasharray[10000][type]==3){
$style3="style='display:none;'";
$style2="style='display:none;'";
}else{
$style2="style='display:none;'";
$style1="style='display:block;'";
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('flashadd');
footer();

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>