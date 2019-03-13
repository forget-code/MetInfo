<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
require_once '../login/login_check.php';
include_once("../../fckeditor/fckeditor.php");
$settings = parse_ini_file('../../job/config_'.$lang.'.inc.php');
@extract($settings);
if($action=='editor'){
if($type==''){
$allids = explode(',',$allid);
$k=count($allids)-1;
for($i=0;$i<$k;$i++){
$skin_m=$db->get_one("SELECT * FROM $met_job WHERE id='$allids[$i]'");
if(!$skin_m){okinfox('../job/index.php?lang='.$lang.'&class1'.$class1,$lang_dataerror);}
$nm = "no_order_".$allids[$i];
$no_order = $$nm;
$query="update $met_job set
           no_order='$no_order'
		   where id='$allids[$i]'";
   $db->query($query);
}
}else{
    //$skin_m=$db->get_one("SELECT * FROM $met_job WHERE id='$allids[$i]'");
    $query = "SELECT * FROM $met_job WHERE lang='$lang' order by no_order desc";
    $result = $db->query($query);
	while($list = $db->fetch_array($result)){	
        $job_list[]=$list;
    }
	$k=count($job_list);
	for($i=0;$i<$k;$i++){
	    if($job_list[$i][id]==$id)break;
	}
	$p = $type=='bottom'?$i+1:$i-1;
	if($i!=0){
	        $text = "no_order={$job_list[$p][no_order]}";
	        $text1 = "no_order={$job_list[$i][no_order]}";
	    if($job_list[$p][no_order] == $job_list[$i][no_order]){
	        $text = "addtime={$job_list[$p][addtime]}";
	        $text1 = "addtime={$job_list[$i][addtime]}";
		}
        $query="update $met_job set $text where id='$id'";
        $db->query($query);
        $query="update $met_job set $text1 where id='{$job_list[$p][id]}'";
        $db->query($query);
	}
}
    echo "index.php?class1=$class1&lang=$lang";
}else{
$query = "update $met_cv SET
					  readok             = '1'
					  where id='$id'";
$db->query($query);
$cv_list=$db->get_one("select * from $met_cv where id='$id'");
if(!$cv_list){
okinfox('../job/cv.php?lang='.$lang,$lang_dataerror);
}
$query = "SELECT * FROM $met_parameter where lang='$lang' and module=6  order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$value_list=$db->get_one("select * from $met_plist where paraid=$list[id] and listid=$id ");
if($list[type]==5){
	if($value_list[info]){  
	    $src = $value_list[info];
	    $value_list[info]="<a href='../$value_list[info]'>$value_list[info]</a>";
		if($met_cv_image == $value_list[paraid])$value_list[info]="<a href='../".$src."' class='showimga'>".$lang_preview."</a>";
	}
}

$list[content]=$value_list[info];
$cv_para[]=$list;
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('cv_editor');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>