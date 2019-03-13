<?php
require_once '../login/login_check.php';
   $bigid_info=$db->get_one("select * from $met_fdparameter where id='$bigid'");
   if($action=="add"){
   $list_if=$db->get_one("SELECT * FROM $met_fdlist WHERE c_list='$c_list'");
   if($list_if){
   okinfo('javascript:history.back();','下拉菜单名已经存在');
}
   $query="insert into $met_fdlist set
           c_list='$c_list',
		   e_list='$e_list',
		   no_order='$no_order',
		   bigid='$bigid'";
   $db->query($query);
   okinfo('list.php?bigid='.$bigid,$lang[user_admin]);
   }
elseif($action=="modify"){
$fdlist_m=$db->get_one("SELECT * FROM $met_fdlist WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_list');
footer();
}
elseif($action=="editor"){
$list_m=$db->get_one("SELECT * FROM $met_fdlist WHERE id='$id'");
if(!$list_m){okinfo('list.php?bigid='.$bigid,$lang[noid]);}
$query="update $met_fdlist set
           c_list='$c_list',
		   e_list='$e_list',
		   no_order='$no_order',
		   bigid='$bigid'
		   where id='$id'";
   $db->query($query);
   okinfo('list.php?bigid='.$bigid,$lang[user_admin]);
}
elseif($action=="delete"){
  if($action_type=="del"){
   $allidlist=explode(',',$allid);
    foreach($allidlist as $key=>$val){
    $query = "delete from $met_skin_table where id='$val'";
    $db->query($query);
    }
    okinfo('skin_manager.php',$lang[user_admin]);
 }
  else{
      $skin_m=$db->get_one("SELECT * FROM $met_skin_table WHERE id='$id'");
      if(!$skin_m){okinfo('skin_manager.php',$lang[noid]);}
      $query="delete from $met_skin_table where id='$id'";
      $db->query($query);
      okinfo('skin_manager.php',$lang[user_admin]);
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
$page_list = $rowset->link("list.php?page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_list');
footer();
}
?>