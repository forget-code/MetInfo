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
        $_M['url']['help_tutorials_helpid']='120';
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
        $current_admin = str_replace($_M['url']['site'], '', trim($_M['url']['site_admin'],'/'));
        $old_admin = $_M['config']['met_adminfile'];
        $new_admin = $_M['form']['met_adminfile'];

        if($old_admin != $current_admin){
            $old_admin = $current_admin;
        }

        $query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
            $result = DB::query($query);
            while($list_config= DB::fetch_array($result)){
                $settings_arr[]=$list_config;
                $_M[config][$list_config['name']]=$list_config['value'];
                if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
             }
       //目录名解密
         // $_M[config][met_adminfile] = authcode($_M['config']['met_adminfile'], 'DECODE', $_M['config']['met_webkeys']);
        $met_adminfile_code=authcode($new_admin,'ENCODE',$_M[config][met_webkeys]);
        if($new_admin != $current_admin){
           //中文和特殊字符判断
           if (preg_match("/[\x{4e00}-\x{9fa5}]+/u",$new_admin)) {
               turnover("{$_M[url][own_form]}a=doindex",$_M[word][js77]);
               die();
           }elseif(!preg_match("/^\w+$/u",$new_admin)){
               turnover("{$_M[url][own_form]}a=doindex",$_M[word][js77]);
               die();
           }

            if(!is_dir(PATH_WEB.$old_admin)){
               turnover("{$_M[url][own_form]}a=doindex",$old_admin.$_M[word][setdbNotExist]);
            }

            if(is_dir(PATH_WEB.$new_admin)){
                turnover("{$_M[url][own_form]}a=doindex",$new_admin.$_M[word][columnerr4]);
            }

            $newname=PATH_WEB.$new_admin;

            if(rename(PATH_WEB.$old_admin,PATH_WEB.$new_admin)){
             $url = str_replace($current_admin,$new_admin,$_M[url][site_admin]);
             echo "<script type='text/javascript'> alert('{$_M[word][authTip11]}');  top.location.href='{$url}#metnav_12'; </script>";
        }else{
             turnover("{$_M[url][own_form]}a=doindex",$_M[word][adminwenjian]);
             die();
         }
        }

        $old_code = authcode($old_admin, 'DECODE', $_M['config']['met_webkeys']);
        $config_list = array();
        $config_list[] = 'met_img_rename';
        $config_list[] = 'met_login_code';
        $config_list[] = 'met_memberlogin_code';
        $config_list[] = 'met_file_maxsize';
        $config_list[] = 'met_file_format';
        $config_list[] = 'met_fd_word';
        // if($rename){
            $_M['form']['met_adminfile'] = $met_adminfile_code;
            $config_list[] = 'met_adminfile';
        // }
        configsave($config_list);

        turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
      }

}