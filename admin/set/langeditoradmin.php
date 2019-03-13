<?php
# 文件名称:langeditoradmin.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
$config_save="";
   for($i=0;$i<$langnum;$i++){
   $langtext[$i]=str_replace("\"","&quot;",$langtext[$i]);
   $langtext[$i]=stripslashes($langtext[$i]);
   $config_save=$config_save."#".$langarray[$i].$langtext[$i];
   }
$config_save=$linetop.$config_save;
switch($langeditor){
case "cn";
$file_nameupdate='../language/language_china.ini';
break;
case "en";
$file_nameupdate='../language/language_en.ini';
break;
case "other";
$file_nameupdate='../language/language_other.ini';
break;}
$fp = fopen($file_nameupdate,w);
    fputs($fp, $config_save);
    fclose($fp);
okinfo('lang.php',$lang_loginUserAdmin);
}
else{
switch($langeditor){
case "cn";
$file_nameupdate='../language/language_china.ini';
$met_lang=$met_c_lang;
break;
case "en";
$file_nameupdate='../language/language_en.ini';
$met_lang=$met_e_lang;
break;
case "other";
$file_nameupdate='../language/language_other.ini';
$met_lang=$met_o_lang;
break;
}
$fp = @fopen($file_nameupdate, "r") or die("Cannot open $file_nameupdate");
$i=0;
$j=0;
while ($conf_line = @fgets($fp, 1024)){  
if($i<4){
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
   $langtext[$k]=$langtext[$k].$line;
   }
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('langeditoradmin');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>