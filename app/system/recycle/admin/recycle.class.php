<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');

class recycle extends admin {
    public function __construct()
    {
        global $_M;
        parent::__construct();
    }

    public function doindex(){
        global $_M;
        $query = "SELECT * FROM {$_M[table][lang]} WHERE `lang`!='metinfo'";
        $langlist = DB::get_all($query);
        require $this->template('own/index');
    }

    public function dotable_list_json(){
        global $_M;
        $table = load::sys_class('tabledata', 'new'); //加载表格数据获取类

        $column = $_M['form']['search_fod'];
        $_M['form']['search_lang']=='0' ? $lang =$_M['form']['lang'] : $lang = $_M['form']['search_lang'];
        $search = $_M['form']['search_title'];

        $fields = '`id`,`title`,`class1`,`class2`,`class3`,`updatetime`,`recycle`';
        $columns  = array("product","news","download","img");
        $searchsql = $search ? $searchsql = "AND `title` LIKE '%$search%'" : $searchsql = '';
        $langsql = "AND lang='$lang'"; //查询条件

        $where = "recycle > 0 $langsql $searchsql";
        $order = '';

        if ($column == '0') {
            $query = "SELECT {$fields} FROM {$_M[table]['news']} WHERE $where ";
            $query .=" UNION SELECT {$fields} FROM {$_M[table]['product']} WHERE $where";
            $query .=" UNION SELECT {$fields} FROM {$_M[table]['download']} WHERE $where";
            $query .=" UNION SELECT {$fields} FROM {$_M[table]['img']} WHERE $where";
            $data = $table->getdata($_M[table][$column], '*', $where, $order, $query);//获取数据
        } else{
            $column = $this->get_colnum_name($column);
            $data = $table->getdata($_M[table][$column], '*', $where, $order);//获取数据
        }
        $query = "SELECT * FROM {$_M[table]['column']} where lang ='{$_M[lang]}'";
        $c_list = DB::get_all($query);

        foreach ($c_list as $key => $value) {
               $column_list[$value[id]]=$value;
        }
  
        if (is_array($data)) {
            foreach($data as $key => $val){
                $column_name = $column_list[$val[class1]][name];
                $mod=$column_list[$val[class1]][module];
                if($val[class2]!=0){
                    $column_name=$column_list[$val[class2]][name];
                    $mod=$column_list[$val[class1]][module];
                }
                if($val[class3]!=0){
                    $column_name=$column_list[$val[class3]][name];
                    $mod=$column_list[$val[class1]][module];
                }
                $list = array();
                $list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}#{$mod}\">";
                $list[] = "<div class='media-body ui-table-a'>{$val['title']}</div>";
                $list[] = "<div class='media-body ui-table-a'>{$val['updatetime']}</div>";
                $list[] = "<div class='media-body ui-table-a'>{$column_name}</div>";
                $list[] = "<a href='{$_M[url][own_form]}a=dosave&id={$val['id']}&recycle={$mod}&submit_type=delete' class='delete' data-confirm='{$_M[word][js7]}'>{$_M[word][delete]}</a>&nbsp;<a href='{$_M[url][own_form]}a=dosave&id={$val['id']}&recycle={$mod}&submit_type=restore' class='edit' >{$_M[word][recyclere]}</a>";
                $rarray[] = $list;
            }
            $table->rdata($rarray);//返回数据
            die();
        }else{
            $table->rdata('');//返回数据;
            die();
        }

    }

    public function dosave()
    {
        global $_M;
        if ($_M['form']['submit_type'] == "restore") {
            //恢复
            if (isset($_M['form']['allid'])) {
                $item = explode( ",",$_M['form']['allid']);
                foreach ($item as $val) {
                    $row = explode( "#" ,$val);
                    $this->dorestore($row[0], $row[1]);
                }
            }else{
                $this->dorestore($_M['form']['id'], $_M['form']['recycle']);
            }
        }

        if ($_M['form']['submit_type'] == "delete") {
            //删除
            if (isset($_M['form']['allid'])) {
                $item = explode( ",",$_M['form']['allid']);
                foreach ($item as $val) {
                    $row = explode( "#" ,$val);
                    load::mod_class('product/product_database','new')->del_plist($row[0],$row[1]);
                    $this->dodelete($row[0], $row[1]);
                }
            }else{
                load::mod_class('product/product_database','new')->del_plist($_M['form']['id'],$_M['form']['recycle']);
                $this->dodelete($_M['form']['id'], $_M['form']['recycle']);
            }
        }

        turnover("{$_M[url][own_form]}a=doindex");

    }

    public function dodelete($id,$colu){
        global $_M;
        $column = $this->get_colnum_name($colu);
        $query = "DELETE  FROM {$_M['table'][$column]} WHERE `id` = '{$id}' and `lang` = '{$_M[lang]}'";
        $data = DB::get_all($query);

    }

    public function dorestore($id,$colu)
    {
        global $_M;
        $column = $this->get_colnum_name($colu);
        $query = "UPDATE {$_M['table'][$column]} SET `recycle` = 0 WHERE `id` = '{$id}' and `lang` = '{$_M[lang]}'";
        $data = DB::get_all($query);
    }

    public function get_colnum_name($mod)
    {
        switch ($mod) {
            case 2:
                $column = 'news';
                break;
            case 3:
                $column = 'product';
                break;
            case 4:
                $column = 'download';
                break;
            case 5:
                $column = 'img';
                break;
        }
        return $column;
    }
}
