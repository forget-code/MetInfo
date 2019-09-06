<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

#load::mod_class('news/admin/news_admin');
load::mod_class('message/admin/message_admin');

class job_manage extends message_admin {
    public $moduleclass;

	public $module;

	public $database;

	public $tabledata;

    public $plist_database;

	/**
	 * 初始化
	 */
	function __construct() {
		global $_M;
		parent::__construct();
		$this->module       = 6;
		$this->database     = load::mod_class('job/job_database', 'new');
		$this->tabledata    = load::sys_class('tabledata', 'new');
        $this->plist_database = load::mod_class('parameter/parameter_list_database', 'new');
        $this->plist_database->construct($this->module);
	}

    /*信息管理*/
    public function dojob_info()
    {
        global $_M;
        $class1 = $_M['form']['class1'];
        $class2 = $_M['form']['class2'];
        $class3 = $_M['form']['class3'];
        if ($class3) {
            $classnow = $class3;
        } elseif ($class2) {
            $classnow = $class2;
        } else {
            $classnow = $class1;
        }

        $config_op = load::mod_class('config/config_op', 'new');
        $conlum_configs = $config_op->getColumnConfArry($classnow);
        $met_cv_showcol = explode('|', $conlum_configs['met_cv_showcol']);

        $para_list = $this->database->get_module_para($classnow, $this->module);
        $parameter_database = load::mod_class('parameter/parameter_database', 'new');
        $showcol = array();

        foreach ($met_cv_showcol as $paraid) {
            foreach ($para_list as $val) {
                if ($paraid == $val['id']) {
                    //表单分类字段下拉列表
                    if ($val['type'] == 2 || $val['type'] == 6) {
                        $options = $parameter_database->get_parameters($val['module'], $val['id']);

                        $op_data = array();
                        $op_data['list'][] = array(
                            'name' => $_M['word']['cvall'],
                            'val' => '',
                        );

                        foreach ($options as $option) {
                            $op_data['list'][] = array(
                                'name' => $option['value'],
                                'val' => $option['value'],
                                #'val'   =>  $option['id'],
                            );
                        }

                        $val['options'] = $op_data;
                        $showcol[] = $val;
                    } else {
                        $showcol[] = $val;
                    }
                }
            }

        }
        $redata['showcol'] = $showcol;
        return $redata;
    }

    public function dojson_list(){
        global $_M;
        $redata = array();
        $class1             = $_M['form']['class1'];
        $class2             = $_M['form']['class2'];
        $class3             = $_M['form']['class3'];
        $keyword            = $_M['form']['keyword'];
        $search_type        = $_M['form']['search_type'];
        $orderby_hits       = $_M['form']['orderby_hits'];
        $orderby_updatetime = $_M['form']['orderby_updatetime'];

        $list = $this->_dojson_list($class1, $class2, $class3, $keyword, $search_type, $orderby_hits, $orderby_updatetime);
        $redata['data'] = $list;
        $this->ajaxReturn($redata);
    }


    public function _dojson_list($class1 , $class2 , $class3 , $keyword = '', $search_type = '', $orderby_hits = '', $orderby_updatetime = '')
    {
        global $_M;
        $class = array();
        $class['class1'] = $class1 ? $class1 : 0;
        $class['class2'] = $class2 ? $class2 : 0;
        $class['class3'] = $class3 ? $class3 : 0;
        if ($class3) {
            $classnow = $class3;
        } elseif ($class2) {
            $classnow = $class2;
        } else {
            $classnow = $class1;
        }
        $lang = $_M['lang'];

        $config_op = load::mod_class('config/config_op', 'new');
        $met_cv_showcol = $config_op->getColumnConf($classnow, 'met_cv_showcol');
        if ($met_cv_showcol) {
            $met_cv_showcol = explode('|', $met_cv_showcol);
        } else {
            $met_cv_showcol = null;
        }

        $where = " lang='{$lang}' ";
        if (isset($_M['form']['jobid']) && $_M['form']['jobid']) {
            $where .= " AND jobid='{$_M['form']['jobid']}' ";
        }
        $where .= $keyword ? " and customerid like '%{$keyword}%' " : '';
        switch ($search_type) {
            case 0:
                break;
            case 1:
                $where .= "AND readok = '0'";
                break;
            case 2:
                $where .= "AND readok = '1'";
                break;
        }
        $order = ' addtime desc ';

        #$cv_list = $this->json_list($where, $order);
        $cv_list = $this->tabledata->getdata($_M['table']['cv'], '*', $where, $order);


        $para_check = 0;
        $search_check = 0;
        foreach ($cv_list as $key => $val) {
            /*$query = "SELECT * FROM {$_M['table']['flist']} WHERE listid = {$val['id']}";
            $flist = DB::get_all($query);*/
            $flist = $this->plist_database->get_by_listid($val['id']);

            $para_mark = array();
            $search_mark = array();

            foreach ($flist as $f) {
                //启用筛选
                if ($_M['form']['para_' . $f['paraid']]) {
                    $para_check = 1;
                }
                if ($_M['form']['para_' . $f['paraid']] != $f['info'] && $_M['form']['para_' . $f['paraid']]) {
                    $para_mark[] = $f;
                }

                //启用收索
                if ($keyword) {
                    $search_check = 1;
                }
                if ($keyword && strstr($f['info'], $keyword)) {
                    $search_mark[] = $f;
                }
            }

            if ($para_check && $search_check) {
                if (!$para_mark && $search_mark) {
                    $res[] = $val;
                }
            }

            if ($para_check && !$search_check) {
                if (!$para_mark) {
                    $res[] = $val;
                }
            }

            if ($search_check && !$para_check) {
                if ($search_mark) {
                    $res[] = $val;
                }
            }

        }

        if ($para_check || $search_check) {
            $cv_list = $res;
        }


        $rarray = array();
        foreach ($cv_list as $key => $row) {
            $job_info = $this->database->get_list_one_by_id($row['jobid']);
            if ($job_info['class1'] != $class['class1'] || $job_info['class2'] != $class['class2'] || $job_info['class3'] != $class['class3']) {
                continue;
            }
            $list = $row;
            if ($_M['config']['met_member_use']) {
                switch ($row['access']) {
                    case '1':
                        $list['access'] = array('name' => $_M['word']['access1'], 'val' => $row['access']);
                        break;
                    case '2':
                        $list['access'] = array('name' => $_M['word']['access2'], 'val' => $row['access']);
                        break;
                    case '3':
                        $list['access'] = array('name' => $_M['word']['access3'], 'val' => $row['access']);
                        break;
                    default:
                        $list['access'] = array('name' => $_M['word']['access0'], 'val' => $row['access']);
                        break;
                }
            }

            $list['customerid'] = $row['customerid'] == '0' ? $_M['word']['feedbackAccess0'] : $row['customerid'];
            $list['position'] = $job_info['position'];
            $list['readok'] = $row['readok'];
            //属性
            if ($met_cv_showcol) {
                foreach ($met_cv_showcol as $paraid) {
                    $this->plist_database = load::mod_class('parameter/parameter_list_database', 'new');
                    $this->plist_database->construct($this->module);
                    $info_list = $this->plist_database->select_by_listid_paraid($row['id'], $paraid);
                    $list['para_list']['para_' . $paraid] = $info_list['info'];
                }
            }

            $list['view_url'] = $_M['url']['own_form'] . "a=doview&lang={$lang}&id={$row['id']}&class1_select={$class1}&class2_select={$class2}&class3_select={$class3}";
            $list['del_url'] = $_M['url']['own_form'] . "a=dolistsave&lang={$lang}&allid={$row['id']}&submit_type=del&class1_select={$class1}";

            $rarray[] = $list;
        }
        return $this->json_return($rarray);
    }

    /**
     * @param array $data
     */
    public function json_return($data){
        global $_M;
        $this->tabledata->rdata($data);
    }

    /**
     * 查看简历
     */
    public function doview() {
        global $_M;
        $redata = array();
        $id     = $_M['form']['id'];
        $lang   = $_M['lang'];
        $class1 = $_M['form']['class1'];
        $class2 = $_M['form']['class2'];
        $class3 = $_M['form']['class3'];

        $query = "UPDATE {$_M['table']['cv']} SET readok  = '1' WHERE id='{$id}' AND lang='{$lang}'";
        DB::query($query);
        $query = "SELECT * FROM {$_M['table']['cv']} WHERE id='{$id}'";
        $cv_info = DB::get_one($query);
        if ($cv_info) {
            //栏目属性列表
            $para_list = $this->para_op->get_para_list($this->module, $class1, $class2, $class3);

            foreach ($para_list as $key => $para) {
                //属性值
                $this->plist_database = load::mod_class('parameter/parameter_list_database','new');
                $this->plist_database->construct($this->module);
                $plist = $this->plist_database->select_by_listid_paraid($id, $para['id']);
                $cv_info['plist'][] = array(
                    'name'    => $para['name'],
                    'val'     => $plist['info'],
                    'type'    => $para['type'],
                    'id'      => $plist['id'],
                    'paraid'  => $para['id'],
                    'listid'  => $id
                );
            }
        }
        $redata['list'] = $cv_info;
        if (is_mobile()){
            $this->success($redata);
        }else{
            return $redata;
        }
    }

    /**
     * 列表操作保存
     */
    public function dolistsave()
    {
        global $_M;
        parent::dolistsave();
    }

    /*删除简历*/
    public function del_list($id)
    {
        global $_M;
        $this->plist_database->del_by_listid($id);
        $query = "DELETE FROM {$_M['table']['cv']} WHERE id = '{$id}'";
        DB::query($query);
        return;
    }

    /**
     * 招聘模块参数设置
     */
    public function dosyset()
    {
        global $_M;
        $redata = array();
        $class1 = $_M['form']['class1'] ? $_M['form']['class1'] : '';
        $class2 = $_M['form']['class2'] ? $_M['form']['class2'] : '';
        $class3 = $_M['form']['class3'] ? $_M['form']['class3'] : '';
        $classnow = $class3 ? $class3 :($class2 ? $class2 : $class1);

        #$para_list = $this->para_op->get_para_list($this->module, $class1, $class2, $class3);

        $config_op = load::mod_class('config/config_op', 'new');
        $conlum_configs = $config_op->getColumnConfArry($classnow);
        #dump($conlum_configs);

        //栏目配置
        $met_cv_showcol_id = explode('|', $conlum_configs['met_cv_showcol']);
        $met_cv_showcol = array();
        $parameters = $this->para_op->get_para_list($this->module, $class1 ,$class2, $class3);
        foreach ($parameters as $para) {
            $row = array();
            $row['id']      = $para['id'];
            $row['name']    = $para['name'];
            if (in_array($para['id'], $met_cv_showcol_id)) {
                $met_cv_showcol['val'].= $para['id'].'|';
            }
            $met_cv_showcol['options'][]    = $row;
        }
        $redata['list']['met_cv_showcol']   = $met_cv_showcol;//列表显示属性
        $redata['list']['met_cv_image']     = $this->get_config_field(5,$conlum_configs['met_cv_image'],$classnow);//邮箱附件字段
        $redata['list']['met_cv_email']     = $this->get_config_field(9,$conlum_configs['met_cv_email'],$classnow);////Email字段名
        $redata['list']['met_cv_type']      = $conlum_configs['met_cv_type'] ? $conlum_configs['met_cv_type'] : '0';//简历接收方式
        $redata['list']['met_cv_emtype']    = $conlum_configs['met_cv_emtype'] ? $conlum_configs['met_cv_emtype'] : '0';//邮件接收方式
        $redata['list']['met_cv_back']      = $conlum_configs['met_cv_back'];     //用户邮件自动回复
        $redata['list']['met_cv_to']        = $conlum_configs['met_cv_to'];       //用户简历接收邮箱
        $redata['list']['met_cv_title']     = $conlum_configs['met_cv_title'];    //用户回复邮件标题
        $redata['list']['met_cv_content']   = $conlum_configs['met_cv_content'];  //用户回复邮件内容
        $redata['list']['met_cv_sms_back']   = $conlum_configs['met_cv_sms_back'];  //用户短信自动回复开关
        $redata['list']['met_cv_sms_tell']   =  $this->get_config_field(8,$conlum_configs['met_cv_sms_tell'],$classnow);  //用户短信自动回复号码
        $redata['list']['met_cv_sms_content']   = $conlum_configs['met_cv_sms_content'];  //用户短信自动回复内容
        $redata['list']['met_cv_time']      = $conlum_configs['met_cv_time'];     //防刷新时间
        $redata['list']['met_cv_job_tel']   = $conlum_configs['met_cv_job_tel'];  //短信通知号码

        //通用配置
        $redata['list']['class1']           = $class1;
        $redata['list']['class2']           = $class2;
        $redata['list']['class3']           = $class3;
        $redata['list']['classnow']         = $classnow;
        if (is_mobile()){
            $this->success($redata);
        }else{
            return $redata;
        }

        #$this->ajaxReturn($redata);
    }

    /**
     * 保存配置
     */
    public function dosaveinc()
    {
        global $_M;
        $redata = array();
        $list   = $_M['form'];
        $class1 = $_M['form']['class1'];
        $class2 = $_M['form']['class2'];
        $class3 = $_M['form']['class3'];
        $classnow = $_M['form']['classnow'];

        if (!is_numeric($classnow)) {
            $redata['status']   = 0;
            $redata['msg']      = $_M['word']['dataerror'];
            $redata['error']    = "Data error no classnow";
            $this->ajaxReturn($redata);
        }

        $config_op = load::mod_class('config/config_op', 'new');
        $conlum_configs = $config_op->getColumnConfArry($classnow);

        foreach ($conlum_configs as $name => $val) {
            if (isset($list[$name]) && $list[$name] != $conlum_configs[$name]) {
                $config_op->saveColumnConf($classnow, $name, $list[$name]);
            }
        }

        buffer::clearConfig();
        $redata['status']   = 1;
        $redata['msg']      = $_M['word']['jsok'];
        $this->ajaxReturn($redata);
    }

    /**
     * @param string $type
     * @param string $value
     * @return mixed
     */
    public function get_config_field($type = '' ,$value = '' ,$classnow = '')
    {
        global $_M;
        $class123 = $class123 = load::sys_class('label', 'new')->get('column')->get_class123_no_reclass($classnow);
        $paralist = load::mod_class('parameter/parameter_database', 'new')->get_parameter('6',$class123['class1']['id'],$class123['class2']['id'],$class123['class3']['id']);
        $list = array();
        $unll = $_M['word']['please_choose'] ? $_M['word']['please_choose'] : '--';
        $list[] = array('name' => $unll, 'val' => '');
        foreach ($paralist as $key => $val) {
            if ($val['type'] == $type) {
                $list[] = array('name' => $val['name'], 'val' => $val['id']);
            }
        }
        $redata['val']      = $value;
        $redata['options']  = $list;
        return $redata;

    }

}



# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
