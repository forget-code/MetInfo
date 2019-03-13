<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
   $bigid_info=$db->get_one("select * from $met_parameter where id='$bigid'");
   if($action=="add"){
   $list_if=$db->get_one("SELECT * FROM $met_list WHERE info='$info' and bigid='$bigid' ");
   if($list_if)okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_parameternameexist);
   $query="insert into $met_list set
           info     ='$info',
		   no_order ='$no_order',
		   lang     ='$lang',
		   bigid    ='$bigid'";
   $db->query($query);
   okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_jsok);
   }
elseif($action=="modify"){
$fdlist_m=$db->get_one("SELECT * FROM $met_list WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter_list');
footer();
}
elseif($action=="editor"){
$list_m=$db->get_one("SELECT * FROM $met_list WHERE id='$id'");
if(!$list_m){okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_dataerror);}
$query="update $met_list set
           info       ='$info',
		   no_order   ='$no_order'
		   where id   ='$id'";
   $db->query($query);
   okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_jsok);
}
elseif($action=="delete"){
  if($action_type=="del"){
   $allidlist=explode(',',$allid);
    foreach($allidlist as $key=>$val){
    $query = "delete from $met_list where id='$val'";
    $db->query($query);
    }
    okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_jsok);
 }
  else{
      $query="delete from $met_list where id='$id'";
      $db->query($query);
      okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_jsok);
	  }
}
else{
    $total_count = $db->counter($met_list, "where bigid='$bigid'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_list  where bigid='$bigid' order BY no_order LIMIT $from_record, $list_num";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
     $fd_list[]=$list;
    }
$page_list = $rowset->link("list.php?bigid=$bigid&lang=$lang&page=");
	
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter_list');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>