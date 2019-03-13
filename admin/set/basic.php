<?php
require_once '../login/login_check.php';
if($action=="modify"){
if(substr($met_weburl,-1,1)!="/")$met_weburl.="/";
if(!strstr($met_weburl,"http://"))$met_weburl="http://".$met_weburl;
require_once '../include/upfile.class.php';
$f = new upfile($met_img_type,'',$met_img_maxsize,'');
if($_FILES['met_logo']['name']!=''){
        $met_logo1   = $f->upload('met_logo'); 
		$met_logo   = $met_logo1;
    }
require_once 'configsave.php';
okinfo('basic.php',$lang[user_admin]);
}
else{
$localurl="http://";
$localurl.=$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"];
$localurl_a=explode("/",$localurl);
$localurl_count=count($localurl_a);
$localurl_admin=$localurl_a[$localurl_count-3];
$localurl_admin=$localurl_admin."/set/basic";
$localurl_real=explode($localurl_admin,$localurl);
$localurl=$localurl_real[0];
if($met_weburl=="")$met_weburl=$localurl;
if($met_en_lang==1)$met_en_lang1="checked='checked'";
if($met_webhtm==1)$met_webhtm1="checked='checked'";
$met_index_type1[$met_index_type]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('set_basic');
footer();
}
?>