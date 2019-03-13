<?php
# 文件名称:news.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../include/common.inc.php';
$member_column=$db->get_one("select * from $met_column where module='12'");
$metaccess=$member_column[access];
$classnow=$member_column[id];
require_once '../include/head.php';

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

$query = "SELECT * FROM $met_job  order by addtime desc";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$list[title]=($lang=="en")?$list[e_position]:(($lang=="other")?$list[o_position]:$list[c_position]);
if($list[title]<>""){
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

	 $list[c_url]=$met_webhtm?$navurl.$htmname.$met_c_htmtype:$navurl.$phpname;
	 $list[e_url]=$met_webhtm?$navurl.$htmname.$met_e_htmtype:$navurl.$phpname."&lang=en";
	 $list[o_url]=$met_webhtm?$navurl.$htmname.$met_o_htmtype:$navurl.$phpname."&lang=other";
	 $list[url]=($lang=="en")?$list[e_url]:(($lang=="other")?$list[o_url]:$list[c_url]);

	$sitemaplist[]=$list;
	}
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
$sitemapname=($lang=="en")?"sitemap_en.xml":(($lang=="other")?"sitemap_other.xml":"sitemap.xml");
    $fp = fopen($sitemapname,w);
    fputs($fp, $config_save);
    fclose($fp);
}
}
$class_info=$class1_info=$class_list[$classnow];
$class_info[name]=($lang=="en")?$class_info[e_name]:(($lang=="other")?$class_info[o_name]:$class_info[c_name]);
     $show[description]=$class_info[description]?$class_info[description]:$met_keywords;
     $show[keywords]=$class_info[keywords]?$class_info[keywords]:$met_keywords;
	 $met_title=$class_info[name]."--".$met_title;
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
$methtml_sitemap.="<ul>\n";
foreach($nav_list_1 as $key=>$val){
if($val[nav]){
$methtml_sitemap.="<li class='sitemapclass'>\n";
$methtml_sitemap.="<span class='sitemapclass1' ><a href='".$val[url]."' title='".$val[name]."'>".$val[name]."</a></span>\n";
foreach($nav_list2[$val[id]] as $key=>$val2){
$methtml_sitemap.="<span class='sitemapclass2' ><a href='".$val2[url]."'  title='".$val2[name]."' >".$val2[name]."</a>\n";
foreach($nav_list3[$val2[id]] as $key=>$val3){
$methtml_sitemap.="<br /><span class='sitemapclass3><a href='".$val3[url]."' class='sitemapclass3' title='".$val3[name]."'>".$val3[name]."</a></span>\n";
}
$methtml_sitemap.="</span>\n";
}
$methtml_sitemap.="</li>\n";
}}
$methtml_sitemap.="<ul>\n";
}

if(file_exists("../templates/".$met_skin_user."/sitemap.html")){
    include template('sitemap');
}else{
 include 'templates/met/sitemap.html';
 }
footer();
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>