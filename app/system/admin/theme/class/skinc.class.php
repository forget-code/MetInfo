<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

class skinc{
	public $iniclass;//旧方法类
	public $metinfover;//获取模板引擎版本
	public $configlist;//配置数据
	public $mobile_configlist;//手机版配置数据
	public $metadmin;//模板后台功能
	public $no;//模板编号
	public $lang;//模板语言
	
	function __construct($no, $lang) {
		global $_M;
		$this->no = $no;
		$this->lang = $lang;
		$tmpincfile=PATH_WEB."templates/{$no}/metinfo.inc.php";
		if(file_exists($tmpincfile)){
			require_once $tmpincfile;
		}
		$metinfover = "v1";
		$this->metinfover = $metinfover;
		$this->metadmin = $metadmin;
		//$this->iniclass = load::mod_class('theme/class/oldskinc.class.php','new');
		load::mod_class('theme/class/skininc.class.php');
		$this->iniclass = new skininc($this->no, $this->lang);
		$configlist = array();
		$configlist[] = 'met_skin_user';
		$configlist[] = 'met_logo';
		/*首页*/
		$configlist[] = 'met_skin_css';
		$configlist[] = 'met_index_content';
		$configlist[] = 'flash_10001';
		$configlist[] = 'index_hadd_ok';
		$configlist[] = 'index_news_no';
		$configlist[] = 'index_product_no';
		$configlist[] = 'index_img_no';
		$configlist[] = 'index_download_no';
		$configlist[] = 'index_job_no';
		$configlist[] = 'index_link_ok';
		$configlist[] = 'index_link_img';
		$configlist[] = 'index_link_text';
		/*列表页*/
		$configlist[] = 'met_bannerpagetype';
		$configlist[] = 'met_product_list';
		$configlist[] = 'met_news_list';
		$configlist[] = 'met_download_list';
		$configlist[] = 'met_img_list';
		$configlist[] = 'met_job_list';
		$configlist[] = 'met_message_list';
		$configlist[] = 'met_search_list';
		$configlist[] = 'met_productimg_x';
		$configlist[] = 'met_productimg_y';
		$configlist[] = 'met_imgs_x';
		$configlist[] = 'met_imgs_y';
		$configlist[] = 'met_newsimg_x';
		$configlist[] = 'met_newsimg_y';
		$configlist[] = 'met_product_page';
		$configlist[] = 'met_img_page';
		$configlist[] = 'met_urlblank';
		$configlist[] = 'met_newsdays';
		$configlist[] = 'met_hot';
		$configlist[] = 'met_listtime';
		/*详情页*/
		$configlist[] = 'met_tools_ok';
		$configlist[] = 'met_contenttime';
		$configlist[] = 'met_productdetail_x';
		$configlist[] = 'met_productdetail_y';
		$configlist[] = 'met_imgdetail_x';
		$configlist[] = 'met_imgdetail_y';
		$configlist[] = 'met_pageclick';
		$configlist[] = 'met_pagetime';
		$configlist[] = 'met_pageprint';
		$configlist[] = 'met_pageclose';
		$configlist[] = 'met_pnorder';
		$this->configlist = $configlist;
		$mobile_configlist = array();
		$mobile_configlist[] = 'wap_skin_user';
		$mobile_configlist[] = 'wap_skin_css';
		$mobile_configlist[] = 'met_wap_logo';
		$mobile_configlist[] = 'flash_10001';
		$mobile_configlist[] = 'met_bannerpagetype';
		$mobile_configlist[] = 'wap_news_list';
		$mobile_configlist[] = 'wap_product_list';
		$mobile_configlist[] = 'wap_download_list';
		$mobile_configlist[] = 'wap_img_list';
		$mobile_configlist[] = 'wap_job_list';
		$mobile_configlist[] = 'wap_message_list';
		$mobile_configlist[] = 'wap_search_list';
		$this->mobile_configlist = $mobile_configlist;
	}

	/*整理ini配置数据*/
	function tminiment($pos){
		global $_M;
		$langtextx = $this->iniclass -> tminiment($pos);
		return $langtextx;
	}
	
	/*预览*/
	function tminipreview($have){
		global $_M;
		//新方法
		$langtext = $this->iniclass -> tminiget('all');
		
		$cglist = $this->configlist;
		if($have['mobile']=='1'){
			$have['wap_skin_user'] = $have['met_skin_user'];
			$have['wap_skin_css'] = $have['met_skin_css'];
			$cglist = $this->mobile_configlist;
			$have['met_flash_10001_y'] = $have['met_flash_10001_y']?$have['met_flash_10001_y']:'400';
			$have['flash_10001'] = '1|'.$have['met_flash_10001_y'];
		}else{
			/*备用字段*/
			for($i=1;$i<=10;$i++){
				$preview['otherinfo']['info'.$i] = str_replace("\\","",$have['info'.$i]);
			}
			$preview['otherinfo']['imgurl1'] = $have['imgurl1'];
			$preview['otherinfo']['imgurl2'] = $have['imgurl2'];
			
			
			$have['flash_10001'] = '3|'.$have['met_flash_10001_x'].'|'.$have['met_flash_10001_y'].'|'.$have['met_flash_10001_imgtype'];
		}
		/*系统配置数据*/
		$cglist[] = 'met_productTabok';
		$cglist[] = 'met_productTabname';
		$cglist[] = 'met_productTabname_1';
		$cglist[] = 'met_productTabname_2';
		$cglist[] = 'met_productTabname_3';
		$cglist[] = 'met_productTabname_4';
		foreach($cglist as $key=>$val){
			global $_M;
			$have[$val] = str_replace("\\","",$have[$val]);
			$preview['config'][$val]=$have[$val];
		}
		
		/*模板自定义参数*/
		foreach($langtext as $key=>$val){
			global $_M;
			//if($key!='linetop'){
				$namelist=$val['name']."_metinfo";
				$preview['langini'][$val['name']] = str_replace("\\","",$have[$namelist]);
			//}
		}
		
		/*大图轮播*/
		$have['indexbannerlist'] = str_replace("\\","",$have['indexbannerlist']);
		$preview['banner']['index'] = json_decode($have['indexbannerlist'],true);
		
		/*写入数据表*/
		$value = json_encode($preview);
		$value = str_replace("'","''",$value);
		$value = str_replace("\\","\\\\",$value);
		DB::query("UPDATE {$_M[table][config]} SET value = '{$value}' WHERE name = 'met_theme_preview' AND lang='{$this->lang}'");
		//echo "UPDATE {$_M[table][config]} SET value = '{$value}' WHERE name = 'met_theme_preview' AND lang='{$lang}'";
		//die();
	}
	
	/*保存配置*/
	function tminisave($have){
		global $_M;
        //新方法
        $this->iniclass->tminisave($have);

        $wap_ok = 0;
		$cglist = $this->configlist;
		if($have['mobile']=='1'){
			$have['wap_skin_user'] = $have['met_skin_user'];
			$have['wap_skin_css'] = $have['met_skin_css'];
			$cglist = $this->mobile_configlist;
			//$have['flash_10001'] = $_M['config']['flash_10001'];
			$have['flash_10001'] = '1|'.$have['met_flash_10001_y'];
			$wap_ok = 1;
		}else{
			/*备用字段*/
			$preview['otherinfo']['imgurl1'] = $have['imgurl1'];
			$preview['otherinfo']['imgurl2'] = $have['imgurl2'];
			$query = "update {$_M[table][otherinfo]} SET ";
			for($i=1;$i<=10;$i++){
				$infoval = $have['info'.$i];
				if(isset($have['info'.$i]))$query.="info{$i} = '{$infoval}',";
			}
			$query.="
				imgurl1 = '{$have['imgurl1']}',
				imgurl2 = '{$have['imgurl2']}'
				where id='{$have['otherinfoid']}'
			";
			DB::query($query);
			load::sys_func('file');
			delfile(PATH_WEB."cache/otherinfo_{$this->lang}.inc.php");

            /*dump($_M['form']);
            die();*/

            //轮播图尺寸
            if ($have['met_flash_10001_x'] || $have['met_flash_10001_y'] || $have['met_flash_10001_imgtype']) {
                $have['flash_10001'] = '1|'.$have['met_flash_10001_x'].'|'.$have['met_flash_10001_y'].'|'.$have['met_flash_10001_imgtype'];
            }
		}
		$cglist[] = 'met_productTabok';
		$cglist[] = 'met_productTabname';
		$cglist[] = 'met_productTabname_1';
		$cglist[] = 'met_productTabname_2';
		$cglist[] = 'met_productTabname_3';
		$cglist[] = 'met_productTabname_4';

		configsave($cglist, $have, $this->lang);/*保存系统配置*/

		/*保存banner设置*/
		$nowidold = array();
		$bannerid = DB::get_all("select * from {$_M[table][flash]} where wap_ok='{$wap_ok}' and (module like '%,10001,%' or module = 'metinfo') and lang='{$this->lang}' and img_path!='' order by no_order ");
		foreach($bannerid as $key=>$val){
			$nowidold[] = $val['id'];
		}
		$nowidnew = array();
		$have['indexbannerlist'] = str_replace("\\","",$have['indexbannerlist']);
		
		$bannerlist = json_decode($have['indexbannerlist'],true);
        #dump($_M['form']);
        #die();
		foreach($bannerlist as $key=>$val){
			if($val['img_path']!=''){
				if(!strstr($val['img_path'],"../"))$val['img_path'] = '../'.$val['img_path'];

				if($val['id']){
					// 添加banner属性img_title_color、img_des、img_des_color、img_text_position（新模板框架v2）
					$query = "update {$_M[table][flash]} SET 
					img_path  = '{$val['img_path']}',
					img_link  = '{$val['img_link']}',
					img_title = '{$val['img_title']}',
					img_title_color = '{$val['img_title_color']}',
					img_des = '{$val['img_des']}',
					img_des_color = '{$val['img_des_color']}',
					img_text_position = '{$val['img_text_position']}',
					no_order  = '{$key}'
					WHERE id  = '{$val['id']}'";
					$nowidnew[] = $val['id'];
				}else{
					// 添加banner属性img_title_color、img_des、img_des_color、img_text_position（新模板框架v2）
					$query = "INSERT INTO {$_M[table][flash]} SET 
					img_path  = '{$val['img_path']}',
					img_link  = '{$val['img_link']}',
					img_title = '{$val['img_title']}',
					img_title_color = '{$val['img_title_color']}',
					img_des = '{$val['img_des']}',
					img_des_color = '{$val['img_des_color']}',
					img_text_position = '{$val['img_text_position']}',
					no_order  = '{$key}',
					module    = ',10001,',
					wap_ok    = '{$wap_ok}',
					lang      = '{$this->lang}'";
				}
                DB::query($query);
            }
            #echo $query."<br>";

        }

		$nowid = array_diff($nowidold,$nowidnew);

		if($nowid){
			foreach($nowid as $key=>$val){

				 $query="select module from {$_M[table][flash]} where id='{$val}'";

				   $result=DB::query($query);

				  while ($metinfo=mysql_fetch_array($result)){

				       if($metinfo['module']!='metinfo'){

				 	    $query = "delete from {$_M[table][flash]} where id='{$val}'";

			              DB::query($query);
				
				       }
				  }
				
				
				
			}
		}
		
	}
	/*模板验证*/
	public function check($no) {
		global $_M;
		if($re != 'ok'){
			
		}
	}
	
	/*获取设置*/
	function setlidb(){
		global $_M;

	}

}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>