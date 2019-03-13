<?php
defined('IN_MET') or exit('No permission');
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_func('file');

class index extends admin {
    public function __construct() {
        global $_M;
        parent::__construct();
        $query="select * from {$_M[table][language]} where lang='{$_M[form][langset]}' and site = 1";
		$langwordlist=DB::get_all($query);
		foreach ($langwordlist as $key => $value) {
			$_M[word][$value[name]]=$value[value];
		}
        $this->jmail = load::sys_class('jmail', 'new');
    }

    public function doindex(){
    	global $_M;
    	$lang=$_M[form][lang];
    	$abt_type=$_M[form][abt_type];
    	$admin_mobile=$_M[form][admin_mobile];
		if(!is_numeric($abt_type)&&$abt_type!='')die();
		if($_M[form][p]){
			   $this->dogetpassword();
		}
	
	  $description=$_M[word][password1];
    	 require_once $this->template('own/index');
    }

    function generate_password($length) {
	    $chars = "ABCDEFGHIJKMNPQRSTUVWXYZabcdefghigkmnpqrstuvwxyz0123456789";
	    $password = '';
	    for ( $i = 0; $i < $length; $i++ ) {
	        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	    }
	    return $password;
	}

	public function dogetpassword(){
		global $_M;
		$lang=$_M[form][lang];
    	$abt_type=$_M[form][abt_type];
    	$admin_mobile=$_M[form][admin_mobile];
    	$action=$_M[form][action];
    	$cnde=$_M[form][cnde];
    	$password=$_M[form][password];
    	$passwordsr=$_M[form][passwordsr];
    	$_M['config']['met_webkeys'] = trim(file_get_contents(PATH_WEB.'/config/config_safe.php'));
        $_M['config']['met_webkeys'] = str_replace('<?php/*', '', $_M['config']['met_webkeys']);
        $_M['config']['met_webkeys'] = str_replace('*/?>', '', $_M['config']['met_webkeys']);
        if($_M[form][p]){
		   $array = explode('.',authcode($_M[form][p],'DECODE', $_M['config']['met_webkeys']));
		   $array[0]=daddslashes($array[0]);
		   $sql="SELECT * FROM {$_M[table][admin_table]} WHERE admin_id='".$array[0]."'";
		   $sqlarray = DB::get_one($sql);

		   $passwords=$sqlarray[admin_pass];
		   $checkCode = md5($array[0].'+'.$passwords);
		   if($array[1]!=$checkCode){
		        okinfo("{$_M[url][own_form]}a=doindex",$_M[word][dataerror]);
		   }
		   if(!$_M[form][action]){
			   $action='next3';
			   $abt_type=2;
			   $nbers[1]=$sqlarray[admin_id];
			   //$this->dogetpassword();
		   }
		}
	switch($action){
	case 'next1':
		if($abt_type==1){
			$description=$_M[word][password2];
			$title=$_M[word][password3];
		}else{
			$description=$_M[word][password4];
			$title=$_M[word][password5];
		}
	break;
	case 'next2':


		if($abt_type==1){
			die();
			if($met_smspass){
				$admin_list = DB::get_one("SELECT * FROM {$_M[table][admin_table]} WHERE admin_id='$admin_mobile' and usertype='3'");
				if($admin_list && $admin_list['admin_mobile']=='')okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password6]);
				if(!$admin_list){
					if(!preg_match("/^((\(\d{2,3}\))|(\d{3}\-))?1(3|5|8|9)\d{9}$/",$admin_mobile))okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password7]);
					$admin_list = DB::get_one("SELECT * FROM {$_M[table][admin_table]} WHERE admin_mobile='$admin_mobile' and usertype='3'");
					if(!$admin_list)okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password8]);
				}
				$code=generate_password(6);
				$nber=generate_password(2);
				$cnde=$code.'-'.$nber.'-'.$admin_list['admin_id'];
				/*发送短信*/
				require_once ROOTPATH.'include/export.func.php';
				$domain = strdomain($_M[config][met_weburl]);
				$message="{$_M[word][password9]}{$code}{$_M[word][password10]}{$nber}[{$domain}]";
				$smsok=sendsms($admin_list['admin_mobile'],$message,5);
				if($smsok=='SUCCESS'){
					$mobile = substr($admin_list['admin_mobile'],0,3).'****'.substr($admin_list['admin_mobile'],7,10);
					$description=$_M[word][password11].'<br/><span class="color999">'.$_M[word][password12].'</span>';
					$query = "delete from $met_otherinfo where lang = 'met_cnde'";				  
					DB::query($query);
					/*写入数据库*/
					$query = "INSERT INTO {$_M[table][otherinfo]} SET 
						authpass = '$cnde',
						lang     = 'met_cnde'";				  
					DB::query($query);
				}else{
					okinfo('getpassword.php',sedsmserrtype($smsok));
				}
			}else{
				okinfo('getpassword.php',$_M[word][password13]);
			}
		}else{
			$admin_list = DB::get_one("SELECT * FROM {$_M[table][admin_table]} WHERE admin_id='$admin_mobile' and usertype='3'");
			if($admin_list && $admin_list['admin_email']=='')okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password14]);
			if(!$admin_list){
				if(!is_email($admin_mobile))okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password7]);
				$admin_list = DB::get_one("SELECT * FROM {$_M[table][admin_table]} WHERE admin_email='$admin_mobile' and usertype='3'");
				if(!$admin_list)okinfo("{$_M[url][own_form]}a=doindex&langset={$_M[form][langset]}",$_M[word][password14]);
			}
			if($admin_list){
				$met_fd_usename=$_M[config][met_fd_usename];
				$met_fd_fromname=$_M[config][met_fd_fromname];
				$met_fd_password=$_M[config][met_fd_password];
				$met_fd_smtp=$_M[config][met_fd_smtp];
				$met_webname=$_M[config][met_webname];
				$met_weburl=$_M[config][met_weburl];
				$adminfile=$url_array[count($url_array)-2];
				$from=$_M[config][met_fd_usename];
				$fromname=$_M[config][met_fd_fromname];
				$to=$admin_list['admin_email'];
				$usename=$_M[config][met_fd_usename];
				$usepassword=$_M[config][met_fd_password];
				$smtp=$_M[config][met_fd_smtp];
				$title=$_M[config][met_webname].$_M[word][getNotice];
				$x = md5($admin_list[admin_id].'+'.$admin_list[admin_pass]);
				$outime=3600*24*3;
				$String=authcode($admin_list[admin_id].".".$x,'ENCODE', $_M[config][met_webkeys], $outime);
				$String=urlencode($String);
				$mailurl= $_M[url][own_form].'a=doindex&langset='.$_M[form][langset].'&p='.$String;
				$body ="<style type='text/css'>\n";
				$body .="#metinfo{ padding:10px; color:#555; font-size:12px; line-height:1.8;}\n";
				$body .="#metinfo .logo{ border-bottom:1px dotted #333; padding-bottom:5px;}\n";
				$body .="#metinfo .logo img{ border:none;}\n";
				$body .="#metinfo .logo a{ display:block;}\n";
				$body .="#metinfo .text{ border-bottom:1px dotted #333; padding:5px 0px;}\n";
				$body .="#metinfo .text p{ margin-bottom:5px;}\n";
				$body .="#metinfo .text a{ color:#70940E;}\n";
				$body .="#metinfo .copy{ color:#BBB; padding:5px 0px;}\n";
				$body .="#metinfo .copy a{ color:#BBB; text-decoration:none; }\n";
				$body .="#metinfo .copy a:hover{ text-decoration:underline; }\n";
				$body .="#metinfo .copy b{ font-weight:normal; }\n";
				$body .="</style>\n";
				$body .="<div id='metinfo'>\n";
				if($_M[config][met_agents_type]<=1){
					$body .="<div class='logo'><a href='{$_M[config][met_weburl]}' title='{$_M[config][met_webname]}'><img src='http://www.metinfo.cn/upload/200911/1259148297.gif' /></a></div>";
				}
				$body .="<div class='text'><p>".$_M[word][hello].$admin_name."</p><p>{$_M[word][getTip1]}</p>";
				$body .="<p><a href='$mailurl'>$mailurl</a></p>\n";
				if($met_agents_type<=1){
					$body .="<p>{$_M[word][getTip2]}</p></div><div class='copy'>$foot</a></div>";
				}
				$sendMail= $this->jmail->send_email($to,$title,$body);
				if($sendMail==0){
				  okinfo('javascript:history.back();',$_M[word][getFail]);
				}
				
				$text=$sendMail?$_M[word][getTip3].$_M[word][memberEmail].'：'.$admin_list['admin_email']:$_M[word][getTip4];
				okinfo("./index.php?n=login&c=login&a=doindex&langset={$_M[form][langset]}",$text);
			}
		}
	break;
	case 'next3':


		if($abt_type==1){
			if(!$checkcode)okinfo('javascript:history.back();',$_M[word][password15]);
			$cnde=$checkcode.'-'.$nber;
			$codeok = DB::get_one("SELECT * FROM {$_M[table][otherinfo]} WHERE authpass='$cnde' and lang='met_cnde'");
			$nbers=explode('-',$nber);
			if($codeok){
				$description=$_M[word][password16];
			}else{
				$adminer = DB::get_one("SELECT * FROM {$_M[table][otherinfo]} WHERE authpass like '%$nbers[1]' and lang='met_cnde'");
				$authcode=$adminer[authcode]==''?1:$adminer[authcode]+1;
				if($authcode>5){
					$query = "delete from {$_M[table][otherinfo]} where id='$adminer[id]' and lang='met_cnde'";
					DB::query($query);
					okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password17]);
					die;
				}else{
					$query="update {$_M[table][otherinfo]} set
					   authcode='$authcode'
					   where id='$adminer[id]'";
					DB::query($query);
					okinfo('javascript:history.back();',$_M[word][password18]);
				}
			}
		}else{
			$description=$_M[word][password16];
		}
	break;
	case 'next4':
		if($abt_type==1){
			$codeok = DB::get_one("SELECT * FROM {$_M[table][otherinfo]} WHERE authpass='$cnde' and lang='met_cnde'");
			$cndes=explode('-',$cnde);
			if($codeok){
				if($password=='')okinfo('javascript:history.back();',$_M[word][dataerror]);
				if($passwordsr!=$password)okinfo('javascript:history.back();',$_M[word][js6]);
				$password = md5($password);
				$query="update {$_M[table][admin_table]} set
				   admin_pass='$password'
				   where admin_id='$cndes[2]'";
				  
				DB::query($query);
				$query = "delete from {$_M[table][otherinfo]} where authpass='$cnde' and lang='met_cnde'";
				DB::query($query);
				okinfo('./index.php',$_M[word][jsok]);
			}else{
				okinfo("{$_M[url][own_form]}a=doindex",$_M[word][password19]);
			}	
		}else{
			if($password=='')okinfo('javascript:history.back();',$_M[word][dataerror]);
			if($passwordsr!=$password)okinfo('javascript:history.back();',$_M[word][js6]);
			$password = md5($password);
			if(!$_M[form][p])die();
			$array = explode('.',authcode($_M[form][p],'DECODE', $_M[config][met_webkeys]));
			$array[0]=daddslashes($array[0]);
			$query="update {$_M[table][admin_table]} set
			   admin_pass='$password'
			   where admin_id='$array[0]'";
			DB::query($query);
			okinfo("./index.php?n=login&c=login&a=doindex&langset={$_M[form][langset]}",$_M[word][jsok]);
		}
	break;
	default :
		if($action!=''){
			die();
		}
	break;	
}
 require_once $this->template('own/index');
	}
	public function check() {

	}

}