<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$module=$met_class[$class1][module];
$query = "select * from $met_parameter where lang='$lang' and module='".$met_class[$class1][module]."' and (class1=$class1 or class1=0) order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){
 if($list[type]==4){
  $query1 = " where lang='$lang' and bigid='".$list[id]."'";
  $total_list[$list[id]] = $db->counter($met_list, "$query1", "*");
  }
$para_list[]=$list;
}
$filename=preg_replace("/\s/","_",trim($filename)); 
$filenameold=preg_replace("/\s/","_",trim($filenameold));  
if($action=="add"){
$access=$access<>""?$access:0;
$query = "INSERT INTO $met_product SET
                      title              = '$title',
					  keywords           = '$keywords',
					  description        = '$description',
					  content            = '$content',
					  class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  new_ok             = '$new_ok',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',
				      com_ok             = '$com_ok',
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',
					  access          	 = '$access',
					  filename           = '$filename',
					  lang          	 = '$lang',";
if($metadmin[productother])$query .="
                      contentinfo         = '$contentinfo',
					  contentinfo1        = '$contentinfo1',
					  contentinfo2        = '$contentinfo2',
					  contentinfo3        = '$contentinfo3',
					  contentinfo4        = '$contentinfo4',
                      content1            = '$content1',
					  content2            = '$content2',
					  content3            = '$content3',
					  content4            = '$content4',
					  ";
			 $query .="top_ok             = '$top_ok'";
         $db->query($query);

$later_product=$db->get_one("select * from $met_product where updatetime='$updatetime' and lang='$lang'");
$id=$later_product[id];
foreach($para_list as $key=>$val){
    if($val[type]!=4){
      $para="para".$val[id];
	  $para=$$para;
	   if($val[type]==5){
	     $paraname="para".$val[id]."name";
		 $paraname=$$paraname;
		 }
	}else{
	  $para="";
	  for($i=1;$i<=$total_list[$val[id]];$i++){
	  $para1="para".$val[id]."_".$i;
	  $para2=$$para1;
	  $para=($para2<>"")?$para.$para2."-":$para;
	  }
	  $para=substr($para, 0, -1);
	}
	
    $query = "INSERT INTO $met_plist SET
                      listid   ='$id',
					  paraid   ='$val[id]',
					  info     ='$para',
					  imgname  ='$paraname',
					  module   ='$module',
					  lang     ='$lang'";
         $db->query($query);
   $paraname="";
 }
//html
contenthtm($class1,$id,'showproduct',$filename);
indexhtm();
classhtm($class1,$class2,$class3);

okinfo('index.php?lang='.$lang.'&class1='.$class1,$lang_jsok);
}

if($action=="editor"){
$query = "update $met_product SET 
                      title              = '$title',
					  keywords           = '$keywords',
					  description        = '$description',
					  content            = '$content',
                      class1             = '$class1',
					  class2             = '$class2',
					  class3             = '$class3',
					  imgurl             = '$imgurl',
					  imgurls            = '$imgurls',";
if($metadmin[productnew])$query .= "					  
					  new_ok             = '$new_ok',";
if($metadmin[productcom])$query .= "	
				      com_ok             = '$com_ok',";
					  $query .= "
					  issue              = '$issue',
					  hits               = '$hits', 
					  addtime            = '$addtime', 
					  updatetime         = '$updatetime',";
if($met_member_use)  $query .= "
					  access			 = '$access',";
if($metadmin[pagename])$query .= "
					  filename       	 = '$filename',";
if($metadmin[productother])$query .="
                      contentinfo         = '$contentinfo',
					  contentinfo1        = '$contentinfo1',
					  contentinfo2        = '$contentinfo2',
					  contentinfo3        = '$contentinfo3',
					  contentinfo4        = '$contentinfo4',
                      content1            = '$content1',
					  content2            = '$content2',
					  content3            = '$content3',
					  content4            = '$content4',
					  ";
					  $query .= "
					  top_ok             = '$top_ok',
					  lang               = '$lang'
					  where id='$id'";
$db->query($query);

foreach($para_list as $key=>$val){
    if($val[type]!=4){
      $para="para".$val[id];
	  $para=$$para;
	   if($val[type]==5){
	     $paraname="para".$val[id]."name";
		 $paraname=$$paraname;
		 }
	}else{
	  $para="";
	  for($i=1;$i<=$total_list[$val[id]];$i++){
	  $para1="para".$val[id]."_".$i;
	  $para2=$$para1;
	  $para=($para2<>"")?$para.$para2."-":$para;
	  }
	  $para=substr($para, 0, -1);
	}
    $now_list=$db->get_one("select * from $met_plist where listid='$id' and  paraid='$val[id]'");
	if($now_list){
    $query = "update $met_plist SET
					  info     ='$para',
					  imgname  ='$paraname',
					  lang     ='$lang'
					  where listid='$id' and  paraid='$val[id]'";
	}else{
    $query = "INSERT INTO $met_plist SET
                      listid   ='$id',
					  paraid   ='$val[id]',
					  info     ='$para',
					  imgname  ='$paraname',
					  module   ='$module',
					  lang     ='$lang'";	
	 }
         $db->query($query);
   $paraname="";
 }
//html
contenthtm($class1,$id,'showproduct',$filename);
indexhtm();
classhtm($class1,$class2,$class3);
if($filenameold<>$filename and $metadmin[pagename])deletepage($met_class[$class1][foldername],$id,'showproduct',$updatetimeold,$filenameold);
okinfo('index.php?lang='.$lang.'&class1='.$class1,$lang_jsok);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
