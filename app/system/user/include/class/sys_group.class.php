<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('group');

class sys_group extends group {
    public function json_group_list(){
        global $_M;

        $table = load::sys_class('tabledata', 'new');
        $order = "access";
        $where = "lang='{$_M['lang']}'";
        $grouplist = $table->getdata($_M['table']['user_group'], '*', $where, $order);

        foreach($grouplist as $val){
            $list = array();
            $list[] = "<input name='id' type='checkbox' value='{$val[id]}' class='ui-input'>";
            $list[] = "<input type='text' name='name-{$val[id]}' data-required='1' class='ui-input listname' value='{$val[name]}'>";
            if(1){
                $query = "SELECT `recharge_price`,`price`,`buyok`,`rechargeok` FROM {$_M['table']['user_group_pay']} WHERE groupid = '{$val[id]}'";
                $res = DB::get_one($query);
                $res_rechargeok_show=intval($res['rechargeok'])?'':'hidden';
                $res_buyok_show=intval($res['buyok'])?'':'hidden';
                if($_M['config']['payment_open']){
                    $list[] = "<input type='checkbox' name='rechargeok-{$val[id]}' class='set-price-ok' id='rechargeok-{$val[id]}' value='1' data-checked='{$res['rechargeok']}'>
					<label for='rechargeok-{$val[id]}' style='font-weight: normal;margin-bottom: 0;margin-left:5px;'>{$_M['word']['usegroupauto1']}</label>
                    <input type='text' name='recharge_price-{$val[id]}' placeholder='".$_M['word']['usersetprice']."' value='{$res['recharge_price']}' class='ui-input' style='width: 50%;' {$res_rechargeok_show}>";
                    $list[] = "<input type='checkbox' name='buyok-{$val[id]}' class='set-price-ok' id='buyok-{$val[id]}' value='1' data-checked='{$res['buyok']}'>
                    <label for='baybale-{$val[id]}' style='font-weight: normal;margin-bottom: 0;margin-left:5px;'>".$_M['word']['sys_group_bayable']."</label>
                    <input type='text' name='group_pricr-{$val[id]}' placeholder='".$_M['word']['sys_group_set_price']."' value='{$res['price']}' class='ui-input' style='width: 50%;' {$res_buyok_show}>";
                }else{
                    $list[] = "{$_M['word']['useinfopay']}";
                    $list[] = "{$_M['word']['useinfopay']}";
                }
            }
            $list[] = "<input type='text' name='access-{$val[id]}' data-required='1' class='ui-input met-center' value='{$val['access']}'>";
            $rarray[] = $list;
        }
        $table->rdata($rarray);

    }
    public function save_group($allid,$type){
        global $_M;

        $list = explode(",",$allid) ;

        foreach($list as $id){
            if($id){
                if($type=='save'){
                    $name = $_M['form']['name-'.$id];
                    $access = $_M['form']['access-'.$id];
                    $pricr = $_M['form']['group_pricr-'.$id];
                    $buyok = $_M['form']['buyok-' . $id] ? $_M['form']['buyok-' . $id] : '';
                    $recharge_price = $_M['form']['recharge_price-'.$id];
                    $rechargeok = $_M['form']['rechargeok-' . $id] ? $_M['form']['rechargeok-' . $id] : '';

                    $access = $access ? $access : 0 ;
                    if(is_number($id)){

                        if($access<1){

                            echo "<script>alert('".$_M['word']['usereadinfo']."')</script>";
                            turnover("{$_M[url][own_form]}a=doindex", $_M['word']['opfailed']);

                        }
                        $query = "UPDATE {$_M['table']['user_group']} SET
						name = '{$name}',
						access = '{$access}'
						WHERE id = '{$id}' and lang = '{$_M[lang]}'
						";
                        if($query)DB::query($query);
                        $query1 = "UPDATE {$_M['table']['admin_array']} SET
						array_name = '{$name}',
						user_webpower = '{$access}'
						WHERE id = '{$id}' and lang = '{$_M[lang]}'
						";
                        if($query1)DB::query($query1);

                        $query = "SELECT * FROM {$_M['table']['user_group_pay']} WHERE groupid = '{$id}' AND lang = '{$_M['lang']}'";
                        if (DB::get_one($query)) {
                            $query = "UPDATE {$_M['table']['user_group_pay']} SET 
                            price = '{$pricr}', 
                            buyok = '{$buyok}',
                            recharge_price = '{$recharge_price}',
                            rechargeok = '{$rechargeok}' 
                            WHERE groupid = '{$id}' AND 
                            lang = '{$_M[lang]}'";
                            DB::query($query);
                        }else{
                            $query = "INSERT INTO {$_M['table']['user_group_pay']} SET 
                            groupid = '{$id}',
                            recharge_price = '{$recharge_price}',
                            price = '{$pricr}',
                            buyok = '{$buyok}',
                            rechargeok = '{$rechargeok}',
                            lang = '{$_M['lang']}'";
                            DB::query($query);
                        }
                    }else{
                        if($name){
                            if($access<1){
                                echo "<script>alert('".$_M['word']['usereadinfo']."')</script>";
                                turnover("{$_M[url][own_form]}a=doindex", $_M['word']['opfailed']);
                            }
                            $query = "INSERT INTO {$_M['table']['user_group']} SET
							name = '{$name}',
							access = '{$access}',
							lang  = '{$_M[lang]}'
							";
                            if($query)DB::query($query);
                            $group_id = DB::insert_id();

                            $query1 = "INSERT INTO {$_M['table']['admin_array']} SET
							id = ".DB::insert_id().",
							array_name = '{$name}',
							user_webpower = '{$access}',
							array_type = 1,
							langok = '',
							lang  = '{$_M[lang]}'
							";
                            if($query1)DB::query($query1);

                            $query = "INSERT INTO {$_M['table']['user_group_pay']} SET 
                            groupid = '{$group_id}' ,
                            price = '{$pricr}' ,
                            buyok = '{$buyok}',
                            recharge_price = '{$recharge_price}',
                            rechargeok = '{$rechargeok}',
                            lang = '{$_M['lang']}'";
                            DB::query($query);
                        }
                    }
                }elseif($type=='del'){
                    if(is_number($id)){
                        $query = "DELETE FROM {$_M['table']['user_group']} WHERE id='{$id}' and lang='{$_M[lang]}' ";
                        $query1 = "DELETE FROM {$_M['table']['admin_array']} WHERE id='{$id}' and lang='{$_M[lang]}' ";
                        $query1 = "DELETE FROM {$_M['table']['user_group_pay']} WHERE groupid='{$id}' and lang='{$_M[lang]}' ";
                    }
                    if($query)DB::query($query);
                    if($query1)DB::query($query1);
                }
            }

        }
        cache::del('user', 'file');
        return true;

    }

    /*public function json_payuser_list()
    {
        global $_M;
        $table = load::sys_class('tabledata', 'new');
        $order = "groupid";
        $where = "lang='{$_M['lang']}'";
        $pay_group_list = $table->getdata($_M['table']['user_group_pay'], '*', $where);

        foreach($pay_group_list as $val){
            $list = array();
            $list[] = "<input name='id' type='checkbox' value='{$val[id]}'>";
            $list[] = "{$val['groupname']}";
            $list[] = "{$val['price']}";
            $list[] = "<a href='{$_M[url][own_form]}a=do_pay_group_editor&id={$val[id]}'>{$_M['word']['editor']}</a><span class='line'>|</span><a href='{$_M[url][own_form]}a=do_pay_group_del&id={$val[id]}'>{$_M['word']['delete']}</a>";
            $rarray[] = $list;
        }
        $table->rdata($rarray);
    }*/

    public function get_paygroup_by_id($groupid)
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['user_group_pay']} WHERE groupid = '{$groupid}'";
        return DB::get_one($query);
    }

    public function get_group_by_id($groupid)
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['user_group']} WHERE id = '{$groupid}'";
        return DB::get_one($query);
    }

    /*public function get_paygroup_list()
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['user_group_pay']}";
        return DB::get_all($query);
    }*/

    public function get_paygroup_list_buyok()
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['user_group_pay']} WHERE buyok = 1 ORDER BY price ";
        $res = DB::get_all($query);
        foreach ($res as $val) {
            $query = "SELECT * FROM {$_M['table']['user_group']} WHERE id = '{$val['groupid']}' AND  lang ='{$_M['lang']}'";
            $ugroup = DB::get_one($query);
            $val['name'] = $ugroup['name'];
            $val['access'] = $ugroup['access'];
            $paygroup_list[] = $val;
        }
        return $paygroup_list;
    }

    public function get_paygroup_list_recharge()
    {
        global $_M;
        $query = "SELECT * FROM {$_M['table']['user_group_pay']} WHERE rechargeok = 1 ORDER BY recharge_price ";
        $res = DB::get_all($query);
        foreach ($res as $val) {
            $query = "SELECT * FROM {$_M['table']['user_group']} WHERE id = '{$val['groupid']}' AND  lang ='{$_M['lang']}'";
            $ugroup = DB::get_one($query);
            $val['name'] = $ugroup['name'];
            $val['access'] = $ugroup['access'];
            $paygroup_list[] = $val;
        }
        return $paygroup_list;
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>