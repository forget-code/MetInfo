<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=='add'){
$img_url="../templates/".$met_skin."/images";
$module=0;
if($id){
$column_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
$module = $column_list['module'];
$foldername = $column_list['foldername'];
}else{
$id=1;
}									
if($type==1){
	$typey = '';
	$bigs = 0;
	$imgs = "<img src='$img_url/columnnox.gif' style='margin:0px 5px;' />";
}else{
	$imgcss = 'padding-left:10px;';
	$imycss = "columnz_$id";
	$typey = $type;
	$bigs = $id;
}
	if($type==2)$imgs = "<div style='float:left; width:12px; height:10px;'></div><img src='{$img_url}/bg_column.gif' style='float:left; margin-right:3px;' />";
	if($type==3)$imgs = "<div style='float:left; width:12px; height:10px;'></div><img src='{$img_url}/bg_column1.gif' style='float:left;' /><img src='{$img_url}/bg_column.gif' style='float:left; margin-right:3px;' />";
		$newlist = "<tr class='mouse click $imycss newlist column_$type'>";
		$newlist.= "<td class='list-text$typey'><input name='id' type='checkbox' checked='checked' id='id' value='new-$lp' /></td>";
		$newlist.= "<td class='list-text$typey'><input type='text' class='text no_order' value='0' name='no_order_new-$lp' /><input type='hidden' value='$type' name='classtype_new-$lp' /><input type='hidden' value='$bigs' name='bigclass_new-$lp' /></td>";
		$newlist.= "<td class='list-text$typey' style='text-align:left; $imgcss'>$imgs<input type='text' class='text namenonull' value='' name='name_new-$lp' />";
		$newlist.= "</td>";
		$newlist.= "<td class='list-text$typey'>";
		$newlist.= "<select name='nav_new-$lp'>";
for($u=0;$u<4;$u++){
		$navtypes = navdisplay($u);
		$newlist.= "<option value='$u'>$navtypes</option>";
}
		$newlist.= "</select>";
		$newlist.= "</td>";
if($met_wap && $met_wap_ok){
		$newlist.= "<td class='list-text$typey'></td>";
}
		$newlist.= "<td class='list-text$typey'>";
		$newlist.= "<select name='module_new-$lp' onchange='newmodule($(this),$module,$type)'>";
if($type==2)$newlist.= "<option value='$module'>".module($module)."</option>";			
for($i=1;$i<=14;$i++){
$j=($i<13)?$i:($i+87);
$langmod="lang_mod".$j;
$langmod1=$$langmod;
$pk=1;
if($type==2 && $i==$module)$pk=0;
if($type==3 && $i!=$module)$pk=0;
if($pk){
if(count($met_module[$j])==0 or ($j<=5 || $j==8)){
		$newlist.= "<option value='$j'>{$langmod1}</option>";
}}}
		$newlist.= "<option value='999'>{$lang_modout}</option>";
		$newlist.= "</select>";
		$newlist.= "</td>";
		$newlist.= "<td class='list-text$typey'>";
if($type==1){
$newlist.= "<input type='text' class='text foldernonull' value='' name='foldername_new-$lp' />";
}else{
$newlist.= "<span>$foldername</span><input type='text' value='' class='text none foldernonull' name='foldername_new-$lp' />";
}
		$newlist.= "<input type='text' class='text none max nonull out_url_new' style='font-weight:normal;' value='{$lang_columnOutLink}' name='out_url_new-$lp' /><font style='font-size:12px; font-weight:normal;'></font></td>";
		$newlist.= "<td class='list-text$typey'>";
		$newlist.= "<input type='text' class='text no_order' value='0' name='index_num_new-$lp' /></td>";
if($met_member_use){
		$newlist.= "<td class='list-text$typey'><select name='access_new-$lp'>";
for($u=0;$u<4;$u++){
		$accesstype=accessdisplay($u);
		$newlist.= "<option value='$u' $navselect>$accesstype</option>";
}	
		$newlist.= "</select></td>";
}
		$newlist.= "<td class='list-text$typey'><a href='javascript:;' class='hovertips' onclick='delettr($(this));'>{$lang_js49}</a>";
		$newlist.= "</td>";
		$newlist.="</tr>";
		echo $newlist;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>