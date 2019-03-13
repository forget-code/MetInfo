<?php
# 文件名称:check.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.

//更新下属二、三级栏目

$columntxt=array(
				2=>"$met_news",
				3=>"$met_product",
				4=>"$met_download",
				5=>"$met_img",
				6=>"$met_job",
				7=>"$met_message"
		);

$column_list = $db->get_one("SELECT * FROM $met_column WHERE id='$id'");

$currentAccess= $column_list['access'];

//增加权限
if(intval($currentAccess)<intval($access)) $cond="access < $access";
//降低权限
if(intval($currentAccess)>intval($access)) $cond="access <= $currentAccess";

if(intval($currentAccess)!=intval($access))
{

if($classtype==1)
{
	//二级栏目
	$table=$met_column;
	$query ="update $table SET ".
				" access='$access' ".
				" where bigclass=$id".
				" and $cond";
	$db->query($query);
	
	//三级栏目
	$query ="update $table SET ".
				" access='$access' ".
				" where $cond and bigclass in (select tmp2.id from (SELECT * FROM `met_column` as tmp) as tmp2 WHERE tmp2.bigclass=$id)";	

	$db->query($query);
	if (array_key_exists($module, $columntxt))
	{		
		$table=$columntxt[$module];
		$query ="update $table SET ".
					" access='$access' ".
					" where $cond";
		if(intval($module)<6) $query = $query." and class1=$id";
		$db->query($query);		
	}

}

if($classtype==2)
{
	//三级栏目
	$table=$met_column;
	$query ="update $table SET ".
				" access='$access' ".
				" where bigclass=$id".
				" and $cond";
	$db->query($query);
	if (array_key_exists($module, $columntxt))
	{		
		$table=$columntxt[$module];
		$query ="update $table SET ".
					" access='$access' ".
					" where $cond";
		if(intval($module)<6) $query = $query." and class2=$id";
		$db->query($query);		
	}
}

if($classtype==3)
{
	if (array_key_exists($module, $columntxt))
	{		
		$table=$columntxt[$module];
		$query ="update $table SET ".
					" access='$access' ".
					" where $cond";
		if(intval($module)<6) $query = $query." and class3=$id";
		$db->query($query);		
	}
}

}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>