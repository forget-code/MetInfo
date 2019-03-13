<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
if($action=="editor"){
$query = "update $met_feedback SET
                      useinfo            = '$useinfo',
					  readok             = '1'
					  where id='$id'";
$db->query($query);
okinfo('editor.php?id='.$id,$lang[user_admin]);
}
else
{
$query = "update $met_feedback SET
					  readok             = '1'
					  where id='$id'";
$db->query($query);
$feedback_list=$db->get_one("select * from $met_feedback where id='$id'");
if(!$feedback_list){
okinfo('index.php',$lang[noid]);
}

$query = "SELECT * FROM $met_fdparameter where use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$para="para".$list[id];
$list[content]=$feedback_list[$para];
if($feedback_list[en]=="en")$list[c_name]=$list[e_name];
$feedback_para[]=$list;
}


$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('feedback_editor');
footer();
}
?>