<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_class('curl');

class seo extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, $_M['word']['article6'], $_M['url']['own_form'].'a=doindex');
		nav::set_nav(2, $_M['word']['pseudostatic'], $_M['url']['own_form'].'a=dourl');
		nav::set_nav(3, $_M['word']['staticpage'], $_M['url']['adminurl'].'anyid=37&n=html&c=html&a=doset');
		if($_M['config']['met_webhtm'] != 0)nav::set_nav(4, $_M['word']['createstatic'], $_M['url']['adminurl'].'anyid=37&n=html&c=html&a=dohtml');
		nav::set_nav(5, $_M['word']['anchor_text'], $_M['url']['own_form'].'a=doanchor');
		nav::set_nav(6, 'SiteMap', $_M['url']['own_form'].'a=dositemap');
		nav::set_nav(7, $_M['word']['indexlink'], $_M['url']['adminurl'].'n=link&c=link_admin&a=doindex&anyid=39');
	}

	function doindex() {
		global $_M;
		nav::select_nav(1);
		$_M['url']['help_tutorials_helpid']='108';
		require $this->template('own/seo');

	}

	function doseoeditor(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_hometitle';
		$configlist[] = 'met_title_type';
		$configlist[] = 'met_keywords';
		$configlist[] = 'met_alt';
		$configlist[] = 'met_atitle';
		$configlist[] = 'met_linkname';
		$configlist[] = 'met_foottext';
		$configlist[] = 'met_seo';
		configsave($configlist);/*保存系统配置*/
		turnover("{$_M[url][own_form]}a=doindex");
	}

	function dourl() {
		global $_M;
		nav::select_nav(2);
		$_M['url']['help_tutorials_helpid']='109';
		require $this->template('own/url');
	}

	function dourleditor() {
		global $_M;
		$configlist = array();
		$configlist[] = 'met_pseudo';
		$configlist[] = 'met_defult_lang';
		configsave($configlist);/*保存系统配置*/
		if($_M['form']['met_pseudo']){
			$query = "update {$_M['table']['lang']} SET met_webhtm = '3' where lang='{$_M['lang']}'";
			DB::query($query);
		}else{
			$query = "update {$_M['table']['lang']} SET met_webhtm = '0' where lang='{$_M['lang']}'";
			DB::query($query);
		}
		/*生成规则文件*/
		if($_M['form']['met_pseudo']||$_M['form']['pseudo_download']){
			if(!$_M['form']['pseudo_download']){
				$configlist = array();
				$configlist[] = 'met_pseudo';
				configsave($configlist);/*保存系统配置*/
				if($_M['lang']==$_M['config']['met_index_type'] && file_exists(PATH_WEB."index.htm"))@unlink(PATH_WEB."index.htm");
				if($_M['lang']==$_M['config']['met_index_type'] && file_exists(PATH_WEB."index.html"))@unlink(PATH_WEB."index.html");
				if(file_exists(PATH_WEB."index_".$_M['lang'].".htm"))@unlink(PATH_WEB."index_".$_M['lang'].".htm");
				if(file_exists(PATH_WEB."index_".$_M['lang'].".html"))@unlink(PATH_WEB."index_".$_M['lang'].".html");
			}
			$nowpath=explode('/',$_SERVER["PHP_SELF"]);
			$cunt=count($nowpath)-2;
			for($i=0;$i<$cunt;$i++){
				$metbase.= $nowpath[$i].'/';
			}
			if(stristr($_SERVER['SERVER_SOFTWARE'],'Apache')){
				$htaccess = 'RewriteEngine on'."\n";
				$htaccess.= '# '.$_M['word']['seohtaccess1']."\n";
				$htaccess.= 'Options -Indexes'."\n";
				$htaccess.= 'RewriteBase '.$metbase."\n";
				$htaccess.= 'RewriteRule ^(.*)\.(asp|aspx|asa|asax|dll|jsp|cgi|fcgi|pl)(.*)$ /404.html'."\n";
				$htaccess.= '# Rewrite '.$_M['word']['seohtaccess1']."\n";
				$htaccess.= 'RewriteRule ^index-([a-zA-Z0-9_^\x00-\xff]+).html$ index.php?lang=$1&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^app/app/ueditor/([a-zA-Z0-9_^\x00-\xff]+).html$ app/app/ueditor/$1.html [L]'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([0-9_]+)-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/index.php?lang=$4&metid=$2&list=1&page=$3&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/index.php?lang=$3&metid=$2&list=1&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([0-9_]+).html$ $1/index.php?metid=$2&list=1&page=$3&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/index.php?metid=$2&list=1&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/jobcv-([a-zA-Z0-9_^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/cv.php?lang=$3&selectedjob=$2&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/product-list-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/product.php?lang=$2&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/img-list-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/img.php?lang=$2&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/([a-zA-Z0-9_^\x00-\xff^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html$ $1/index.php?lang=$3&metid=$2&pseudo_jump=1'."\n";
                $htaccess.= 'RewriteRule ^([a-zA-Z0-9_^\x00-\xff]+)/([a-zA-Z0-9_^\x00-\xff]+).html$ $1/index.php?metid=$2&pseudo_jump=1'."\n";
				$htaccess.= 'RewriteRule ^tag/([\s\S]+)-([a-zA-Z0-9_^\x00-\xff]+)$ search/search.php?class1=&class2=&class3=&searchtype=0&searchword=$1&lang=$2'."\n";
				$htaccess.= 'RewriteRule ^tag/([\s\S]+)$ search/search.php?class1=&class2=&class3=&searchtype=0&searchword=$1'."\n";
				$str = load::plugin('doseourl', 1, array('str'=>$str, 'type'=>'apache'));//加载插件
				$htaccess = $htaccess.$str;
				$httpdurl ='.htaccess';
				$httpd    = $htaccess;
			}
			else if(stristr($_SERVER['SERVER_SOFTWARE'],'nginx')){
				$htaccess = 'rewrite ^/index-([a-zA-Z0-9_^x00-xff]+).html$ /index.php?lang=$1&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/app/app/ueditor/([a-zA-Z0-9_^\x00-\xff]+).html$ /app/app/ueditor/$1.html last;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/list-([a-zA-Z0-9_^x00-xff]+).html$ /$1/index.php?metid=$2&list=1&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/list-([a-zA-Z0-9_^x00-xff]+)-([0-9_]+).html$ /$1/index.php?metid=$2&list=1&page=$3&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/list-([a-zA-Z0-9_^x00-xff]+)-([a-zA-Z0-9_^x00-xff]+).html$ /$1/index.php?lang=$3&metid=$2&list=1&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/list-([a-zA-Z0-9_^x00-xff]+)-([0-9_]+)-([a-zA-Z0-9_^x00-xff]+).html$ /$1/index.php?lang=$4&metid=$2&list=1&page=$3&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/jobcv-([a-zA-Z0-9_^x00-xff]+)-([a-zA-Z0-9_^x00-xff]+).html$ /$1/cv.php?lang=$3&selectedjob=$2&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/product-list-([a-zA-Z0-9_^x00-xff]+).html$ /$1/product.php?lang=$2&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/img-list-([a-zA-Z0-9_^x00-xff]+).html$ /$1/img.php?lang=$2&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/([a-zA-Z0-9_^\x00-\xff]+)-([a-zA-Z0-9_^x00-xff]+).html$ /$1/index.php?lang=$3&metid=$2&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/([a-zA-Z0-9_^\x00-\xff]+).html$ /$1/index.php?metid=$2&pseudo_jump=1;'."\n";
                $htaccess.= 'rewrite ^/([a-zA-Z0-9_^x00-xff]+)/([a-zA-Z0-9_^x00-xff]+).html$ /$1/index.php?lang=$3&metid=$2&pseudo_jump=1;'."\n";
				$htaccess.= 'rewrite ^/tag/([\s\S]+)-([a-zA-Z0-9_^\x00-\xff]+)$ /search/search.php?class1=&class2=&class3=&searchtype=0&searchword=$1&lang=$2;'."\n";
				$htaccess.= 'rewrite ^/tag/([\s\S]+)$ /search/search.php?class1=&class2=&class3=&searchtype=0&searchword=$1;'."\n";
				$str = load::plugin('doseourl', 1, array('str'=>$str, 'type'=>'nginx'));//加载插件
				$htaccess = $htaccess.$str;
				$httpdurl ='.htaccess';
				$httpd    = $htaccess;
			}
			else if(stristr($_SERVER['SERVER_SOFTWARE'],'IIS')){
				$web = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
				$web.= '<configuration>'."\n";
				$web.= '<system.webServer>'."\n";
				$web.= '<rewrite>'."\n";
				$web.= '<rules>'."\n";
				$web.= '<rule name="rule1" stopProcessing="true">'."\n";
				$web.= '<match url="^index-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="index.php?lang={R:1}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";

				$web.= '<rule name="rule2" stopProcessing="true">'."\n";
				$web.= '<match url="^/app/app/ueditor/([a-zA-Z0-9_^\x00-\xff]+).html$" />'."\n";
				$web.= '<action type="Rewrite" url="/app/app/ueditor/$1.html" />'."\n";
				$web.= '</rule>'."\n";

				$web.= '<rule name="rule3" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/list-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?metid={R:2}&amp;list=1&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule4" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/list-([a-zA-Z0-9_\u4e00-\u9fa5]+)-([0-9_]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?metid={R:2}&amp;list=1&amp;page={R:3}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule5" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/list-([a-zA-Z0-9_\u4e00-\u9fa5]+)-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?lang={R:3}&amp;metid={R:2}&amp;list=1&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule6" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/list-([a-zA-Z0-9_\u4e00-\u9fa5]+)-([0-9_]+)-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?lang={R:4}&amp;metid={R:2}&amp;list=1&amp;page={R:3}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule7" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/jobcv-([a-zA-Z0-9_\u4e00-\u9fa5]+)-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/cv.php?lang={R:3}&amp;selectedjob={R:2}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule8" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/product-list-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/product.php?lang={R:2}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule9" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/img-list-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/img.php?lang={R:2}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule10" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?metid={R:2}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
				$web.= '<rule name="rule11" stopProcessing="true">'."\n";
				$web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/([a-zA-Z0-9_\u4e00-\u9fa5]+)-([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
				$web.= '<action type="Rewrite" url="{R:1}/index.php?lang={R:3}&amp;metid={R:2}&amp;pseudo_jump=1" />'."\n";
				$web.= '</rule>'."\n";
                $web.= '<rule name="rule12" stopProcessing="true">'."\n";
                $web.= '<match url="^([a-zA-Z0-9_\u4e00-\u9fa5]+)/([a-zA-Z0-9_\u4e00-\u9fa5]+).html" />'."\n";
                $web.= '<action type="Rewrite" url="{R:1}/index.php?lang={R:3}&amp;metid={R:2}&amp;pseudo_jump=1" />'."\n";
                $web.= '</rule>'."\n";
				$web.= '<rule name="rule13" stopProcessing="true">'."\n";
				$web.= '<match url="^tag/([\s\S]+)-([a-zA-Z0-9_\u4e00-\u9fa5]+)" />'."\n";
				$web.= '<action type="Rewrite" url="search/search.php?class1=&amp;class2=&amp;class3=&amp;searchtype=0&amp;searchword={R:1}&amp;lang={R:2}" />'."\n";
				$web.= '</rule>'."\n";

				$web.= '<rule name="rule14" stopProcessing="true">'."\n";
				$web.= '<match url="^tag/([\s\S]+)" />'."\n";
				$web.= '<action type="Rewrite" url="search/search.php?class1=&amp;class2=&amp;class3=&amp;searchtype=0&amp;searchword={R:1}" />'."\n";
				$web.= '</rule>'."\n";
				$str = load::plugin('doseourl', 1, array('str'=>$str, 'type'=>'iis7'));//加载插件
				$web = $web.$str;
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
				$httpd.= 'RewriteRule '.$metbase.'index-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'index.php\?lang=$1&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/index.php\?metid=$2&list=1&pseudo_jump=1'."\n";

				$httpd.= 'RewriteRule '.$metbase.'app/app/ueditor/([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'app/app/ueditor/$1.html'."\n";

				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([0-9_]+).html '.$metbase.'$1/index.php\?metid=$2&list=1&page=$3&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/index.php\?lang=$3&metid=$2&list=1&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/list-([a-zA-Z0-9_^\x00-\xff]+)-([0-9_]+)-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/index.php\?lang=$4&metid=$2&list=1&page=$3&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/jobcv-([a-zA-Z0-9_^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/cv.php\?lang=$3&selectedjob=$2&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/product-list-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/product.php\?lang=$2&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/img-list-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/img.php\?lang=$2&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/([a-zA-Z0-9_^\x00-\xff^\x00-\xff]+).html '.$metbase.'$1/index.php\?metid=$2&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'([a-zA-Z0-9_^\x00-\xff]+)/([a-zA-Z0-9_^\x00-\xff^\x00-\xff]+)-([a-zA-Z0-9_^\x00-\xff]+).html '.$metbase.'$1/index.php\?lang=$3&metid=$2&pseudo_jump=1'."\n";
				$httpd.= 'RewriteRule '.$metbase.'tag/([\s\S]+)-([a-zA-Z0-9_^\x00-\xff]+) '.$metbase.'search/search.php\?class1=&class2=&class3=&searchtype=0&searchword=$1&lang=$2'."\n";
				$httpd.= 'RewriteRule '.$metbase.'tag/([\s\S]+) '.$metbase.'search/search.php\?class1=&class2=&class3=&searchtype=0&searchword=$1'."\n";
				$str = load::plugin('doseourl', 1, array('str'=>$str, 'type'=>'iis6'));//加载插件
				$httpd = $httpd.$str;
				$httpdurl = 'httpd.ini';

			}
			if($_M['form']['pseudo_download']){
				echo "<textarea style=\"width:95%; height:350px; margin:5px;\">{$httpd}</textarea>";
				die;
			}else{
				$fp = fopen(PATH_WEB.$httpdurl,w);
				fputs($fp,$httpd);
				fclose($fp);
			}
		}else{
			if(file_exists(PATH_WEB.'httpd.ini'))@unlink(PATH_WEB.'httpd.ini');
			if(file_exists(PATH_WEB.'.htaccess'))@unlink(PATH_WEB.'.htaccess');
			if(file_exists(PATH_WEB.'web.config'))@unlink(PATH_WEB.'web.config');
		}

		turnover("{$_M[url][own_form]}a=dourl");
	}

	function doanchor() {
		global $_M;
		nav::select_nav(5);
		$_M['url']['help_tutorials_helpid']='111';
		require $this->template('own/anchor');
	}

	function doanchor_json(){
		global $_M;

		$table = load::sys_class('tabledata', 'new');
		$where = "lang='{$_M[lang]}'"; //在条件语句中加入查询条件 $search
		$order = "id";
		$array = $table->getdata($_M[table][label], '*', $where, $order);

		foreach($array as $key => $val){
			$list = array();
			$list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
			$list[] = "<input type=\"text\" name=\"oldwords-{$val[id]}\" class=\"ui-input\" value=\"{$val[oldwords]}\"  data-required=\"1\">";
			$list[] = "<input type=\"text\" name=\"newwords-{$val[id]}\" class=\"ui-input\" value=\"{$val[newwords]}\">";
			$list[] = "<input type=\"text\" name=\"newtitle-{$val[id]}\" class=\"ui-input\" value=\"{$val[newtitle]}\">";
			$list[] = "<input type=\"text\" name=\"url-{$val[id]}\" class=\"ui-input\" value=\"{$val[url]}\" data-required=\"1\">";
			$list[] = "<input type=\"text\" name=\"num-{$val[id]}\" class=\"ui-input\" value=\"{$val[num]}\" data-required=\"1\">";
			$list[] = "<a href=\"{$_M[url][own_form]}a=doanchortablesave&allid={$val[id]},&submit_type=del\" class=\"delet\" data-confirm='{$_M[word][js7]}'>{$_M[word][delete]}</a>";
			$rarray[] = $list;
		}
		$table->rdata($rarray);
	}

	function doanchor_add(){
		global $_M;
		$id = 'new-'.$_M[form][ai];
		$metinfo ="<tr class=\"even newlist\">
					<td class=\"met-center\"><input name=\"id\" type=\"checkbox\" value=\"{$id}\" checked></td>
					<td><input type=\"text\" name=\"oldwords-{$id}\" placeholder=\"{$_M[word][enter_original]}\" class=\"ui-input\" value=\"\"  data-required=\"1\"></td>
					<td><input type=\"text\" name=\"newwords-{$id}\" placeholder=\"{$_M[word][enter_replacement]}\" class=\"ui-input\" value=\"\"></td>
					<td><input type=\"text\" name=\"newtitle-{$id}\" placeholder=\"{$_M[word][title_description]}\" class=\"ui-input\" value=\"\"></td>
					<td><input type=\"text\" name=\"url-{$id}\" placeholder=\"{$_M[word][input_link_address]}\" class=\"ui-input\" value=\"http://\"  data-required=\"1\"></td>
					<td class='met-center'><input type=\"text\" name=\"num-{$id}\" class=\"ui-input\" value=\"9999\"  data-required=\"1\"></td>
					<td><a href=\"\" class=\"delet\">{$_M[word][js49]}</a></td>
				</tr>";
		echo $metinfo;
	}

	function doanchortablesave(){
		global $_M;

		$list = explode(",",$_M[form][allid]) ;
		$type = $_M[form][submit_type];
		foreach($list as $id){
			if($id){
				if($type=='save'){
					$oldwords = $_M['form']['oldwords-'.$id];
					$newwords = $_M['form']['newwords-'.$id];
					$newtitle = $_M['form']['newtitle-'.$id];
					$url 	  = $_M['form']['url-'.$id];
					$num 	  = $_M['form']['num-'.$id];
					// if(strstr($_M['config']['met_weburl'],'https')){
					// 		if(!strstr($url,'http')){
					// 					$url.='https://'.$url;
					// 			}
					// 		if(strstr($url,'http') && !strstr($url,'https')){
					// 					$url= str_replace('http','https',$url);
					// 			}
					// }else{
					// 					$url=str_replace('http://','',$url);
					// 					$url="http://".$url;
					// }
					if(is_number($id)){//修改
						$query = "UPDATE {$_M['table']['label']} SET
							oldwords = '{$oldwords}',
							newwords = '{$newwords}',
							newtitle = '{$newtitle}',
							url	     = '{$url}',
							num	     = '{$num}'
							WHERE id = '{$id}' and lang = '{$_M[lang]}'
						";
					}else{//新增
						$query = "INSERT INTO {$_M['table']['label']} SET
							oldwords = '{$oldwords}',
							newwords = '{$newwords}',
							newtitle = '{$newtitle}',
							url	     = '{$url}',
							num	     = '{$num}',
							lang	 = '{$_M[lang]}'
						";
					}
				}elseif($type=='del'){//删除
					if(is_number($id)){
						$query = "DELETE FROM {$_M['table']['label']} WHERE id='{$id}' and lang='{$_M[lang]}' ";
					}
				}
				DB::query($query);
			}
		}
		load::sys_func('file');
		delfile(PATH_WEB."cache/str_{$_M[lang]}.inc.php");
		turnover("{$_M[url][own_form]}a=doanchor");
	}

	function dositemap(){
		global $_M;
		nav::select_nav(6);
		$_M['url']['help_tutorials_helpid']='112';
		require $this->template('own/sitemap');
	}

	function dositemapeditor(){
		global $_M;
		$configlist = array();
		$configlist[] = 'met_sitemap_auto';
		$configlist[] = 'met_sitemap_not1';
		$configlist[] = 'met_sitemap_not2';
		$configlist[] = 'met_sitemap_lang';
		$configlist[] = 'met_sitemap_xml';
		$configlist[] = 'met_sitemap_txt';
		$_M['form']['met_sitemap_not1'] = $_M['form']['met_sitemap_not1'] ? $_M['form']['met_sitemap_not1'] : 0;
		$_M['form']['met_sitemap_not2'] = $_M['form']['met_sitemap_not2'] ? $_M['form']['met_sitemap_not2'] : 0;
		$_M['form']['met_sitemap_xml'] = $_M['form']['met_sitemap_xml'] ? $_M['form']['met_sitemap_xml'] : 0;
		$_M['form']['met_sitemap_txt'] = $_M['form']['met_sitemap_txt'] ? $_M['form']['met_sitemap_txt'] : 0;
		configsave($configlist);/*保存系统配置*/

		load::sys_func('file');

		if(!$_M['form']['met_sitemap_xml']){
			delfile(PATH_WEB."/sitemap.xml");
		}

		if(!$_M['form']['met_sitemap_txt']){
			delfile(PATH_WEB."/sitemap.txt");
		}

		load::sys_class('label', 'new')->get('seo')->site_map();

		turnover("{$_M[url][own_form]}a=dositemap");
	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>