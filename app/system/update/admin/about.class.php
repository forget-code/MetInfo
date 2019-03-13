<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class about extends admin {
	public $curl;
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->curl = load::sys_class('curl','new');
	}

	function doindex() {
		global $_M;
		$agens = php_uname('s').' '.php_uname('r');
		$php   = PHP_VERSION;
		$mysql = DB::version();
		$web   = $_SERVER['SERVER_SOFTWARE'];
		$web   = str_replace("PHP/{$php}","",$web);
		$url   = str_replace("http://","",$_M[url][site]);
		if(substr($url,-1,1)=="/")$url   = substr($url,0,strlen($url)-1);
		$ip    = gethostbyname($url);
		$ip    = $ip==$url?'127.0.0.1':$ip;
		$_M['url']['help_tutorials_helpid']='116';
		require $this->template('own/index');
	}

	public function dodown_update()
	{
		global $_M;
		$cms_version = $_M['form']['cms_version'];
		$current = $_M['form']['current'];

		$this->curl->set('host',$_M['config']['met_host_new']);
		$this->curl->set('file',"index.php?n=platform&c=system&a=dodownload_update");
		$data = array(
			'cms_version'=>$cms_version,
			'current'=>$current
		);
		$res = $this->curl->curl_post($data, 30);
		$res = json_decode($res,true);
		if($res['status']){
			$tmp = PATH_WEB.'cache/update';
			if(!file_exists($tmp)){
				if(!mkdir($tmp,0777,true)){
					echo json_encode(array('status'=>0,'msg'=>'cache directory is not allowed to write'));die;
				}
			}

			$update_zip = $tmp.'/'.$cms_version.'.zip';
			$add = file_put_contents($update_zip, base64_decode($res['string']),FILE_APPEND);
			if($add){
				echo json_encode(array('status'=>1,'current'=>$current,'total'=>$res['total']));die;
			}else{
				echo json_encode(array('status'=>0,'msg'=>$update_zip.' write failure'));die;
			}
		}
	}

	public function docheck_update()
	{
		global $_M;

		$this->curl->set('host',$_M['config']['met_host_new']);
		$this->curl->set('file',"index.php?n=platform&c=system&a=docheck_update");
		$data = array(
			'cms_version'=>$_M['config']['metcms_v'],
			'url'=>$_M['url']['site']
		);
		$res = $this->curl->curl_post($data, 30);
		$result = json_decode($res,true);
		if(!$result['status']){
			echo $res;die;
		}


		$new_ver = $result['cms_version'];
		if(version_compare(PHP_VERSION, '5.3') < 0){
			echo json_encode(array('status'=>-2,'cms_version'=>$new_ver));die;
		}

		if(file_exists(PATH_WEB.'cache/update/'.$new_ver.'.zip')){
			echo json_encode(array('status'=>-1,'cms_version'=>$new_ver));die;
		}

		echo $res;die;
	}

	public function dodelete_zip()
	{
		global $_M;
		$cms_version = $_M['form']['cms_version'];
		$zipname = PATH_WEB.'cache/update/'.$cms_version.'.zip';
		if(file_exists($zipname)){
			@unlink($zipname);
		}
	}

	public function doinstall_metcms()
	{
		global $_M;
		$cms_version = $_M['form']['cms_version'];
		$zipname = PATH_WEB.'cache/update/'.$cms_version.'.zip';
		if(!file_exists($zipname)){
			echo json_encode(array('status'=>0,'msg'=>$_M['word']['updatenofile']));die;
		}

		$zip = new ZipArchive;
        if ($zip->open($zipname) === TRUE) {
          $zip->extractTo(PATH_WEB);
          $zip->close();
        } else {
            echo json_encode(array('status'=>0,'msg'=>$_M['word']['updateupzipfileno']));die;
        }

        $install_file = PATH_WEB.'install.class.php';
        if(!file_exists($install_file)){
        	echo json_encode(array('status'=>0,'msg'=>$_M['word']['updateupzipfileno']));die;
        }

        require_once $install_file;
        $install = new install();
        $install->dosql();
        @unlink($install_file);
        echo json_encode(array('status'=>1,'msg'=>$_M['word']['met_template_installok']));die;

	}

	public function doupdate_warning()
	{
		global $_M;
		$this->curl->set('host',$_M['config']['met_host_new']);
		$this->curl->set('file',"index.php?n=platform&c=system&a=doupdate_warning");
		$data = array(
			'cms_version'=>$_M['config']['metcms_v'],
			'url'=>$_M['url']['site']
		);
		$res = $this->curl->curl_post($data, 30);
		echo $res;die;
	}

	public function dodown_warning()
	{
		global $_M;
		$this->curl->set('host',$_M['config']['met_host_new']);
		$this->curl->set('file',"index.php?n=platform&c=system&a=dodown_warning");
		$data = array(
			'cms_version'=>$_M['config']['metcms_v'],
			'url'=>$_M['url']['site']
		);
		$res = $this->curl->curl_post($data, 30);
		echo $res;die;
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>