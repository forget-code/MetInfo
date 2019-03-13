<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

    $news=$db->get_one("select * from $met_news where id='$id'");
	if(!$news){
	okinfo('../',$lang[noid]);
	};
	$news[c_content]=contentshow($news[c_content]);
	$news[e_content]=contentshow($news[e_content]);
    $class1=$news[class1];
	$class2=$news[class2];
    $class3=$news[class3];

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
    $query = "SELECT * FROM $met_news $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$url1_c="shownews.php?id=".$list[id];
	$url2_c="shownews".$list[id].".htm";
	$url1_e="shownews.php?en=en&id=".$list[id];
	$url2_e="shownews".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($list[new_ok] == 1)$news_list_new[]=$list;
	if($list[com_ok] == 1)$news_list_com[]=$list;
    $news_list[]=$list;
    }
	
require_once '../include/head.php';

$nav_x[c_name]="<a href=news.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=news.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>";

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$nav_x[c_name]="<a href=news.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=news.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>";
$nav_x[e_name]="<a href=news.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=news.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>";
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$nav_x[c_name]="<a href=news.php?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=news.php?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>"." > "."<a href=news.php?class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[c_name]."</a>";
$nav_x[e_name]="<a href=news.php?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=news.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>"." > "."<a href=news.php?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[e_name]."</a>";
}
}
}


if($en=="en"){
$show[e_description]=$news[e_description]?$news[e_description]:$met_e_keywords;
$show[e_keywords]=$news[e_keywords]?$news[e_keywords]:$met_e_keywords;
$e_title_keywords=$news[e_title]."--".$e_title_keywords;
$nav_x[e_name]=$nav_x[e_name]." > ".$news[e_title];
include template('e_shownews');
}
else{
$show[c_description]=$news[c_description]?$news[c_description]:$met_c_keywords;
$show[c_keywords]=$news[c_keywords]?$news[c_keywords]:$met_c_keywords;
$c_title_keywords=$news[c_title]."--".$c_title_keywords;
$nav_x[c_name]=$nav_x[c_name]." > ".$news[c_title];
include template('shownews');
}

footer();
?>