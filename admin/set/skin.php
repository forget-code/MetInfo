<?php
require_once '../login/login_check.php';
if($action=="modify"){
require_once 'configsave.php';
okinfo('skin.php',$lang[user_admin]);
}
else{
$query="select * from $met_skin_table order by id";
$result = $db->query($query);
 while($list = $db->fetch_array($result)) {
     $skin_list[]=$list;
    }
$met_online_type1[$met_online_type]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_skin');
footer();
}
?>