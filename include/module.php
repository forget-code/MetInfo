<?php
require_once 'common.inc.php';
$modulefname[1] = array(0=>'show.php',1=>'show.php',2=>$met_column);
$modulefname[2] = array(0=>'news.php',1=>'shownews.php',2=>$met_news);
$modulefname[3] = array(0=>'product.php',1=>'showproduct.php',2=>$met_product);
$modulefname[4] = array(0=>'download.php',1=>'showdownload.php',2=>$met_download);
$modulefname[5] = array(0=>'img.php',1=>'showimg.php',2=>$met_img);
$modulefname[6] = array(0=>'job.php',1=>'showjob.php',2=>$met_job);
$modulefname[8] = array(0=>'feedback.php',1=>'feedback.php',2=>$met_column);
if($metid && $met_pseudo){
	$dname = is_numeric($metid)?'id':'filename';
	if($list){
		$anyone = $db->get_one("SELECT * FROM $met_column WHERE $dname='$metid' and lang ='$lang'");
		if($anyone['releclass']){
			$class1=$metid;
		}
		else{
			if($anyone['classtype']==1)$class1= $anyone['id'];
			if($anyone['classtype']==2)$class2= $anyone['id'];
			if($anyone['classtype']==3)$class3= $anyone['id'];
		
		}
		$mdle = $anyone['module'];
		$mdtp = '0';
		$lang = $anyone['lang'];
	}else{
		$anybody = $db->get_one("SELECT * FROM $met_column WHERE foldername='$filpy' and lang='$lang'");
		$danmy = $modulefname[$anybody['module']][2];
		if($anybody['module']==8)$metid=$anybody['id'];
		$anyone = $db->get_one("SELECT * FROM $danmy WHERE $dname='$metid' and lang ='$lang'");
		$mdtp = '1';
		$id = $anybody['module']==8?$anybody['id']:$anyone['id'];
		$mdle = $anybody['module'];
	}
}else{
	$modulelang=$lang?$lang:$met_index_type;
	$anyone = $db->get_one("SELECT * FROM $met_column WHERE foldername='$filpy' and bigclass='0' and lang='$modulelang'");
	$class1 = $anyone['id'];
	if(!$class1){
	$anyone = $db->get_one("SELECT * FROM $met_column WHERE foldername='$filpy' and releclass!='0' and lang='$modulelang'");
	$class1 = $anyone['id'];
	}
	if(!$anyone['isshow'] && $anyone['module'] == 1){
		$anytwo = $db->get_one("SELECT * FROM $met_column WHERE foldername='$filpy' and bigclass='$class1' and lang='$modulelang' order by no_order");
		$id = $anytwo['id'];
		$lang = $anytwo['lang'];
		$class1 = 0;
		if(!$anytwo['isshow']){
			$anysry = $db->get_one("SELECT * FROM $met_column WHERE foldername='$filpy' and bigclass='$id' and lang='$modulelang' order by no_order");
			$id = $anysry['id'];
		}
	}
	$mdle = $anyone['module'];
	$mdtp = '0';
}
$module = $modulefname[$mdle][$mdtp];
if($mdle==8){
if(!$id)$id=$class1;
$module = '../feedback/index.php';
}
?>