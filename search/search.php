<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!$class1_info){
	okinfo('../',$lang[noid]);
	};
switch($class1_info[module]){
    case 2;
	$table_name=$met_news;
	$preurl="../".$class1_info[foldername]."/shownews";
	echo $preurl;
	break;
	case 3;
	$table_name=$met_product;
	$preurl="../".$class1_info[foldername]."/showproduct";
	break;
	case 4;
	$table_name=$met_download;
	$preurl="../".$class1_info[foldername]."/showdownload";
	break;
	case 5;
	$table_name=$met_img;
	$preurl="../".$class1_info[foldername]."/showimg";
	break;
}
    $serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$order_sql=list_order($class1_info[list_order]);    
    if($c_title) { $serch_sql .= " and c_title like '%$c_title%' "; }
	if($e_title) { $serch_sql .= " and e_title like '%$e_title%' "; }
    $total_count = $db->counter($table_name, "$serch_sql", "*");
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_search_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $table_name $serch_sql $order_sql LIMIT $from_record, $list_num";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$url1_c=$preurl.".php?id=".$list[id];
	$url2_c=$preurl.$list[id].".htm";
	$url1_e=$preurl.".php?en=en&id=".$list[id];
	$url2_e=$preurl.$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
    $search_list[]=$list;
    }
$c_page_list = $rowset->link("search.php?class1=$class1&class2=$class2&class3=$class3&c_title=$c_title&page=");		
$e_page_list = $rowset->link("search.php?en=en&class1=$class1&class2=$class2&class3=$class3&e_title=$e_title&page=");	
require_once '../include/head.php';

$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$nav_x[c_name]=$class1_info[c_name];
$nav_x[e_name]=$class1_info[e_name];

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$class_info[e_name]=$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]=$class1_info[c_name]." > ".$class2_info[c_name];
$nav_x[e_name]=$class1_info[e_name]." > ".$class2_info[e_name];
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$class_info[e_name]=$class3_info[e_name]."--".$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class3_info[c_name]."--".$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]=$class1_info[c_name]." > ".$class2_info[c_name]." > ".$class3_info[c_name];
$nav_x[e_name]=$class1_info[e_name]." > ".$class2_info[e_name]." > ".$class3_info[e_name];
}
}
}
$nav_x[c_name]=$nav_x[c_name].":搜索关键字--".$c_title;
$nav_x[e_name]=$nav_x[e_name].":keywords--".$e_title;
if($en=="en"){
$e_title_keywords=$class_info[e_name]."--search--".$e_title_keywords;
include template('e_search');
}
else{
$c_title_keywords=$class_info[c_name]."--搜索--".$c_title_keywords;
include template('search');
}

footer();
?>