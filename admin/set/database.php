<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
if($action=='export')
{
    if($dosubmit)
    {
        $fileid = isset($fileid) ? $fileid : 1;
        if($fileid==1 && $tables)
        {
            if(!isset($tables) || !is_array($tables))okinfo('database.php?lang='.$lang,$lang_setdbSelectTable); 
            $random = mt_rand(1000, 9999);
            cache_write('bakup_tables.php', $tables);
        }
        else
        {
            if(!$tables = cache_read('bakup_tables.php'))okinfo('database.php?lang='.$lang,$lang_setdbSelectTable);
        }
        $sqldump = '';
        $tableid = isset($tableid) ? $tableid - 1 : 0;
        $startfrom = isset($startfrom) ? intval($startfrom) : 0;
        $tablenumber = count($tables);
        for($i = $tableid; $i < $tablenumber && strlen($sqldump) < $sizelimit * 1000; $i++)
        {
            $sqldump .= sql_dumptable($tables[$i], $startfrom, strlen($sqldump));
            $startfrom = 0;
        }
        if(trim($sqldump))
        {
            $sqldump = "#MetInfo.cn Created\n# --------------------------------------------------------\n\n\n".$sqldump;
            $tableid = $i;
            $filename = $con_db_name.'_'.date('Ymd').'_'.$random.'_'.$fileid.'.sql';
			$zipname  = $con_db_name.'_'.date('Ymd').'_'.$random.'_'.$fileid;
            $fileid++;
            $bakfile = '../databack/'.$filename;
            if(!is_writable('../databack/'))okinfo('database.php?lang='.$lang,$lang_setdbTip2.'../databack/'.$lang_setdbTip3); 
            file_put_contents($bakfile, $sqldump);
			$data_msg.="{$lang_setdbBackupFile}".$filename."{$lang_setdbWriteOK}<br>";
			echo $data_msg;
		  include "pclzip.lib.php";
		 if(!file_exists('../databack/sql'))@mkdir ('../databack/sql', 0777);  
		 $sqlzip='../databack/sql/metinfo_'.$zipname.'.zip';
		 $archive = new PclZip($sqlzip);
         $zip_list = $archive->create('../databack/'.$filename,PCLZIP_OPT_REMOVE_PATH,'../databack/');
         if ($zip_list == 0) {
            die("Error : ".$archive->errorInfo(true));
         }
            header('location:database.php?lang='.$lang.'&data_msg='.$data_msg.'&action='.$action.'&sizelimit='.$sizelimit.'&tableid='.$tableid.'&fileid='.$fileid.'&startfrom='.$startrow.'&random='.$random.'&dosubmit=1');
        }
        else
        {
            cache_delete('bakup_tables.php');
            okinfo("database.php?action=import",$lang_setdbBackupOK);
        }
        exit;
    }

    else {
        $size = $bktables = $bkresults = $results= array();
        $k = 0;
        $totalsize = 0;
        $query = $db->query("SHOW TABLES FROM ".$con_db_name);
        while($r = $db->fetch_row($query))
        {
            $tables[$k] = $r[0];
            $count = $db->get_one("SELECT count(*) as number FROM $r[0] WHERE 1");
            $results[$k] = $count['number'];
            $bktables[$k] = $r[0];
            $bkresults[$k] = $count['number'];
            $q = $db->query("SHOW TABLE STATUS FROM `".$con_db_name."` LIKE '".$r[0]."'");
            $s = $db->fetch_array($q);
            $size[$k] = round($s['Data_length']/1024/1024, 2);
            $totalsize += $size[$k];
            $k++;
        }
        include_once template('database');
    }
}


/**data import**/
elseif ($action=='import')
{
    if($dosubmit)
    {
        $fileid = $fileid ? $fileid : 1;
        $filename = $pre.$fileid.'.sql';
        $filepath = '../databack/'.$filename;
        if(file_exists($filepath))
        {
            $sql = file_get_contents($filepath);
            sql_execute($sql);
            $fileid++;
            okinfo("database.php?lang=".$lang."&action=".$action."&pre=".$pre."&fileid=".$fileid."&dosubmit=1","{$lang_setdbDBFile} $filename {$lang_setdbImportOK}");
        }
        else {
            okinfo("database.php?action=$action&lang=$lang","{$lang_setdbDBRestoreOK}");
        }
    }
	 else
	 {
		 $sqlfiles = glob('../databack/*.sql');
		 if(is_array($sqlfiles))
		 {
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile)
			 {
				 preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.sql/i",basename($sqlfile),$num);
				 $info['filename'] = basename($sqlfile);
				 $info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				 $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				 $info['pre'] = $num[1];
				 $info['number'] = $num[2];
				 if(!$id) $prebgcolor = '#E4EDF9';
				 if($info['pre'] == $prepre)
				 {
					 $info['bgcolor'] = $prebgcolor;
				 }
				 else
				 {
					 $info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				 }
				 $prebgcolor = $info['bgcolor'];
				 $prepre = $info['pre'];
				 $infos[] = $info;
			 }
		 }
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('database');
footer();
	 }
}


/**delete file**/
elseif ($action=='delete') {
    if(is_array($filenames)) {
        
        foreach($filenames as $filename){
            if(fileext($filename)=='sql'){
                @unlink('../databack/'.$filename);
            }
        }
    } 
    else{
        if(fileext($filenames)=='sql'){
		$filenamearray=explode(".sql",$filenames);
            @unlink('../databack/'.$filenames);
			@unlink('../databack/sql/metinfo_'.$filenamearray[0].".zip");
        }else{
		    @unlink('../databack/'.$fileon.'/'.$filenames);
		}
    }
	if($fileon=""){
	okinfo("database.php?action=import&lang=".$lang,"{$lang_setdbDeleteOK}");
	}else{
	okinfo("database.php?action=filedown&lang=".$lang,"{$lang_setdbDeleteOK}");
	}
}

/**download**/
elseif ($action=='down'){
		 $filenamearray=explode(".sql",$filenames);
		 file_down('../databack/sql/metinfo_'.$filenamearray[0].'.zip');
}

/**upload sql**/
elseif ($action=='uploadsql') {
require_once '../include/upfile.class.php';
if(strstr($_FILES['met_upsql']['name'],'.sql')){
$filenamearray=explode('.sql',$_FILES['met_upsql']['name']);
$f = new upfile('sql,zip','../databack/','','');
if(file_exists('../databack/'.$filenamearray[0].'.sql'))$filenamearray[0]='metinfo'.$filenamearray[0];
if($_FILES['met_upsql']['name']!=''){
        $met_upsql   = $f->upload('met_upsql',$filenamearray[0]); 
    }
}else{
$filenamearray=explode('.zip',$_FILES['met_upsql']['name']);
$f = new upfile('sql,zip','../databack/sql/','','');
if(file_exists('../databack/sql/'.$filenamearray[0].'.zip'))$filenamearray[0]='metinfo'.$filenamearray[0];
if($_FILES['met_upsql']['name']!=''){
        $met_upsql   = $f->upload('met_upsql',$filenamearray[0]); 
    }
 include "pclzip.lib.php";
 $archive = new PclZip('../databack/sql/'.$filenamearray[0].'.zip');
  if ($archive->extract(PCLZIP_OPT_PATH, '../databack') == 0)die("Error : ".$archive->errorInfo(true));
}
    okinfo('database.php?action=import&lang='.$lang,$lang_setdbUploadOK);
}
//extract
elseif ($action=='extract'){
 include "pclzip.lib.php";
 $archive = new PclZip('../databack/'.$fileon.'/'.$filenames);
  if ($archive->extract(PCLZIP_OPT_PATH, '../../') == 0)die("Error : ".$archive->errorInfo(true));

    okinfo('database.php?action=filedown&lang='.$lang,$lang_setdbExtractOK);
}
//dislpay database
elseif($action=='datadisplay'){
        $size = $bktables = $bkresults = $results= array();
        $k = 0;
        $totalsize = 0;
        $query = $db->query("SHOW TABLES FROM ".$con_db_name);
        while($r = $db->fetch_row($query))
        {  
		 if(strstr($r[0], $tablepre)){
            $tables[$k] = $r[0];
            $count = $db->get_one("SELECT count(*) as number FROM $r[0] WHERE 1");
            $results[$k] = $count['number'];
            $bktables[$k] = $r[0];
            $bkresults[$k] = $count['number'];
            $q = $db->query("SHOW TABLE STATUS FROM `".$con_db_name."` LIKE '".$r[0]."'");
            $s = $db->fetch_array($q);
            $size[$k] = round($s['Data_length']/1024/1024, 2);
            $totalsize += $size[$k];
            $k++;
		 }
        }
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('database');
footer();
}
//archive config file
elseif($action=='config'){
   foreach($met_langok as $key=>$val){
   if(file_exists("../../config/config_".$val[mark].".inc.php"))$zipfile.="../../config/config_".$val[mark].".inc.php,";
   if(file_exists("../../config/flash_".$val[mark].".inc.php"))$zipfile.="../../config/flash_".$val[mark].".inc.php,";
   if(file_exists("../../config/str_".$val[mark].".inc.php"))$zipfile.="../../config/str_".$val[mark].".inc.php,";
   if(file_exists("../../feedback/config_".$val[mark].".inc.php"))$zipfile.="../../feedback/config_".$val[mark].".inc.php,";
   if(file_exists("../../message/config_".$val[mark].".inc.php"))$zipfile.="../../message/config_".$val[mark].".inc.php,";
   }
         include "pclzip.lib.php";
		 if(!file_exists('../databack/config'))@mkdir ('../databack/config', 0777);  
		 $sqlzip='../databack/config/metinfo_config_'.date('YmdHis',time()).'.zip';
		 $zipfile.="../../lang,../../config/lang.inc.php,../../config/config_db.php";
		 $archive = new PclZip($sqlzip);
         $zip_list = $archive->create($zipfile,PCLZIP_OPT_REMOVE_PATH,'../../');
         if ($zip_list == 0) {
            die("Error : ".$archive->errorInfo(true));
         }
      okinfo('database.php?action=filedown&lang='.$lang,$lang_setdbArchiveOK);
}
// archive upload file
elseif($action=='uploadimg'){
         include "pclzip.lib.php";
		 if(!file_exists('../databack/upload'))@mkdir ('../databack/upload', 0777);  
		 $sqlzip='../databack/upload/metinfo_upload_'.date('YmdHis',time()).'.zip';
		 $zipfile="../../upload";
		 $archive = new PclZip($sqlzip);
         $zip_list = $archive->create($zipfile,PCLZIP_OPT_REMOVE_PATH,'../../');
         if ($zip_list == 0) {
            die("Error : ".$archive->errorInfo(true));
         }
      okinfo('database.php?action=filedown&lang='.$lang,$lang_setdbArchiveOK);
}
// archive all file
elseif($action=='allfile'){
         include "pclzip.lib.php";
		 if(!file_exists('../databack/web'))@mkdir ('../databack/web', 0777);  
		 $sqlzip='../databack/web/metinfo_web_'.date('YmdHis',time()).'.zip';
		 $zipfile="../../";
		 $archive = new PclZip($sqlzip);
         $zip_list = $archive->create($zipfile,PCLZIP_OPT_REMOVE_PATH,'../../');
         if ($zip_list == 0) {
            die("Error : ".$archive->errorInfo(true));
         }
      okinfo('database.php?action=filedown&lang='.$lang,$lang_setdbArchiveOK);
}elseif($action=='filedown'){
//sql
		 $sqlfiles = glob('../databack/sql/*.zip');
		 if(is_array($sqlfiles))
		 {
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile)
			 {
				 preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.zip/i",basename($sqlfile),$num);
				 $info['filename'] = basename($sqlfile);
				 $info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				 $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				 $info['pre'] = $num[1];
				 $info['number'] = $num[2];
				 if(!$id) $prebgcolor = '#E4EDF9';
				 if($info['pre'] == $prepre)
				 {
					 $info['bgcolor'] = $prebgcolor;
				 }
				 else
				 {
					 $info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				 }
				 $prebgcolor = $info['bgcolor'];
				 $prepre = $info['pre'];
				 $infosql[] = $info;
			 }
		 }
//config
		 $sqlfiles = glob('../databack/config/*.zip');
		 if(is_array($sqlfiles))
		 {
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile)
			 {
				 preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.zip/i",basename($sqlfile),$num);
				 $info['filename'] = basename($sqlfile);
				 $info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				 $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				 $info['pre'] = $num[1];
				 $info['number'] = $num[2];
				 if(!$id) $prebgcolor = '#E4EDF9';
				 if($info['pre'] == $prepre)
				 {
					 $info['bgcolor'] = $prebgcolor;
				 }
				 else
				 {
					 $info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				 }
				 $prebgcolor = $info['bgcolor'];
				 $prepre = $info['pre'];
				 $infoconfig[] = $info;
			 }
		 }
//upload
		 $sqlfiles = glob('../databack/upload/*.zip');
		 if(is_array($sqlfiles))
		 {
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile)
			 {
				 preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.zip/i",basename($sqlfile),$num);
				 $info['filename'] = basename($sqlfile);
				 $info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				 $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				 $info['pre'] = $num[1];
				 $info['number'] = $num[2];
				 if(!$id) $prebgcolor = '#E4EDF9';
				 if($info['pre'] == $prepre)
				 {
					 $info['bgcolor'] = $prebgcolor;
				 }
				 else
				 {
					 $info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				 }
				 $prebgcolor = $info['bgcolor'];
				 $prepre = $info['pre'];
				 $infoupload[] = $info;
			 }
		 }
//all files
		 $sqlfiles = glob('../databack/web/*.zip');
		 if(is_array($sqlfiles))
		 {
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile)
			 {
				 preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{4}_)([0-9]+)\.zip/i",basename($sqlfile),$num);
				 $info['filename'] = basename($sqlfile);
				 $info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				 $info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				 $info['pre'] = $num[1];
				 $info['number'] = $num[2];
				 if(!$id) $prebgcolor = '#E4EDF9';
				 if($info['pre'] == $prepre)
				 {
					 $info['bgcolor'] = $prebgcolor;
				 }
				 else
				 {
					 $info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				 }
				 $prebgcolor = $info['bgcolor'];
				 $prepre = $info['pre'];
				 $infoweb[] = $info;
			 }
		 }
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('database');
footer();
}else{
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('database');
footer();
}

function file_down($file)
{
    global $lang_setdbNotExist;
	!file_exists($file) && okinfo('database.php?action=import',$lang_setdbNotExist);
	$filename = $filename ? $filename : basename($file);
	$filetype = fileext($filename);
    //$filetype!='sql' && okinfo('database.php?action=import',$lang_setdbOnlyDownload);
	$filesize = filesize($file);
	header('Cache-control: max-age=31536000');
	header('Expires: '.gmdate('D, d M Y H:i:s', time() + 31536000).' GMT');
	header('Content-Encoding: none');
	header('Content-Length: '.$filesize);
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Type: '.$filetype);
	readfile($file);
	exit;
}

function cache_write($file, $string, $type = 'array')
{
	if(is_array($string))
	{
		$type = strtolower($type);
		if($type == 'array')
		{
			$string = "<?php\n return ".var_export($string,TRUE).";\n?>";
		}
		elseif($type == 'constant')
		{
			$data='';
			foreach($string as $key => $value) $data .= "define('".strtoupper($key)."','".addslashes($value)."');\n";
			$string = "<?php\n".$data."\n?>";
		}
	}
	file_put_contents('../databack/'.$file, $string);
}

function cache_read($file, $mode = 'i')
{
	$cachefile = '../databack/'.$file;
	if(!file_exists($cachefile)) return array();
	return $mode == 'i' ? include $cachefile : file_get_contents($cachefile);
}

function cache_delete($file)
{
	return @unlink('../databack/'.$file);
}

function sql_dumptable($table, $startfrom = 0, $currsize = 0)
{
	global $db, $sizelimit, $startrow;

	if(!isset($tabledump)) $tabledump = '';
	$offset = 100;
	if(!$startfrom)
	{
		$tabledump = "DROP TABLE IF EXISTS $table;\n";
		$createtable = $db->query("SHOW CREATE TABLE $table");
		$create = $db->fetch_row($createtable);
		$tabledump .= $create[1].";\n\n";
	}

	$tabledumped = 0;
	$numrows = $offset;
	while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset)
	{
		$tabledumped = 1;
		$rows = $db->query("SELECT * FROM $table LIMIT $startfrom, $offset");
		$numfields = $db->num_fields($rows);
		$numrows = $db->num_rows($rows);
		while ($row = $db->fetch_row($rows))
		{
			$comma = "";
			$tabledump .= "INSERT INTO $table VALUES(";
			for($i = 0; $i < $numfields; $i++)
			{
				$tabledump .= $comma."'".mysql_escape_string($row[$i])."'";
				$comma = ",";
			}
			$tabledump .= ");\n";
		}
		$startfrom += $offset;
	}
	$startrow = $startfrom;
	$tabledump .= "\n";
	return $tabledump;
}

function sql_execute($sql)
{
	global $db;
    $sqls = sql_split($sql);
	if(is_array($sqls))
    {
		foreach($sqls as $sql)
		{
			if(trim($sql) != '') 
			{
				$db->query($sql);
			}
		}
	}
	else
	{
		$db->query($sqls);
	}
	return true;
}

function sql_split($sql)
{
	global $db_charset, $db;
	if($db->version() > '4.1' && $db_charset)
	{
		$sql = preg_replace("/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "TYPE=\\1 DEFAULT CHARSET=".$db_charset,$sql);
	}
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query)
	{
		$ret[$num] = '';
		$queries = explode("\n", trim($query));
		$queries = array_filter($queries);
		foreach($queries as $query)
		{
			$str1 = substr($query, 0, 1);
			if($str1 != '#' && $str1 != '-') $ret[$num] .= $query;
		}
		$num++;
	}
	return($ret);
}
function fileext($filename)
{
	return trim(substr(strrchr($filename, '.'), 1));
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>