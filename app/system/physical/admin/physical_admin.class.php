<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class physical_admin extends base_admin {
	public $moduleclass;
	public $module;
	public $database;
	/**
	 * 初始化
	 */

	function __construct() {
		global $_M;
		parent::__construct();
		$this->module =9;
		$this->database = load::mod_class('link/link_database', 'new');
		$this->tabledata = load::sys_class('tabledata', 'new');
		$this->physical = load::mod_class('physical/physical', 'new');
		//$this->database->construct('new');
	}


   public function doindex(){
   	    global $_M;
   	    $phy=$_M[form][phy];
   	    $physicaldo=array(
				array('id'=>1,'name'=>$_M[word][physicaladmin]),
				array('id'=>2,'name'=>$_M[word][physicalbackup]),
				array('id'=>3,'name'=>$_M[word][physicalupdate]),
				array('id'=>4,'name'=>$_M[word][physicalseo]),
				array('id'=>5,'name'=>$_M[word][physicalstatic]),
				array('id'=>6,'name'=>$_M[word][physicalunread]),
				array('id'=>7,'name'=>$_M[word][physicalspam]),
				array('id'=>8,'name'=>$_M[word][physicalmember]),
				array('id'=>9,'name'=>$_M[word][physicalweb]),
				array('id'=>10,'name'=>$_M[word][physicalfile])
			);
			/*项目1*/
			switch($_M[config][physical_admin]){
				case 0:
					$physicaldo[0]['text']=$_M[word][physicaladmin1];
					$physicaldo[0]['type']=2;/*1为危险项目，2为可优化项目，3为安全项目*/
				break;
				case 1:
					$physicaldo[0]['text']=$_M[word][physicaladmin2];
					$physicaldo[0]['type']=3;
				break;
			}
			/*项目2*/
			switch($_M[config][physical_backup]){
				case -2:
					$physicaldo[1]['text']=$_M[word][physicalbackup1];
					$physicaldo[1]['type']=1;
				break;
				default:
					$timedays=$_M[config][physical_backup];
					if($timedays<=30){
						$physicaldo[1]['text']="{$_M[word][physicalbackup2]}{$timedays} {$_M[word][physicalfiletime3]}";
						$physicaldo[1]['type']=3;
					}else{
						$physicaldo[1]['text']="{$_M[word][physicalbackup2]}{$timedays} {$_M[word][physicalbackup4]}";
						$physicaldo[1]['type']=2;
					}
				break;
			}
			/*项目3*/
			switch($_M[config][physical_update]){
				default:
					$timedays=$_M[config][physical_update];
					if($timedays<=7){
						$physicaldo[2]['text']="{$_M[word][physicalupdate1]}$timedays {$_M[word][physicalfiletime3]}";
						$physicaldo[2]['type']=3;
					}elseif($timedays>7&&$timedays<=30){
						$physicaldo[2]['text']="{$_M[word][physicalupdate2]}({$_M[word][physicalupdate1]}$timedays {$_M[word][physicalfiletime3]})";
						$physicaldo[2]['type']=2;
					}else{
						$physicaldo[2]['text']="{$_M[word][physicalupdate3]}({$_M[word][physicalupdate1]}$timedays {$_M[word][physicalfiletime3]})";
						$physicaldo[2]['type']=1;
					}
				break;
			}
			/*项目4*/
			if(strstr($_M[config][physical_seo],'0')){
				$_M[config][physical_seo]=explode('|',$_M[config][physical_seo]);
				$i=0;
				$physicaldo[3]['text']='';
				foreach($_M[config][physical_seo] as $key=>$val){
				$i++;
					if($val!=''){
						if($val==0){
							if($i==1)$physicaldo[3]['text'].=$_M[word][physicalseo1].'<br/>';
							if($i==2)$physicaldo[3]['text'].=$_M[word][physicalseo2].'<br/>';
							if($i==3)$physicaldo[3]['text'].=$_M[word][physicalseo3];
						}
					}
				}
				$physicaldo[3]['type']=2;
			}else{
				$physicaldo[3]['text']=$_M[word][physicalseo4];
				$physicaldo[3]['type']=3;
			}
			/*项目5*/
			switch($_M[config][physical_static]){
				case 0:
					$physicaldo[4]['text']=$_M[word][physicalstatic1];
					$physicaldo[4]['type']=1;
				break;
				case 1:
					$physicaldo[4]['text']=$_M[word][physicalok];
					$physicaldo[4]['type']=3;
				break;
			}
			/*项目6*/
			switch($_M[config][physical_unread]){
				default:
					$unread=explode('|',$_M[config][physical_unread]);
					if($unread[0]==0 && $unread[1]==0 && $unread[2] ==0){
						$physicaldo[5]['text']="{$_M[word][physicalunread]}：{$_M[word][physicalunread1]} $unread[0] {$_M[word][item]}&nbsp;&nbsp;{$_M[word][physicalunread2]} $unread[1] {$_M[word][item]}&nbsp;&nbsp;{$_M[word][physicalunread3]} $unread[2] {$_M[word][item]}";
						$physicaldo[5]['type']=3;
					}else{
						$physicaldo[5]['text']=$_M[word][physicalnoneed];
						$physicaldo[5]['type']=3;
					}
				break;
			}
			/*项目7*/
			switch($_M[config][physical_spam]){
				case '0':
					$physicaldo[6]['text']=$_M[word][physicalspam1];
					$physicaldo[6]['type']=2;
				break;
				case '1':
					$physicaldo[6]['text']=$_M[word][physicalnoneed];
					$physicaldo[6]['type']=3;
				break;
			}
			/*项目8*/
			switch($_M[config][physical_member]){
				case 0:
					$physicaldo[7]['text']=$_M[word][physicalmember1].$count_member.' '.$_M[word][physicalmember2];
					$physicaldo[7]['type']=2;
				break;
				case 1:
					$physicaldo[7]['text']=$_M[word][physicalnoneed];
					$physicaldo[7]['type']=3;
				break;
			}
			/*项目9*/
			switch($_M[config][physical_web]){
				case 0:
					$physicaldo[8]['text']=$_M[word][physicalweb1];
					$physicaldo[8]['type']=2;
				break;
				case 1:
					$physicaldo[8]['text']=$_M[word][physicalok];
					$physicaldo[8]['type']=3;
				break;
			}
			/*项目10*/
			switch($_M[config][physical_file]){
				case "0":
					$physicaldo[9]['text']=$_M[word][physicalfile1];
					$physicaldo[9]['type']=1;
				break;
				default:
					if($_M[config][physical_file]=="1"){
						$physicaldo[9]['text']=$_M[word][physicalfile2];
						$physicaldo[9]['type']=3;
					}else{
					$fun=explode(',',$_M[config][physical_file]);
					$physical_file=NULL;
					foreach($fun as $key=>$val){
						$val1=explode('|',$val);
						if($val1[1]!=''){
							switch($val1[0]){
								case 1:
									$physical_file .="[{$_M[word][physicalfile3]} - {$val1[1]}] {$_M[word][physicalfile5]} <a href=\"javascript:void(0)\" name=\"download\" onclick=\"return physical_ajax($(this),'$val',2,2);\">{$_M[word][physicalfile7]}</a><br/>";
									break;
								case 2:
									$physical_file .="[{$_M[word][physicalfile3]} - {$val1[1]}] {$_M[word][physicalfile6]} <a href=\"javascript:void(0)\" name=\"download\" onclick=\"return physical_ajax($(this),'$val',2,2);\">{$_M[word][physicalfile7]}</a><br/>";
									break;
								case 3:
									$physical_file .="[{$_M[word][physicalfile4]} - {$val1[1]}] {$_M[word][physicalfile5]} <a name=\"download\">{$_M[word][physicalfile8]}</a><br/>";
								break;
								case 4:
									$physical_file .="[{$_M[word][physicalfile3]} - {$val1[1]}] {$_M[word][physicalfile5]} <a href=\"javascript:void(0)\" name=\"download\" onclick=\"return physical_ajax($(this),'$val',2,3);\">{$_M[word][physicalfile9]}</a><br/>";
									break;
								case 5:
									$physical_file .="[{$_M[word][physicalfile3]} - {$val1[1]}] {$_M[word][physicalfile5]} <a href=\"javascript:void(0)\" name=\"download\" onclick=\"return physical_ajax($(this),'$val',2,3);\">{$_M[word][physicalfile9]}</a><br/>";
									break;
							}
						}
					}
					if($physical_file!='')$physical_file .="<a href=\"javascript:void(0)\" onclick=\"return physical_ajax($(this),'',4,'download');\">{$_M[word][cvall]}{$_M[word][physicalfile7]}</a>";
					$physicaldo[9]['text']=$physical_file;
					$physicaldo[9]['type']=1;
					}
				break;
			}
			$dfnum=0;
			foreach($physicaldo as $key=>$val){
				switch($val['type']){
					case 1:$physical1[]=$val;break;
					case 2:$physical2[]=$val;break;
					case 3:$physical3[]=$val;$dfnum++;break;
				}
			}
			/*体检得分和上次体检时间等*/
			if($_M[config][physical_time]==''){
				$sctimetxt=$_M[word][physicalfileno];
				$defen = 0;
				$notde = 0;
			}else{
				$sctimes = strtotime(date("Y-m-d H:i:s"))-strtotime($_M[config][physical_time]);
				$sctime=floor($sctimes/3600/24);
				$sctimenum=$sctime==0?floor($sctimes/60):$sctime;
				$sctimetxt=$sctime==0?$_M[word][physicalfiletime1]:$_M[word][physicalfiletime3];
				if($sctime==0 && floor($sctimes/60/60)>=1){
					$sctimenum=floor($sctimes/60/60);
					$sctimetxt=$_M[word][physicalfiletime2];
				}
				if($sctime>=7){
					$sctimenum=floor($sctime/7);
					$sctimetxt=$_M[word][physicalfiletime4];
				}
				if($sctime>=30){
					$sctimenum=floor($sctime/30);
					$sctimetxt=$_M[word][physicalfiletime5];
				}
				if($sctime>=365){
					$sctimenum=floor($sctime/365);
					$sctimetxt=$_M[word][physicalfiletime6];
				}
				$defen=$dfnum==10?100:$dfnum*floor(100/10);
				$notde=10-$dfnum;
			}
   	    require_once $this->template('own/physical_index');
   }


   /*网站体检*/

	public function dophysical(){
        global $_M; 
        $lang=$this->lang;
	    $physicaldo[1]=1;
		$physicaldo[2]=1;
		$physicaldo[3]=1;
		$physicaldo[4]=1;
		$physicaldo[5]=1;
		$physicaldo[6]=1;
		$physicaldo[7]=1;
		$physicaldo[8]=1;
		$physicaldo[9]=1;
		$physicaldo[10]=1;
		$physicaldo[11]=1;
		@set_time_limit(0);
		$physical_time=date('Y-m-d H:i:s');
		/*后台文件*/
		$physical_admin="";
		if($physicaldo[1]==1){
			$adminfile=$_M[config][met_adminfile];
			$physical_admin =$adminfile=="admin"?"0":"1";
		}
		$physical_admin=$physical_admin==null?"-1":$physical_admin;
		/*备份*/
		$physical_backup="";
		if($physicaldo[2]==1){
			$sqlfiles = glob(PATH_WEB.$_M[config][met_adminfile].'/databack/*.sql');
			if(is_array($sqlfiles)){
				foreach($sqlfiles as $val){
					$timearray[]= date('Y-m-d H:i:s', filemtime($val));
				}
				arsort($timearray);
				$timearray=array_merge($timearray);
			}
			if($timearray[0]){
				$timenow=strtotime(date('Y-m-d H:i:s'));
				$timebackup=strtotime($timearray[0]);
				$timedifference=$timenow-$timebackup;
				$timedays = intval($timedifference/86400);
				$physical_backup="$timedays";
			
			}
			else{
				$physical_backup=-2;
			}
		}
	
		$physical_backup=$physical_backup==null?"-1":$physical_backup;
		/*网站更新*/
	$physical_update="";
	if($physicaldo[3]==1){
		$updatearray[]=DB::get_one("select max(addtime) as time from {$_M[table][news]} where lang='$lang'");
		$updatearray[]=DB::get_one("select max(addtime) as time from {$_M[table][product]} where lang='$lang'");
		$updatearray[]=DB::get_one("select max(addtime) as time from {$_M[table][download]} where lang='$lang'");
		$updatearray[]=DB::get_one("select max(addtime) as time from {$_M[table][img]} where lang='$lang'");
		arsort($updatearray);
		$updatearray=array_merge($updatearray);
		$updatetime=$updatearray[0]['time'];
		if($updatetime){
			$timenow=strtotime(date('Y-m-d H:i:s'));
			$timebackup=strtotime($updatetime);
			$timedifference=$timenow-$timebackup;
			$timedays = intval($timedifference/86400);
			$physical_update="$timedays";
		}
	}
	$physical_update=$physical_update==null?"-1":$physical_update;
	/*网站关键词*/
	$physical_seo="";
	if($physicaldo[4]==1){
		$physical_seo.=$_M[config][met_keywords]?'1|':'0|';
		$physical_seo.=stristr($_M[config][met_keywords],'，')?'0|':'1|';
		$physical_seo.=$_M[config][met_description]?'1|':'0|';
	}

	/*静态页面*/
	$physical_static="";
	if($physicaldo[5]==1){
		$physical_static=$_M[config][webhtm]!=0&&$_M[config][pseudo]?"0":"1";
	}
	$physical_static=$physical_static==null?"-1":$physical_static;
	/*未读信息*/
	$physical_unread="";
	if($physicaldo[6]==1){
		$feedbackcount=DB::counter($_M[table][feedback]," where readok=0","*");
		$messagecount=DB::counter($_M[table][message]," where readok=0","*");
		$jobcount=DB::counter($_M[table][cv]," where readok=0","*");
		$physical_unread="$feedbackcount|$messagecount|$jobcount";
	}
	$physical_unread=$physical_unread==null?"-1":$physical_unread;
	/*垃圾信息*/
	$physical_spam="";
	if($physicaldo[7]==1){
		$count_spam=0;
		$count_spam+=DB::counter($_M[table][news]," where recycle>0 and lang='$lang'","*");
		$count_spam+=DB::counter($_M[table][product]," where recycle>0 and lang='$lang'","*");
		$count_spam+=DB::counter($_M[table][download]," where recycle>0 and lang='$lang'","*");
		$count_spam+=DB::counter($_M[table][img]," where recycle>0 and lang='$lang'","*");
		$physical_spam=$count_spam==0?"1":"0";
	}
	$physical_spam=$physical_spam==null?"-1":$physical_spam;
	/*会员激活*/
	$physical_member="";
	if($physicaldo[8]==1){
		$count_member=DB::counter($_M[table][news]," where admin_type is null and checkid=0","*");
		$physical_member=$count_member==0?"1":"0";
	}
	$physical_member=$physical_member==null?"-1":$physical_member;
	/*网站网址*/
	$physical_web="";
	if($physicaldo[9]==1){
		$localurl="http://";
		$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
		$localurl=str_replace($met_adminfile."/app/physical/physical.php","",$localurl);
		  if(substr($localurl,-1)!="/"){
              $localurl=$localurl.'/';
		  }
		$physical_web=$localurl==$_M[config][met_weburl]?"1":"0";
	}
	$physical_web=$physical_web==null?"-1":$physical_web;
	/*网站扫描*/
	$physical_file="";
	if($physicaldo[11]==1){
		$post=array('ver'=>$_M[config][metcms_v],'app'=>$applist);
		$result=$this->physical->curl_post($post,60);
		if($this->physical->link_error($result)==1){
			$results=explode('<Met>',$result);
			file_put_contents(PATH_WEB.$_M[config][met_adminfile].'/app/physical/dlappfile.php',$results[1]);
			file_put_contents(PATH_WEB.$_M[config][met_adminfile].'/app/physical/standard.php',$results[0].$results[1]);
		}
		
		if(file_exists(PATH_WEB.$_M[config][met_adminfile].'/app/physical/standard.php')){$physical_file=$this->physical->filescan('../../..',PATH_WEB.$_M[config][met_adminfile].'/app/physical/standard.php');}
		else{$physical_file="0";}
	}
	$physical_file=$physical_file==null?"-1":$physical_file;
	$query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
        $result = DB::query($query);
        while($list_config= DB::fetch_array($result)){
            $settings_arr[]=$list_config;
            $_M[config][$list_config['name']]=$list_config['value'];
            if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
        }
     $columnid=$columnid?$columnid:0;
    foreach($settings_arr as $key=>$val){
	if($val['columnid']==$columnid){
		$name = $val['name'];
		$newvalue1 = stripslashes($$val['name']);
		$newvalue1 = str_replace("'","''",$newvalue1);
		$newvalue = str_replace("\\","\\\\",$newvalue1);
		if($val['value']!=$newvalue1 && $newvalue1){
			$query1 = $columnid?"and columnid='$columnid'":'';
			$query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";
			DB::query($query);
		}
	}
}
	turnover("{$_M[url][own_form]}a=doindex&phy=1",'');

	}



}