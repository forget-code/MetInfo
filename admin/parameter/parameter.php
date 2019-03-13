<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
switch($module){
case "3";
$p_title=($action=="addsave")?$lang_parameteradd."[".$lang_mod3."]":$lang_parameterName."[".$lang_mod3."]";
break;
case "4";
$p_title=($action=="addsave")?$lang_parameteradd."[".$lang_mod4."]":$lang_parameterName."[".$lang_mod4."]";
break;
case "5";
$p_title=($action=="addsave")?$lang_parameteradd."[".$lang_mod5."]":$lang_parameterName."[".$lang_mod5."]";
break;
case "6";
$p_title=($action=="addsave")?$lang_parameteradd."[".$lang_indexcv."]":$lang_parameterName."[".$lang_indexcv."]";
break;
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
if($action=="editor"){
    $query="select * from $met_parameter where module='$module' and lang='$lang'  order by no_order";
	if($class1)$query="select * from $met_parameter where module='$module' and (class1='$class1' or class1='0') and lang='$lang'  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
		$list1[name]="name_".$list1[id];
		$list1[name]=$$list1[name];
		$list1[no_order]="no_order_".$list1[id];
		$list1[no_order]=$$list1[no_order];
		$list1[type]="type_".$list1[id];
		$list1[type]=$$list1[type];
		$list1[access]="access_".$list1[id];
		$list1[access]=$$list1[access];
		$list1[class1]="class1_".$list1[id];
		$list1[class1]=$$list1[class1];
		$list1[wr_ok]="wr_ok_".$list1[id];
		$list1[wr_ok]=intval($$list1[wr_ok]);
		$list[]=$list1;
	}
foreach($newlist as $key=>$val){
	$name     = "name_new$val"; 	
	$name     = $$name;
	$no_order = "no_order_new$val";
	$no_order = $$no_order;
	$type     = "type_new$val";
	$type     = $$type;
	$access   = "access_new$val";
	$access   = $$access;
	$class1   = "class1_new$val";
	$class1   = $$class1;
	$wr_ok    = "wr_ok_new$val";
	$wr_ok    = $$wr_ok;
	$query = "INSERT INTO $met_parameter SET
		name               = '$name',
		no_order           = '$no_order',
		type               = '$type',
		access             = '$access',
		class1             = '$class1',
		module             = '$module',
		lang               = '$lang',
		wr_ok              = '$wr_ok'";
	$db->query($query);
}
foreach($list as $key=>$val){
	$query = "update $met_parameter SET 
		name               = '$val[name]',
		no_order           = '$val[no_order]',
		type               = '$val[type]',
		access             = '$val[access]',
		class1             = '$val[class1]',
		wr_ok              = '$val[wr_ok]'
		where id=$val[id]";
	$db->query($query);
}
okinfox('../parameter/parameter.php?module='.$module.'&lang='.$lang.'&class1='.$class1);
}elseif($action=="delete"){
      $query="delete from $met_parameter where id='$id'";
      $db->query($query);
  if($type==2 or $type==4 or $type==6){
      $query="delete from $met_list where bigid='$id'";
      $db->query($query);
   }
//delete images
  if($met_deleteimg && $type==5){
    $query="select * from $met_plist where paraid='$id'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
       file_unlink("../".$list[info]);
      }
  }
   $query="delete from $met_plist where paraid='$id'";
   $db->query($query);
  okinfox('../parameter/parameter.php?module='.$module.'&lang='.$lang.'&class1='.$class1);
}elseif($action=="addsave"){
	$newslit = "<tr class='mouse newlist'>\n"; 
	$newslit.= "<td class='list-text'><input name='no_order_new$lp' type='text' class='text no_order' /></td>\n";
	$newslit.= "<td class='list-text'><input name='name_new$lp' type='text' class='text nonull' /><input name='newlist[$lp]' type='hidden' class='text no_order' value='$lp' /></td></td>\n";
	if($module<6){		
	$newslit.= "<td class='list-text'>\n";
	$newslit.= "<select name='class1_new$lp' >\n";
	$newslit.= "<option value='0' selected='selected'>$lang_allcategory</option>\n";
		foreach($met_classindex[$module] as $key=>$val1){
	$newslit.= "<option value='$val1[id]' >$val1[name]</option>\n";
		}
	$newslit.= "</select>\n";
	}
	if($met_member_use){
	$newslit.= "<td class='list-text'>\n";
	$newslit.="<select name='access_new$lp' id='access' >";
	$newslit.= "<option value='0'>{$lang_access0}</option>\n";
	$newslit.= "<option value='1' >{$lang_access1}</option>\n";
	$newslit.= "<option value='2' >{$lang_access2}</option>\n";
	$newslit.= "<option value='3' >{$lang_access3}</option>\n";
	$newslit.= "</select></td>\n";	
	}
	$newslit.= "<td class='list-text'><select name='type_new$lp' id='access'>\n";
	$newslit.= "<option value='1' >{$lang_parameter1}</option>\n";
	$newslit.= "<option value='2' >{$lang_parameter2}</option>\n";
	$newslit.= "<option value='3' >{$lang_parameter3}</option>\n";
	$newslit.= "<option value='4' >{$lang_parameter4}</option>\n";
	$newslit.= "<option value='5' >{$lang_parameter5}</option>\n";
	$newslit.= "<option value='6' >{$lang_parameter6}</option>\n";
	$newslit.= "</select></td>\n";
	$newslit.= "<td class='list-text'><input type='checkbox' name='wr_ok_new$lp' value='1' /></td>\n";
	$newslit.= "<td class='list-text'><a href='javascript:;' class='hovertips' style='padding:0px 5px;' onclick='delettr($(this));'><img src='$img_url/12.png' /><span class='vihide'>$lang_js49</span></a></td>\n";
	$newslit.= "</tr>";
	echo $newslit;
}else{
    $query="select * from $met_parameter where module='$module' and lang='$lang'  order by no_order";
	if($class1)$query="select * from $met_parameter where module='$module' and (class1='$class1' or class1='0') and lang='$lang'  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$typelist="type".$list1[type];
	$list1[$typelist]="selected='selected'";
	$list1[wr_ok]=($list1[wr_ok]==1)?"checked='checked'":"";
if($met_member_use){
	switch($list1['access'])
	{
		case '1':$list1['access1']="selected='selected'";break;
		case '2':$list1['access2']="selected='selected'";break;
		case '3':$list1['access3']="selected='selected'";break;
		default:$list1['access0']="selected='selected'";break;
	}
}
	$list[]=$list1;
	}
include template('parameter');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>