<?php
require_once '../include/common.inc.php';
$rooturl="..";
$css_url="../templates/".$met_skin_user."/css/";
$img_url="../templates/".$met_skin_user."/images";
$navurl=($rooturl=="..")?$rooturl."/":"";

    $job=$db->get_one("select * from $met_job where id='$id'");
	if(!$job){
	okinfo('../',$lang[noid]);
	};
	if($en=="en"){
	$job[useful_life]=($job[useful_life]=="0")?"No Limit":$job[useful_life]." Day";
	}else{
	$job[useful_life]=($job[useful_life]=="0")?"不限":$job[useful_life]." 天";
	}
	$job[c_content]=contentshow($job[c_content]);
	$job[e_content]=contentshow($job[e_content]);

    $class1_info=$db->get_one("select * from $met_column where module='6'");
	if(!class1_info){
	okinfo('../',$lang[noid]);
	};    
	
	
require_once '../include/head.php';

$nav_x[c_name]="<a href=job.php>".$class1_info[c_name]."</a>";
$nav_x[e_name]="<a href=job.php?en=en>".$class1_info[e_name]."</a>";



if($en=="en"){
$show[e_description]=$job[e_description]?$job[e_description]:$met_e_keywords;
$show[e_keywords]=$job[e_keywords]?$job[e_keywords]:$met_e_keywords;
$e_title_keywords=$job[e_position]."--".$e_title_keywords;
$nav_x[e_name]=$nav_x[e_name]." > ".$job[e_position];
include template('e_showjob');
}
else{
$show[c_description]=$job[c_description]?$job[c_description]:$met_c_keywords;
$show[c_keywords]=$job[c_keywords]?$job[c_keywords]:$met_c_keywords;
$c_title_keywords=$job[c_position]."--".$c_title_keywords;
$nav_x[c_name]=$nav_x[c_name]." > ".$job[c_position];
include template('showjob');
}

footer();
?>