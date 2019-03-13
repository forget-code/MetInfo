<?php
require_once '../login/login_check.php';
$query = "select * from $met_column where bigclass=0 and if_in='0' order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){$column_list[]=$list;}

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin_add');
footer();
?>