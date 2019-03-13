<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once 'common.inc.php';
$member_login_url="login.php?lang=".$lang;
$member_register_url="register_include.php?lang=".$lang;
$navurl=($index=='index')?'':'../';
$met_js_ac=" document.body.innerHTML=''; alert('".$lang_access."'); location.href='".$navurl."member/".$member_index_url."&referer='+encodeURIComponent(window.location.href);";
$query="select * from $met_user_group where id='$metaccess'";
$memberacess=$db->get_one($query);
$metaccess=$memberacess[access];
if($met_member_use!=0){
if($metuser=='para'){
if(intval($metinfo_member_type)>=intval($metaccess)){
$listinfo=codetra($listinfo,0);
$met_js_ac='document.write("'.authcode($listinfo, 'DECODE', $met_member_force).'")';
}else{
	$met_js_ac='document.write("'."【<a href='".$navurl."member/$member_login_url' target='_blank'>$lang_login</a>】【<a href='".$navurl."member/$member_register_url' target='_blank'>$lang_register</a>】".'")';
}
}else{
if(intval($metinfo_member_type)>=intval($metaccess)){
    $met_js_ac="";
  }else{
	//met_cooike_unset();
	//change_met_cookie('metinfo_member_name',$metinfo_member_name);
	//change_met_cookie('metinfo_member_pass',$metinfo_member_pass);
	//change_met_cookie('metinfo_member_type',$metinfo_member_type);
	//change_met_cookie('metinfo_admin_name',$metinfo_admin_name);
	//save_met_cookie();
  }
}
}
echo $met_js_ac;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>