<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$query = "SELECT * FROM $met_parameter where type='5' and use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[maxsize]==200)$img_para200[]=$list;
$img_para[]=$list;
}
    $img=$db->get_one("select * from $met_img where id='$id'");
	if(!$img){
	okinfo('../',$lang[noid]);
	};
	$img[c_content]=contentshow($img[c_content]);
	$img[e_content]=contentshow($img[e_content]);
    $class1=$img[class1];
	$class2=$img[class2];
    $class3=$img[class3];

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!class1_info){
	okinfo('../',$lang[noid]);
	};  

    $serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	if($search == "detail_search") {     
        if($c_title) { $serch_sql .= " and c_title like '%$c_title%' "; }
		if($e_title) { $serch_sql .= " and e_title like '%$e_title%' "; }
	}
	$order_sql=list_order($class1_info[list_order]);
    $query = "SELECT * FROM $met_img $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$url1_c="showimg.php?id=".$list[id];
	$url2_c="showimg".$list[id].".htm";
	$url1_e="showimg.php?en=en&id=".$list[id];
	$url2_e="showimg".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($list[new_ok] == 1)$img_list_new[]=$list;
	if($list[com_ok] == 1)$img_list_com[]=$list;
    $img_list[]=$list;
    }
  
require_once '../include/head.php';

$nav_x[c_name]=$class1_info[c_name];
$nav_x[e_name]=$class1_info[e_name];

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$nav_x[c_name]=$class1_info[c_name]." > ".$class2_info[c_name];
$nav_x[e_name]=$class1_info[e_name]." > ".$class2_info[e_name];
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$nav_x[c_name]=$class1_info[c_name]." > ".$class2_info[c_name]." > ".$class3_info[c_name];
$nav_x[e_name]=$class1_info[e_name]." > ".$class2_info[e_name]." > ".$class3_info[e_name];
}
}
}


if($en=="en"){
$show[e_description]=$img[e_description]?$img[e_description]:$met_e_keywords;
$show[e_keywords]=$img[e_keywords]?$img[e_keywords]:$met_e_keywords;
$e_title_keywords=$img[e_title]."--".$e_title_keywords;
$nav_x[e_name]=$nav_x[e_name]." > ".$img[e_title];
include template('e_showimg');
}
else{
$show[c_description]=$img[c_description]?$img[c_description]:$met_c_keywords;
$show[c_keywords]=$img[c_keywords]?$img[c_keywords]:$met_c_keywords;
$c_title_keywords=$img[c_title]."--".$c_title_keywords;
$nav_x[c_name]=$nav_x[c_name]." > ".$img[c_title];
include template('showimg');
}

footer();
?>