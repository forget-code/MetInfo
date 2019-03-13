<?php
require_once 'common.inc.php';
switch($type){
case 'product';
$met_hits=$met_product;
break;
case 'news';
$met_hits=$met_news;
break;
case 'download';
$met_hits=$met_download;
break;
case 'img';
$met_hits=$met_img;
break;
}
$query="select * from $met_hits where id='$id'";
$hits_list=$db->get_one($query);
$hits_list[hits]=$hits_list[hits]+1;
$query = "update $met_hits SET hits='$hits_list[hits]' where id='$id'";
$db->query($query); 
$query="select * from $met_hits where id='$id'";
$hits_list=$db->get_one($query);
$hits=$hits_list[hits];
?>
$hits="<?=$hits?>";
document.write($hits) 