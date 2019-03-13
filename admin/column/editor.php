<?php
require_once '../login/login_check.php';
$column_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$column_list){
okinfo('index.php',$lang[noid]);
}
$classtype=1;
$list_order[0]="checked='checked'";
$list_order[$column_list[list_order]]="checked='checked'";
$list_orderok="none";
if($column_list[list_order]!=0)$list_orderok="";
$module[$column_list[module]]="selected='selected'";
$nav[$column_list[nav]]="checked='checked'";
$if_in[$column_list[if_in]]="checked='checked'";
$bigclass=$lang[class1];
$addtitle=$lang[class1];
$foldername="";
$class=$column_list[bigclass];
if($column_list[module]!=1)$filenameok="none";
if($column_list[if_in]==1){$if_in_p="none";}
else{$if_out_p="none";}
if($column_list[new_windows]=="target='_blank'"){$new_windows="checked='checked'";}

if($column_list[bigclass]!=0){
$class2_list = $db->get_one("SELECT * FROM $met_column WHERE id='$column_list[bigclass]'");
$bigclass=$class2_list[c_name];
if($class2_list[bigclass]!=0){
$addtitle=$lang[class3];
$classtype=3;
}
else{
$addtitle=$lang[class2];
$classtype=2;
}
}


$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('column_editor');
footer();
?>