<?php
require_once '../login/login_check.php';
    $query = "SELECT * FROM $met_column order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 if($list[bigclass]==0){$column_big[]=$list;}
	 else{$column_small[]=$list;}
    }
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('column');
footer();
?>