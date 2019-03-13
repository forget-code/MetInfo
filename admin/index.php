<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$admin_index=TRUE;
require_once 'login/login_check.php';
if($action=="renameadmin"){
   $adminfile=$url_array[count($url_array)-2];
  if($met_adminfile!=""&&$met_adminfile!=$adminfile){
  $oldname='../'.$adminfile;
  $newname='../'.$met_adminfile;
  rename($oldname,$newname);
  echo "<script type='text/javascript'>parent.setCookie('adminnow', '$met_adminfile'); top.location.href='$newname'; </script>";
  }
}

$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
    $query = "SELECT * FROM $met_column where if_in=0 and lang='$lang' order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	  if($list[bigclass]==0){
	    $class1_list[$list[module]][]=$list;	 
	   }else{
	   $class2_list[$list[module]][]=$list;	
      }
	}
if(	$metinfo_admin_pop!="metinfo"){
$admin_pop=explode('-',$metinfo_admin_pop);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1=$admin_poptext.$val=$val;
$$admin_poptext1="metinfo";
}
}

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name'");
include template('index');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>