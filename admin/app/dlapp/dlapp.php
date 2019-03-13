<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once ROOTPATH.'include/export.func.php';
$met_file='/dl/app_inc.php';
$authinfo=$db->get_one("SELECT * FROM $met_otherinfo where id=1");
$post_data = array('met_code'=>$authinfo['authcode'],'met_key'=>$authinfo['authpass'],'checksum'=>'info');
$info=curl_post($post_data,30);
$post_data = array('checksum'=>'ver');
$sysver=curl_post($post_data,30);
$mytype[0]=$lang_usertype1;
$mytype[1]=$lang_usertype2;
$mytype[2]=$lang_usertype3;
$mytype[3]=$lang_usertype4;
if($info!='nohost'){
	$info=explode('|',$info);
	$info[0]=ltrim($info[0],'metinfo');
	$query="select * from $met_app where download=1";
	$apptemp=$db->get_all($query);
	foreach($apptemp as $keyapptemp=>$valapptemp){
		$app[$valapptemp['no']]=$valapptemp;
	}
	$query="select * from $met_app where download=0";
	$apptemp=$db->get_all($query);
	foreach($apptemp as $keyapptemp=>$valapptemp){
		$str_apps[$valapptemp['no']][0]=$valapptemp['name'];
		$str_apps[$valapptemp['no']][1]=$valapptemp['no'];
		$str_apps[$valapptemp['no']][2]=$valapptemp['ver'];
		$str_apps[$valapptemp['no']][3]=$valapptemp['img'];
		$str_apps[$valapptemp['no']][4]=$valapptemp['info'];
		$str_apps[$valapptemp['no']][5]=$valapptemp['file'];
		$str_apps[$valapptemp['no']][6]=$valapptemp['power'];
		$str_apps[$valapptemp['no']][7]=$valapptemp['sys'];
	}
	$error=1;
	if($met_apptime!=$info[1]){
		$checksum='metinfo';
		$result=dlfile('app/applist.inc.php','');
		if($error==1){
			$str_temp=explode('|',$result);
			foreach($str_temp as $strkey=>$strval){
				$str_app[]=explode(',',$strval);
			}
			foreach($str_app as $appkey=>$appval){
				if(is_array($str_apps[$appval[1]])){
					if($appval[7]==0){
						$query="delete from $met_app where no='$appval[1]' and download=0";
						$db->query($query);
						unset($str_apps[$appval[1]]);
					}
					else{
						$query="update $met_app set name='$appval[0]',ver='$appval[2]',img='$appval[3]',info='$appval[4]',file='$appval[5]',power='$appval[6]',sys='$appval[7]',site='$appval[8]',url='$appval[9]' where no='$appval[1]' and download=0";
						$db->query($query);
						$str_apps[$appval[1]]=$appval;
					}
				}
				else{
					$query="insert into $met_app set name='$appval[0]',no='$appval[1]',ver='$appval[2]',img='$appval[3]',info='$appval[4]',file='$appval[5]',power='$appval[6]',sys='$appval[7]',site='$appval[8]',url='$appval[9]',download='0'";
					$db->query($query);
					$str_apps[$appval[1]]=$appval;
				}
			}
			$checksum='img';
			foreach($str_apps as $appskey=>$appsval){
				dlfile($appsval[3],"../dlapp/img/$appsval[3]");
			}
		}
		$query="update $met_config set value='$info[1]' where name='met_apptime'";
		$db->query($query);
	}
	foreach ($str_apps as $keyapps=>$valapps){
		$rrr=metver($metcms_v,$valapps[7],$sysver);
		$valapps['xtype1']="<span class='color390'>{$mytype[$valapps[6]]}</span> {$lang_appdl1}";
		if($info[0]>=$valapps[6]){
			if(metver($metcms_v,$valapps[7],$sysver)>=2){
				if($app[$valapps[1]]['download']==0){
					$valapps['xtype']="<a href=\"http://$met_host/dl/app.php\" onclick=\"return olupdate('$valapps[1]','0','testc');\">".$mytype[$valapps[6]]."{$lang_appinstall}</a>";
					$valapps['ver_now']=0;
				}else{
					$valapps['ver_now']=$app[$valapps[1]]['ver'];
					if($valapps['ver_now']==$valapps[2]){
						$valapps['xtype']="{$lang_appdl2} <a href='http://$met_host/dl/app.php' onclick=\"return olupdate('$valapps[1]','0','testc');\">{$lang_appreinstall}</a>";
					}else{
						$valapps['xtype']="<a href='http://$met_host/dl/app.php' onclick=\"return olupdate('$valapps[1]','$valapps[ver_now]','testc');\">{$lang_appupgrade}</a>";
					}
				}
			}else{
				$valapps['xtype']="{$lang_appdl3}{$valapps[7]}{$lang_appdl4}";
			}
		}
		$newapplist[]=$valapps;
	}
	$str_apps=$newapplist;
}else{
	$error=$lang_hosterror;
}
$authinfo=$db->get_one("SELECT * FROM $met_otherinfo where id=1");
$listclass[2]='class="now"';
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('app/dlapp/dlapp');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>