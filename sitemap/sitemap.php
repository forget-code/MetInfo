<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';
$sitemap_column=$db->get_one("select * from $met_column where module='12' and lang='$lang'");
$metaccess=$sitemap_column[access];
$class1=$sitemap_column[id];
require_once '../include/head.php';
$class1_info=$class_list[$class1][releclass]?$class_list[$class_list[$class1][releclass]]:$class_list[$class1];
$class2_info=$class_list[$class1][releclass]?$class_list[$class1]:$class_list[$class2];
    $navtitle=$sitemap_column[name];
foreach($listall[news] as $key=>$val){
$sitemaplist[]=$val;
}
foreach($listall[product] as $key=>$val){
$sitemaplist[]=$val;
}
foreach($listall[download] as $key=>$val){
$sitemaplist[]=$val;
}
foreach($listall[img] as $key=>$val){
$sitemaplist[]=$val;
}

$query = "SELECT * FROM $met_job  where lang='$lang' order by addtime desc";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list[title]=$list[position];
$list[updatetime]= date($met_listtime,strtotime($list[addtime]));
	switch($met_htmpagename){
     case 0:
	 $htmname="job/showjob".$list[id];
	 $phpname="job/showjob.php?id=".$list[id];	
	 break;
	 case 1:
	 $htmname="job/".date('Ymd',strtotime($list[addtime])).$list[id];
	 $phpname="job/showjob.php?id=".$list[id];
	 break;
	 case 2:
	 $htmname="job/job".$list[id];
	 $phpname="job/showjob.php?id=".$list[id];	
	 break;
	 }
	 $list[url]=$met_webhtm?$navurl.$htmname.$met_htmtype:$navurl.$phpname."&lang=".$lang;
	$sitemaplist[]=$list;
}

function cmp ($a, $b) {
    return (strtotime($a[updatetime])<strtotime($b[updatetime]));
}
usort($sitemaplist, "cmp");

foreach($nav_listall as $key=>$val){
$val[updatetime]=date($met_listtime,strtotime($m_now_date));
$val[title]=$val[name];
$sitemaplist[]=$val;
}

if($htmxml==$met_member_force){
if($met_sitemap_xml==1){
$i=0;
foreach($sitemaplist as $key=>$val){
$val[url]=str_replace('../','',$val[url]);
$val[url]=str_replace('&','&amp;',$val[url]);
$val[url]=$met_weburl.$val[url];
$i++;
$val[updatetime]=date("Y-m-d",strtotime($val[updatetime]));
$sitemaptext.="<url>\n";
$sitemaptext.="<loc>$val[url]</loc>\n";
$sitemaptext.="<lastmod>$val[updatetime]</lastmod>\n";
$sitemaptext.="<changefreq>daily</changefreq>\n";
$sitemaptext.="</url>\n";
if($i>=$met_sitemap_max)break;
}
$config_save="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
$config_save.="<urlset xmlns=\"http://www.google.com/schemas/sitemap/0.84\">\n";
$config_save.=$sitemaptext;
$config_save.="</urlset>";
$sitemapname=($lang==$met_index_type)?"sitemap.xml":"sitemap_".$lang.".xml";
    $fp = fopen($sitemapname,w);
    fputs($fp, $config_save);
    fclose($fp);
}
}
$class2=$class_list[$class1][releclass]?$class1:$class2;
$class1=$class_list[$class1][releclass]?$class_list[$class1][releclass]:$class1;
$class_info=$class2?$class2_info:$class1_info;
if($class2!=""){
$class_info[name]=$class2_info[name]."--".$class1_info[name];
}
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$met_title?$class_info['name'].'-'.$met_title:$class_info['name'];
	 if($class_info['ctitle']!='')$met_title=$class_info['ctitle'];
if(count($nav_list2[$classaccess[id]])){
$k=count($nav_list2[$class1]);
$nav_list2[$class1][$k]=$class1_info;
}
require_once '../public/php/methtml.inc.php';


if($met_sitemap_html==2){
$i=0;
$methtml_sitemap.="<ul>\n";
foreach($sitemaplist as $key=>$val){
$i++;
$methtml_sitemap.="<li class='sitemaplist'><a href='".$val[url]."' title='".$val[title]."' target='_blank'>".$val[title]."</a><span>".$val[updatetime]."</span></li>\n";
if($i>=$met_sitemap_max)break;
}
}else{
foreach($nav_list_1 as $key=>$val){
if($val[nav]){
$methtml_sitemap.="<dl class='sitemapclass'>\n";
$methtml_sitemap.="<dd class='sitemapclass1' ><h2 style='font-size:13px;'><a href='".$val[url]."' title='".$val[name]."' >".$val[name]."</a></h2></dd>\n";
foreach($nav_list2[$val[id]] as $key=>$val2){
$methtml_sitemap.="<dd class='sitemapclass2' ><h3 style='font-weight:normal; font-size:12px;'><a href='".$val2[url]."'  title='".$val2[name]."' >".$val2[name]."</a></h3>\n";
$methtml_sitemap.="<div>";
foreach($nav_list3[$val2[id]] as $key=>$val3){
$methtml_sitemap.="<h4 class='sitemapclass3' style='font-weight:normal; font-size:12px;'><a href='".$val3[url]."' title='".$val3[name]."' >".$val3[name]."</a></h4>\n";
}
$methtml_sitemap.="</div></dd>\n";
}
$methtml_sitemap.="</dl>\n";
}}

}

if(file_exists("../templates/".$met_skin_user."/sitemap.".$dataoptimize_html)){
    include template('sitemap');
}else{
 include 'templates/met/sitemap.html';
 }
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>