<?php
require_once '../login/login_check.php';
   if($action=="add"){
   $skin_if=$db->get_one("SELECT * FROM $met_skin_table WHERE skin_file='$skin_file'");
   if($skin_if){
   okinfo('javascript:history.back();',$lang[skin_if]);
}
   $query="insert into $met_skin_table set
           skin_name='$skin_name',
		   skin_file='$skin_file',
		   skin_info='$skin_info'";
   $db->query($query);
   okinfo('skin_manager.php',$lang[user_admin]);
   }
elseif($action=="modify"){
$skin_m=$db->get_one("SELECT * FROM $met_skin_table WHERE id='$id'");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('skin');
footer();
}
elseif($action=="editor"){
$skin_m=$db->get_one("SELECT * FROM $met_skin_table WHERE id='$id'");
if(!$skin_m){okinfo('skin_manager.php',$lang[noid]);}
$query="update $met_skin_table set
           skin_name='$skin_name',
		   skin_file='$skin_file',
		   skin_info='$skin_info'
		   where id='$id'";
   $db->query($query);
   okinfo('skin_manager.php',$lang[user_admin]);
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
    $total_count = $db->counter($met_skin_table, "", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_skin_table order BY id LIMIT $from_record, $list_num";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
     $skin_list[]=$list;
    }
$page_list = $rowset->link("skin_manager.php?page=");
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('skin');
footer();
}
?>