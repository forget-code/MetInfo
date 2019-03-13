<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$backurl="../content/download/index.php?anyid={$anyid}&lang=$lang&class1=$class1&class2=$class2&class3=$class3";
if($action=='copy'){
	$query= "select * from $met_column where id='$copyclass1'";
	$result1=$db->get_one($query);
	if(!$result1){
		metsave('-1',$lang_dataerror,$depth);
		exit();
	}
	$allidlist=explode(',',$allid);
	$k=count($allidlist)-1;
	for($i=0;$i<$k; $i++){
		$query="select * from {$met_download} where id='{$allidlist[$i]}'";
		$copy=$db->get_one($query);
		$copy[content]=str_replace('\'','\'\'',$copy[content]);
		$query = "insert into {$met_download} set title='$copy[title]',ctitle='$copy[ctitle]',keywords='$copy[keywords]',description='$copy[description]',content='$copy[content]',class1='{$copyclass1}',class2='{$copyclass2}',class3='{$copyclass3}',no_order='$copy[no_order]',new_ok='$copy[new_ok]',wap_ok='$copy[wap_ok]',downloadurl='$copy[downloadurl]',filesize='$copy[filesize]',com_ok='$copy[com_ok]',hits='$copy[hits]',updatetime='$copy[updatetime]',addtime='$copy[addtime]',issue='$copy[issue]',access='$copy[access]',top_ok='$copy[top_ok]',downloadaccess='$copy[downloadaccess]',lang='{$copylang}',recycle='$copy[recycle]'";
		$db->query($query);
	}
	metsave($backurl,'',$depth);
}elseif($action=="moveto"){
	$allidlist=explode(',',$allid);
	$k=count($allidlist)-1;
	$query= "select * from $met_column where id='$moveclass1'";
	$result1=$db->get_one($query);
	if(!$result1){
		metsave('-1',$lang_dataerror,$depth);
		exit();
	}
	for($i=0;$i<$k; $i++){
		$filname= '';
		if($movelang!=$lang)$filname = "filename = '',";
		$query = "update {$met_download} SET";
		$query = $query."
						  class1             = '$moveclass1',
						  class2             = '$moveclass2',
						  class3             = '$moveclass3',
						  access             = '$access',
						  {$filname}
						  lang               = '$movelang'";
		$query = $query." where id='$allidlist[$i]'";
		$db->query($query);
	}
	metsave($backurl,'',$depth);
}else{
	$admin_list = $db->get_one("SELECT * FROM $met_download WHERE id='$id'");
	if(!$admin_list)metsave('-1',$lang_loginNoid,$depth);
	$query = "update $met_download SET ";
	if(isset($new_ok)){
		$new_ok=$new_ok==1?0:1;
		$query = $query."new_ok             = '$new_ok',";
	}
	if(isset($com_ok)){
		$com_ok=$com_ok==1?0:1;
		$query = $query."com_ok             = '$com_ok',";
	}
	if(isset($top_ok)){
		$top_ok=$top_ok==1?0:1;
		$query = $query."top_ok             = '$top_ok',";
	}
	if(isset($wap_ok)){
		$wap_ok=$wap_ok==1?0:1;
		$query = $query."wap_ok             = '$wap_ok',";
	}
	$query = $query."id='$id' where id='$id'";
	$db->query($query);
	if($top_ok==1)$page=0;
	metsave("../content/download/index.php?anyid={$anyid}&lang=$lang&class1=$class1&class2=$class2&class3=$class3".'&modify='.$id.'&page='.$page,'',$depth);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
