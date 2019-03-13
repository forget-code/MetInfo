<?php
require_once '../login/login_check.php';
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
if($val!=0){
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$val'");
if($admin_list2){
okinfo('index.php',$lang[bigclass1]);
}
}
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$val'");
$classtype="class".$admin_list[classtype];
switch ($admin_list[module]){
case 2;
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 3;
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 4;
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 5;
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 6;
$listok=$db->get_one("SELECT * FROM $met_job WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
}
$query = "delete from $met_column where id='$val'";
$db->query($query);
 if($admin_list[module]==1){
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename].".htm";
 if(file_exists($filename))@unlink($filename);
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename]."_en.htm";
 if(file_exists($filename))@unlink($filename);
 }
 
}
okinfo('index.php',$lang[user_admin]);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$admin_list){
okinfo('index.php',$lang[noid]);
}
$classtype="class".$admin_list[classtype];
switch ($admin_list[module]){
case 2;
$listok=$db->get_one("SELECT * FROM $met_news WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 3;
$listok=$db->get_one("SELECT * FROM $met_product WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 4;
$listok=$db->get_one("SELECT * FROM $met_download WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 5;
$listok=$db->get_one("SELECT * FROM $met_img WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
case 6;
$listok=$db->get_one("SELECT * FROM $met_job WHERE $classtype='$admin_list[id]'");
if($listok)okinfo('index.php',"请先删除【$admin_list[c_name]】栏目中的信息！");
break;
}
$admin_list2=$db->get_one("SELECT * FROM $met_column WHERE bigclass='$admin_list[id]'");
if($admin_list2){
okinfo('index.php',$lang[bigclass]);
}
$query = "delete from $met_column where id='$id'";
$db->query($query);
 if($admin_list[module]==1){
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename].".htm";
 if(file_exists($filename))@unlink($filename);
 $filename="../../".$admin_list[foldername]."/".$admin_list[filename]."_en.htm";
 if(file_exists($filename))@unlink($filename);
 }
okinfo('index.php',$lang[user_admin]);
}
?>
