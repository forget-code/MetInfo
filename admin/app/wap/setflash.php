<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$serch_sql=$met_wap_ok?"and wap_ok='1'":'';
$query="select * from $met_column where lang='$lang' {$serch_sql} and if_in='0' order by no_order";
$result= $db->query($query);
$mod1[0]=$mod[10000]=array(
			id=>10000,
			name=>"$lang_flashGlobal",
			url=>$met_weburl."index.php?lang=".$lang,
			bigclass=>0
		);
$mod1[1]=$mod[10001]=array(
			id=>10001,
			name=>"$lang_flashHome",
			url=>$met_weburl."index.php?lang=".$lang,
			bigclass=>0
		);
$i=2;
while($list = $db->fetch_array($result)){
	if(!isset($met_flasharray[$list[id]][type]))$met_flasharray[$list[id]]=$met_flasharray[10000];
	$list['url']=linkrules($list);
	if($list[classtype]==1){
		$mod1[$i]=$list;
		$i++;
	}
	if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
	if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
	$mod[$list['id']]=$list;
}
if($action=="modify"){
	$met_array=Array();
	$met_flash_wap_yall=$wap_flash_10000_y;
	$met_flash_wap_typeall=$wap_flash_10000_type;
	foreach($mod as $key=>$val){
		$met_flash_all="met_flash_".$val[id]."_all";
		$met_flash_all=$$met_flash_all;
		if($met_flash_all==1){
			$met_array[$val['id']]['wap_y']=$met_flash_wap_yall;
			$met_array[$val['id']]['wap_type']=$met_flash_wap_typeall;
		}else{
			$met_flash_wap_y="wap_flash_".$val[id]."_y";
			$met_flash_wap_y=$$met_flash_wap_y;
			$met_flash_wap_type="wap_flash_".$val[id]."_type";
			$met_flash_wap_type=$$met_flash_wap_type;
			$met_flash_wap_y=intval($met_flash_wap_y)?$met_flash_wap_y:$met_flash_wap_yall;
			$met_array[$val['id']]['wap_y']=intval($met_flash_wap_y);
			$met_array[$val['id']]['wap_type']=$met_flash_wap_type;
		}
	}
	foreach($met_flasharray as $key=>$val){
		if(!$met_array[$key]){
			$query = "delete from $met_config where flashid='$key' and lang='$lang'";
			$db->query($query);
		}
	}
	$met_flasharray=$met_array;
	foreach($met_flasharray as $key=>$val){
		$name='flash_'.$key;
		$value="{$val[wap_type]}|{$val[wap_y]}";
		$configok = $db->get_one("SELECT * FROM $met_config WHERE flashid ='$key' and lang='$lang'");
		if(!$configok){
			$query = "INSERT INTO $met_config SET
					name              = '$name',
					mobile_value      = '$value',
					flashid           = '$key',
					lang              = '$lang'
					";
			$db->query($query);
		}elseif($configok['value']!=$value){
			$query = "update $met_config SET mobile_value = '$value' where flashid ='$key' and lang='$lang'";
			$db->query($query);
		}
	}
	$rurl="../app/wap/setflash.php?anyid={$anyid}&lang={$lang}&cs={$cs}";
	metsave($rurl,'',$depth);
}else{
$motop[1]='now';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('app/wap/setflash');footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>