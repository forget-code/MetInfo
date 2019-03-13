<?php
# 文件名称:export.php 2009-08-12 17:15:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.	
	ob_start();
	require_once '../include/common.inc.php';
	ob_clean();
	ob_start();
	
	require('php_xls.php');
	
	$settings = parse_ini_file('../../feedback/config.inc.php');
	@extract($settings);	
	$fdclass1= $db->get_one("SELECT * FROM $met_fdparameter WHERE c_name='$met_fd_class'");
	$fdclass2="para".$fdclass1[id];
	if($met_fd_export==-1)
	{
		$where=" ";
	}else
	{
		$where="and $fdclass2 like '$met_fd_export'";
	}
	$query = "SELECT * FROM $met_feedback where 1=1 ".$where;
	$result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$list['customerid']=$list['customerid']=='0'?$lang_fdeditorAccess0:$list['customerid'];
	$feedback_list[]=$list;
	}

	$query = "SELECT * FROM $met_fdparameter where use_ok='1' order by no_order";
	$result = $db->query($query);
	while($list= $db->fetch_array($result)){
	$feedback_para[]=$list;
	}
	/*设置xls
	*/
	

	$column=array("",$lang_fdeditorInterest);
	$param=array('fdtitle');
	foreach($feedback_para as $key=>$val){
		if($feedback_list[en]=="en")
		$column[]=$val['e_name'];//添加英文
		elseif($feedback_list[en]=="other")
		$column[]=$val['o_name'];
		else
		$column[]=$val['c_name'];
		$param[]="para".$val[id];
	}
	$column[]=$lang_fdeditorTime;
	$column[]=$lang_fdeditorFrom;
	$column[]=$lang_fdeditorID;
	$column[]=$lang_fdeditorRecord;
	$param[]='addtime';
	$param[]='fromurl';
	$param[]='customerid';
	$param[]='useinfo';
	$xls=new PHP_XLS();
	$xls->AddSheet($lang_fdeditorTitle);
	$xls->NewStyle('hd_t');

	$xls->StyleSetFont(0, 10, 0, 1, 0, 0);

	$xls->StyleSetAlignment(0, 0);
	$xls->StyleAddBorder("Top", '#000000', 2);
	$xls->StyleAddBorder("Right", '#000000', 1);
	
	$xls->CopyStyle('hd_t','hd_l');
	$xls->StyleAddBorder("Left", '#000000', 2);

	$xls->CopyStyle('hd_t','hd_r');
	$xls->StyleAddBorder("Right", '#000000', 2);
	
	$xls->SetRowHeight(1,30);

	for($i=1;$i<count($column);$i++)
	{
		$xls->SetColWidth($i,80);
	}
	
	$xls->SetActiveStyle('hd_l');
	$xls->SetActiveStyle('hd_t');
	$xls->SetActiveStyle('hd_r');
	for($i=1;$i<count($column);$i++)
	{
		$xls->Textc(1,$i,$column[$i]);
	}

	
	$xls->NewStyle('center');
	$xls->StyleSetAlignment(0, 0);
	$xls->StyleAddBorder("Top", '#000000', 1);
	$xls->StyleAddBorder("Right", '#000000', 1);
	
	$xls->CopyStyle('center','center_l');
	$xls->StyleAddBorder("Left", '#000000', 2);

	$xls->CopyStyle('center','center_r');
	$xls->StyleAddBorder("Right", '#000000', 2);

	
	/*获取表中的反馈信息
	 *导出xls
	*/	
		
	for ($i=0; $i<count($feedback_list); $i++) 
	{		
		
		for ($j=0; $j<count($column)-1; $j++) {
			$xls->SetActiveStyle('center');	
			
			if(($param[$j]=="para25" || $param[$j]=="para26" ||$param[$j]=="para27") && $feedback_list[$i][$param[$j]]!=NULL)
			{
				$x=explode('/', $feedback_list[$i]['fromurl']);
				unset($x[count($x)-1]);
				unset($x[count($x)-1]);
				$path = implode('/', $x).'/upload/file/'.$feedback_list[$i][$param[$j]];
				$xls->Textc($i+2,$j+1,$path);
				continue;
			}
			$xls->Textc($i+2,$j+1,$feedback_list[$i][$param[$j]]);
		}
	}	
	$xls->Output("$lang_fdeditorTitle.xls");
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.	
?>