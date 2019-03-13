<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$news_list=$db->get_one("select * from $met_news where id='$id'");
if(!$news_list){
okinfo('index.php',$lang[noid]);
}
$class1=$news_list[class1];
if($news_list[img_ok]==1){
$img_ok="checked='checked'";
$img_ok_display="";
}
else{
$img_ok="";
$img_ok_display="none";
}
if($news_list[com_ok]==1)$com_ok="checked='checked'";
$class2[$news_list[class2]]="selected='selected'";
if($news_list[class3]!=0){
$query ="select * from $met_column where bigclass=$news_list[class2] order by no_order";
$result = $db->query($query);
while($class3_r= $db->fetch_array($result)){
$class3_list[]=$class3_r;
}
}
$class3[$news_list[class3]]="selected='selected'";

    $class2_ok=FALSE;
    $query = "SELECT * FROM $met_column where module=2 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 if($list[id]==$class1){$class1_name=$list[c_name];}
     if($list[bigclass]==$class1){
	 $column_list2[]=$list;
	 $class2_ok=TRUE;
	 }
	 if($list[bigclass]!=0)$column_list[]=$list;
    }
	$i=0;
echo "<script language = 'JavaScript'>\n";
echo "var onecount;\n";
echo "subcat = new Array();\n";
foreach($column_list as $key=>$vallist){
echo "subcat[".$i."] = new Array('".$vallist[c_name]."','".$vallist[bigclass]."','".$vallist[id]."');\n";
	 $i=$i+1;
}
echo "onecount=".$i.";\n";
echo "</script>";

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('article_editor');
footer();
?>