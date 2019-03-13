<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

class session{

    public function __construct() {
        global $_M;
        $this->start();
    }

    public function start(){
        $ip=$this->getip();
        session_id(md5($_SERVER['HTTP_USER_AGENT'].$ip));
        session_start();
    }

    public function set($name, $value){
        $this->start();
        $_SESSION[$name] = $value;
    }

    public function get($name){
        $this->start();
        return $_SESSION[$name];
    }

    public function del($name){
        $this->start();
        unset($_SESSION[$name]);
    }

    public function getip() {
        $unknown = 'unknown';
        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>