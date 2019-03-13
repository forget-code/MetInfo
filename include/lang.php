<?php
# 文件名称:common.inc.php 2009-10-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
if($lang=="en"){
$met_webname         =$met_e_webname;
$met_logo            =($met_e_logo=="")?$met_c_logo:$met_e_logo;
$met_title_keywords  =$e_title_keywords;
$met_keywords        =$met_e_keywords;
$met_description     =$met_e_description;
$met_seo             =$met_e_seo;
$met_alt             =$met_e_alt;
$met_atitle          =$met_e_atitle;
$met_linkname        =$met_e_linkname;
$met_footright       =$met_e_footright;
$met_footaddress     =$met_e_footaddress;
$met_foottel         =$met_e_foottel;
$met_footother       =$met_e_footother;
$met_foottext        =$met_e_foottext;
$met_footstat        =$met_e_footstat;
$searchurl           =$met_weburl."search/search.php?lang=en";
$file_basicname      =ROOTPATH."lang/language_en.ini";
$file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_en.ini';
}elseif($lang=="other"){
$met_webname         =$met_o_webname;
$met_logo            =($met_o_logo=="")?$met_c_logo:$met_o_logo;
$met_title_keywords  =$o_title_keywords;
$met_keywords        =$met_o_keywords;
$met_description     =$met_o_description;
$met_seo             =$met_o_seo;
$met_alt             =$met_o_alt;
$met_atitle          =$met_o_atitle;
$met_linkname        =$met_o_linkname;
$met_footright       =$met_o_footright;
$met_footaddress     =$met_o_footaddress;
$met_foottel         =$met_o_foottel;
$met_footother       =$met_o_footother;
$met_foottext        =$met_o_foottext;
$met_footstat        =$met_o_footstat;
$searchurl           =$met_weburl."search/search.php?lang=other";
$file_basicname      =ROOTPATH."lang/language_other.ini";
$file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_other.ini';
}else{
$met_webname         =$met_c_webname;
$met_logo            =$met_c_logo;
$met_title_keywords  =$c_title_keywords;
$met_keywords        =$met_c_keywords;
$met_description     =$met_c_description;
$met_seo             =$met_c_seo;
$met_alt             =$met_c_alt;
$met_atitle          =$met_c_atitle;
$met_linkname        =$met_c_linkname;
$met_footright       =$met_c_footright;
$met_footaddress     =$met_c_footaddress;
$met_foottel         =$met_c_foottel;
$met_footother       =$met_c_footother;
$met_foottext        =$met_c_foottext;
$met_footstat        =$met_c_footstat;
$searchurl           =$met_weburl."search/search.php";
$file_basicname      =ROOTPATH."lang/language_cn.ini";
 if(file_exists(ROOTPATH."templates/".$met_skin_user.'/lang/language_cn.ini')){
 $file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_cn.ini';
 }else{
 $file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_china.ini';
 }
}

if(file_exists($file_basicname)){
$fp = @fopen($file_basicname, "r") or die("Cannot open $file_basicname");
while ($conf_line = @fgets($fp, 1024)){    
if(substr($conf_line,0,1)=="#"){   
$line = ereg_replace("#.*$", "", $conf_line);
}else{
$line = $conf_line;
}
if (trim($line) == "") continue;
$linearray=explode ('=', $line);
$linenum=count($linearray);
if($linenum==2){
list($name, $value) = explode ('=', $line);
}else{

  for($i=0;$i<$linenum;$i++){

     $linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
   }
list($name, $value) = explode ('metinfo_=', $linetra);
}
$value=str_replace("\"","&quot;",$value);
list($value, $valueinfo)=explode ('/*', $value);
$name = 'lang_'.daddslashes(trim($name),1,'metinfo');
$$name= trim($value);
}
fclose($fp) or die("Can't close file $file_basicname");
}

if(!file_exists($file_name)){
  if(file_exists(ROOTPATH."templates/".$met_skin_user.'/lang/language_cn.ini')){
 $file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_cn.ini';
 }else{
 $file_name           =ROOTPATH."templates/".$met_skin_user.'/lang/language_china.ini';
 }}
if(file_exists($file_name)){
$fp = @fopen($file_name, "r") or die("Cannot open $file_name");
while ($conf_line = @fgets($fp, 1024)){    
if(substr($conf_line,0,1)=="#"){   
$line = ereg_replace("#.*$", "", $conf_line);
}else{
$line = $conf_line;
}
if (trim($line) == "") continue;
$linearray=explode ('=', $line);
$linenum=count($linearray);
if($linenum==2){
list($name, $value) = explode ('=', $line);
}else{

  for($i=0;$i<$linenum;$i++){

     $linetra=$i?$linetra."=".$linearray[$i]:$linearray[$i].'metinfo_';
   }
list($name, $value) = explode ('metinfo_=', $linetra);
}
$value=str_replace("\"","&quot;",$value);
list($value, $valueinfo)=explode ('/*', $value);
$name = 'lang_'.daddslashes(trim($name),1,'metinfo');
$$name= trim($value);
}
fclose($fp) or die("Can't close file $file_name");
}

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>
