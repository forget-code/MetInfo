<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class job extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
		$this->upfile = load::sys_class('upfile', 'new');
		$this->database = load::mod_class('job/job_database', 'new');
	}


  public function dojob() {
		global $_M;
		if($_M['form']['pseudo_jump'] && $_M['form']['list']!=1){
			$_M['form']['id'] = $_M['form']['metid'];
			$this->doshowjob();
		}
		$classnow = $this->input_class();
		$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$this->seo($data['name'], $data['keywords'], $data['description']);
		$this->seo_title($data['ctitle']);
		$this->add_input('page', $_M['form']['page']);
		$this->add_input('list', 1);
		require_once $this->template('tem/job');
  }

	public function dosave() {
		global $_M;
		$this->check_field();
		$info = $_M['form'];
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
				    okinfo('javascript:history.back();',$_M[word][opfailed]);
				}
			}
		}
	}

    $ip=$this->getip();
	if(load::sys_class('label', 'new')->get('job')->insert_cv($_M['form']['jobid'], $info, $user['customerid'],$ip)){
         $this->notice_by_emial($info);
         if($_M[config][met_nurse_job]){
         	$this->notice_by_sms();
         }
	}else{
		 $this->notice_by_emial($info);
	}

	setcookie('submit',time());
	okinfo(HTTP_REFERER, $_M['word']['success']);

	}

	public function doshowjob(){
		global $_M;
		$this->input_class();
		$data = load::sys_class('label', 'new')->get('job')->get_one_list_contents($_M['form']['id']);
		$this->add_array_input($data);
		require_once $this->template('tem/showjob');
	}

	public function docvjob(){
		global $_M;
		$classnow = $this->input_class();
		$this->add_input('selectedjob', $_M['form']['selectedjob']);
		$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$this->seo($_M['word']['cvtitle'], $data['keywords'], $data['description']);
		$this->seo_title($data['ctitle']);
		require_once $this->template('tem/cv');
	}
/*字段关键词过滤*/
	public function checkword(){
		global $_M;
		$keyword=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and  name= 'met_fd_word' and columnid = 0");
		$_M[config][met_fd_word]=$keyword[value];
		$cvarray=explode("|",$_M[config][met_fd_word]);
		$cvarrayno=count($cvarray);
		$paralist = load::mod_class('parameter/parameter_list', 'new')->get_parameter($_M['form']['lang'],6);
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
		#$cv_word="工作简历中不能包含 [{$cv_word}]";
		$cv_word="{$_M[word][job_tips1_v6]} [{$cv_word}]";
		if($cvok==true){
			okinfo('javascript:history.back();',$cv_word);
		}else{
			return true;
		}

	}
 /*表单提交时间检测*/
	public function checktime(){
		global $_M;
		$ip=$this->getip();
		$addtime=time();
		$ipok=DB::get_one("select * from {$_M[table][cv]} where ip='$ip' order by addtime desc");
		if($ipok){
		   $time1 = strtotime($ipok[addtime]);
		}else{
		   $time1 = 0;
		}
		$time2 = time();
		$timeok= (float)($time2-$time1);
		$timeok2=(float)($time2-$_COOKIE['submit']);
		if($timeok<=$_M[config][met_cv_time]&&$timeok2<=$_M[config][met_cv_time]){
		$fd_time="{$_M[word][Feedback1]}".$_M[config][met_cv_time]."{$_M[word][Feedback2]}";
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
	public function notice_by_emial($info){
        global $_M;
       //$job_list =DB::get_one("SELECT * FROM {$_M[table][job]} WHERE id='{$_M[form][jobid]}'");
        $job_list = $this->database->get_list_one_by_id($_M['form']['jobid']);
        //$job_list[position])
	    $from=$_M[config][met_fd_usename];
	    $fromname=$_M[config][met_fd_fromname];
	    $to=$_M[config][met_cv_emtype]?($job_list[email]!=''?$job_list[email]:$_M[config][met_cv_to]):$_M[config][met_cv_to];
	    $usename=$_M[config][met_fd_usename];
	    $usepassword=$_M[config][met_fd_password];
	    $smtp=$_M[config][met_fd_smtp];
	    $title=$_M[word][cv2].$job_list[position].'('.$_M[config][met_weburl].')';
		$body = '<style type="text/css">'."\n";
		$body .= 'table.metinfo_cv{ width:500px; border:1px solid #999; margin:10px auto; color:#555; font-size:12px; line-height:1.8;}'."\n";
		$body .= 'table.metinfo_cv td.title{ background:#999; font-size:14px; text-align:center; padding:2px 5px; font-weight:bold; color:#fff;}'."\n";
		$body .= 'table.metinfo_cv td.l{ width:20%; background:#f4f4f4; text-align:right; padding:2px 5px; font-weight:bold;}'."\n";
		$body .= 'table.metinfo_cv td.r{ background:#fff; text-align:left; padding:2px 5px; }'."\n";
		$body .= 'table.metinfo_cv td.pc{ text-align:right; width:25%; padding:0px;}'."\n";
		$body .= 'table.metinfo_cv td.pc img{ border:1px solid #999; padding:1px; margin:3px;}'."\n";
		$body .= 'table.metinfo_cv td.footer{ text-align:center; padding:0px; font-size:11px; color:#666; background:#f4f4f4; border-top:1px dotted #999;}'."\n";
		$body .= 'table.metinfo_cv td.footer a{  color:#666; }'."\n";
		$body .= '</style>'."\n";
		$body .= '<table cellspacing="1" cellpadding="2" class="metinfo_cv">'."\n";
		$body_title=$cv_para[0][para];
		$body_title=$_M[form][$body_title];
		$body .= '<tr><td class="title" colspan="3">'.$_M[word][memberCV].'</td></tr>'."\n";
		$j=0;
		$cv_para = load::mod_class('parameter/parameter_list', 'new')->get_parameter($_M['form']['lang'],6);
	    $usename=$_M[form]['para'.$cv_para[0][id]];

		if($_M[config][met_cv_image]){
		foreach($cv_para as $key=>$val){
		    if($val[id]==$_M[config][met_cv_image]){

			    $imgurl = $info['para'.$val[id]];

				break;
			}
		}
		$imgurl=explode('../',$imgurl);
		}
		$bt=$imgurl[1]!=''?'<td class="pc" rowspan="5">'.'<img src="'.$_M[config][met_weburl].$imgurl[1].'" width="140" height="160" /></td>':'';

		foreach($cv_para as $key=>$val){
			$j++;
			if($j>1)$bt = '';
			    if($val['type']!=4){
				  $para=$_M[form][$val[para]];
				}else{

				  $para="";
				  $para_arr = array();
				  $para_total = count(json_decode($val['options'],true));
				  for($i=1;$i<=$para_total;$i++){

				  $para_key="para".$val['id'].'_'.$i;
				  $para_arr[] = $_M['form'][$para_key];
				  }
				  if($para_arr){
				  	$_M[form]['para'.$val[id]] = implode(',', $para_arr);
				  }else{
				  	$_M[form]['para'.$val[id]] = '';
				  }

				}
				$para=strip_tags($para);
	if($val[type]!=5){

	$body=$body.'<tr><td class="l">'.$val[name].'</td><td class="r">'.$_M[form]['para'.$val[id]].'</td>'.$bt.'</tr>'."\n";
	}else{
	if($_M[config][met_cv_image]!=$val[id]){
	$para=explode('../',$para);
	$para=$para[1]<>""?"<a href=".$_M[config][met_weburl].$para[1]." trage='_blank' style='color:#f00;' >".$_M[word][Download]."</a>":$_M[word][Emptyno];
	$body=$body.'<tr><td class="l">'.$val[name].'</td><td class="r">'.$_M[form]['para'.$val[id]].'</td>'.$bt.'</tr>'."\n";
	}else{
		$body=$body.'<tr><td class="l">'.$val[name].'</td><td class="r">'.$_M[form]['para'.$val[id]].'</td>'.$bt.'</tr>'."\n";
	}
	}
	}
	$body.='</table>';
	$cvto="para".$_M[config][met_cv_email];
    $cvto=$_M[form][$cvto];
    $title="[{$job_list[position]}]-{$usename}";
    $mail=load::sys_class('jmail','new');

    if($_M[config][met_cv_type]==2 || $_M[config][met_cv_type]==0){
    	$mail->send_email($to,$title,$body);
    }

     if($_M[config][met_cv_back]==1){
			$mail->send_email($cvto,$_M[config][met_cv_title],$_M[config][met_cv_content]);
		}
	}

   /*通过短信通知*/
   public function notice_by_sms(){
      global $_M;
      $job_list =DB::get_one("SELECT * FROM {$_M[table][job]} WHERE id='{$_M[form][jobid]}'");
      $ct=strtotime(date("Y/m/d 00:00:00",time()));
	  $et=strtotime(date("Y/m/d 23:59:59",time()));
	  $maxnurse = DB::get_all("SELECT * FROM {$_M[table][sms]} WHERE time>='{$ct}' and time<='{$et}' and type='4' and remark='SUCCESS'");
	  $str       = str_replace("http://","",$_M[config][met_weburl]);
	  $strdomain = explode("/",$str);
	  $domain = $strdomain[0];
	  $met_nurse_job_tel=DB::get_one("select * from {$_M[table][config]} where lang='{$_M[form][lang]}' and name='met_nurse_job_tel' and columnid='{$_M[form][id]}'");
	  $_M[config][met_nurse_job_tel]=$met_nurse_job_tel[value];
      #$message="您网站[{$domain}]收到了新的简历[{$job_list[position]}]，请尽快登录网站后台查看";
       $message="{$_M[word][reMessage1]}[{$domain}]{$_M[word][jobPrompt]}[{$title}]{$_M[word][reMessage2]}";
      load::sys_class('sms', 'new')->sendsms($_M[config][met_nurse_job_tel], $message, 6);

   }

   /*检测后台设置的字段*/
   function check_field(){
        global $_M;
        $met_cv_email=$_M[form]['para'.$_M[config][met_cv_email]];
        $paralist=load::mod_class('parameter/parameter_database','new')->get_parameter('6');
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
    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
