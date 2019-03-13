<?php
# 文件名称:list.php 2009-08-12 14:21:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
   $bigid_info=$db->get_one("select * from $met_parameter where id='$bigid'");
   $bigid_info[name]=$langusenow=="en"?$bigid_info['e_mark']:($langusenow=="other"?$bigid_info['o_mark']:$bigid_info['c_mark']);
   if($action=="add"){
   $list_if=$db->get_one("SELECT * FROM $met_fdlist WHERE c_list='$c_list'");

   $query="insert into $met_fdlist set
           c_list='$c_list',
		   e_list='$e_list',
		   o_list='$o_list',
		   no_order='$no_order',
		   bigid='$bigid'";
   $db->query($query);
   onepagehtm('feedback','index');
   okinfo('list.php?bigid='.$bigid,$lang_loginUserAdmin);
   }
elseif($action=="modify"){
$fdlist_m=$db->get_one("SELECT * FROM $met_fdlist WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter_list');
footer();
}
elseif($action=="editor"){
$list_m=$db->get_one("SELECT * FROM $met_fdlist WHERE id='$id'");
if(!$list_m){okinfo('list.php?bigid='.$bigid,$lang_loginNoid);}
$query="update $met_fdlist set
           c_list='$c_list',
		   e_list='$e_list',
		   o_list='$o_list',
		   no_order='$no_order',
		   bigid='$bigid'
		   where id='$id'";
   $db->query($query);
   okinfo('list.php?bigid='.$bigid,$lang_loginUserAdmin);
}
elseif($action=="delete"){
  if($action_type=="del"){
   $allidlist=explode(',',$allid);
    foreach($allidlist as $key=>$val){
    $query = "delete from $met_fdlist where id='$val'";
    $db->query($query);
    }
    okinfo('list.php?bigid='.$bigid,$lang_loginUserAdmin);
 }
  else{
      $skin_m=$db->get_one("SELECT * FROM $met_fdlist WHERE id='$id'");
      if(!$skin_m){okinfo('skin_manager.php',$lang_loginNoid);}
      $query="delete from $met_fdlist where id='$id'";
      $db->query($query);
      okinfo('list.php?bigid='.$bigid,$lang_loginUserAdmin);
	  }
}
else{
    $total_count = $db->counter($met_fdlist, "where bigid='$bigid'", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_fdlist  where bigid='$bigid' order BY no_order LIMIT $from_record, $list_num";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
     $fd_list[]=$list;
    }
$page_list = $rowset->link("list.php?bigid=$bigid&page=");
	
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter_list');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>