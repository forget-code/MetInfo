<?php
defined('IN_MET') or exit ('No permission');
load::sys_class('admin');
load::sys_class('nav.class.php');
class install extends admin {
    public function __construct() {
        parent::__construct();
    }
    public function dosql() {
        global $_M;
		$query      = "SELECT * FROM {$_M['table']['config']} WHERE name='met_tablename'";
        $tablenames = DB::get_one($query);
        //支付模块信息表
        if(!is_strinclude($tablenames['value'], 'pay_config')) {
            $table = $_M['config']['tablepre'].'pay_config';
            $query = "CREATE TABLE IF NOT EXISTS {$table} (`id` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(255) NOT NULL,`value` text NOT NULL,`mobile_value` text,`columnid` int(11),`flashid` int(11),`lang` varchar(50) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            DB::query($query);
            add_table('pay_config');
        } else {
            $query    = "SELECT * FROM {$_M['table']['pay_config']} WHERE name='model_name'";
            $pageinfo = DB::get_one($query);
            if(!$pageinfo) {
                $pageinfo['value'] = '在线支付';
                $query = "INSERT INTO {$_M['table']['pay_config']} SET value='{$pageinfo['value']}',name='model_name',mobile_value='',columnid='',flashid='',lang='metinfo'";
                DB::query($query);
            }
            if($_M['config']['met_title_type'] == 0){
                $_M['tem_data']['title'] = $pageinfo['value'];
            }else if($_M['config']['met_title_type'] == 1){
                $_M['tem_data']['title'] = $pageinfo['value'].'-'.$_M['config']['met_keywords'];
            }else if($_M['config']['met_title_type'] == 2){
                $_M['tem_data']['title'] = $pageinfo['value'].'-'.$_M['config']['met_webname'];
            }else if($_M['config']['met_title_type'] == 3){
                $_M['tem_data']['title'] = $pageinfo['value'].'-'.$_M['config']['met_keywords'].'-'.$_M['config']['met_webname'];
            }
        }
        //接口参数表
        if(!is_strinclude($tablenames['value'], 'pay_api')) {
            $table = $_M['config']['tablepre'].'pay_api';
            $query = "CREATE TABLE IF NOT EXISTS {$table} (`id` int(11) NOT NULL AUTO_INCREMENT,`name` varchar(50) NOT NULL,`paytype` varchar(255) NOT NULL,`value` varchar(255) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            DB::query($query);
            add_table('pay_api');
        }
        //订单存储表
        if(!is_strinclude($tablenames['value'], 'pay_order')) {
            $table = $_M['config']['tablepre'].'pay_order';
            $query = "CREATE TABLE IF NOT EXISTS {$table} (`id` int(11) NOT NULL AUTO_INCREMENT,`no` int(11) NOT NULL,`callback_url` varchar(255),`out_trade_no` varchar(32) NOT NULL,`subject` varchar(255) NOT NULL,`product_id` varchar(32),`body` varchar(128),`goods_tag` varchar(32),`attach` varchar(127),`show_url` varchar(255),`total_fee` decimal(9,2) NOT NULL,`order_time` datetime NOT NULL,`pay_time` datetime,`pay_type` int(1),`callback` int(1),`status` int(1),PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
            DB::query($query);
            add_table('pay_order');
        }
        //后台导航
        $query  = "SELECT * FROM {$_M['table']['admin_column']} WHERE name='lang_pay'";
        $result = DB::get_one($query);
        if(!$result) {
            $query = "INSERT INTO {$_M['table']['admin_column']} SET name='lang_pay',url='index.php?n=pay&c=admin_pay&a=dopaylist',bigclass='5',field='0',type='2',list_order='0',icon='<i class=\"fa fa-rub\"></i>',info=''";
            DB::query($query);
            
            $query  = "SELECT * FROM {$_M['table']['language']} WHERE name='pay'";
            $result = DB::get_one($query);
            if(!$result) {
                $query = "INSERT INTO {$_M['table']['language']} SET name='pay',value='支付接口',site='1',no_order='0',array='1',app='0',lang='cn'";
                DB::query($query);
                $query = "INSERT INTO {$_M['table']['language']} SET name='pay',value='payment',site='1',no_order='0',array='1',app='0',lang='en'";
                DB::query($query);
                $query = "INSERT INTO {$_M['table']['language']} SET name='pay',value='支付接口',site='1',no_order='0',array='1',app='0',lang='tc'";
                DB::query($query);
            }
        }
        //会员中心侧导航
        $query  = "SELECT * FROM {$_M['table']['ifmember_left']} WHERE foldername='pay/demo'";
        $result = DB::get_one($query);
        if(!$result) {
            $query = "INSERT INTO {$_M['table']['ifmember_left']} SET no='0',columnid='0',title='账单支付',foldername='pay/demo',filename='index.php'";
            DB::query($query);
        }
    }
}
?>