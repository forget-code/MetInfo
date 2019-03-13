<?php
function cache_all($lang){
	//cache_head($lang);
	cache_otherinfo($lang);
	cache_online($lang);
	//cache_listpage($lang);
	return true;
}
function cache_listpage($lang){
    global $db,$met_member_use,$metinfo_member_type,$dataoptimize,$met_news,$met_product,$met_download,$met_plist,$m_now_date,$met_memberforce,$img_url,$met_newsdays,$met_img,$met_pseudo,$met_webhtm,$met_htmtype;
	$langmark='lang='.$lang;
	$index='index';
	$pagemark = 10001;
	//require_once 'page.php';
	if($classlistall)cache_page('classlistall_'.$lang.'.php',$classlistall);	
	if($classlistcom)cache_page('classlistcom_'.$lang.'.php',$classlistcom);	
	if($classlistnew)cache_page('classlistnew_'.$lang.'.php',$classlistnew);		
	if($listcom)cache_page('listcom_'.$lang.'.php',$listcom);	
	if($listnew)cache_page('listnew_'.$lang.'.php',$listnew);	
	if($listall)cache_page('listall_'.$lang.'.php',$listall);	
	if($hitslistnew)cache_page('hitslistnew_'.$lang.'.php',$hitslistnew);	
	if($hitslistcom)cache_page('hitslistcom_'.$lang.'.php',$hitslistcom);	
	if($hitslistall)cache_page('hitslistall_'.$lang.'.php',$hitslistall);
}
function cache_online($lang){
    global $db,$met_online;
	$query="select * from $met_online where lang='$lang' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		$data[]=$list;
	}
	cache_page('online_'.$lang.'.php',$data);
}
function cache_otherinfo($lang){
	global $db,$met_otherinfo;
    $data = $db->get_one("SELECT * FROM $met_otherinfo where lang='$lang'");
	cache_page('otherinfo_'.$lang.'.php',$data);
}
function cache_head($lang){
    global $db,$met_member_use,$met_column,$metinfo_member_type;
	$query="select * from $met_column where lang='$lang' order by no_order";
	if($met_member_use==2)$query="select * from $met_column where lang='$lang' and access<=$metinfo_member_type order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	    $data[]=$list;
	}
	cache_page('column_'.$lang.'.php',$data);
	return $metinfo_member_type;
}
function cache_page($file,$string){  
	if(is_array($string)) $string = "<?php\n return ".var_export($string, true)."; ?>";
	$file = ROOTPATH.'cache/'.$file;
	$strlen = file_put_contents($file, $string);
	return $strlen;
}
function met_cache($file){
    $file = ROOTPATH.'cache/'.$file;
	if(!file_exists($file))return array();
	return include $file;
}
?>