<?php
defined('IN_MET') or exit('No permission');
load::sys_class('admin');
load::sys_func('file');

class index extends admin {
    public function __construct() {
        global $_M;
        parent::__construct();
    }
    public function doindex(){
        global $_M;
        $metinfo_admin_name= get_met_cookie('metinfo_admin_name');
        $met_login_code=$_M['config']['met_login_code'];
        $met_memberlogin_code=$_M['config']['met_memberlogin_code'];
        $met_automatic_upgrade=$_M['config']['met_automatic_upgrade'];
        $localurl=$_M['config']['met_weburl'];
        $localurl_admin=$_M['config']['met_weburl'].$_M['config']['met_adminfile'].'/';
        $feedcfg=DB::get_one("select * from {$_M[table][config]} where lang ='{$_M[form][lang]}' and name='met_fd_word' and columnid = 0");
        $_M[config][met_fd_word]=$feedcfg[value];
        if(!is_dir(PATH_WEB.'install'))$installstyle="display:none;";
        if(!is_dir(PATH_WEB.'update'))$updatestyle="display:none;";
        $met_login_code1[$met_login_code]="checked='checked'";
        $met_memberlogin_code1[$met_memberlogin_code]="checked='checked'";
        $met_automatic_upgrade1[$met_automatic_upgrade]="checked";
        if($_M[config][met_img_rename]==1)$met_img_rename1="checked='checked'";
        $query="SELECT * FROM {$_M[table][admin_table]} WHERE admin_id='{$metinfo_admin_name}'";
        $admin_list =DB::get_one($query);
        require_once $this->template('own/index');
    }

    /*删除系统安装与升级文件*/
    public function dodelete(){
        global $_M;
        $filename=$_M[form][filename]=='update'?$_M[form][filename]:'install';
        if($filename=='update')@chmod(PATH_WEB.'update/install.lock',0777);
           $dir=PATH_WEB.$filename;
           $dh=opendir($dir);
           while ($file=readdir($dh)) {
                if($file!="." && $file!="..") {
                  $fullpath=$dir."/".$file;
                  if(!is_dir($fullpath)) {
                      unlink($fullpath);
                  } else {
                      deldir($fullpath);
                  }
                }
            }
              closedir($dh);
        if($dir!=PATH_WEB.'upload'){
            rmdir($dir);
        }

         turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);

    } 
   /*更新数据*/
   public function doupdate(){
         global $_M;
          $met_adminfile=$_M[config][met_adminfile];
          $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
                    $result = DB::query($query);
                    while($list_config= DB::fetch_array($result)){
                        $settings_arr[]=$list_config;
                        $_M[config][$list_config['name']]=$list_config['value'];
                        if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
             }
       //目录名解密
         $_M[config][met_adminfile] = authcode($_M['config']['met_adminfile'], 'DECODE', $_M['config']['met_webkeys']);

       if($_M[form][met_adminfile]!=""&&$_M[form][met_adminfile]!=$_M[config][met_adminfile]){
           //中文和特殊字符判断
           if (preg_match("/[\x{4e00}-\x{9fa5}]+/u",$_M[form][met_adminfile])) {
               turnover("{$_M[url][own_form]}a=doindex",$_M[word][js77]);
               die();
           }elseif(!preg_match("/^\w+$/u",$_M[form][met_adminfile])){
               turnover("{$_M[url][own_form]}a=doindex",$_M[word][js77]);
               die();
           }

           if (is_dir(PATH_WEB."{$_M[form][met_adminfile]}")) {
               turnover("{$_M[url][own_form]}a=doindex",$_M[form][met_adminfile].$_M[word][columnerr4]);
           }
           if(!is_dir(PATH_WEB.$_M[config][met_adminfile])){
               turnover("{$_M[url][own_form]}a=doindex",$_M[config][met_adminfile].$_M[word][setdbNotExist]);
           }
             $met_adminfile_temp=$_M[form][met_adminfile];
             $newname=PATH_WEB.$_M[form][met_adminfile];
             $met_adminfile_code=authcode($_M[form][met_adminfile],'ENCODE',$_M[config][met_webkeys]);
             $columnid=$columnid?$columnid:0;
             !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
             $met_adminfile=$met_adminfile_code;
            foreach($settings_arr as $key=>$val){
                if($val['columnid']==$columnid){
                    $name = $val['name'];
                    $newvalue1 = stripslashes($_M[form][$name]);
                    $newvalue1 = str_replace("'","''",$newvalue1);
                    $newvalue = str_replace("\\","\\\\",$newvalue1);
                    if($val['value']!=$newvalue1 && isset($_M[form][$name])){
                        $query1 = $columnid?"and columnid='$columnid'":'';
                           $query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";
                        if($val['name']=='met_adminfile'){
                            $newvalue=authcode($newvalue,'ENCODE',$_M[config][met_webkeys]);
                        }
                        $query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";

                        DB::query($query);
                    }
                }
            }

         if(rename(PATH_WEB.$_M[config][met_adminfile],PATH_WEB.$_M[form][met_adminfile])){
             $url = str_replace($_M['config']['met_adminfile'],$_M[form][met_adminfile],$_M[url][site_admin]);
             echo "<script type='text/javascript'> alert('{$_M[word][authTip11]}');  top.location.href='{$url}#metnav_12'; </script>";
        }else{
             turnover("{$_M[url][own_form]}a=doindex",$_M[word][adminwenjian]);
             die();
         }
        }else{
            $columnid=$columnid?$columnid:0;
            !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
            $met_adminfile = authcode($_M[form][met_adminfile],'ENCODE',$_M[config][met_webkeys]);
            foreach($settings_arr as $key=>$val){
                if($val['columnid']==$columnid){
                    if($val['name']=="met_adminfile"){
                        continue;
                    }
                }
                    $name = $val['name'];
                    $newvalue1 = stripslashes($_M[form][$name]);
                    $newvalue1 = str_replace("'","''",$newvalue1);
                    $newvalue = str_replace("\\","\\\\",$newvalue1);
                    if($val['value']!=$newvalue1 && isset($_M[form][$name])){
                        $query1 = $columnid?"and columnid='$columnid'":'';
                        $query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";
                        
                         DB::query($query);
                    }
                }
            }
        turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
      }

}