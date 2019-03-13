<?php
require_once 'include/common.inc.php';
    $query = "SELECT * FROM $met_column where if_in=0 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 if($list[bigclass]==0){
	 switch($list[module]){
	 case 1;
	 $list1[]=$list;
	 break;
	 case 2;
	 $list2[]=$list;
	 break;
	 case 3;
	 $list3[]=$list;
	 break;
	 case 4;
	 $list4[]=$list;
	 break;
	 case 5;
	 $list5[]=$list;
	 break;
	 case 6;
	 $list6[]=$list;
	 break;
	 case 7;
	 $list7[]=$list;
	 break;
	 } 
	 }
	 else{
	 switch($list[module]){
	 case 1;
	 $list11[]=$list;
	 $list12[]=$list;
	 break;
	 case 2;
	 $list22[]=$list;
	 break;
	 case 3;
	 $list33[]=$list;
	 break;
	 case 4;
	 $list44[]=$list;
	 break;
	 case 5;
	 $list55[]=$list;
	 break;
	 case 6;
	 $list66[]=$list;
	 break;
	 case 7;
	 $list77[]=$list;
	 break;
	 }
    }}
if(	$metinfo_admin_pop!="metinfo"){
$admin_pop=explode('-',$metinfo_admin_pop);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1=$admin_poptext.$val=$val;
$$admin_poptext1="metinfo";
}
}
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name'");
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include template('lefttree');
footer();
?>