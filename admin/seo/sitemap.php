<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=='modify'){
	require_once $depth.'../include/config.php';
	if(!$met_sitemap_html)unlink(ROOTPATH."/sitemap.html");
	if(!$met_sitemap_xml)unlink(ROOTPATH."/sitemap.xml");
	if(!$met_sitemap_txt)unlink(ROOTPATH."/sitemap.txt");
	$gent='../../sitemap/index.php?lang='.$lang.'&htmsitemap='.$met_member_force;
	metsave('../seo/sitemap.php?lang='.$lang.'&anyid='.$anyid,'','','',$gent);
}else{
	$met_sitemap_html1[$met_sitemap_html]='checked';
	$met_sitemap_xml1[$met_sitemap_xml]='checked';
	$met_sitemap_txt1[$met_sitemap_txt]='checked';
	$met_sitemap_not11[$met_sitemap_not1]='checked';
	$met_sitemap_not21[$met_sitemap_not2]='checked';
	$met_sitemap_lang1[$met_sitemap_lang]='checked';
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('seo/sitemap');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>