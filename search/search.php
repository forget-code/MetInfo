<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";
if($c_searchword==""&&$e_searchword==""){
$search_list[0][c_title]="<font color=red>请输入搜索关键词！</font>";
$search_list[0][e_title]="Please input keywords!";
$search_list[0][updatetime]=$m_now_date;
$search_list[0][c_url]=$met_weburl;
$search_list[0][e_url]=$met_weburl;  
require_once '../include/head.php';
}
else
{
if($class1==""){
    if($c_searchword)$serch_sql=" where c_title like '%$c_searchword%' or c_content like '%$c_searchword%' ";
	if($e_searchword)$serch_sql=" where e_title like '%$e_searchword%' or e_content like '%$e_searchword%' ";
	$order_sql=list_order($class1_info[list_order]); 
	if($c_searchword!="" ){
     if($searchtype==1){ $serch_sql= " where c_title like '%$c_searchword%' "; }
	 if($searchtype==2){ $serch_sql= " where c_content like '%$c_searchword%' "; }
	}
	if($e_searchword!="" ){
     if($searchtype==1){ $serch_sql= " where e_title like '%$e_searchword%' "; }
	 if($searchtype==2){ $serch_sql= " where e_content like '%$e_searchword%' "; }
	}
	
	if($c_searchword)$serch_sql1=" where c_name like '%$c_searchword%' or c_content like '%$c_searchword%' ";
	if($e_searchword)$serch_sql1=" where e_name like '%$e_searchword%' or e_content like '%$e_searchword%' ";
	if($c_searchword!="" ){
     if($searchtype==1){ $serch_sql1= " where c_name like '%$c_searchword%' "; }
	 if($searchtype==2){ $serch_sql1= " where c_content like '%$c_searchword%' "; }
	}
	if($e_searchword!="" ){
     if($searchtype==1){ $serch_sql1= " where e_name like '%$e_searchword%' "; }
	 if($searchtype==2){ $serch_sql1= " where e_content like '%$e_searchword%' "; }
	}
	$query1 = "SELECT * FROM $met_column $serch_sql1 order by id";
	
    $query = "SELECT * FROM $met_news $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$class1_info=$db->get_one("select * from $met_column where id='$list[class1]'");
	$url1_c="../".$class1_info[foldername]."/shownews.php?id=".$list[id];
	$url2_c="../".$class1_info[foldername]."/shownews".$list[id].".htm";
	$url1_e="../".$class1_info[foldername]."/shownews.php?en=en&id=".$list[id];
	$url2_e="../".$class1_info[foldername]."/shownews".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	  $e_searchword="";
	}
    $search_list[]=$list;
    }
	
	$query = "SELECT * FROM $met_product $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$class1_info=$db->get_one("select * from $met_column where id='$list[class1]'");
	$url1_c="../".$class1_info[foldername]."/showproduct.php?id=".$list[id];
	$url2_c="../".$class1_info[foldername]."/showproduct".$list[id].".htm";
	$url1_e="../".$class1_info[foldername]."/showproduct.php?en=en&id=".$list[id];
	$url2_e="../".$class1_info[foldername]."/showproduct".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	 $e_searchword="";
	}
    $search_list[]=$list;
    }
	
	$query = "SELECT * FROM $met_download $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$class1_info=$db->get_one("select * from $met_column where id='$list[class1]'");
	$url1_c="../".$class1_info[foldername]."/showdownload.php?id=".$list[id];
	$url2_c="../".$class1_info[foldername]."/showdownload".$list[id].".htm";
	$url1_e="../".$class1_info[foldername]."/showdownload.php?en=en&id=".$list[id];
	$url2_e="../".$class1_info[foldername]."/showdownload".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	 $e_searchword="";
	}
    $search_list[]=$list;
    }
	
	$query = "SELECT * FROM $met_img $serch_sql $order_sql";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$class1_info=$db->get_one("select * from $met_column where id='$list[class1]'");
	$url1_c="../".$class1_info[foldername]."/showimg.php?id=".$list[id];
	$url2_c="../".$class1_info[foldername]."/showimg".$list[id].".htm";
	$url1_e="../".$class1_info[foldername]."/showimg.php?en=en&id=".$list[id];
	$url2_e="../".$class1_info[foldername]."/showimg".$list[id]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	 $e_searchword="";
	}
    $search_list[]=$list;
    }

    $result = $db->query($query1);
	while($list= $db->fetch_array($result)){
	if($list[module]==1){
	$url1_c="../".$list[foldername]."/show.php?id=".$list[id];
	$url2_c="../".$list[foldername]."/".$list[filename].".htm";
	$url1_e="../".$list[foldername]."/show.php?en=en&id=".$list[id];
	$url2_e="../".$list[foldername]."/".$list[filename]."_en.htm";	
	$list[c_url]=$met_webhtm?$url2_c:$url1_c;
	$list[e_url]=$met_webhtm?$url2_e:$url1_e;
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_name],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_name],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_name],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_name],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	 $e_searchword="";
	}
	$list[updatetime]=$m_now_date;
    $search_list[]=$list;
    }}
	$total_count = count($search_list);
    require_once '../include/pager.class.php';
    $page = (int)$page;
	if($page_input){$page=$page_input;}
    $list_num=$met_search_list;
    $rowset = new Pager($total_count,$list_num,$page);
    $from_record = $rowset->_offset();
	$searchok=$search_list;
	$search_list=array_slice($search_list,$from_record,$list_num);
    $c_page_list = $rowset->link("search.php?class1=$class1&class2=$class2&class3=$class3&c_searchword=$c_searchword&searchtype=$searchtype&page=");		
    $e_page_list = $rowset->link("search.php?en=en&class1=$class1&class2=$class2&class3=$class3&e_searchword=$e_searchword&searchtype=$searchtype&page=");	
require_once '../include/head.php';
}else{
    $class1_info=$db->get_one("select * from $met_column where id='$class1'");
	if(!$class1_info){
	okinfo('../',$lang[noid]);
	};
switch($class1_info[module]){
    case 2;
	$table_name=$met_news;
	$preurl="../".$class1_info[foldername]."/shownews";
    $pagename="../".$class1_info[foldername]."/news.php";
	break;
	case 3;
	$table_name=$met_product;
	$preurl="../".$class1_info[foldername]."/showproduct";
	$pagename="../".$class1_info[foldername]."/product.php";
	break;
	case 4;
	$table_name=$met_download;
	$preurl="../".$class1_info[foldername]."/showdownload";
	$pagename="../".$class1_info[foldername]."/download.php";
	break;
	case 5;
	$table_name=$met_img;
	$preurl="../".$class1_info[foldername]."/showimg";
	$pagename="../".$class1_info[foldername]."/img.php";
	break;
}
    $serch_sql=" where class1=$class1 ";
	if($class2)$serch_sql .= " and class2=$class2";
	if($class3)$serch_sql .= " and class3=$class3"; 
	$order_sql=list_order($class1_info[list_order]);  
	switch($searchtype) {
	case 0;
	if($c_searchword)$serch_sql .=" and (c_title like '%$c_searchword%' or c_content like '%$c_searchword%') ";
	if($e_searchword)$serch_sql .=" and (e_title like '%$e_searchword%' or e_content like '%$e_searchword%') ";
	break;
	case 1;
	if($c_searchword)$serch_sql .=" and c_title like '%$c_searchword%' ";
	if($e_searchword)$serch_sql .=" and e_title like '%$e_searchword%' ";
	break;
	case 2;
	if($c_searchword)$serch_sql .=" and c_content like '%$c_searchword%' ";
	if($e_searchword)$serch_sql .=" and e_content like '%$e_searchword%' ";
	break;
	}
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
	if($c_searchword){
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	}else{
	 $c_searchword="MetInfo";
	 $list[c_title]=get_keyword_str($list[c_title],$c_searchword,50);
	 $list[c_content]=get_keyword_str($list[c_content],$c_searchword,68);
	 $c_searchword="";
	}
	if($e_searchword){
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	}else{
	 $e_searchword="MetInfo";
	 $list[e_title]=get_keyword_str($list[e_title],$e_searchword,50);
	 $list[e_content]=get_keyword_str($list[e_content],$e_searchword,68);
	 $e_searchword="";
	}
    $search_list[]=$list;
    }

$c_page_list = $rowset->link("search.php?class1=$class1&class2=$class2&class3=$class3&c_searchword=$c_searchword&searchtype=$searchtype&page=");		
$e_page_list = $rowset->link("search.php?en=en&class1=$class1&class2=$class2&class3=$class3&e_searchword=$e_searchword&searchtype=$searchtype&page=");	
require_once '../include/head.php';

$class_info[e_name]=$class1_info[e_name];
$class_info[c_name]=$class1_info[c_name];
$nav_x[c_name]="<a href=".$pagename."?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=".$pagename."?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>";

if($class2!=""){
foreach($nav_list2[$class1] as $key=>$val){
if($class2==$val[id]){
$class2_info=$val;
$class_info[e_name]=$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]="<a href=".$pagename."?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=".$pagename."?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>";
$nav_x[e_name]="<a href=".$pagename."?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=".$pagename."?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>";
}
}
}
if($class3!=""){
foreach($nav_list3[$class2] as $key=>$val){
if($class3==$val[id]){
$class3_info=$val;
$class_info[e_name]=$class3_info[e_name]."--".$class2_info[e_name]."--".$class1_info[e_name];
$class_info[c_name]=$class3_info[c_name]."--".$class2_info[c_name]."--".$class1_info[c_name];
$nav_x[c_name]="<a href=".$pagename."?class1=".$class1_info[id]." >".$class1_info[c_name]."</a>"." > "."<a href=".$pagename."?class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[c_name]."</a>"." > "."<a href=".$pagename."?class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[c_name]."</a>";
$nav_x[e_name]="<a href=".$pagename."?en=en&class1=".$class1_info[id]." >".$class1_info[e_name]."</a>"." > "."<a href=".$pagename."?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]." >".$class2_info[e_name]."</a>"." > "."<a href=".$pagename."?en=en&class1=".$class1_info[id]."&class2=".$class2_info[id]."&class3=".$class3_info[id]." >".$class3_info[e_name]."</a>";
}
}
}
}
}
if($nav_x[c_name]==""){
$nav_x[c_name]="全站搜索:关键字--".$c_searchword;
$class_info[c_name]="全站搜索";
}else{
$nav_x[c_name]=$nav_x[c_name].":搜索关键字--".$c_searchword;
}
if($nav_x[e_name]==""){
$nav_x[e_name]="All Information:keywords--".$e_searchword;
$class_info[e_name]="All Information";
}else{
$nav_x[e_name]=$nav_x[e_name].":keywords--".$e_searchword;
}
if(!count($search_list)){
$search_list[0][c_title]="没有含有[<font color=red>$c_searchword</font>]的信息内容";
$search_list[0][e_title]="No information that contains [<font color=red>$e_searchword</font>]";
$search_list[0][updatetime]=$m_now_date;
$search_list[0][c_url]=$met_weburl;
$search_list[0][e_url]=$met_weburl;
}
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