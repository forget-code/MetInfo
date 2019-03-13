<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$show = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");
if(!$show){
okinfo('../',$lang[noid]);
}
if($show[classtype]==3){
$show3 = $db->get_one("SELECT * FROM $met_column WHERE id='$show[bigclass]'");
$class1=$show3[bigclass];
}else{
$class1=$show[bigclass]?$show[bigclass]:$id;
}
$class1_list = $db->get_one("SELECT * FROM $met_column WHERE id='$class1'");
require_once '../include/head.php';
if($en=="en"){
$show[e_content]=contentshow($show[e_content]);
$show[e_description]=$show[e_description]?$show[e_description]:$met_e_keywords;
$show[e_keywords]=$show[e_keywords]?$show[e_keywords]:$met_e_keywords;
$e_title_keywords=$show[e_name]."--".$e_title_keywords;
include template('e_show');
}
else{
$show[c_content]=contentshow($show[c_content]);
$show[c_description]=$show[c_description]?$show[c_description]:$met_c_keywords;
$show[c_keywords]=$show[c_keywords]?$show[c_keywords]:$met_c_keywords;
$c_title_keywords=$show[c_name]."--".$c_title_keywords;

include template('show');
}
footer();
?>