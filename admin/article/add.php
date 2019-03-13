<?php
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
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
include template('article_add');
footer();
?>