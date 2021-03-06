<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('news/admin/news_admin');

class product_admin extends news_admin {
    public $moduleclass;
    public $shop_exists;
    public $shop;
    public $module;
    public $specification_admin;

    /**
     * product_admin constructor.
     */
	function __construct() {
		global $_M;
		parent::__construct();
        ###$this->moduleclass = load::mod_class('content/class/sys_product', 'new');
        $this->shop_exists = false;
        $shop_applist = DB::get_one("SELECT * FROM {$_M['table']['applist']} WHERE `no`='10043'");	//判断商城applist
        $shop_appfile = file_exists(PATH_ALL_APP.'shop');										//商城文件
        if($_M['config']['shopv2_open'] && $shop_applist && $shop_appfile) {
            $this->specification_admin = load::app_class('shop/admin/specification_admin', 'new');
            if($this->shop = load::plugin('doproduct_plugin_class', '99')){
                $this->shop_exists = 1;
                ##$this->shop = load::mod_class('content/class/sys_shop', 'new');
            }
        }
        //$this->paraclass = load::mod_class('system/class/sys_para', 'new');

        $this->module   = 3;
        $this->database = load::mod_class('product/product_database', 'new');

	}

    /*产品管理*/
    function doindex() {
        global $_M;
        $column = $this->column(3,$this->module);
        $list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : '' ;
        $list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : '' ;
        $list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : '' ;
        $tmpname = $this->shop->get_tmpname('product_shop_index');

        if($tmpname && $_M['config']['shopv2_open']==1){
            $tmpname = $this->shop->get_tmpname('product_shop_index');
        } else {
            $tmpname = $this->template('tem/product_index');
        }
        require $tmpname;
        //
    }

	/*产品增加*/
	function doadd() {
		global $_M;
        $redata = array();
		$list = $this->add();
        $list['class1'] = $_M['form']['class1'] ? $_M['form']['class1'] : 0;
        $list['class2'] = $_M['form']['class2'] ? $_M['form']['class2'] : 0;
        $list['class3'] = $_M['form']['class3'] ? $_M['form']['class3'] : 0;
        $list['lnvoice'] = 0;
		$list['auto_sent'] = 0;

        if($this->shop_exists){
            $list = $this->shop->default_value($list);
            $list_s['paraku']=$this->specification_admin->dogetspeclist();
            $list_s['speclist']=jsonencode($list_s['paraku']);
            $list = array_merge($list, $list_s);
        }
        $column_list=$this->_columnjson();
        $access_option = $this->access_option();

        $redata['list'] = $list;
        $redata['access_option'] = $access_option;
        $redata=array_merge($redata,$column_list);

        if (is_mobile()){
            $this->success($redata);
        }else{
            if ($_M['form']['app_type'] == 'shop'){
                require $this->shop->get_tmpname('product_shop');
            }else{
                return $redata;
            }
        }
	}

	function doaddsave() {
		global $_M;
        $redata = array();
        $_M['form']['addtime'] = $_M['form']['addtype'] == 2 ? $_M['form']['addtime'] : date("Y-m-d H:i:s");
		$pid = $this->insert_list($_M['form']);
		if($pid){
			//商城产品属性
            if ($this->shop_exists) {

                $this->shop->save_product($pid,$_M['form']);
            }

           	$url="{$_M['url']['own_form']}a=doindex{$_M['form']['turnurl']}";
            $html_res = load::mod_class('html/html_op', 'new')->html_generate($url, $_M['form']['class1'], $pid);

            //写日志
            logs::addAdminLog('administration','addinfo','jsok','doaddsave');
            if ($_M['form']['app_type']) {
                okinfo($_M['form']['turnurl'], $_M['word']['jsok']);
            }else{
                $redata['status'] = 1;
                $redata['msg'] = $_M['word']['jsok'];
                $redata['html_res'] = $html_res;
                $redata['back_url'] = $url;
                $this->ajaxReturn($redata);
            }
            #load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1'],$pid);
        }else {
            //写日志
            logs::addAdminLog('administration', 'addinfo', 'dataerror', 'doaddsave');
            if ($_M['form']['app_type']) {
                okinfo('-1', $_M['word']['dataerror']);
            }else {
                $redata['status'] = 0;
                $redata['msg'] = $_M['word']['dataerror'];
                $redata['error'] = $this->error;
                $this->ajaxReturn($redata);
            }
        }
	}

    /**
     * @param 前台提交的表单数组 $list
     * @return bool|number
     */
	public function insert_list($list){
		global $_M;
        $list['issue']    = $this->met_admin['admin_id'];

        // $list = $this->form_classlist($list);
        if($list['imgurl']){
            $list = $this->form_imglist($list,$this->module);
        }
        $pid = $this->insert_list_sql($list);
        // 更新TAG标签
            load::sys_class('label','new')->get('tags')->updateTags($list['tag'],$this->module,$list['class1'],$pid,1);
		if($pid){
		    if($this->module == 3 || $this->module == 4 || $this->module == 5){
                //产品 下载 图片
                $this->para_op->insert($pid, $this->module, $list);
            }
			return $pid;
		}else{
			return false;
		}
	}

    /**
     * @param array $list
     * @return bool
     */
	public function insert_list_sql($list = array()){
        return parent::insert_list_sql($list);
	}

    /**
     *系统属性
     */
    public function dopara() {
        global $_M;
        if($_M['form']['app_type']=='shop'){
            $class1 = $_M['form']['class1'];
            $class2 = $_M['form']['class2'];
            $class3 = $_M['form']['class3'];
            $paralist = $this->para_op->paratem($_M['form']['id'],$this->module,$class1,$class2,$class3);
            require PATH_WEB . 'app/system/include/public/ui/admin/paratype.php';
       }else{
            parent::dopara();
        }
    }

    /**
     * 获取栏目信息
     */
    public function doGetColumnSeting()
    {
        global $_M;
        $class1 = $_M['form']['class1'];
        $class2 = $_M['form']['class2'];
        $class3 = $_M['form']['class3'];
        $classnow = $class3 ? $class3 :($class2 ? $class2 : $class1);

        $class = load::mod_class('column/column_label', 'new')->get_column_id($classnow);
        $c123 = load::mod_class('column/column_label', 'new')->get_class123_no_reclass($classnow);

        $c_lev = $class['classtype'];

        //三级栏目
        if ($c_lev == 3) {
            //tab_num
            $tab_num = $c123['class3']['tab_num'] ? $c123['class3']['tab_num'] : ($c123['class2']['tab_num'] ? $c123['class2']['tab_num'] : ($c123['class1']['tab_num'] ? $c123['class1']['tab_num'] : 3));

            //tab_name
            if ($c123['class3']['tab_name'] && $c123['class3']['tab_name'] != '|') {
                $tab_name = explode("|", $c123['class3']['tab_name']);
            }else{
                if ($c123['class2']['tab_name'] && $c123['class2']['tab_name'] != '|') {
                    $tab_name = explode("|", $c123['class2']['tab_name']);
                }else{
                    if ($c123['class1']['tab_name'] && $c123['class1']['tab_name'] != '|') {
                        $tab_name = explode("|", $c123['class1']['tab_name']);
                    }else{
                        $tab_name = array(
                            $_M['config']['met_productTabname'],
                            $_M['config']['met_productTabname_1'],
                            $_M['config']['met_productTabname_2'],
                            $_M['config']['met_productTabname_3'],
                            $_M['config']['met_productTabname_4']
                        );
                    }
                }
            }
        }

        //二级栏目将
        if($c_lev == 2){
            //tab_num
            $tab_num = $c123['class2']['tab_num'] ? $c123['class2']['tab_num'] : ($c123['class1']['tab_num'] ? $c123['class1']['tab_num'] : 3);

            //tab_name
            if ($c123['class2']['tab_name'] && $c123['class2']['tab_name'] != '|') {
                $tab_name = explode("|", $c123['class2']['tab_name']);
            }else{
                if ($c123['class1']['tab_name'] && $c123['class1']['tab_name'] != '|') {
                    $tab_name = explode("|", $c123['class1']['tab_name']);
                }else{
                    $tab_name = array(
                        $_M['config']['met_productTabname'],
                        $_M['config']['met_productTabname_1'],
                        $_M['config']['met_productTabname_2'],
                        $_M['config']['met_productTabname_3'],
                        $_M['config']['met_productTabname_4']
                    );
                }
            }
        }

        //一级栏目
        if ($c_lev == 1) {
            //tab_num
            $tab_num = $c123['class1']['tab_num'] ? $c123['class1']['tab_num'] : 3;

            //tab_name
            if ($c123['class1']['tab_name'] && $c123['class1']['tab_name'] != '|') {
                $tab_name = explode("|", $c123['class1']['tab_name']);
            }else{
                $tab_name = array(
                    $_M['config']['met_productTabname'],
                    $_M['config']['met_productTabname_1'],
                    $_M['config']['met_productTabname_2'],
                    $_M['config']['met_productTabname_3'],
                    $_M['config']['met_productTabname_4']
                );
            }
        }


        $redata['tab_name'] = "{$tab_name[0]}|{$tab_name[1]}|{$tab_name[2]}|{$tab_name[3]}|{$tab_name[4]}";
        $redata['tab_num']  = $tab_num;
        $this->ajaxReturn($redata);
    }

    /**
     * 产品编辑
     */
	public function doeditor() {
		global $_M;
        $redata = array();
        $id = $_M['form']['id'];

        if ($id && is_numeric($id)) {
            $list = $this->database->get_list_one_by_id($id);
            $list = $this->listAnalysis($list);
            $list['class1']=$list['class1']!=''?$list['class1']:0;
            $list['class2']=$list['class2']!=''?$list['class2']:0;
            $list['class3']=$list['class3']!=''?$list['class3']:0;
            $list['imgurl_all'] = $list['imgurl'];
            $displayimg = explode("|",$list['displayimg']) ;
            foreach($displayimg as $val){
                if($val){
                    $img = explode("*",$val);
                    $list['imgurl_all'].= '|'.$img[1];
                }
            }
            $list['imgurl_all'] = trim($list['imgurl_all'], '|');
            if($list['classother']){
                $list['classother_str'] = str_replace("-|-",'|',$list['classother']);
                $list['classother_str'] = str_replace('|-','|',$list['classother_str']);
                $list['classother_str'] = str_replace('-|','',$list['classother_str']);
            }

            //商城商品数据
            if($this->shop_exists){
                $list_s = $this->shop->default_value($list);
                $list_s['paraku']=$this->specification_admin->dogetspeclist();
                $list_s['speclist']=jsonencode($list_s['paraku']);
                $list = array_merge($list, $list_s);
            }
            $column_list=$this->_columnjson();
            $access_option = $this->access_option('',$list['access']);

            $redata['list'] = $list;
            $redata['access_option'] = $access_option;
            $redata=array_merge($redata,$column_list);

            if (is_mobile()){
                $this->success($redata);
            }else{
                if ($_M['form']['app_type'] == 'shop'){

                    require $this->shop->get_tmpname('product_shop');
                }else{
                    return $redata;
                }


            }
        }
        if (is_mobile()){
            $this->error();
        }else{
            return false;
        }

        /*$redata['status'] = 0;
        $redata['msg'] = 'Data error';
        $this->ajaxReturn($redata);*/
	}

    /**
     * 保存编辑
     */
	function doeditorsave() {
		global $_M;
        $redata = array();
        $list = $_M['form'];
        $id = $_M['form']['id'];

        if (!is_numeric($id)) {
            //写日志
            logs::addAdminLog('administration','physicalupdate','dataerror','doeditorsave');
            $redata['status']   = 0;
            $redata['msg']      = $_M['word']['dataerror'];
            $redata['error']    = "No id";
            $this->ajaxReturn($redata);
        }
        //发布信息需要审核才能正常显示
        $admin_info = admin_information();
        if ($admin_info['admin_check'] == 1 && !strstr($admin_info['admin_type'],'metinfo')){
            $list['displaytype'] = 0;
        }
		if($this->update_list($list, $id)){
            if ($this->shop_exists && $_M['form']['app_type'] == 'shop') {
                $this->shop->save_product($id,$list);
            }
			//if($_M['config']['met_webhtm'] == 2 && $_M['config']['met_htmlurl'] == 0){
			$url="{$_M['url']['own_form']}a=doindex&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}";
            $html_res = load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1'],$_M['form']['id']);
            //写日志
            logs::addAdminLog('administration','editor','jsok','doaddsave');
            if ($_M['form']['app_type']){
                okinfo($_M['form']['turnurl'],$_M['word']['jsok']);
            }else{
                $redata['status']   = 1;
                $redata['msg']      = $_M['word']['jsok'];
                $redata['html_res'] = $html_res;
                $redata['back_url'] = $url;
                $this->ajaxReturn($redata);
            }
		}else {
            //写日志
            logs::addAdminLog('administration', 'editor', 'dataerror', 'doeditorsave');

            if ($_M['form']['app_type']) {
                okinfo('-1',$_M['word']['dataerror']);
            }else{
                $redata['status'] = 0;
                $redata['msg'] = $_M['word']['dataerror'];
                $this->ajaxReturn($redata);
            }
        }
	}

	/*编辑产品*/
	public function update_list($list = array(), $id = ''){
        return parent::update_list($list, $id);
		/*$list = $this->form_classlist($list);
		if($list['imgurl'])$list = $this->form_imglist($list,$this->module);

		if($this->update_list_sql($list,$id)){
			$this->para_op->update($id, $this->module, $list);
			return true;
		}else{
			return false;
		}*/
	}

    /**
	 * 保存修改sql
     * @param array $list
     * @param string $id
     * @return bool
     */
	public function update_list_sql($list = array(),$id = '')
    {
        if (!$list['title']) {
            $this->error[] = 'no title';
            return false;
        }
        if (!$this->check_filename($list['filename'], $id, 3)) {
            return false;
        }
        if ($list['links']) {
            $list['links'] = url_standard($list['links']);
        }
        if ($list['description']) {
            $listown = $this->database->get_list_one_by_id($id);
            $description = $this->description($listown['content']);
            if ($list['description'] == $description) {
                $list['description'] = $this->description($list['content']);
            }
        } else {
            $list['description'] = $this->description($list['content']);
        }
        $list['displayimg'] = $this->displayimg_check($list['displayimg']);
        $list['addtime']    = $list['addtype'] == 2 ? $list['addtime'] : $list['updatetime'];
        // $list['updatetime'] = $list['update_list'] ? $list['update_list'] : date("Y-m-d H:i:s");
        $list['id'] = $id;
        return $this->database->update_by_id($list);
    }

	/*去除多余的displayimg里面的图片数据*/
	public function displayimg_check($img){
		$imgs = stringto_array($img, '*', '|');
		$str = '';
		foreach($imgs as $val){
			if($val[1]){
				$str .="{$val[0]}*{$val[1]}*{$val[2]}|";//增加展示图片尺寸值{$val[2]}（新模板框架v2）
			}
		}
		$str = trim($str, '|');
		return $str;
	}

	function dojson_list()
    {
        global $_M;
        $redata = array();
        if ($this->shop_exists && $_M['form']['app_type'] == 'shop') {
            $this->shop->plgin_json_list();
            die();
        }else{
            $class1 = is_numeric($_M['form']['class1_select']) ? $_M['form']['class1_select'] : (is_numeric($_M['form']['class1']) ? $_M['form']['class1'] : '');
            $class2 = is_numeric($_M['form']['class2_select']) ? $_M['form']['class2_select'] : (is_numeric($_M['form']['class2']) ? $_M['form']['class2'] : '');
            $class3 = is_numeric($_M['form']['class3_select']) ? $_M['form']['class3_select'] : (is_numeric($_M['form']['class3']) ? $_M['form']['class3'] : '');
            $keyword = $_M['form']['keyword'];
            $search_type = $_M['form']['search_type'];
            foreach ($_M['form']['order'] as $key => $value) {
                $order[$value['name']]=$value['value'];
            }

            $list = self::_dojson_list($class1, $class2, $class3, $keyword, $search_type, $order['hits'], $order['updatetime']);
		}
        $this->json_return($list);
        /*$redata['data'] = $list;
        $this->ajaxReturn($redata);*/
    }

    /**
     * @param string $class1
     * @param string $class2
     * @param string $class3
     * @param string $keyword
     * @param string $search_type
     * @param string $orderby_hits
     * @param string $orderby_updatetime
     * @return array
     */
    public function _dojson_list($class1 = '', $class2 = '', $class3 = '', $keyword = '', $search_type = '', $orderby_hits = '', $orderby_updatetime = ''){
		global $_M;
        $ps = '';
        $where = $class1 ? "and class1 = '{$class1}'" : '';
        $where .= $class2 ? " and class2 = '{$class2}'" : '';
        $where .= $class3 ? " and class3 = '{$class3}'" : '';
        $where .= $keyword ? " and title like '%{$keyword}%'" : '';
        switch ($search_type) {
            case 0:
                break;
            case 1:
                $where .= " and {$ps}displaytype = '0'";
                break;
            case 2:
                $where .= " and {$ps}com_ok = '1'";
                break;
        }

        if ($class3) {
            $classother = "|-{$class1}-{$class2}-{$class3}-|";
        } else {
            if ($class2) {
                $classother = "|-{$class1}-{$class2}-0-|";
            } else {
                $classother = "|-{$class1}-0-0-|";
            }
        }
        $where .= " or classother like '%{$classother}%'";


        $met_class = $this->column(2, $this->module);
        if ($class3) {
            $classnow = $class3;
        } elseif ($class2) {
            $classnow = $class2;
        } else {
            $classnow = $class1;
        }
        $order = $this->list_order($met_class[$classnow]['list_order']);
        if ($orderby_hits) $order = "{$ps}hits {$orderby_hits}";
        if ($orderby_updatetime) $order = "{$ps}updatetime {$orderby_updatetime}";

        $data = $this->json_list($where, $order);

        foreach ($data as $key => $val) {
            $val['url'] = $this->url($val, $this->module);
            // $val['displaytype'] = $val['displaytype'];
            // $state = array();
            // $val['displaytype'] ? array_push($state,$_M['word']['displaytype2']) : '';
            // strtotime($val['addtime']) > time() ? array_push($state,$_M['word']['timedrelease']) : '';
            // $val['com_ok'] ? array_push($state,$_M['word']['recom']) : '';
            // $val['top_ok'] ? array_push($state,$_M['word']['top']) : '';
            // $var['state'] = $state;

            $row = array();
            $row['id'] 		    = $val['id'];
            $row['no_order']    = $val['no_order'];
            $row['title'] 	    = $val['title'];
            $row['url'] 	    = $val['url'];
            $row['imgurl'] 	    = $val['imgurl'];
            $row['com_ok'] 	    = $val['com_ok'];
            $row['top_ok'] 	    = $val['top_ok'];
            $row['displaytype'] = $val['displaytype'];
            $row['addtype'] = strtotime($val['addtime'])>time()?1:0;
            $row['price_html'] 	= $val['price_html'];
            $row['hits'] 	    = $val['hits'];
            $row['updatetime'] 	= $val['updatetime'];
            #$row['state'] 	    = $state;
            $row['editor_url'] 	= "{$_M['url']['own_form']}a=doeditor&id={$val['id']}&class1={$class1}&class2={$class2}&class3={$class3}";
            $row['del_url'] = "{$_M['url']['own_form']}a=dolistsave&submit_type=del&allid={$val['id']}";
            $rarray[] = $row;
        }
        return $rarray;
	}


    /**
     * @param array $where
     * @param array $order
     * @return mixed
     */
	public function json_list($where = '', $order = ''){
		global $_M;
		$this->tabledata = load::sys_class('tabledata', 'new');

		$p = $_M['table']['product'];
		$s = $_M['table']['shopv2_product'];

		if($this->shop_exists){//开启在线订购时
			$table = $p.' Left JOIN '.$s." ON ({$p}.id = {$s}.pid)";
			$where = "{$p}.lang='{$_M['lang']}' and ({$p}.recycle = '0' or {$p}.recycle = '-1') {$where}";
		}else{
			$table = $p;
			$where = "lang='{$_M['lang']}' and (recycle = '0' or recycle = '-1') {$where}";
		}

        if ($this->met_admin['admin_issueok']) {
		    $where = "({$where})  and (issue = '{$this->met_admin['admin_id']}')";
        }

        $data = $this->tabledata->getdata($table, '*', $where, $order);
		return $data;
	}

    /**
     * @param array $data
     */
    public function json_return($data){
        global $_M;
        $this->tabledata->rdata($data);
    }

    /**
     * 保存列表
     */
	public function dolistsave(){
		global $_M;
		$list = explode(",",$_M['form']['allid']) ;
		foreach($list as $id){
			if($id){
				switch($_M['form']['submit_type']){
					case 'save':
						$list['no_order'] 	 = $_M['form']['no_order-'.$id];
						$this->list_no_order($id,$list['no_order']);
						$log_name = 'submit';
					break;
					case 'del':
						$this->del_list($id,$_M['form']['recycle']);
                        $log_name = 'jslang1';
                        if($_M['form']['recycle']==0){
                            $para_op = load::mod_class("parameter/parameter_op", 'new');
							$para_op->del_plist($id,3);
                            if ($this->shop_exists) {
                                $this->shop->del_product($id);
                            }
                            $log_name = 'jslang0';
                        }
					break;
					case 'comok':
                        $log_name = 'recom';
                        $this->list_com($id,1);
					break;
					case 'comno':
                        $log_name = 'unrecom';
                        $this->list_com($id,0);
					break;
					case 'topok':
                        $log_name = 'top';
                        $this->list_top($id,1);
					break;
					case 'topno':
                        $log_name = 'untop';
                        $this->list_top($id,0);
					break;
					case 'displayok':
                        $log_name = 'frontshow';
                        $this->list_display($id,1);
					break;
					case 'displayno':
                        $log_name = 'fronthidden';
                        $this->list_display($id,0);
					break;
					case 'move':
                        $log_name = 'columnmove1';
                        $class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$this->list_move($id,$class1,$class2,$class3);
					break;
					case 'copy':
                        $log_name = 'copyotherlang2';
                        $class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$newid = $this->list_copy($id,$class1,$class2,$class3);
					break;
                    case 'copy_tolang':
                        $log_name = 'copy_tolang';
                        $new_class = explode("-", $_M['form']['columnid']);
                        $tolang = $_M['form']['tolang'];
                        $module = $_M['form']['module'];
                        $res = $this->copy_tolang($id, $module, $tolang, $new_class);
                    break;
				}
			}
		}

        if (!$this->error) {
            $url = "{$_M['url']['own_form']}a=doindex&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}";
            $html_res = load::mod_class('html/html_op', 'new')->html_generate($url, $_M['form']['class1'], $_M['form']['id']);
            $redata['status']   = 1;
            $redata['msg']      = $_M['word']['jsok'];
            $redata['html_res'] = $html_res;
            $redata['back_url'] = $url;
            //写日志
            logs::addAdminLog('administration',$log_name,'jsok','dolistsave');
        }else{
            $redata['status']   = 0;
            $redata['msg']      = $this->error[0];
            $redata['error']    = $this->error;
            //写日志
            logs::addAdminLog('administration',$log_name,$this->error[0],'dolistsave');

        }

        if ($_M['form']['app_type']) {
            okinfo('-1',$redata['msg']);
        }else {
            $this->ajaxReturn($redata);
        }

		$old_class_str="&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}";
		$url="{$_M[url][own_form]}a=doindex&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}";
		load::mod_class('html/html_op', 'new')->html_generate($url,$_M['form']['class1'],$_M['form']['id']);
	}

	/*复制*/
	public function list_copy($id = '', $class1 = '', $class2 = '', $class3 = ''){
		global $_M;
        if ($id && is_numeric($id)) {
            $list =$this->database->get_list_one_by_id($id);
            $list['filename'] = '';
            $list['class1']   = $class1;
            $list['class2']   = $class2;
            $list['class3']   = $class3;
            $list['updatetime']  = date("Y-m-d H:i:s");
            $list['addtime']  = date("Y-m-d H:i:s");
            $list['content']  = str_replace('\'','\'\'',$list['content']);
            $list['content1'] = str_replace('\'','\'\'',$list['content1']);
            $list['content2'] = str_replace('\'','\'\'',$list['content2']);
            $list['content3'] = str_replace('\'','\'\'',$list['content3']);
            $list['content4'] = str_replace('\'','\'\'',$list['content4']);

            $copyid     = $this->insert_list_sql($list); //复制产品参数
            if ($this->module == 3 || $this->module == 4 || $this->module == 5) {
                $this->para_copy($id, $copyid);
            }

            //开启在线订购时
            if ($this->shop_exists) {
                $this->shop->copy_product($id,$copyid);
            }
            return $copyid;
        }
        $this->error[] = 'error no id';
        return false;
	}

    /**
     * 多语言内容复制
     */
    public function copy_tolang($id = '' , $module = '', $tolang = '' , $new_class = '')
    {
        global $_M;
        if ($id && $module && $tolang && $new_class) {
            $content = $this->database->get_list_one_by_id($id);
            if ($content) {
                $content['id'] = '';
                $content['filename'] = '';
                $content['class1'] = $new_class[0];
                $content['class2'] = $new_class[1];
                $content['class3'] = $new_class[2];
                $content['updatetime'] = date("Y-m-d H:i:s");
                $content['addtime'] = date("Y-m-d H:i:s");
                $content['content'] = str_replace('\'', '\'\'', $content['content']);
                $content['content1'] = str_replace('\'', '\'\'', $content['content1']);
                $content['content2'] = str_replace('\'', '\'\'', $content['content2']);
                $content['content3'] = str_replace('\'', '\'\'', $content['content3']);
                $content['content4'] = str_replace('\'', '\'\'', $content['content4']);
                $content['lang'] = $tolang ? $tolang : $content['lang'];
                $new_id = $this->database->insert($content);
                if ($new_id) {
                    return $new_id;
                }
            }
            $this->error[] = "Content replication failed";
            return false;
        }
    }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
