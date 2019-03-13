<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../include/common.inc.php';

if($action=="add"){
     if($met_memberlogin_code==1){
         require_once 'captcha.class.php';
         $Captcha= new  Captcha();
         if(!$Captcha->CheckCode($code)){
         echo("<script type='text/javascript'> alert('$lang_membercode');window.history.back();</script>");
		       exit;
         }
     }
$ip=$m_user_ip;
$addtime=$m_now_date;
$ipok=$db->get_one("select * from $met_cv where ip='$ip' order by addtime desc");
if($ipok)
$time1 = strtotime($ipok[addtime]);
else
$time1 = 0;
$time2 = strtotime($m_now_date);
$timeok= (float)($time2-$time1);
if($timeok<=120){
$fd_time="{$lang_Feedback1} 120 {$lang_Feedback2}";
okinfo('javascript:history.back();',$fd_time);
}
$query = "SELECT * FROM $met_parameter where lang='$lang' and module=6 order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
 if($list[type]==4){
  $query1 = " where lang='$lang' and bigid='".$list[id]."'";
  $total_list[$list[id]] = $db->counter($met_list, "$query1", "*");
  } 
$list[para]="para".$list[id];
$cv_para[]=$list;
}
	 
require_once 'uploadfile_save.php';
$customerid=$metinfo_member_name!=''?$metinfo_member_name:0;
$query = "INSERT INTO $met_cv SET addtime = '$m_now_date', customerid = '$customerid',jobid=$jobid,lang='$lang',ip='$ip' ";
$db->query($query);
$later_cv=$db->get_one("select * from $met_cv where lang='$lang' order by addtime desc");
$id=$later_cv[id];
foreach($cv_para as $key=>$val){
    if($val[type]!=4){
	  $para=$$val[para];
	}else{
	  $para="";
	  for($i=1;$i<=$total_list[$val[id]];$i++){
	  $para1="para".$val[id]."_".$i;
	  $para2=$$para1;
	  $para=($para2<>"")?$para.$para2."-":$para;
	  }
	  $para=substr($para, 0, -1);
	}
	$para=htmlspecialchars($para);
    $query = "INSERT INTO $met_plist SET
                      listid   ='$id',
					  paraid   ='$val[id]',
					  info     ='$para',
					  module   ='6',
					  lang     ='$lang'";
         $db->query($query);
 }
$backurl=$metinfo_member_name==""?'../':'../member/'.$member_index_url;					  
okinfo($backurl,$lang_js21);
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
