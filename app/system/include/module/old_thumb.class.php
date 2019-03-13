<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class old_thumb extends web{

      public function doshow(){
        global $_M;

         $dir = str_replace(array('../','./'), '', $_GET['dir']);


        if(substr(str_replace($_M['url']['site'], '', $dir),0,4) == 'http' && strpos($dir, './') === false){
            header("Content-type: image/jpeg");
            ob_start();
            readfile($dir);
            ob_flush();
            flush();
            die;
        }

        if($_M['form']['pageset']){
          $path = $dir."&met-table={$_M['form']['met-table']}&met-field={$_M['form']['met-field']}";

        }else{
          $path = $dir;
        }
        $image =  thumb($path,$_M['form']['x'],$_M['form']['y']);
        if($_M['form']['pageset']){
          $img = explode('?', $image);
          $img = $img[0];
        }else{
          $img = $image;
        }
        if($img){
            header("Content-type: image/jpeg");
            ob_start();
            readfile(PATH_WEB.str_replace($_M['url']['site'], '', $img));
            ob_flush();
            flush();
        }

    }
}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>