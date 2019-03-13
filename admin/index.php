<?php
# 文件名称:index.php 2009-08-19 11:21:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
$admin_index=TRUE;
require_once 'login/login_check.php';
if($action=="renameadmin"){
   $adminfile=$url_array[count($url_array)-2];
  if($met_adminfile!=""&&$met_adminfile!=$adminfile){
  $oldname='../'.$adminfile;
  $newname='../'.$met_adminfile;
  rename($oldname,$newname);
  echo "<script type='text/javascript'>parent.setCookie('adminnow', '$met_adminfile'); top.location.href='$newname'; </script>";
  }
}
$css_url="templates/".$met_skin."/css";
$img_url="templates/".$met_skin."/images";
    $query = "SELECT * FROM $met_column where if_in=0 order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 $list[name]=($langusenow=='en')?$list[e_name]:(($langusenow=='other')?$list[o_name]:$list[c_name]);
	 if($langusenow=="en" && $met_e_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['o_name'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['name']=$met_e_lang_ok==1?$list['e_name']:$list['o_name'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['e_name'];
	  if($list[bigclass]==0){
	    $class1_list[$list[module]][]=$list;	 
	   }else{
	   $class2_list[$list[module]][]=$list;	
      }
	}
if(	$metinfo_admin_pop!="metinfo"){
$admin_pop=explode('-',$metinfo_admin_pop);
$admin_poptext="admin_pop";
foreach($admin_pop as $key=>$val){
$admin_poptext1=$admin_poptext.$val=$val;
$$admin_poptext1="metinfo";
}
}

$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$metinfo_admin_name'");
include template('index');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>