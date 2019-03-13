<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class temtool extends admin {
	public $UI;
	public function __construct() {
		global $_M;
		parent::__construct();
		nav::set_nav(1, '模板管理', $_M['url']['own_form'].'&a=dotemlist');
		$this->UI = load::own_class('admin/class/UI','new');
	}

	public function dotemlist() {
		global $_M;
		nav::select_nav(1);
		require $this->template('own/temlist');
	}

	public function dotable_temlist_json() {
		global $_M;
		$table = load::sys_class('tabledata', 'new');
		$where = "";
		$order = "";
		$array = $table->getdata($_M['table']['skin_table'], '*', $where, $order);

		foreach ($array as $value) {
			$table_tem[] = $value['skin_name'];
		}
		foreach (scandir(PATH_WEB.'templates') as $t) {
			if(!in_array($t, array_values($table_tem)) && $t != '.' && $t != '..' && is_file(PATH_WEB.'templates/'.$t.'/ui.json')){
				$array[]['skin_name'] = $t;
			}
		}

		foreach($array as $key => $val) {
			$list = array();
			$skin_name = $val['skin_name'];
			$progress = "<div class=\"progress progress-striped hide {$skin_name}_progress\" style='width:20%'>
			    <div class=\"{$skin_name}_progress-bar progress-bar progress-bar-success\" role='progressbar' aria-valuenow='0'
			        aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>
			        <span class=\"{$skin_name}_name\"></span>
			    </div>
			</div>";

			$info = "";
			if(!$_M['config']['met_secret_key']){
				if(strstr($skin_name, 'ui')){
					$info = "<span>
						请使用已购买模板的账号在增值服务中
						<a href=\"{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=appstore&c=appstore&c=member&a=dologin\" >登录官方商城</a>后再进行升级操作
						</span>";
				}


			}else{
				if(strstr($skin_name, 'ui')){
					if(!$val['id']){
						$info = "<a href=\"javascript:;\" class='tem_import' data-name=\"{$skin_name}\">导入</a>{$progress}";
					}else{

						$info = "<a href='javascript:;' class='update_ui_list hide' data-url=\"{$_M['url']['own_name']}c=uiset&a=doupdate&skin_name={$skin_name}\" id=\"{$skin_name}\">升级</a>{$progress}";
					}
				}
			}

			if($val['id']){
				$info .= "<a href=\"{$_M['url']['own_name']}c=uiset&a=dodel_template&id={$val['id']}&skin_name={$skin_name}\" data-confirm=\"您确定要删除该模板吗？删除之后无法再恢复。\"> 删除</a> ";
			}
			$tem_inc = PATH_WEB.'templates/'.$skin_name.'/metinfo.inc.php';

            $view = "{$_M['url']['site']}templates/{$skin_name}/view.jpg";
            $view_path = PATH_WEB."templates/{$skin_name}/view.jpg";
            if(!file_exists($view_path)){
                $view = "{$_M['url']['site']}app/system/login/admin/templates/img/login-logo.png";
            }
			$list[] = "<img src=\"{$view}\" width='150' style='padding:5px; background:#fff; border:1px solid #ddd;' />";
			$list[] = $skin_name;

			$list[] = $info;

			$rarray[] = $list;
		}
		$table->rdata($rarray);
	}

	public function dotemin() {
		global $_M;
		require $this->template('own/temin');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>