<?php
# 文件名称:fddetail.php 2009-08-20 16:19:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once 'login_check.php';

$feedback_list=$db->get_one("select * from $met_feedback where id='$id'");
if(!$feedback_list){
okinfo('feedback.php',$lang_js1);
}

$query = "SELECT * FROM $met_fdparameter where use_ok='1' order by no_order";
$result = $db->query($query);
while($list= $db->fetch_array($result)){
$para="para".$list[id];
if($list[type]==5)
{
$x=explode('/', $feedback_list['fromurl']);
unset($x[count($x)-1]);
unset($x[count($x)-1]);
$path = implode('/', $x).'/upload/file/';
$feedback_list[$para]="<a href='".$path.$feedback_list[$para]."'>{$feedback_list[$para]}</a>";
}
$list[content]=$feedback_list[$para];
$list[name]=($lang=="en")?$list[e_name]:(($lang=="other")?$list[o_name]:$list[c_name]);
$feedback_para[]=$list;
}


$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
include templatemember('feedback_detail');
footermember();

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>