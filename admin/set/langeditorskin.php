<?php
# 文件名称:langeditor.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.

require_once '../login/login_check.php';

switch($langeditor){
case "cn";
if(file_exists("../../templates/".$met_skin_user."/lang/language_cn.ini")){
 $file_nameupdate="../../templates/".$met_skin_user."/lang/language_cn.ini";
 }else{
 $file_nameupdate="../../templates/".$met_skin_user."/lang/language_china.ini";
 }
$met_lang=$met_c_lang;
break;
case "en";
$file_nameupdate="../../templates/".$met_skin_user."/lang/language_en.ini";
$met_lang=$met_e_lang;
break;
case "other";
$file_nameupdate="../../templates/".$met_skin_user."/lang/language_other.ini";
$met_lang=$met_o_lang;
break;
}
$fp = @fopen($file_nameupdate, "r") or die("Cannot open $file_nameupdate");
$i=0;
$j=0;

while ($conf_line = @fgets($fp, 1024)){  
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
   $langtext[0][]=array(name=>$name,value=>$value,valueinfo=>$valueinfo);
   }
}

if($action=="modify"){
$config_save="";
    for($m=0;$m<1;$m++){
   $config_save=$config_save."#".$langarray[$m]."\n";
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
   $reurl="langeditorskin.php?langeditor=".$langeditor."&langnowok=metinfo&langid=".$metinfolangid;
$config_save=$linetop."\n".$config_save;
$fp = fopen($file_nameupdate,w);
    fputs($fp, $config_save);
    fclose($fp);
okinfo($reurl,$lang_loginUserAdmin);
}else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('langeditorskin');
footer();
}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>