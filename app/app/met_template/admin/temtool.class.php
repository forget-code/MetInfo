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
		nav::set_nav(1, $_M['word']['met_template_templates'], $_M['url']['own_form'].'&a=dotemlist');
		nav::set_nav(2, $_M['word']['met_template_othertemplates'], "{$_M['url']['site_admin']}index.php?lang={$_M['lang']}&n=theme&c=theme&a=doindex&from_page=met_template");
		$this->UI = load::own_class('admin/class/UI','new');
	}

	public function dotemlist() {
		global $_M;
		nav::select_nav(1);
		$status = load::mod_class('appstore/include/inapp', 'new')->get_appstore_status();

		require $this->template('own/temlist');
	}

	public function dotable_temlist_json() {
		global $_M;
		$table = load::sys_class('tabledata', 'new');

		$templates = $this->UI->list_my_templates();
		$local = array();
		foreach (scandir(PATH_WEB.'templates') as $t) {
			if($t != '.' && $t != '..' && file_exists(PATH_WEB.'templates/'.$t.'/ui.json')){
				$local[] = $t;
			}
		}
		if($templates['status']){
			$skins = array_unique(array_merge($templates['data'],$local));
		}else{
			$skins = $local;
		}

		foreach ($skins as $key => $skin_name) {
			$list = array();

			$progress = "<div class=\"progress progress-striped hide {$skin_name}_progress\" style='width:20%'>
		    <div class=\"{$skin_name}_progress-bar progress-bar progress-bar-success\" role='progressbar' aria-valuenow='0'
		        aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>
		        <span class=\"{$skin_name}_name\"></span>
		    </div>
			</div>";
			$query = "SELECT id FROM {$_M['table']['skin_table']} WHERE skin_name = '{$skin_name}'";
			$has = DB::get_one($query);
			if(!$has){
				if(file_exists(PATH_WEB.'templates/'.$skin_name)){
					$info = "<a href=\"javascript:;\" class='tem_import btn btn-primary' data-name=\"{$skin_name}\"> {$_M['word']['setdbImportData']} </a>{$progress}";
				}else{
					$info = "<a href=\"javascript:;\" class='tem_install btn  btn-primary' data-name=\"{$skin_name}\"> {$_M['word']['appinstall']} </a>{$progress}";
				}
			}else{
				$info = "<a href='javascript:;' class='update_ui_list hide btn btn-success' data-url=\"{$_M['url']['own_name']}c=uiset&a=doupdate&skin_name={$skin_name}\" id=\"{$skin_name}\"> {$_M['word']['appupgrade']} </a>{$progress}";
				if($skin_name == $_M['config']['met_skin_user']){
					$info .= "<span class='btn btn-danger' style='margin-left:5px;cursor:default;'> {$_M['word']['skinused']} </span><a href='javascript:;' class='install_data btn btn-info' data-url=\"{$_M['url']['own_name']}c=uiset&a=dodown_data&skin_name={$skin_name}\" id=\"{$skin_name}\" style='margin-left:5px;'>{$_M['word']['met_template_installdemo']}</a>";
				}else{
					$info.="<a href='javascript:;' class='set_default btn btn-info' data-url=\"{$_M['url']['own_name']}c=uiset&a=doset_default&skin_name={$skin_name}\" id=\"{$skin_name}\" style='margin-left:5px;'> {$_M['word']['skinusenow']} </a>";
				}

				$info .= "<a href=\"{$_M['url']['own_name']}c=uiset&a=dodel_template&id={$val['id']}&skin_name={$skin_name}\" class='btn btn-default' data-confirm=\"{$_M['word']['met_template_deletteminfo']}\" style='margin-left:5px;'> {$_M['word']['delete']} </a> ";
			}


			$view = "{$_M['url']['site']}templates/{$skin_name}/view.jpg";
            $view_path = PATH_WEB."templates/{$skin_name}/view.jpg";
            if(!file_exists($view_path)){
                $view = "{$_M['url']['site']}app/system/login/admin/templates/img/login-logo.png";
            }
			$list[] = "<img src=\"{$view}\" width='150' style='padding:5px; background:#fff; border:1px solid #ddd;' />";
			$list[] = $skin_name;

			$list[] = $info;
			if($skin_name == $_M['config']['met_skin_user']) $list['toclass']='active';
			$rarray[] = $list;
		}
		$table->rarray['recordsTotal'] = $table->rarray['recordsFiltered'] = count($rarray);
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