<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class search extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
	}


  public function dosearch() {
		global $_M;
        $classnow = $this->input_class();
		$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$this->check($data['access']);
		if($_M['form']['searchtype']){
			$this->seo($_M['form']['searchword'].'-'.$data['name'], $data['keywords'], $data['description']);
		}else{
			$this->seo($_M['form']['searchword'], $data['keywords'], $data['description']);
		}

		$this->seo_title($data['ctitle']);
		// $this->input['searchword'] = $_M['form']['searchword'];
		// $this->input['class1'] = $_M['form']['class1'];
		// $this->input['type'] = $_M['form']['class1'];//all title contents para
		$this->add_input('searchword', $_M['form']['searchword']);

		require_once $this->template('tem/search', $this->input);
  }

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
