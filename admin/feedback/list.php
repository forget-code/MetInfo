<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
   $bigid_info=$db->get_one("select * from $met_parameter where id='$bigid'");
   if($action=="add"){
   $list_if=$db->get_one("SELECT * FROM $met_list WHERE info='$info' and bigid='$bigid' ");
   if($list_if)okinfo('list.php?bigid='.$bigid.'&lang='.$lang,$lang_parameternameexist);
   $list_ok=$db->get_one("SELECT * FROM $met_list WHERE bigid='$bigid' and no_order=99999 ");
   if($listproduct=="metinfo" && $list_ok){
   $query=(trim($info)==0)?"delete from $met_list where bigid='$bigid' and no_order=99999":"update $met_list set info='$info' where bigid='$bigid' and no_order=99999";
   }else{
   $query="insert into $met_list set
           info     ='$info',
		   no_order ='$no_order',
		   lang     ='$lang',
		   bigid    ='$bigid'";
   }
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
    $listinfo=$db->get_one("select * from $met_list where bigid='$bigid' and no_order=99999");
	$listinfoid=intval(trim($listinfo[info]));
	if($listinfo){
	$listmarknow='metinfo';
	$classtype=($listinfo[info]=='metinfoall')?$listinfoid:($met_class[$listinfoid][releclass]?'class1':'class'.$met_class[$listinfoid][classtype]);
    $total_count = $db->counter($met_product, "where $classtype='$listinfoid' and lang='$lang' ", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT title FROM $met_product where $classtype=$listinfoid and lang='$lang' order BY updatetime desc LIMIT $from_record, $list_num";
    $result = $db->query($query);
	$i=0;
	 while($list = $db->fetch_array($result)) {
	 $list[info]=$list[title];
	 $i++;
	 $list[no_order]=$i;
     $fd_list[]=$list;
    }
$page_list = $rowset->link("list.php?bigid=$bigid&lang=$lang&page=");
}else{
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
}	
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter_list');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>