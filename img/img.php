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

    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!class1_info){
	okinfo('../',$lang[noid]);
	};
    $serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$order_sql=list_order($class1_info[list_order]);
    if($search == "detail_search") {     
        if($c_title) { $serch_sql .= " and c_title like '%$c_title%' "; }
		if($e_title) { $serch_sql .= " and e_title like '%$e_title%' "; }
        $total_count = $db->counter($met_img, "$serch_sql", "*");
    } else {
        $total_count = $db->counter($met_img, "$serch_sql", "*");
    }
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_img_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
    $query = "SELECT * FROM $met_img $serch_sql $order_sql LIMIT $from_record, $list_num";
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
$c_page_list = $rowset->link("img.php?class1=$class1&class2=$class2&class3=$class3&search=$search&c_title=$c_title&page=");		
$e_page_list = $rowset->link("img.php?en=en&class1=$class1&class2=$class2&class3=$class3&search=$search&e_title=$e_title&page=");	
require_once '../include/head.php';

$class_info[e_description]=$class1_info[e_description];
$class_info[c_description]=$class1_info[c_description];
$class_info[e_keywords]=$class1_info[e_keywords];
$class_info[c_keywords]=$class1_info[c_keywords];
$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$nav_x[c_name]="<a href=img.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=img.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>";

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$class_info[e_description]=$class2_info[e_description];
$class_info[c_description]=$class2_info[c_description];
$class_info[e_keywords]=$class2_info[e_keywords];
$class_info[c_keywords]=$class2_info[c_keywords];
$class_info[e_name]=$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]="<a href=img.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=img.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>";
$nav_x[e_name]="<a href=img.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=img.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>";
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$class_info[e_description]=$class3_info[e_description];
$class_info[c_description]=$class3_info[c_description];
$class_info[e_keywords]=$class3_info[e_keywords];
$class_info[c_keywords]=$class3_info[c_keywords];
$class_info[e_name]=$class3_info[e_name]."--".$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class3_info[c_name]."--".$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]="<a href=img.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=img.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>"." > "."<a href=img.php?class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[c_name]."</a>";
$nav_x[e_name]="<a href=img.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=img.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>"." > "."<a href=img.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[e_name]."</a>";
}
}
}

if($en=="en"){
$show[e_description]=$class_info[e_description]?$class_info[e_description]:$met_e_keywords;
$show[e_keywords]=$class_info[e_keywords]?$class_info[e_keywords]:$met_e_keywords;
$e_title_keywords=$class_info[e_name]."--".$e_title_keywords;
include template('e_img');
}
else{
$show[c_description]=$class_info[c_description]?$class_info[c_description]:$met_c_keywords;
$show[c_keywords]=$class_info[c_keywords]?$class_info[c_keywords]:$met_c_keywords;
$c_title_keywords=$class_info[c_name]."--".$c_title_keywords;

include template('img');
}

footer();
?>