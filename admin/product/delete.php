<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$module=$met_class[$class1][module];
$backurl="index.php?lang=$lang&class1=$class1&class2=$class2&class3=$class3";
$query = "select * from $met_parameter where lang='$lang' and module='".$met_class[$class1][module]."' and (class1=$class1 or class1=0) and type='5' order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
$para_list[]=$list;
}
$folder=$db->get_one("select * from $met_column where id='$class1'");
if($action=="del"){
$allidlist=explode(',',$allid);
$k=count($allidlist)-1;
for($i=0;$i<$k; $i++){
if($met_htmpagename==1 or $met_deleteimg or $metadmin[pagename])$product_list=$db->get_one("select * from $met_product where id='$allidlist[$i]'");
$updatetime=date('Ymd',strtotime($product_list[updatetime]));
//delete images
if($met_deleteimg){
file_unlink("../".$product_list[imgurl]);
file_unlink("../".$product_list[imgurls]);
$product_list[imgurlbig]=str_replace('watermark/','',$product_list[imgurl]);
file_unlink("../".$product_list[imgurlbig]);
foreach($para_list as $key=>$val){
$imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val[id]' and listid='$allidlist[$i]'");
file_unlink("../".$imagelist[info]);
}
}
deletepage($folder[foldername],$allidlist[$i],'showproduct',$updatetime,$product_list[filename]);
$query = "delete from $met_product where id='$allidlist[$i]'";
$db->query($query);
$query = "delete from $met_plist where listid='$allidlist[$i]' and module='$module'";
$db->query($query);
}
indexhtm();
classhtm($class1,$class2,$class3);
  if($met_webhtm==2){
   okinfo($backurl,$lang_delall);
   }else{
   okinfo($backurl,$lang_jsok);
   }
}
else{
$product_list = $db->get_one("SELECT * FROM $met_product WHERE id='$id'");
if(!$product_list){
okinfo($backurl,$lang_dataerror);
}
$query = "delete from $met_product where id='$id' ";
$db->query($query);

//delete images
if($met_deleteimg){
file_unlink("../".$product_list[imgurl]);
file_unlink("../".$product_list[imgurls]);
$product_list[imgurlbig]=str_replace('watermark/','',$product_list[imgurl]);
file_unlink("../".$product_list[imgurlbig]);
foreach($para_list as $key=>$val){
$imagelist=$db->get_one("select * from $met_plist where lang='$lang' and  paraid='$val[id]' and listid='$id'");
file_unlink("../".$imagelist[info]);
}
}

$query = "delete from $met_plist where listid='$id' and module='$module'";
$db->query($query);

$updatetime=date('Ymd',strtotime($product_list[updatetime]));
deletepage($folder[foldername],$id,'showproduct',$updatetime,$product_list[filename]);
indexhtm();
$class1=$product_list[class1];
$class2=$product_list[class2];
$class3=$product_list[class3];
classhtm($class1,$class2,$class3);
okinfo($backurl,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
