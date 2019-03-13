<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class hits extends web {

    public function __construct() {
        global $_M;
        parent::__construct();
    }

    public function dohits(){
        global $_M;

        switch($_M['form']['type']){
            case 'product':
                $met_hits='product';
                break;
            case 'news':
                $met_hits='news';
                break;
            case 'download':
                $met_hits='download';
                break;
            case 'img':
                $met_hits='img';
                break;
            default :
                $met_hits='';
                break;
        }
        $query="select * from {$_M['table'][$met_hits]} where id='{$_M['form']['id']}'";
        $hits_list=DB::get_one($query);
        $hits_list[hits]=$hits_list[hits]+1;
        $query = "update {$_M['table'][$met_hits]} SET hits='$hits_list[hits]' where id='{$_M['form']['id']}'";
        DB::query($query);
        $query="select * from {$_M['table'][$met_hits]} where id='{$_M['form']['id']}'";
        $hits_list=DB::get_one($query);
        $hits=$hits_list[hits];
        if($metinfover=='v1' || $metinfover=='v2'){// 增加判断值（新模板框架v2）
            echo $hits;
        }else{
            echo $hits;
        }
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
