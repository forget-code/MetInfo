<?php
require_once '../include/common.inc.php';
if($action=='admin'){
    if (isblank($id)) {
        echo $lang[intput_member];
        exit;
    } 
    $id = dhtmlchars(trim($id));
    foreach($char_key as $value){
		if(strpos($id,$value)!==false){
			echo $lang[user_err];
			exit;
		}
	}
	unset($id_list);
    $id_list = $db->get_one("select admin_id from $met_admin_table where admin_id = '$id'");
    if ($id_list[admin_id]) {
        echo $lang[user_mudb];
        exit;
    } else {
        echo $lang[user_regok];
        exit;
    }
} 


?>