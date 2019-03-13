<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin.class.php');
load::sys_class('nav.class.php');
load::sys_class('curl');
load::sys_class('cache');

class online extends admin {
    function __construct() {
        global $_M;
        parent::__construct();
        nav::set_nav(1,$_M[word][onlone_onlinelist_v6], $_M['url']['own_form'].'a=doindex');
        nav::set_nav(2, $_M[word][onlone_online_v6], $_M['url']['own_form'].'a=doonline');
        #nav::set_nav(2, $_M['word']['indexhtmset'], $_M['url']['own_form'].'a=dourl');
    }


    function doindex() {
        global $_M;
        nav::select_nav(1);
        $_M['url']['help_tutorials_helpid']='117';
        require $this->template('tem/onlinelist');

    }

    function doonline_list_json(){
        global $_M;
        /*$query = "SELECT * FROM {$_M['table']['online']} where lang='{$_M['lang']}' order by no_order";
        $list = DB::get_all($query);*/

        $table = load::sys_class('tabledata', 'new'); //加载表格数据获取类
        $where = "lang='{$_M['lang']}'"; //查询条件
        $order = "no_order"; //排序方式
        $array = $table->getdata($_M['table']['online'], '*', $where, $order);//获取数据

        foreach($array as $key => $val){
            //msn 保存信息前台显示为 Facebook
            $list = array();
            $list[] = "<input name=\"id\" type=\"checkbox\" value=\"{$val[id]}\">";
            $list[] = "<input type='text' name='no_order-{$val[id]}' class='ui-input' met-center='' style='width:30px;text-align: center' value='{$val[no_order]}'>";
            $list[] = "<input type='text' name='name-{$val[id]}' class='ui-input' met-center='' value='{$val['name']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<input type='text' name='qq-{$val[id]}' class='ui-input' met-center='' value='{$val['qq']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<input type='text' name='msn-{$val[id]}' class='ui-input' met-center='' value='{$val['msn']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<input type='text' name='taobao-{$val['id']}' class='ui-input' met-center='' value='{$val['taobao']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<input type='text' name='alibaba-{$val['id']}' class='ui-input' met-center='' value='{$val['alibaba']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<input type='text' name='skype-{$val['id']}' class='ui-input' met-center='' value='{$val['skype']}' placeholder='{$_M[word][onlineHolder1]}'/>";
            $list[] = "<a href='{$_M[url][own_form]}a=dosave&submit_type=delone&onlineid={$val['id']}' class='delet' data-confirm='{$_M[word][js7]}'>{$_M[word][delete]}</a>";
            $rarray[] = $list;
        }
        $table->rdata($rarray);//返回数据
    }

    function do_table_add_list(){
        global $_M;
        $id = 'new-'.$_M[form][ai];
        $metinfo ="<tr class='even newlist'>
                    <td class='met-center'><input name='id' type='checkbox' value='{$id}' checked=''></td>
                    <td class='met-center'><input type='text' name='no_order-{$id}' class='ui-input met-center' style='width:30px;' value='0'></td>
                    <td><input type='text' name='name-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder1]}' data-required='1'></td>
                    <td><input type='text' name='qq-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder2]}' ></td>
                    <td><input type='text' name='msn-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder2]}'></td>
                    <td><input type='text' name='taobao-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder2]}'></td>
                    <td><input type='text' name='alibaba-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder2]}'></td>
                    <td><input type='text' name='skype-{$id}' class='ui-input listname' value='' placeholder='{$_M[word][onlineHolder2]}'></td>
                    <td><a href='' class='delet'>{$_M[word][js49]}</a></td>
                </tr>
            "; //HTML代码请看下面的示例
        echo $metinfo;
    }

    function dosave(){
        global $_M;
        $list = explode(",",$_M[form][allid]) ;   //将选择项列表ID拆分为数组
        $type = $_M[form][submit_type];           //表格提交类型
        foreach($list as $id){
            if($id){//不能为空
                if($type=='save'){//用户点击了保存按钮
                    $no_order = $_M['form']['no_order-'.$id];
                    $name = $_M['form']['name-'.$id];
                    $qq = $_M['form']['qq-'.$id];
                    $msn = $_M['form']['msn-'.$id];
                    $taobao    = $_M['form']['taobao-'.$id];
                    $alibaba    = $_M['form']['alibaba-'.$id];
                    $skype    = $_M['form']['skype-'.$id];
                    if(is_number($id)){//修改
                        $query = "UPDATE {$_M['table']['online']} SET
                        `name` = '{$name}',
                        `no_order` = '{$no_order}',
                        `qq` = '{$qq}',
                        `msn` = '{$msn}',
                        `taobao` = '{$taobao}',
                        `alibaba` = '{$alibaba}',
                        `skype` = '{$skype}'
                        WHERE `id` = '{$id}' and `lang` = '{$_M[lang]}'
                        ";
                    }else{//新增
                        $query = "INSERT INTO {$_M['table']['online']} SET
                        `name` = '{$name}',
                        `no_order` = '{$no_order}',
                        `qq` = '{$qq}',
                        `msn` = '{$msn}',
                        `taobao` = '{$taobao}',
                        `alibaba` = '{$alibaba}',
                        `skype` = '{$skype}',
                        `lang` = '{$_M['lang']}'
                        ";
                    }
                }elseif($type=='del'){//删除
                    if(is_number($id)){
                        $query = "DELETE FROM {$_M['table']['online']} WHERE `id`='{$id}' and `lang`='{$_M[lang]}' ";
                    }
                }
                DB::query($query);
            }
        }

        //单个删除
            if($_M[form][submit_type]=='delone' && $_M['form']['onlineid'] != ''){
            $id = $_M['form']['onlineid'];
            if(is_number($id)){
                $query = "DELETE FROM {$_M['table']['online']} WHERE `id`='{$id}' and `lang`='{$_M[lang]}' ";
                DB::query($query);
            }
        }

        cache::del("online_{$_M['lang']}.inc");

        turnover("{$_M[url][own_form]}a=doindex");
    }

    //---------------------------
    function doonline(){
        global $_M;
        nav::select_nav(2);

        $met_online_skinarray[]=array(1,$_M['word']['onlineblue'],1);
        $met_online_skinarray[]=array(1,$_M['word']['onlinered'],2);
        $met_online_skinarray[]=array(1,$_M['word']['onlinepurple'],3);
        $met_online_skinarray[]=array(1,$_M['word']['onlinegreen'],4);
        $met_online_skinarray[]=array(1,$_M['word']['onlinegray'],5);
        $met_online_skinarray[]=array(2,$_M['word']['onlineblue'],1);
        $met_online_skinarray[]=array(2,$_M['word']['onlinered'],2);
        $met_online_skinarray[]=array(2,$_M['word']['onlinepurple'],3);
        $met_online_skinarray[]=array(2,$_M['word']['onlinegreen'],4);
        $met_online_skinarray[]=array(2,$_M['word']['onlinegray'],5);
        $met_online_skinarray[]=array(3,$_M['word']['onlineblue'],1);
        $met_online_skinarray[]=array(3,$_M['word']['onlinered'],2);
        $met_online_skinarray[]=array(3,$_M['word']['onlinepurple'],3);
        $met_online_skinarray[]=array(3,$_M['word']['onlinegreen'],4);
        $met_online_skinarray[]=array(3,$_M['word']['onlinegray'],5);
        $met_online_skinarray[]=array(4,$_M['word']['onlineblue'],1);
        $met_online_skinarray[]=array(4,$_M['word']['onlinered'],2);
        $met_online_skinarray[]=array(4,$_M['word']['onlinepurple'],3);
        $met_online_skinarray[]=array(4,$_M['word']['onlinegreen'],4);
        $met_online_skinarray[]=array(4,$_M['word']['onlinegray'],5);
        $_M['url']['help_tutorials_helpid']='117#在线客服漂浮框设置';
        require $this->template('tem/setonline');
    }

    function doonlinesave(){
        global $_M;
        $_M['form']['met_onlinenameok'] = $_POST['met_onlinenameok'] ? 1 : 0;
        $configlist = array();
        $configlist[] = 'met_online_type';
        $configlist[] = 'met_onlineleft_left';
        $configlist[] = 'met_onlineleft_top';
        $configlist[] = 'met_onlineright_right';
        $configlist[] = 'met_onlineright_top';
        $configlist[] = 'met_online_x';
        $configlist[] = 'met_online_y';
        $configlist[] = 'met_online_skin';
        $configlist[] = 'met_online_color';
        $configlist[] = 'met_onlinetel';
        $configlist[] = 'met_onlinenameok';
        $configlist[] = 'met_qq_type';
        $configlist[] = 'met_msn_type';
        $configlist[] = 'met_taobao_type';
        $configlist[] = 'met_alibaba_type';
        $configlist[] = 'met_skype_type';
        configsave($configlist);/*保存系统配置*/

        cache::del("online_{$_M['lang']}.inc");

        turnover("{$_M[url][own_form]}a=doonline");
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>