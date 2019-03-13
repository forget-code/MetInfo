<?php
require_once '../common.inc.php';
$query = "UPDATE {$met_config} set value='{$apppass}' where name = 'met_apppass'";
$db->get_one($query);
header("{$serverurl}");
?>