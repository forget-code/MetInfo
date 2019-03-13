<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class feedback extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->upfile = load::sys_class('upfile', 'new');
		load::sys_class('upfile', 'new');
	}


  public function dofeedback() {
		global $_M;
      if($_M['form']['action'] == 'add'){
          $this->check_field();
          $this->add($_M['form']);
      }else{
          $classnow = $this->input_class($_M['form']['id']);
          $this->add_input('id', $classnow);
          if($classnow)$this->load_config($_M['lang'], $classnow);
          $data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
          $this->add_array_input($data);
          $this->check($data['access']);
          unset($data['id']);
          $this->seo($data['name'], $data['keywords'], $data['description']);
          $this->seo_title($data['ctitle']);
          // $this->seo_title($_M['config']['met_fdtable']);
		  $this->add_input('fdtitle',$data['name']);
		  require_once $this->template('tem/feedback');
		}
  }

	public function add($info) {
		global $_M;

		$query="select * from {$_M[table][config]} where name ='met_fd_ok' and columnid='{$_M[form][id]}' and lang='{$_M[form][lang]}'";

		$met_fd_ok=DB::get_one($query);
		$_M[config][met_fd_ok]=$met_fd_ok[value];
		if(!$_M[config][met_fd_ok]){
            okinfo(-1, $_M['word']['Feedback5']);
		}
        if($_M[config][met_memberlogin_code]){
			if(!load::sys_class('pin', 'new')->check_pin($_M['form']['code']) ){
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
				    okinfo('javascript:history.back();',$_M[word][opfailed]);
				}
			}
		}
		$user = $this->get_login_user_info();
		$fromurl= $_M['form']['referer'] ? $_M['form']['referer'] : HTTP_REFERER;
		$ip=getip();

		$feedcfg=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}'and name='met_fd_class' and columnid ='{$_M[form][id]}'");
        $_M[config][met_fd_class]=$feedcfg[value];
		$fdclass2="para".$_M[config][met_fd_class];
		$fdclass=$_M[form][$fdclass2];
		$title=$fdclass." - ".$_M[form][fdtitle];
		$addtime=date('Y-m-d H:i:s',time());
		$met_fd_type=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_type' and columnid = {$_M[form][id]}");
         $_M[config][met_fd_type]= $met_fd_type[value];
		if(load::sys_class('label', 'new')->get('feedback')->insert_feedback($info['id'], $info, $title, $user['username'],$fromurl,$addtime,$ip)){

            $this->notice_by_emial($info,$fromurl,$title,$addtime);

            $this->notice_by_sms($title);
		}
		setcookie('submit',time());
		okinfo(HTTP_REFERER, $_M['word']['Feedback4']);
	}
}

	public function doshowfeedback(){
		global $_M;
		require_once $this->template('tem/showfeedback');
	}

    /*字段关键词过滤*/
	public function checkword(){
		global $_M;
		$keyword=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_word' and columnid = 0");
		$_M[config][met_fd_word]=$keyword[value];
		$cvarray=explode("|",$_M[config][met_fd_word]);
		$cvarrayno=count($cvarray);
		$paralist = load::mod_class('parameter/parameter_list', 'new')->get_parameter($_M['form']['lang'],8);
		$cvok=false;
		foreach($paralist as $key=>$val){
		$para="para".$val[id];
		$content=$content."-".$_M[form][$para];
		}
		for($i=0;$i<$cvarrayno;$i++){
		if(strstr($content, $cvarray[$i])){
		$cvok=true;
		$cv_word=$cvarray[$i];
		break;
		}
	   }
		$cv_word="{$_M[word][Feedback3]} [".$cv_word."] ";
		if($cvok==true){
			okinfo('javascript:history.back();',$cv_word);
		}else{
			return true;
		}

	}
 /*表单提交时间检测*/
	public function checktime(){
		global $_M;
		$ip=getip();
		$addtime=time();
		$ipok=DB::get_one("select * from {$_M[table][feedback]} where ip='$ip' order by addtime desc");
		if($ipok){
		   $time1 = strtotime($ipok[addtime]);
		}else{
		   $time1 = 0;
		}
		$time2 = time();
		$timeok= (float)($time2-$time1);
		$timeok2=(float)($time2-$_COOKIE['submit']);
		$met_fd_time=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_time' and columnid ='{$_M[form][id]}'");
		$_M[config][met_fd_time]=$met_fd_time[value];
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
	public function notice_by_emial($info,$fromurl,$title,$addtime){
        global $_M;
        if(!$_M[form][id]){
           $message=DB::get_one("select * from {$_M[table][column]} where module= 8 and lang ='{$_M[form][lang]}'");
           $_M[form][id]=$message[id];
		}
	    $from=$_M[config][met_fd_usename];
	    $fromname=$_M[config][met_fd_fromname];
	    $to=$_M[config][met_cv_emtype]?($job_list[email]!=''?$job_list[email]:$_M[config][met_fd_to]):$_M[config][met_fd_to];
	    $usename=$_M[config][met_fd_usename];
	    $usepassword=$_M[config][met_fd_password];
	    $smtp=$_M[config][met_fd_smtp];
	    $title=$_M[word][cv2].$job_list[position].'('.$_M[config][met_weburl].')';
	    $fdtitle=$_M[config][met_fd_title];
		$fromurl=$info['referer'];
		$body='';
		$body=$body."<b>{$_M[word][AddTime]}</b>:".$addtime."<br>";
		$body=$body."<b>{$_M[word][SourcePage]}</b>:".$fromurl."<br>";
		$body=$body."<b>IP</b>:".getip()."<br>";
		$j=0;
		$cv_para = load::mod_class('parameter/parameter_list', 'new')->get_parameter($_M['form']['lang'],8,$_M[form][id]);
		if($_M[config][met_cv_image]){
		foreach($cv_para as $key=>$val){
		    if($val[id]==$_M[config][met_cv_image]){
			    $imgurl = $_M[form][$val[para]];
				break;
			}
		}
		$imgurl=explode('../',$imgurl);
		}
		$bt=$imgurl[1]!=''?'<td class="pc" rowspan="5">'.'<img src="'.$_M[config][met_weburl].$imgurl[1].'" width="140" height="160" /></td>':'';
			foreach($cv_para as $key=>$val){
			$j++;
			if($j>1)$bt = '';
			    if($val[type]!=4){
				  $para=$_M[form][$val[para]];
				}else{
				  $para="";
				  for($i=1;$i<=$_M[form][$val[para]];$i++){
				  $para1="para".$val[id];
				  $para2=$_M[form][$para1];
				  $para=($para2!="")?$para.$para2."-":$para;
				  }
				  $para=substr($para, 0, -1);
				}
				$para=strip_tags($para);
		    if($val[type]==4){
		        for($i=1;$i<=count($val[para_list]);$i++){

		        	if($_M[form]['para'.$val[id].'_'.$i]){
		                 $_M[form]['para'.$val[id]]=$_M[form]['para'.$val[id].'_'.$i];
		        	}
				}

		    }
	if($val[type]!=5){
	$body=$body.'<tr><td class="l"><b>'.$val[name].'</b></td><td class="r">:'.$_M[form]['para'.$val[id]].'</td>'.$bt.'</tr>'."\n";
	}else{
	if($_M[config][met_cv_image]!=$val[id]){
	$para=explode('../',$info['para'.$val[id]]);
	$para=$para[1]<>""?"<a href=".$_M[config][met_weburl].$para[1]." trage='_blank' style='color:#f00;' >".$_M[word][Download]."</a>":$_M[word][Emptyno];
	$body=$body.'<tr><td class="l"><b>'.$val[name].'</b></td><td class="r">:'.$para.'</td>'.$bt.'</tr>'."\n";
	}
	}
	$body.='</table>';
	}
	$feedcfg=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_email' and columnid='{$_M[form][id]}'");
	$_M[config][met_fd_email]=$feedcfg[value];

	$met_fd_to=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_to' and columnid='{$_M[form][id]}'");
	$_M[config][met_fd_to]=$met_fd_to[value];

	$cvto="para".$_M[config][met_fd_email];
    $cvto=$_M[form][$cvto];
    $met_fd_back=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_back' and columnid = {$_M[form][id]}");
    $_M[config][met_fd_back]= $met_fd_back[value];
    $met_fd_content=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_content' and columnid = {$_M[form][id]}");
    $_M[config][met_fd_content]= $met_fd_content[value];
    $met_fd_title=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_title' and columnid = {$_M[form][id]}");
    $_M[config][met_fd_title]= $met_fd_title[value];
    $title=$_M[word][newFeedback];
    $mail=load::sys_class('jmail','new');
    if($_M[config][met_fd_type]==0 or $_M[config][met_fd_type]==2){
	    	$mail->send_email($_M[config][met_fd_to],$title,$body);
	}


     if($_M[config][met_fd_back]==1){
		 $mail->send_email($cvto,$_M[config][met_fd_title],$_M[config][met_fd_content]);
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
      #$message="您网站[{$domain}]收到了新的反馈信息[{$title}]，请尽快登录网站后台查看";
      $message="{$_M[word][reMessage1]}[{$domain}]{$_M[word][feedbackPrompt]}[{$title}]{$_M[word][reMessage2]}";
      // load::sys_class('sms', 'new')->sendsms($_M[config][met_nurse_feed_tel], $message, $type = 6);
      }
      $met_fd_sms_dell=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_sms_dell' and columnid='{$_M[form][id]}'");


	  $_M[config][met_fd_sms_dell]=$met_fd_sms_dell[value];
	  $met_fd_sms_content=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_sms_content' and columnid='{$_M[form][id]}'");
	  $_M[config][met_fd_sms_content]=$met_fd_sms_content[value];
	  $tell='para'.$_M[config][met_fd_sms_dell];
	  $tel=$_M[form][$tell];


	  $met_fd_sms_back=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_fd_sms_back' and columnid='{$_M[form][id]}'");
	  $_M[config][met_fd_sms_back]=$met_fd_sms_back[value];


	  if($tel&&$_M[config][met_fd_sms_back]){//短信回复
		   load::sys_class('sms', 'new')->sendsms($tel,$_M[config][met_fd_sms_content],4);
		}

   }

   /*检测后台设置的字段*/
   function check_field(){
        global $_M;
        $feedbackcfg= load::mod_class('feedback/feedback_handle','new')->get_feedback_config($_M[form][id]);
        $met_fd_email=$_M[form]['para'.$feedbackcfg[met_fd_email][value]];
        $met_fd_sms_dell=$_M[form]['para'.$feedbackcfg[met_fd_sms_dell][value]];
        $met_fd_class=$_M[form]['para'.$feedbackcfg[met_fd_class][value]];
        $met_fd_back=$feedbackcfg[met_fd_back][value];
        $paralist=load::mod_class('parameter/parameter_database','new')->get_parameter('8');
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
               // okinfo('javascript:history.back();',$info);
           }
       }
   }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
