<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
   if($action=="add"){
   $skin_if=$db->get_one("SELECT * FROM $met_label WHERE oldwords='$oldwords' and lang='$lang'");
   if($skin_if){
   okinfo('javascript:history.back();',$lang_loginOldwords);
}
   $query="insert into $met_label set
           oldwords='$oldwords',
		   newwords='$newwords',
		   url='$url',
		   lang='$lang'";
   $db->query($query);
   require_once 'strsave.php';
   okinfo('strcontent.php?lang='.$lang,$lang_jsok);
   }
elseif($action=="modify"){
$label_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('label');
footer();
}
elseif($action=="editor"){
$skin_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
if(!$skin_m){okinfo('strcontent.php?lang='.$lang,$lang_dataerror);}
$query="update $met_label set
           oldwords='$oldwords',
		   newwords='$newwords',
		   url='$url'
		   where id='$id'";
   $db->query($query);
   require_once 'strsave.php';
   okinfo('strcontent.php?lang='.$lang,$lang_jsok);
}
elseif($action=="delete"){
  if($action_type=="del"){
   $allidlist=explode(',',$allid);
    foreach($allidlist as $key=>$val){
    $query = "delete from $met_label where id='$val'";
    $db->query($query);
    }
	require_once 'strsave.php';
    okinfo('strcontent.php?lang='.$lang,$lang_jsok);
 }
  else{
      $skin_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
      if(!$skin_m){okinfo('strcontent.php?lang='.$lang,$lang_dataerror);}
      $query="delete from $met_label where id='$id'";
      $db->query($query);
	  require_once 'strsave.php';
      okinfo('strcontent.php?lang='.$lang,$lang_jsok);
	  }
}
else{
    $total_count = $db->counter($met_label, " where lang='$lang'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_label where lang='$lang' order BY id LIMIT $from_record, $list_num";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
     $skin_list[]=$list;
    }
$page_list = $rowset->link("strcontent.php?page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('label');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>