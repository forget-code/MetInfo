<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$cs=isset($cs)?$cs:0;
$listclass[$cs]='class="now"';
if(!$langid)$langid=0;
$file_nameupdate=$depth."../../lang/language_".$langeditor.".ini";
$file_nameupdate1=$file_nameupdate;
if(!file_exists($file_nameupdate)){
	foreach($met_langok as $key=>$val){
		$file_nameupdate1=$depth."../../lang/language_".$val[mark].".ini";
		break;
	}
}
$fp = @fopen($file_nameupdate1, "r") or die("Cannot open $file_nameupdate");
$i=0;
$j=0;
while($conf_line = @fgets($fp, 1024)){  
	if($i<4 && substr($conf_line,0,1)=="#"){
		$i++;  
		$linetop=$linetop.$conf_line;
		$lineno = ereg_replace("#.*$", "", $conf_line);
		$line="";
	}else{
		$line=$conf_line;
	}
	if (trim($line) == "") continue;
	if(substr($line,0,1)=="#"){
		$langarray[$j]=substr($line,1);
		$j++;
	}else{
		$k=$j-1;
		$linearray=explode ('=', $line);
		$linenum=count($linearray);
		if($linenum==2){
			list($name, $value) = explode ('=', $line);
		}else{
			for($n=0;$n<$linenum;$n++){
				$linetra=$n?$linetra."=".$linearray[$n]:$linearray[$n].'metinfo_';
			}
			list($name, $value) = explode ('metinfo_=', $linetra);
		}
		$value=str_replace("\"","&quot;",$value);
		list($value, $valueinfo)=explode ('/*', $value);
		list($valueinfo)=explode ('*/', $valueinfo);
		$name = daddslashes(trim($name),1,'metinfo');
		$langtext[$k][]=array(name=>$name,value=>$value,valueinfo=>$valueinfo);
	}
}
if($action=="modify"){
	$config_save="";
	for($m=0;$m<$j;$m++){
		$config_save=$config_save."#".$langarray[$m];
		$config_list='';
		foreach($langtext[$m] as $key=>$val){
			$namelist=$val[name]."_metinfo";
			$namemetinfo=$$namelist;
			if($namemetinfo!="")$namemetinfo=stripslashes($namemetinfo);
			$val[value]=($namemetinfo=="")?$val[value]:$namemetinfo;
			$nameinfolist=$val[name]."_info_metinfo";
			$nameinfometinfo=$$nameinfolist;
			if($nameinfometinfo!="")$nameinfometinfo=stripslashes($nameinfometinfo);
			$val[valueinfo]=($nameinfometinfo=="")?$val[valueinfo]:$nameinfometinfo;
			$val[valueinfo]=($val[valueinfo]=="")?"":"/*".$val[valueinfo]."*/"."\n";
			if($val[valueinfo]=="" and $nameinfometinfo=="" and $namemetinfo!="")$val[valueinfo]="\n";
			$config_list.=$val[name]."=".$val[value].$val[valueinfo];
		}
		$config_save=$config_save.$config_list."\n";
	}
	$config_save=$linetop."\n".$config_save;
	//if(!is_writable($file_nameupdate))@chmod($file_nameupdate,0777);
	$fp = fopen($file_nameupdate,w);
    fputs($fp, $config_save);
    fclose($fp);
	metsave('../system/lang/langeditor.php?anyid='.$anyid.'&langeditor='.$langeditor."&langid=".$metinfolangid.'&lang='.$lang.'&cs='.$cs,'',$depth);
}else{
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('system/lang/langeditor');footer();
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>