<?php
defined('IN_MET') or exit('No permission');

load::sys_class('admin');


  class inapp extends admin{

     public function get_appstore_status(){
     	          global $_M;
                  $array =array();
     	            $adminurl=$_M['url']['site_admin'];
                  if($_M['config']['met_secret_key']){
                      $array['state'] =1;
                  }else{
                      $array['state'] =0;
                  }
                  //会员登录地址
                  $array['loginurl'] =  $adminurl."index.php?lang={$_M["lang"]}&anyid=65&n=appstore&c=appstore&c=member&a=dologin&returnurl=";
                  //获取会员信息
                  $array['memberinfourl']=$adminurl."index.php?lang={$_M["lang"]}&anyid=65&n=appstore&c=member&a=domenmberinfo";
                  //退出登录地址
                  $array['loginouturl']=  $adminurl."index.php?lang={$_M["lang"]}&anyid=65&n=appstore&c=member&a=dologout&returnurl=";
                  return $array;
       } 

  }