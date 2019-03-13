<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class message extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->upfile = load::sys_class('upfile', 'new');
	}



  public function domessage() {
		global $_M;
		if($_M['form']['action'] == 'add'){
			$this->check_field();
			$this->add($_M['form']);

		}else{
			$classnow = $this->input_class();
			$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
			$this->check($data['access']);
			unset($data['id']);
			$this->add_array_input($data);
			$this->seo($data['name'], $data['keywords'], $data['description']);
			$this->seo_title($data['ctitle']);
			$this->add_input('list', 1);
			require_once $this->template('tem/message_index', $this->input);
		}
  }

	public function add($info) {
		global $_M;
		if(!$_M[form][id]){
           $message=DB::get_one("select * from {$_M[table][column]} where module= 7 and lang ='{$_M[form][lang]}'");
           $_M[form][id]=$message[id];
		}
		$met_fd_ok=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_ok' and columnid = '{$_M[form][id]}'");
        $_M[config][met_fd_ok]= $met_fd_ok[value];
		if(!$_M[config][met_fd_ok])okinfo('javascript:history.back();',"{$_M[word][Feedback5]}");
		if($_M[config][met_memberlogin_code]){
			if(!load::sys_class('pin', 'new')->check_pin($_M['form']['code'])){

			 			okinfo(-1, $_M['word']['membercode']);
			}
	    }
		if($this->checkword() && $this->checktime()){

			foreach ($_FILES as $key => $value) {
				if($value[tmp_name]){
	              $ret = $this->upfile->upload($key);//上传文件
	            if ($ret['error'] == 0) {
			      $info[$key]=$ret[path];
				} else {
				    okinfo('javascript:history.back();',$_M[word][opfail]);
				}
			}
		}
		$user = $this->get_login_user_info();
		$addtime=date('Y-m-d H:i:s',time());
		$paralist=load::mod_class('parameter/parameter_list','new')->get_parameter($_M['form']['lang'],7);
		foreach ($paralist as $key => $value) {
			$list[$value[id]]=$value[name];
			$imgname=$value[id].'imgname';
			$info[$imgname]=$value[name];
		}
		foreach ($user as $key => $value) {
		}
		if(load::sys_class('label', 'new')->get('message')->insert_message($info, $value['metinfo_admin_name'],$addtime)){
            $this->notice_by_emial($addtime);
            $this->notice_by_sms($info);
		}
		setcookie('submit',time());
		okinfo(HTTP_REFERER, $_M['word']['MessageInfo2']);
	}
}

	public function doshowmessage(){
		global $_M;
		require_once $this->template('tem/showmessage', $this->input);
	}

	/*字段关键词过滤*/
	public function checkword(){
		global $_M;
		$pname="para".$_M[config][met_message_fd_class];
		$pname=$_M[form][$pname];
		$email="para".$_M[config][met_message_fd_email];
		$email=$_M[form][$email];
		$tel="para".$_M[config][met_message_fd_sms];
		$tel=$_M[form][$tel];
		$info="para".$_M[config][met_message_fd_content];
		$info=$_M[form][$info];
		$pname=strip_tags($pname);
		$email=strip_tags($email);
		$tel=strip_tags($tel);
		$contact=strip_tags($contact);
		$keyword=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_word' and columnid = 0");
		$_M[config][met_fd_word]=$keyword[value];
		$fdstr = $_M[config][met_fd_word];
		$fdarray=explode("|",$fdstr);
		$fdarrayno=count($fdarray);
		$fdok=false;
		$paralist = load::mod_class('parameter/parameter_list', 'new')->get_parameter($_M['form']['lang'],7);
		$cvok=false;
		foreach($paralist as $key=>$val){
		$para="para".$val[id];
		$content=$content."-".$_M[form][$para];
		}
		for($i=0;$i<$fdarrayno;$i++){
		if(strstr($content, $fdarray[$i])){
		$fdok=true;
		$fd_word=$fdarray[$i];
		break;
		}
	   }
		$fd_word="{$_M[word][Feedback3]} [".$fd_word."] ";
		if($fdok==true){
			okinfo('javascript:history.back();',$fd_word);
		}else{
			return true;
		}

	}
 /*表单提交时间检测*/
	public function checktime(){
		global $_M;
		$ip=IP;
		$addtime=time();
		$ipok=DB::get_one("select * from {$_M[table][message]} where ip='$ip' order by addtime desc");
		if($ipok){
		   $time1 = strtotime($ipok[addtime]);
		}else{
		   $time1 = 0;
		}
		$time2 = time();
		$timeok= (float)($time2-$time1);
		$timeok2=(float)($time2-$_COOKIE['submit']);
		if(!$_M[form][id]){
           $message=DB::get_one("select * from {$_M[table][column]} where module= 7 and lang ='{$_M[form][lang]}'");
           $_M[form][id]=$message[id];
		}
		$met_fd_time=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_time' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_time]= $met_fd_time[value];

		if($timeok<=$_M[config][met_fd_time]&&$timeok2<=$_M[config][met_fd_time]){
		$fd_time="{$_M[word][Feedback1]}".$_M[config][met_fd_time]."{$_M[word][Feedback2]}";
		okinfo('javascript:history.back();',$fd_time);
		}else{
            return true;
		}

	}
/*获取表单提交的ip*/
	public function getip(){
		if($_SERVER['HTTP_X_FORWARDED_FOR']){
   	        $m_user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif($_SERVER['HTTP_CLIENT_IP']){
         	$m_user_ip = $_SERVER['HTTP_CLIENT_IP'];
        } else{
	        $m_user_ip = $_SERVER['REMOTE_ADDR'];
         }
       $m_user_ip  = preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}$/',$m_user_ip) ? $m_user_ip : 'Unknown';
       return $m_user_ip;
	}

/*通过邮箱通知*/
	public function notice_by_emial($addtime){
        global $_M;
		$ip=IP;
		$use_id=DB::get_one("SELECT * FROM {$_M[table][message]} WHERE ip='$ip' and addtime='$addtime'");
		$query = "select * from {$_M[table][mlist]} where lang='{$_M[form][lang]}' and module='7' and listid=$use_id[id] order by id";
		//dump($query);
		$result =DB::query($query);
		while($list =DB::fetch_array($result)){
			$email_list[]=$list;
		}
		$body = '';
		foreach($email_list as $val){
			$body.="<b>$val[imgname]</b>:$val[info]<br />";
		}

		$pname="para".$_M[config][met_message_fd_class];
	    $pname=$_M[form][$pname];
		$title=$pname."{$_M[word][message_mailtext_v6]}";
	    $email="para".$_M[config][met_message_fd_email];
		$email=$_M[form][$email];
		if(!$_M[form][id]){
           $message=DB::get_one("select * from {$_M[table][column]} where module= 7 and lang ='{$_M[form][lang]}'");
           $_M[form][id]=$message[id];
		}
		$met_fd_back=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_back' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_back]= $met_fd_back[value];
        $met_fd_title=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_title' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_title]= $met_fd_title[value];
        $met_fd_content=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_content' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_content]= $met_fd_content[value];
        $met_fd_to=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_to' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_to]= $met_fd_to[value];
        $met_fd_email=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_email' and columnid = {$_M[form][id]}");
        $_M[config][met_fd_email]= $met_fd_email[value];


        if($_M[config][met_fd_email]){
	    	load::sys_class('jmail', 'new')->send_email($_M[config][met_fd_to],$title,$body);
	    }
	    if($_M[config][met_fd_back]==1 and $email!=""){
			load::sys_class('jmail', 'new')->send_email($email,$_M[config][met_fd_title],$_M[config][met_fd_content]);
			//($from,$fromname,$cvto,$met_cv_title,$met_cv_content,$usename,$usepassword,$smtp);
		}


	}

    /*通过短信通知*/
   public function notice_by_sms($title){
      global $_M;
      $ct=strtotime(date("Y/m/d 00:00:00",time()));
	  $et=strtotime(date("Y/m/d 23:59:59",time()));
	  $maxnurse = DB::get_all("SELECT * FROM {$_M[table][sms]} WHERE time>='{$ct}' and time<='{$et}' and type='4' and remark='SUCCESS'");
	  if($maxnurse<$_M[config][met_nurse_max]){//短信提醒
	  $str       = str_replace("http://","",$_M[config][met_weburl]);
	  $strdomain = explode("/",$str);
	  $domain = $strdomain[0];

       $met_nurse_massge_tel=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_nurse_massge_tel' and columnid='{$_M[form][id]}'");
	  $_M[config][met_nurse_massge_tel]=$met_nurse_massge_tel[value];
	   $met_message_fd_class=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_message_fd_class' and columnid='{$_M[form][id]}'");
	  $_M[config][met_message_fd_class]=$met_message_fd_class[value];
	   $met_message_fd_sms=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_message_fd_sms' and columnid='{$_M[form][id]}'");
	  $_M[config][met_message_fd_sms]=$met_message_fd_sms[value];
	   $met_fd_sms_content=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_sms_content' and columnid='{$_M[form][id]}'");
	  $_M[config][met_fd_sms_content]=$met_fd_sms_content[value];


	  $query = "SELECT * FROM {$_M['table']['config']} WHERE lang = '{$_M['lang']}' AND name = 'met_fd_sms_back' AND columnid = {$_M['form']['id']}";
	  $sms_config = DB::get_one($query);

      #$message="您网站[{$domain}]收到了新的留言[{$title}]:".utf8substr($info,0,9)."，请尽快登录网站后台查看";
      $message="{$_M[word][reMessage1]}[{$domain}]{$_M[word][messagePrompt]}[{$title}]{$_M[word][reMessage2]}";
      load::sys_class('sms', 'new')->sendsms($_M[config][met_nurse_massge_tel], $message, $type = 6);
      }
      $pname="para".$_M[config][met_message_fd_class];
	  $pname=$_M[form][$pname];
	  $title=$pname."{$_M[word][MessageInfo1]}";
	  $tell='para'.$_M[config][met_message_fd_sms];
	  $tel=$_M[form][$tell];

	  if($tel&&$_M[config][met_message_fd_sms] && $sms_config){//短信回复
		   load::sys_class('sms', 'new')->sendsms($tel,$_M[config][met_fd_sms_content],4);
		}

   }
/*检测后台设置的字段*/
   function check_field(){
        global $_M;
        $messagecfg= load::mod_class('message/message_handle','new')->get_message_config(load::mod_class('message/message_database','new')->get_message_columnid());
        $met_message_fd_class=$_M[form]['para'.$messagecfg[met_message_fd_class][value]];
        $met_message_fd_content=$_M[form]['para'.$messagecfg[met_message_fd_content][value]];
        $met_message_fd_email=$_M[form]['para'.$messagecfg[met_message_fd_email][value]];
        $met_message_fd_sms=$_M[form]['para'.$messagecfg[met_message_fd_sms][value]];
        $met_fd_back=$messagecfg[met_fd_back][value];
        $paralist=load::mod_class('parameter/parameter_database','new')->get_parameter('7');
        foreach ($paralist as $key => $val) {
        	$para[$val[id]]=$val;
        }

       $paraarr = array();
       foreach (array_keys($_M['form']) as $vale) {
           if (strstr($vale, 'para')) {
               if (strstr($vale, '_')) {
                   $arr = explode('_',$vale);
                   $paraarr[] = str_replace('para','',$arr[0]);
               }else{
                   $paraarr[] = str_replace('para','',$vale);
               }
           }
       }

       foreach (array_keys($para) as $val) {
           if($para[$val]['wr_ok']==1 && !in_array($val,$paraarr)){
               $info="【{$para[$val]['name']}】".$_M[word][noempty];
               okinfo('javascript:history.back();',$info);
           }
       }
        //met_message_fd_class  姓名
        //met_message_fd_content 留言内容
        //met_message_fd_email  邮箱
        // met_message_fd_sms 电话
   }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
