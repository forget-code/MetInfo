<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=='modify'){
	if($met_webhtm == 0){
		$met_htmlurl = 0;
	}
	if($met_pseudo&&$met_webhtm>0){
		metsave('../seo/sethtm.php?lang='.$lang.'&anyid='.$anyid.'&cs='.$cs,$lang_rewritefinfo3);
		die;
	}
	$query = "update $met_lang SET met_webhtm = '$met_webhtm' where lang='$lang'";
	$db->query($query);
	$query = "update $met_lang SET met_htmtype = '$met_htmtype' where lang='$lang'";
	$db->query($query);
	
	require_once $depth.'../include/config.php';
	if($met_htmlurl == 1){
		$query = "update $met_config set value='1' where name = 'met_htmway' and lang='$lang'";
		$db->query($query);
		$nowpath=explode('/',$_SERVER["PHP_SELF"]);
		$cunt=count($nowpath)-3;
		for($i=0;$i<$cunt;$i++){
			$metbase.= $nowpath[$i].'/';
		}
		if(stristr($_SERVER['SERVER_SOFTWARE'],'Apache')){
			$htaccess = 'RewriteEngine on'."\n";
			$htaccess.= '# 是否显示根目录下文件列表'."\n";
			$htaccess.= 'Options -Indexes'."\n";
			$htaccess.= 'RewriteBase '.$metbase."\n";
			$htaccess.= 'RewriteRule ^(.*)\.(asp|aspx|asa|asax|dll|jsp|cgi|fcgi|pl)(.*)$ /404.'.$met_htmtype."\n";
			$htaccess.= '# Rewrite 系统规则请勿修改'."\n";
			$htaccess.= 'RewriteRule ^index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ index.php?lang=$1'."\n";
			$htaccess.= 'RewriteRule ^index.'.$met_htmtype.'$ index.php'."\n";
			$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/index_list_([^/\\\\]+).'.$met_htmtype.'$ $1/index.php?murlid=index_list_$2&furlid=$1'."\n";
			$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ $1/index.php?lang=$2'."\n";
			$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/index.'.$met_htmtype.'$ $1/index.php'."\n";
			$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\x28^\x30-\xff]+)/([^/\\\\]+).'.$met_htmtype.'$ $1/index.php?murlid=$2&furlid=$1'."\n";
			
			$httpdurl ='.htaccess';
			$httpd    = $htaccess;	
		}
		else if(stristr($_SERVER['SERVER_SOFTWARE'],'nginx')){
			$htaccess = 'rewrite ^/index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ /index.php?lang=$1;'."\n";
			$htaccess.= 'rewrite ^/index.'.$met_htmtype.'$ /index.php;'."\n";
			$htaccess.= 'rewrite ^/([a-zA-Z0-9_^\x00-\xff]+)/index_list_([^/\\\\\\\\]+).'.$met_htmtype.'$ /$1/index.php?murlid=index_list_$2&furlid=$1;'."\n";
			$htaccess.= 'rewrite ^/([a-zA-Z0-9_^\x00-\xff]+)/index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ /$1/index.php?lang=$2;'."\n";
			$htaccess.= 'rewrite ^/([a-zA-Z0-9_^\x00-\xff]+)/index.'.$met_htmtype.'$ /$1/index.php;'."\n";
			$htaccess.= 'rewrite ^/([a-zA-Z0-9_^\x00-\x28^\x30-\xff]+)/([^/\\\\\\\\]+).'.$met_htmtype.'$ /$1/index.php?murlid=$2&furlid=$1;'."\n";
			$httpdurl ='.htaccess';
			$httpd    = $htaccess;	
		}
		else if(stristr($_SERVER['SERVER_SOFTWARE'],'IIS/7')){
			$web = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
			$web.= '<configuration>'."\n";
			$web.= '<system.webServer>'."\n";
			$web.= '<rewrite>'."\n";
			$web.= '<rules>'."\n";
			$web.= '<rule name="rule1" stopProcessing="true">'."\n";
			$web.= '<match url="^index_([a-zA-Z0-9_\u4e00-\u9fa5]+).'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="index.php?lang={R:1}" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '<rule name="rule2" stopProcessing="true">'."\n";
			$web.= '<match url="^index.'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="index.php" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '<rule name="rule3" stopProcessing="true">'."\n";
			$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/index_list_([^/\\\\]+).'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="{R:1}/index.php?murlid=index_list_{R:2}&amp;furlid={R:1}" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '<rule name="rule4" stopProcessing="true">'."\n";
			$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/index_([a-zA-Z0-9_\u4e00-\u9fa5]+).'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="{R:1}/index.php?lang={R:2}" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '<rule name="rule5" stopProcessing="true">'."\n";
			$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/index.'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="{R:1}/index.php" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '<rule name="rule6" stopProcessing="true">'."\n";
			$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/([^/\\\\]+).'.$met_htmtype.'$" />'."\n";
			$web.= '<action type="Rewrite" url="{R:1}/index.php?murlid={R:2}&amp;furlid={R:1}" />'."\n";
			$web.= '</rule>'."\n";
			$web.= '</rules>'."\n";
			$web.= '</rewrite>'."\n";
			$web.= '</system.webServer>'."\n";
			$web.= '</configuration>'."\n";
			$httpdurl ='web.config';
			$httpd    = $web;			
		}
		else{
			$httpd = '[ISAPI_Rewrite]'."\n";
			$httpd.= '# 3600 = 1 hour'."\n";
			$httpd.= 'CacheClockRate 3600'."\n";
			$httpd.= 'RepeatLimit 32'."\n";
			$httpd.= 'RewriteRule '.$metbase.'index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ '.$metbase.'index.php?lang=$1'."\n";
			$httpd.= 'RewriteRule '.$metbase.'index.'.$met_htmtype.'$ '.$metbase.'index.php'."\n";
			$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/index_list_([^/\\\\]+).'.$met_htmtype.'$ '.$metbase.'$1/index.php?murlid=index_list_$2&furlid=$1'."\n";
			$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/index_([a-zA-Z0-9_^\x00-\xff]+).'.$met_htmtype.'$ '.$metbase.'$1/index.php?lang=$2'."\n";
			$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/index.'.$met_htmtype.'$ '.$metbase.'$1/index.php'."\n";
			$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\x28^\x30-\xff]+)/([^/\\\\]+).'.$met_htmtype.'$ '.$metbase.'$1/index.php?murlid=$2&furlid=$1'."\n";
			
			$httpdurl = 'httpd.ini';
			
		}
		if($_M['form']['pseudo_download']){
			echo "<textarea style=\"width:95%; height:350px; margin:5px;\">{$httpd}</textarea>";
			die;
		}else{
			$fp = fopen(ROOTPATH.$httpdurl,w);
			fputs($fp,$httpd);
			fclose($fp);
		}
	}else{
		if(file_exists(ROOTPATH.'httpd.ini'))@unlink(ROOTPATH.'httpd.ini');
		if(file_exists(ROOTPATH.'.htaccess'))@unlink(ROOTPATH.'.htaccess');
		if(file_exists(ROOTPATH.'web.config'))@unlink(ROOTPATH.'web.config');
	}

	if(($met_webhtm==0 && $dehtm=='deleteall') || $dehtm=='bianhtm' || $met_htmlurl == 1){
		$query = "SELECT * FROM $met_column where (bigclass=0 or releclass!=0) and if_in=0 and lang='$lang'";
		$result = $db->query($query);
		while($list= $db->fetch_array($result)){
			$dir='../../'.$list['foldername']; 
			$file=met_scandir($dir);
			foreach ($file as $value){
				if($lang==$met_index_type){
					if($value != "." && $value !=".."){
						$langmarkarray=explode("_",$value);
						$k=count($langmarkarray)-1;
						$langmark=$k?$langmarkarray[$k]:"";
						if((substr($value,-4,4)=="html" || substr($value,-3,3)=="htm") and (!strstr($htmlang, "_".$langmark) || $langmark=="")){
							unlink($dir."/".$value); 
						}
					} 
				}else{
					if($value != "." && $value !=".."){
						if(strstr($value,".htm")){
							unlink($dir."/".$value);
						}	
					} 
				}
			}
		}
		unlink(ROOTPATH.'index.html');
		unlink(ROOTPATH.'index.htm');
	}
	if($met_webhtm==0 || $dehtm=='bianhtm'){
		if($lang==$met_index_type && file_exists("../../index.htm"))@unlink("../../index.htm");
		if($lang==$met_index_type && file_exists("../../index.html"))@unlink("../../index.html");
		if(file_exists("../../index_".$lang.".htm"))@unlink("../../index_".$lang.".htm");
		if(file_exists("../../index_".$lang.".html"))@unlink("../../index_".$lang.".html");
	}
	$gent='../../include/404.php?lang='.$lang.'&metinfonow='.$met_member_force;
	if(($dehtm=='newhtm' || $dehtm=='bianhtm') && $met_htmlurl != 1){
		metsave('../seo/htm.php?lang='.$lang.'&anyid='.$anyid.'&cs=2&newhtm_open=1','','','',$gent);
	}else{
		metsave('../seo/sethtm.php?lang='.$lang.'&anyid='.$anyid.'&cs='.$cs,'','','',$gent);
	}
}else{
	if($met_webhtm && !$sethtm && $met_htmlurl != 1 && !$nojump)header('location:htm.php?lang='.$lang.'&anyid='.$anyid);
	$cs=isset($cs)?$cs:1;
	$listclass[$cs]='class="now"';
	$met_webhtm1[$met_webhtm]='checked';
	if($met_htmtype=='htm')$met_htmtype1[0]='checked';
	if($met_htmtype=='html')$met_htmtype1[1]='checked';
	$met_htmpagename1[$met_htmpagename]='checked';
	$met_listhtmltype1[$met_listhtmltype]='checked';
	$met_htmlistname1[$met_htmlistname]='checked';
	$met_htmway1[$met_htmway]='checked';
	$met_htmlurl1[$met_htmlurl]='checked';
	if($met_webhtm == 0 )$display_htmlurl = "style=\"display:none;\"";
	if($met_htmlurl == 1 )$display_htmway = "style=\"display:none;\"";
	
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('seo/sethtm');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>