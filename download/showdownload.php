<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$query = "SELECT * FROM $met_parameter where type='4' and use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[maxsize]==200)$download_para200[]=$list;
$download_para[]=$list;
}
    $download=$db->get_one("select * from $met_download where id='$id'");
	if(!$download){
	okinfo('../',$lang[noid]);
	};
	$download[c_content]=contentshow($download[c_content]);
	$download[e_content]=contentshow($download[e_content]);
    $class1=$download[class1];
	$class2=$download[class2];
    $class3=$download[class3];

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
    $query = "SELECT * FROM $met_download $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$url1_c="showdownload.php?id=".$list[id];
	$url2_c="showdownload".$list[id].".htm";
	$url1_e="showdownload.php?en=en&id=".$list[id];
	$url2_e="showdownload".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($list[new_ok] == 1)$download_list_new[]=$list;
	if($list[com_ok] == 1)$download_list_com[]=$list;
    $download_list[]=$list;
    }   
require_once '../include/head.php';

$nav_x[c_name]="<a href=download.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=download.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>";

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$nav_x[c_name]="<a href=download.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=download.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>";
$nav_x[e_name]="<a href=download.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=download.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>";
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$nav_x[c_name]="<a href=download.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=download.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>"." > "."<a href=download.php?class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[c_name]."</a>";
$nav_x[e_name]="<a href=download.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=download.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>"." > "."<a href=download.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[e_name]."</a>";
}
}
}


if($en=="en"){
$show[e_description]=$download[e_description]?$download[e_description]:$met_e_keywords;
$show[e_keywords]=$download[e_keywords]?$download[e_keywords]:$met_e_keywords;
$e_title_keywords=$download[e_title]."--".$e_title_keywords;
$nav_x[e_name]=$nav_x[e_name]." > ".$download[e_title];
include template('e_showdownload');
}
else{
$show[c_description]=$download[c_description]?$download[c_description]:$met_c_keywords;
$show[c_keywords]=$download[c_keywords]?$download[c_keywords]:$met_c_keywords;
$c_title_keywords=$download[c_title]."--".$c_title_keywords;
$nav_x[c_name]=$nav_x[c_name]." > ".$download[c_title];
include template('showdownload');
}

footer();
?>