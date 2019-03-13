<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

$query = "SELECT * FROM $met_parameter where type='3' and use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
if($list[maxsize]==200)$product_para200[]=$list;
$product_para[]=$list;
}
    $product=$db->get_one("select * from $met_product where id='$id'");
	if(!$product){
	okinfo('../',$lang[noid]);
	};
	$product[c_content]=contentshow($product[c_content]);
	$product[e_content]=contentshow($product[e_content]);
    $class1=$product[class1];
	$class2=$product[class2];
    $class3=$product[class3];

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
    $query = "SELECT * FROM $met_product $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$url1_c="showproduct.php?id=".$list[id];
	$url2_c="showproduct".$list[id].".htm";
	$url1_e="showproduct.php?en=en&id=".$list[id];
	$url2_e="showproduct".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($list[new_ok] == 1)$product_list_new[]=$list;
	if($list[com_ok] == 1)$product_list_com[]=$list;
    $product_list[]=$list;
    }
	
require_once '../include/head.php';

$nav_x[c_name]="<a href=product.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=product.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>";

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$nav_x[c_name]="<a href=product.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=product.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>";
$nav_x[e_name]="<a href=product.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=product.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>";}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$nav_x[c_name]="<a href=product.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=product.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>"." > "."<a href=product.php?class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[c_name]."</a>";
$nav_x[e_name]="<a href=product.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=product.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>"." > "."<a href=product.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[e_name]."</a>";
}
}
}


if($en=="en"){
$show[e_description]=$product[e_description]?$product[e_description]:$met_e_keywords;
$show[e_keywords]=$product[e_keywords]?$product[e_keywords]:$met_e_keywords;
$e_title_keywords=$product[e_title]."--".$e_title_keywords;
$nav_x[e_name]=$nav_x[e_name]." > ".$product[e_title];
include template('e_showproduct');
}
else{
$show[c_description]=$product[c_description]?$product[c_description]:$met_c_keywords;
$show[c_keywords]=$product[c_keywords]?$product[c_keywords]:$met_c_keywords;
$c_title_keywords=$product[c_title]."--".$c_title_keywords;
$nav_x[c_name]=$nav_x[c_name]." > ".$product[c_title];
include template('showproduct');
}

footer();
?>