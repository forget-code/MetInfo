<?php
require_once '../login/login_check.php';
   if($action=="add"){
   $skin_if=$db->get_one("SELECT * FROM $met_label WHERE oldwords='$oldwords'");
   if($skin_if){
   okinfo('javascript:history.back();',$lang[oldwords]);
}
   $query="insert into $met_label set
           oldwords='$oldwords',
		   newwords='$newwords',
		   url='$url'";
   $db->query($query);
   require_once 'strsave.php';
   okinfo('strcontent.php',$lang[user_admin]);
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
if(!$skin_m){okinfo('strcontent.php',$lang[noid]);}
$query="update $met_label set
           oldwords='$oldwords',
		   newwords='$newwords',
		   url='$url'
		   where id='$id'";
   $db->query($query);
   require_once 'strsave.php';
   okinfo('strcontent.php',$lang[user_admin]);
}
elseif($action=="delete"){
  if($action_type=="del"){
   $allidlist=explode(',',$allid);
    foreach($allidlist as $key=>$val){
    $query = "delete from $met_label where id='$val'";
    $db->query($query);
    }
	require_once 'strsave.php';
    okinfo('strcontent.php',$lang[user_admin]);
 }
  else{
      $skin_m=$db->get_one("SELECT * FROM $met_label WHERE id='$id'");
      if(!$skin_m){okinfo('strcontent.php',$lang[noid]);}
      $query="delete from $met_label where id='$id'";
      $db->query($query);
      okinfo('strcontent.php',$lang[user_admin]);
	  }
}
else{
    $total_count = $db->counter($met_label, "", "*");
    require_once 'include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num = 16;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_label order BY id LIMIT $from_record, $list_num";
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
?>