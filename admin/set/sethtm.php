<?php
# 文件名称:sethtm.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
if($action=="modify"){
if(substr($met_weburl,-1,1)!="/")$met_weburl.="/";
if(!strstr($met_weburl,"http://"))$met_weburl="http://".$met_weburl;
require_once 'configsave.php';
if($met_webhtm==0){
if(file_exists("../../index.htm"))@unlink("../../index.htm");
if(file_exists("../../index_cn.htm"))@unlink("../../index_cn.htm");
if(file_exists("../../index_ch.htm"))@unlink("../../index_ch.htm");
if(file_exists("../../index".$met_htmpre_e.".htm"))@unlink("../../index".$met_htmpre_e.".htm");
if(file_exists("../../index".$met_htmpre_o.".htm"))@unlink("../../index".$met_htmpre_o.".htm");
if(file_exists("../../index.html"))@unlink("../../index.html");
if(file_exists("../../index_cn.html"))@unlink("../../index_cn.html");
if(file_exists("../../index_ch.html"))@unlink("../../index_ch.html");
if(file_exists("../../index".$met_htmpre_e.".html"))@unlink("../../index".$met_htmpre_e.".html");
if(file_exists("../../index".$met_htmpre_o.".html"))@unlink("../../index".$met_htmpre_o.".html");
echo "<script type='text/javascript'>";
echo "if(!confirm('".$lang_js21."')){";
echo "alert('".$lang_loginUserAdmin."'); location.href='sethtm.php';}";
echo "</script>";
 }
if($met_webhtm!=0){
$localurl="http://";
$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
$localurl_a=explode("/",$localurl);
$localurl_count=count($localurl_a);
$localurl_admin=$localurl_a[$localurl_count-3];
$localurl_admin=$localurl_admin."/set/sethtm";
$localurl_real=explode($localurl_admin,$localurl);
$localurl=$localurl_real[0];
if($localurl<>$met_weburl)okinfo('basic.php',$lang_sethtmurlerror);
indexhtm();
}
if($met_webhtm==0)okinfo('sethtm.php?action=deleteall',$lang_loginUserAdmin);
okinfo('sethtm.php',$lang_loginUserAdmin);

}elseif($action=="deleteall"){
 $query = "SELECT * FROM $met_column where bigclass=0 and if_in=0";
 $result = $db->query($query);
  while($list= $db->fetch_array($result)){
   $dir="../../".$list[foldername]; 
   $file=scandir($dir); 
   foreach ($file as $value){ 
   if($value != "." && $value !=".."){ if(substr($value,-4,4)=="html" || substr($value,-3,3)=="htm")unlink($dir."/".$value);  } 
   } 
  } 
  okinfo('sethtm.php',$lang_sethtmdetelall);
}
else{
$met_webhtm1[$met_webhtm]="checked='checked'";
if($met_htmtype=="htm")$met_htmtype1[0]="checked='checked'";
if($met_htmtype=="html")$met_htmtype1[1]="checked='checked'";
$met_htmpagename1[$met_htmpagename]="checked='checked'";
$met_htmlistname1[$met_htmlistname]="checked='checked'";
$met_sitemap_html1[$met_sitemap_html]="checked='checked'";
$met_sitemap_xml1[$met_sitemap_xml]="checked='checked'";
$met_htmway1[$met_htmway]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('sethtm');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>