<?php
defined('IN_MET') or exit('No permission');
load::sys_class('admin');
load::sys_class('pclzip');
#load::module()
class index extends admin {
	public function __construct() {
		global $_M,$adminurl;
		parent::__construct();
		nav::set_nav(1, $_M[word][databackup1], "{$_M[url][own_form]}a=doindex");
		nav::set_nav(2, $_M[word][databackup2], "{$_M[url][own_form]}a=dorecovery");
		nav::set_nav(3, $_M[word][databackup3], "{$_M[url][own_form]}a=dodownload");
		##$adminurl= $_M['config']['met_weburl'].$_M['config']['met_adminfile'].'/';
        $adminurl = $_M['url']['site_admin'];
        $arr = explode('/', $_M['url']['site_admin']);
        array_pop($arr);
        define(ADMIN_FILE, end($arr));
	}

	public function doindex() {
		global $_M;
		nav::select_nav(1);
		$_M['url']['help_tutorials_helpid']='115#网站备份';
		require_once $this->template('own/index');
	}
	/*数据库备份*/
	public function dopackdata(){
		global $_M;
		$zip_list = $this->dogetsql();

		if($zip_list == 0){
			//die("Error : ".$archive->errorInfo(true));
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][setdbArchiveNo]);
		}
		$this->docache_delete('bakup_tables.php');
		turnover("{$_M[url][own_form]}a=dodownload",$_M[word][setdbBackupOK]);
	}

	/*恢复数据*/
	public  function dorecovery(){
		global $_M,$adminurl;
		nav::select_nav(2);
		$infos=$this->dogetfileattr();
		if($_M[config][met_agents_type]>1){
			$_M[config][dataexplain2]=str_replace('met',$_M[config][met_agents_backup],$_M[word][dataexplain2]);
		}
		$_M['url']['help_tutorials_helpid']='115#恢复数据';
		require_once $this->template('own/recovery');
	}

	/*导入数据*/
	public function doimport(){
		global $_M;
		$metinfo_admin_name = get_met_cookie('metinfo_admin_name');
		$query="select admin_op from {$_M[table][admin_table]} where admin_id='{$metinfo_admin_name}'";
		$admin_op =DB::get_one($query);
		if(strstr($admin_op['admin_op'],'metinfo') === false){
			echo "<script type='text/javascript'> alert('{$_M[word][jsx38]}');location.href='recovery.php?anyid={$anyid}&lang={$_M['lang']}&cs=2'; </script>";
			die();
		}
		$fileid = $fileid ? $fileid : 1;
		$filename = $_M[form][pre].$fileid.'.sql';
		$filepath = PATH_WEB.ADMIN_FILE.'/databack/'.$filename;
		if(file_exists($filepath)){
			$sql = file_get_contents($filepath);
			if(substr($sql,28,5)!=$_M[config][metcms_v] && substr($sql,28,6)!=$_M[config][metcms_v]) turnover("{$_M[url][own_form]}a=dorecovery", $_M[word][dataerr1]);
			if(stristr($sql,'INSERT INTO met_admin_table')){
				echo "<script>
				function import1(text){
					if(confirm(text)){
						 location.href='{$_M[url][own_form]}a=dosql_execute&anyid=$anyid&pre={$_M[form][pre]}&dosubmit=1&dosubmit1=0';
					}else{
						location.href='{$_M[url][own_form]}a=dosql_execute&anyid=$anyid&pre={$_M[form][pre]}&dosubmit=1&dosubmit1=1';
					}
				}
				import1('{$_M[word][js72]}');
				</script>";
			}else{
				header("location:{$_M[url][own_form]}a=dosql_execute&anyid=$anyid&pre={$_M[form][pre]}&dosubmit=1&dosubmit1=1");
			}
	    }
	}

	public function dosql_execute()
    {
        global $_M;
        $tablepre = $_M['config']['tablepre'];
        $fileid = $_M['form']['fileid'] ? $_M['form']['fileid'] : 1;
        $filename = $_M[form][pre] . $fileid . '.sql';
        $filepath = PATH_WEB . ADMIN_FILE . '/databack/' . $filename;
        if (file_exists($filepath)) {
            $sql = file_get_contents($filepath);
            if (substr($sql, 28, 5) != $_M[config][metcms_v] && substr($sql, 28, 6) != $_M[config][metcms_v]) turnover("{$_M[url][own_form]}a=doindex", $_M[word][dataerr1]);
            $split = $this->dosql_split($sql);
            $sqls = $split['sql'];
            $info = $split['info'];
            $infos = explode('#', $info);
            $localurl = $_M[config][met_weburl];
            if ($infos[3] && $tablepre != $infos[3]) $sqlre1 = 1;
            if ($infos[2] && $localurl != $infos[2]) $sqlre2 = 1;
            if (is_array($sqls)) {
                foreach ($sqls as $sql) {
                    if ($_M[form][dosubmit1] == '1') {
                        $sql = preg_replace(array('/INSERT INTO ' . $_M[table][admin_table] . '/', '/DROP TABLE IF EXISTS ' . $_M[table][admin_table] . '/', '/CREATE TABLE `' . $_M[table][admin_table] . '`/'), array('INSERT INTO test_admin_table1', 'DROP TABLE IF EXISTS test_admin_table1', 'CREATE TABLE `test_admin_table1`'), $sql);
                    }
                    if ($sqlre1 == 1) $sql = preg_replace(array('/^INSERT INTO ' . $infos[3] . '/', '/^DROP TABLE IF EXISTS ' . $infos[3] . '/', '/^CREATE TABLE `' . $infos[3] . '/'), array('INSERT INTO ' . $tablepre, 'DROP TABLE IF EXISTS ' . $tablepre, 'CREATE TABLE `' . $tablepre), $sql, 1);
                    if ($sqlre2 == 1) {
                        if (!preg_match('/^INSERT INTO ((' . $_M[table][visit_day] . ')|(' . $_M[table][visit_detail] . '.))/', $sql)) {
                            $sql = str_replace($infos[2], $localurl, $sql);
                        }
                    }
                    DB::query($sql);
                    // if(trim($sql) != '') {
                    // 	if(!DB::query($sql)){
                    // 		echo $sql;
                    // 		return false;
                    // 	}
                    // }
                }
            } else {
                // if(!DB::query($sqls)){
                // 	return false;
                // }
            }
            if ($_M[form][dosubmit1] == '1') {
                if (!DB::query('DROP TABLE IF EXISTS test_admin_table1')) {
                    return false;
                }
            }
            //return true;
            $fileid++;
            $this->dosave_met_cookie();

            header("location:{$_M[url][own_form]}a=dosql_execute&anyid={$_M['form']['anyid']}&pre={$_M['form']['pre']}&dosubmit={$_M['form']['dosubmit']}&dosubmit1={$_M['form']['dosubmit1']}&fileid={$fileid}");
        } else {
            //恢复栏目文件
            $this->dorecover_column();
            //剔除不存在的applist记录
            $this->docheckapplsit();
            //清除官方商城登录信息
            $this->metshot_logout();
            load::sys_func('file');
            deldir('cache', 1);
            deldir('upload/thumb_src', 1);
            turnover("{$_M[url][own_form]}a=doindex", "{$_M[word][setdbImportOK]}");
        }
    }

	function dosave_met_cookie(){
	    global $_M;
	    $metinfo_admin_name = get_met_cookie('metinfo_admin_name');
	    $query="select * from {$_M[table][admin_table]} where admin_id='{$metinfo_admin_name}'";
		$user=DB::get_one($query);
		$usercooike=json_decode($user['cookie']);
		foreach($usercooike as $key=>$val){
				$met_cookie[$key]=$val;
			}
	    $met_cookie['time']=time();
	    $json=json_encode($met_cookie);
	    $username=$met_cookie[metinfo_admin_id]?$met_cookie[metinfo_admin_id]:$met_cookie[metinfo_member_id];
	   // $username=daddslashes($username,0,1);
	    $query="update {$_M[table][admin_table]} set cookie='$json' where id='$username'";
	    $user=DB::get_one($query);
	}
	// if(!function_exists('json_encode')){
	//     include ROOTPATH.'include/JSON.php';
	//     function json_encode($val){
	//         $json = new Services_JSON();
	//         $json=$json->encode($val);
	//         return $json;
	//     }
	//     function json_decode($val){
	//         $json = new Services_JSON();
	//         return $json->decode($val);
	//     }
	// }
	// }
	public function dosql_split($sql){
		global $_M;
		$db_charset='utf-8';
		if(DB::version() > '4.1' && $db_charset){
			$sql = preg_replace("/TYPE=(InnoDB|MyISAM)( DEFAULT CHARSET=[^; ]+)?/", "TYPE=\\1 DEFAULT CHARSET=".$db_charset,$sql);
		}
		$sql = str_replace("\r", "\n", $sql);
		$ret = array();
		$num = 0;
		$queriesarray = explode(";\n", trim($sql));
		unset($sql);
		foreach($queriesarray as $query){
			$ret['sql'][$num] = '';
			$queries = explode("\n", trim($query));
			$queries = array_filter($queries);
			foreach($queries as $query){
				$str1 = substr($query, 0, 1);
				if($str1 != '#' && $str1 != '-') {
					$ret['sql'][$num] .= $query;
				}else{
					$ret['info'].= $query;
				}
			}
			$num++;
		}
		return($ret);
	}

	/*获取文件属性*/
	public  function dogetfileattr(){
		global $_M;
		$sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/*.sql');
		if(is_array($sqlfiles)){
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile){
				preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-zA-Z]{6}_)([a-z0-9]+)\.sql/i",basename($sqlfile),$num);
				$info['filename'] = basename($sqlfile);
				$info['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
				$info['maketime'] = date('Y-m-d H:i:s', filemtime($sqlfile));
				$info['pre'] = $num[1];
				$info['number'] = $num[2];
				if(!$id) $prebgcolor = '#E4EDF9';
				if($info['pre'] == $prepre){
					$info['bgcolor'] = $prebgcolor;
				}else{
					$info['bgcolor'] = $prebgcolor == '#E4EDF9' ? '#F1F3F5' : '#E4EDF9';
				}
				$prebgcolor = $info['bgcolor'];
				$prepre = $info['pre'];
				$infos[] = $info;
			}
		}
		foreach($infos as $key=>$val){
			$val['time']=strtotime($val['maketime']);
			$infos1[]=$val;
		}

		foreach($infos1 as $key=>$val){
			if($val['number']==1){
				$infos2[$val['pre']]=$val;
			}else{
				$infos3[]=$val;
			}

		}
		foreach($infos3 as $key=>$val){
			$infos2[$val[pre]][number]++;
			$infos2[$val[pre]][filesize]+=$val[filesize];
		}


		$infos=$this->array_sort($infos2,'time','we');
		foreach($infos as $key=>$val){
			$fp = @fopen(PATH_WEB.ADMIN_FILE.'/databack/'.$val['filename'],"rb");
			$str = @fgets($fp);
			@fclose($fp);
			$infos[$key]['ver']=trim(str_replace('#MetInfo.cn Created version:','',$str));
		}
		foreach($infos as $key=>$val){
			$infos[$key]['filename']=$key.'1';
			$info_num=1;
			while(file_exists(PATH_WEB.ADMIN_FILE.'/databack/'.$key.$info_num.'.sql')){
				$info_num++;
			}
			if($info_num-1!=$val['number']){
				$infos[$key]['error']='1';
			}else{
				$infos[$key]['error']='0';
			}
		}

		foreach($infos as $key=>$val){
			if($val[ver]!=$_M[config][metcms_v]){
				$val['error']=2;
				unset($infos[$key]);
				$infos[$key]=$val;
			}
		}

		return $infos;
	}

	function array_sort($arr,$keys,$type='asc'){
		// dump($arr);
		// exit;
		$keysvalue = $new_array = array();
		foreach ($arr as $k=>$v){
			$keysvalue[$k] = $v[$keys];
		}
		if($type == 'asc'){
			asort($keysvalue);
		}else{
			arsort($keysvalue);
		}
		reset($keysvalue);
		foreach ($keysvalue as $k=>$v){
			$new_array[$k] = $arr[$k];
		}
		return $new_array;
	}

	/*写入数据库缓存文件*/
   function docache_write($file, $string, $type = 'array'){
   	    global $_M;
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
		file_put_contents(PATH_WEB.ADMIN_FILE.'/databack/'.$file, $string);
	}

	/*获取所有数据表*/
   function dotableprearray($tablepre){
		    global $_M;
			$mettables=explode('|',$_M[config][met_tablename]);
			$i=0;
			foreach($mettables as $key=>$val){
				$tables[$i]=$tablepre.$val;
				$i++;
			}
			return $tables;
		}

	function dosql_dumptable($table, $startfrom = 0, $currsize = 0){
		global $_M;
		$sizelimit=2048;

		if(!isset($tabledump)) $tabledump = '';
		$offset = 100;
		if(!$startfrom)
		{
			$tabledump = "DROP TABLE IF EXISTS $table;\n";

			$createtable = DB::query("SHOW CREATE TABLE $table");
			$create = DB::fetch_row($createtable);

			$tabledump .= str_replace(strtolower($table),$table,$create[1]).";\n\n";
		}

        if (strstr($table, '_visit_')) {
            return $tabledump;
        }

		$tabledumped = 0;
		$numrows = $offset;

		while($currsize + strlen($tabledump) < $sizelimit * 1000 && $numrows == $offset)
		{
			$tabledumped = 1;
			$rows = DB::query("SELECT * FROM $table LIMIT $startfrom, $offset");
			$numfields = DB::num_fields($rows);
			$numrows = DB::num_rows($rows);
			while ($row = DB::fetch_row($rows))
			{
				$comma = "";
				$tabledump .= "INSERT INTO $table VALUES(";
				for($i = 0; $i < $numfields; $i++)
				{
                    if ($row[$i-1] == "met_secret_key" ) {
                        $row[$i] = '';
                    }
					#$tabledump .= $comma."'".mysql_escape_string($row[$i])."'";
					$tabledump .= $comma."'".mysqli_real_escape_string(DB::$link,$row[$i])."'";
                    $comma = ",";
                }
                $tabledump .= ");\n";
            }
			$startfrom = $startfrom + $offset;
		}
		$this->startrow = $startfrom;
		$tabledump .= "\n";
		return $tabledump;
	}

  	/*删除数据库缓存文件*/
  	function docache_delete($file){
		global $_M;
		return @unlink(PATH_WEB.ADMIN_FILE.'/databack/'.$file);
	}

	/*上传文件备份*/
	 function dopackupload(){
		global $_M;

		$upload_path = PATH_WEB.'/upload';
		$upload_back_path = PATH_WEB.ADMIN_FILE.'/databack/upload/';
		$zipname =  $upload_back_path . $_M['config']['met_agents_backup'].'_upload_'.date('YmdHis',time()).'.zip';
		if(!file_exists($upload_back_path)){
			mkdir($upload_back_path,0777,true);
		}

		echo "<span id=\"tips\">{$_M['word']['setdbArchiveNo']}</span>";

		if(class_exists('ZipArchive'))
		{
			load::sys_func('file');
			$zip = new ZipArchive();
			$status = $zip->open($zipname,ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
			if(!$status){
				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['setdbArchiveNo']);
			}
			file_zip($upload_path, $zip);
			$zip->close();
		}else{
			$archive = new PclZip($zipname);
			$zip_list = $archive->create($upload_path,PCLZIP_OPT_REMOVE_PATH,PATH_WEB);
			if ($zip_list == 0) {
				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['setdbArchiveNo']);
			}
		}
		turnover("{$_M['url']['own_form']}a=dodownload",$_M['word']['setdbArchiveOK']);
	}

	/*获取sql文件*/
	public function dogetsql($table='') {
		global $_M;
		if($_M['form']['tables'] && !$table)$table = $_M['form']['tables'];
		$localurl=$_M['config']['met_weburl'];
		$tablepre=$_M['config']['tablepre'];
		$fileid = isset($_M['form']['fileid']) ? $_M['form']['fileid'] : 1;
		if($table){
			$tables=$table;
		}else{
			$tables=$this->dotableprearray($tablepre);
		}

		$sizelimit=2048;
		if($fileid==1){
			$random = isset($_M['form']['random']) ? $_M['form']['random'] : met_rand(6);
			$this->docache_write('bakup_tables.php', $tables);
		}elseif(!$tbl){
			$random = isset($_M['form']['random']) ? $_M['form']['random'] : met_rand(6);
			$allidlist=explode('|',$tablestx);
			for($i=0;$i<count($allidlist)-1;$i++){
				$tables[$i]=$allidlist[$i];
			}
		}
		$sqldump = '';
		$tableid = isset($_M['form']['tableid']) ? $_M['form']['tableid'] : 0;
		$startfrom = isset($_M['form']['startfrom']) ? intval($_M['form']['startfrom']) : 0;
		$tablenumber = count($tables);
		for($i = $tableid-1; $i < $tablenumber && strlen($sqldump) < $sizelimit * 1000; $i++){
			$sqldump .= $this->dosql_dumptable($tables[$i], $startfrom, strlen($sqldump));
			$startfrom = 0;
		}
		$zip_list = 1;
		if(trim($sqldump)){
			$version='version:'.$_M['config']['metcms_v'];
			$sqldump = "#MetInfo.cn Created {$version} \n#$localurl\n#$tablepre\n# --------------------------------------------------------\n\n\n".$sqldump;
			$tableid = $i;
			$db_settings = parse_ini_file(PATH_CONFIG.'config_db.php');
				@extract($db_settings);
			$filename = $con_db_name.'_'.date('Ymd').'_'.$random.'_'.$fileid.'.sql';
			$zipname  = $con_db_name.'_'.date('Ymd').'_'.$random.'_'.$fileid;
			$fileid++;
			$bakfile = PATH_WEB.ADMIN_FILE.'/databack/'.$filename;
			if(!is_writable(PATH_WEB.ADMIN_FILE.'/databack/'))turnover("{$_M[url][own_form]}a=doindex",$_M[word][setdbTip2].'databack/'.$_M[word][setdbTip3]);
			file_put_contents($bakfile, $sqldump);
			if(!file_exists(PATH_WEB.ADMIN_FILE.'databack/sql'))@mkdir (PATH_WEB.ADMIN_FILE.'/databack/sql', 0777);
			$sqlzip=PATH_WEB.ADMIN_FILE.'/databack/sql/'.$_M[config][met_agents_backup].'_'.$zipname.'.zip';
			$archive = new PclZip($sqlzip);
			$zip_list = $archive->create(PATH_WEB.ADMIN_FILE.'/databack/'.$filename,PCLZIP_OPT_REMOVE_PATH,PATH_WEB.ADMIN_FILE.'/databack/');
		}
		if(trim($sqldump)){
			header('location:index.php?n=databack&c=index&a=dopackdata&lang='.$_M['lang'].'&tables='.$_M['form']['tables'].'&tableid='.$tableid.'&fileid='.$fileid.'&startfrom='.$this->startrow.'&random='.$random.'&anyid='.$anyid.'&cs='.$cs);
		}
		$this->docache_delete('bakup_tables.php', $tables);
		return $zip_list;
	}

  	/*整站备份*/
  	function doallfile(){
	    global $_M;

	    $this->dogetsql();

	    $web_path = PATH_WEB;

	    $web_back_path = PATH_WEB.ADMIN_FILE.'/databack/web';
	    $web_zip = $web_back_path.'/'.$_M['config']['met_agents_backup'].'_web_'.$con_db_name.'_'.date('YmdHis',time()).'_'.met_rand(6).'.zip';
		if(!file_exists($web_back_path)){
			mkdir($web_back_path,0777,true);
		}

		if(class_exists('ZipArchive'))
		{
			load::sys_func('file');
			$zip = new ZipArchive();
			$status = $zip->open($web_zip,ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);

			if(!$status){
				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['setdbArchiveNo']);
			}

			file_zip($web_path, $zip);
			$zip->close();
		}else{
			$archive = new PclZip($web_zip);
			$zip_list = $archive->create($web_path,PCLZIP_OPT_REMOVE_PATH,$web_path);
			if ($zip_list == 0) {

				turnover("{$_M['url']['own_form']}a=doindex",$_M['word']['setdbArchiveNo'].$archive->errorInfo(true));
			}
		}
		echo "<script type=\"text/javascript\">document.getElementById('tips').style.display = 'none';</script>";
		turnover("{$_M['url']['own_form']}a=dodownload",$_M['word']['setdbArchiveOK']);
	}

	/*删除备份文件*/
	public function dodelete(){
	    global $_M;
	    if(substr_count(trim($_M[form][filenames]),'../'))die('met2');
		if(trim(substr(strrchr($_M[form][filenames], '.'), 1))=='zip'){
			@unlink(PATH_WEB.ADMIN_FILE.'/databack/'.$_M[form][fileon].'/'.$_M[form][filenames]);
			turnover("{$_M[url][own_form]}a=dodownload",$_M[word][physicaldelok]);
		}else{
			$prefix=$_M[form][filenames];
			$sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/*.sql');
			foreach($sqlfiles as $id=>$sqlfile){
				$sqlfile=str_ireplace(PATH_WEB.ADMIN_FILE.'/databack/','',$sqlfile);
				if(stripos($sqlfile,$prefix)!==false){
					$filetype=trim(substr(strrchr($sqlfile, '.'), 1));
					if($filetype=='sql'){
						$filenamearray=explode(".sql",$sqlfile);
						@unlink(PATH_WEB.ADMIN_FILE.'/databack/'.$sqlfile);
						@unlink(PATH_WEB.ADMIN_FILE.'/databack/sql/'.$_M[config][met_agents_backup].'_'.$filenamearray[0].".zip");
					}
				}
			}
		}
		turnover("{$_M[url][own_form]}a=dorecovery",$_M[word][physicaldelok]);
	}

	/*获取文件后缀*/
	public function dogetfilefix(){
		 global $_M;
		 $sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/sql/*.zip');
		 if(is_array($sqlfiles)){
			 $prepre = '';
			 $info = $infos = array();
			 foreach($sqlfiles as $id=>$sqlfile){
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
				 $info['typename']=$_M[word][database];
				 $info['type']='sql';
				 $infosql[] = $info;
				 $metinfodata[]=$info;
			 }
		 }
		 $sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/config/*.zip');
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
				 $info['typename']=$_M[word][physicalfile4];
				 $info['type']='config';
				 $infoconfig[] = $info;
				 $metinfodata[]=$info;
			 }
		 }
/*upload*/
		 $sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/upload/*.zip');
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
				 $info['typename']=$_M[word][uploadfile];
				 $info['type']='upload';
				 $infoupload[] = $info;
				 $metinfodata[]=$info;
			 }
		 }
/*all files*/
		 $sqlfiles = glob(PATH_WEB.ADMIN_FILE.'/databack/web/*.zip');
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
				 $info['typename']=$_M[word][webcompre];
				 $info['type']='web';
				 $infoweb[] = $info;
				 $metinfodata[]=$info;
			 }
		 }
		foreach($metinfodata as $key=>$val){
			$val['time']=strtotime($val['maketime']);
			$metinfodata1[]=$val;
		}
		$metinfodata=$this->array_sort($metinfodata1,'time','we');
		return $metinfodata;
	}

	/*备份文件下载*/
	public function dodownload(){
		 global $_M,$adminurl;
		 nav::select_nav(3);
		 $metinfodata=$this->dogetfilefix();
		 $_M['url']['help_tutorials_helpid']='115#下载备份数据';
		 require_once $this->template('own/filedown');
	}

	/*生成zip*/
	public function docreatezip(){
	     global $_M,$adminurl;
	     $filenames=$_M[form][filenames];
	     if($filenames){
			 $filenum=1;
			 while(file_exists($adminurl.'/databack/'.$filenames.$filenum.'.sql')){
				$sqlfiles[]=$adminurl.'/databack/sql/'.$_M[config][met_agents_backup].'_'.$filenames.$filenum.'.zip';
				if(!file_exists($adminurl.'/databack/sql/'.$_M[config][met_agents_backup].'_'.$filenames.$filenum.'.zip')){
					if(!file_exists($adminurl.'/databack/sql'))@mkdir ($adminurl.'/databack/sql', 0777);
					$sqlzip=$adminurl.'/databack/sql/'.$_M[config][met_agents_backup].'_'.$filenames.$filenum.'.zip';
					$archive = new PclZip($sqlzip);
					$zip_list = $archive->create($adminurl.'/databack/'.$filenames.$filenum.'.sql',PCLZIP_OPT_REMOVE_PATH,$adminurl.'/databack/');
					if($zip_list == 0){
						die("Error : ".$archive->errorInfo(true));
					}
				}
				$filenum++;
			 }
			 if(is_array($sqlfiles)){
				 $prepre = '';
				 $info = $infos = array();
				 foreach($sqlfiles as $id=>$sqlfile){
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
					 $info['typename']=$lang_database;
					 $info['type']='sql';
					 $infosql[] = $info;
					 $metinfodata[]=$info;
				}
			}

	       	turnover("{$_M[url][own_form]}a=dodownload",'');
		}
	}

	/*自定义数据库*/
  	public  function doselecttable(){
	  	global $_M,$adminurl;
	  	nav::select_nav(1);
	  	$size = $bktables = $bkresults = $results= array();
		$k = 0;
		$totalsize = 0;
		$db_settings = parse_ini_file(PATH_CONFIG.'config_db.php');
	    @extract($db_settings);
		$query = DB::query("SHOW TABLES FROM ".$con_db_name);
		while($r = DB::fetch_row($query)){
			if(strstr($r[0], $tablepre)){
				$tables[$k] = $r[0];
				$count = DB::get_one("SELECT count(*) as number FROM $r[0] WHERE 1");
				$results[$k] = $count['number'];
				$bktables[$k] = $r[0];
				$bkresults[$k] = $count['number'];
				$q = DB::query("OPTIMIZE TABLE $r[0]");
				$q = DB::query("SHOW TABLE STATUS FROM `".$con_db_name."` LIKE '".$r[0]."'");
				$s = DB::fetch_array($q);
				$size[$k] = round($s['Data_length']/1024/1024, 2);
				$totalsize += $size[$k];
				$k++;
			}
		}
	  	require_once $this->template('own/table');
  	}

	/*打包自定义数据表*/
  	public function dopacktable(){
	    global $_M;
	    $this->dogetsql($_M[form][tables]);
	    turnover("{$_M[url][own_form]}a=dodownload",$_M[word][setdbBackupOK]);
  	}

    /**
     * 恢复栏目文件
     */
    public function dorecover_column()
    {
        global $_M;
        $columnclass = load::mod_class('column/column_op', 'new');
        $columnclass->do_recover_column_files();

    }

    /**
     * 不插入app文件不存在的applist记录
     */
    public function docheckapplsit(){
        global $_M;

        $query = "SELECT `m_name` FROM {$_M['table'][applist]}";
        $applist = DB::get_all($query);
        #dump($applist);

        $file = scandir(PATH_WEB.'app/app');
        $appdir = array();
        $no_include = array('.', '..');
        foreach ($file as $val) {
            if(!in_array($val,$no_include)){
                if (is_dir(PATH_WEB . "app/app/" . $val)) {
                    $appdir[] = $val;
                }
            }
        }

        foreach ($applist as $app) {
            if(!in_array($app['m_name'],$appdir)){
                $query = "DELETE FROM {$_M['table']['applist']} WHERE `m_name`= '{$app['m_name']}'";
                DB::query($query);
            }
        }
    }

    /**
     * 清除官方商城登录信息
     */
    public function metshot_logout(){
        global $_M;
        $query = "UPDATE {$_M['table']['config']} SET `value`= '' WHERE `name`= 'met_secret_key'";
        DB::query($query);
    }

    //zip递归添加文件
    function addFileToZip($path,$zip){
        $handler=opendir($path); //打开当前文件夹由$path指定。
        while(($filename=readdir($handler))!==false){
            if($filename != "." && $filename != ".." ){//文件夹文件名字为'.'和‘..'，不要对他们进行操作
                if(is_dir($path."/".$filename)){// 如果读取的某个对象是文件夹，则递归
                    $zip->addEmptyDir(str_replace(PATH_WEB,'web/',$path."/".$filename));
                    $this->addFileToZip($path."/".$filename, $zip);
                }else{ //将文件加入zip对象
                    $zip->addFile($path."/".$filename,str_replace(PATH_WEB,'web/',$path."/".$filename));
                    #$zip->addFile($path."/".$filename);
                }
            }
        }
        @closedir($path);
        return 1;
    }

}