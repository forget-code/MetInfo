<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$backurl="../online/index.php?lang=".$lang;
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_online where id='$val'";
$db->query($query);
}
require_once '../../include/cache.func.php';
cache_online($lang);
okinfo($backurl);
}
elseif($action=="editor"){
	$allidlist=explode(',',$allid);
	$adnum = count($allidlist)-1;
	for($i=0;$i<$adnum;$i++){
		$name = 'name_'.$allidlist[$i];
		$name = $$name;
		$no_order = 'no_order_'.$allidlist[$i];
		$no_order = $$no_order;
		$qq = 'qq_'.$allidlist[$i];
		$qq = $$qq;
		$msn = 'msn_'.$allidlist[$i];
		$msn = $$msn;		
		$taobao = 'taobao_'.$allidlist[$i];
		$taobao = $$taobao;		
		$alibaba = 'alibaba_'.$allidlist[$i];
		$alibaba = $$alibaba;		
		$skype = 'skype_'.$allidlist[$i];
		$skype = $$skype;
		$tpif = is_numeric($allidlist[$i])?1:0;
		$sqly = $tpif?"id='$allidlist[$i]'":'';
		if($sqly!='')$skin_m=$db->get_one("SELECT * FROM $met_online WHERE $sqly");
		if($tpif){
			if(!$skin_m){okinfox($backurl,$lang_dataerror);}
		}
		$uptp = $tpif?"update":"insert into";
		$upbp = $tpif?"where id='$allidlist[$i]'":",lang='$lang'";
		$query="$uptp $met_online set
                      name           = '$name',
     				  no_order       = '$no_order',
					  qq             = '$qq',
					  msn            = '$msn',
					  taobao         = '$taobao',
					  alibaba        = '$alibaba',
					  skype          = '$skype'
			$upbp";
		$db->query($query);
	}
require_once '../../include/cache.func.php';
cache_online($lang);	
okinfo($backurl);
}else{
$query = "delete from $met_online where id='$id'";
$db->query($query);
require_once '../../include/cache.func.php';
cache_online($lang);
okinfo($backurl);
}
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
?>
