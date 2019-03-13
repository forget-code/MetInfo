<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::sys_class('web');

class news extends web {
	public function __construct() {
		global $_M;
		parent::__construct();
	}

  public function donews() {
		global $_M;
		$classnow = $_M['form']['class3'] ? $_M['form']['class3'] :($_M['form']['class2'] ? $_M['form']['class2'] : $_M['form']['class1']);
		$classnow = $this->input_class($classnow);
		$data = load::sys_class('label', 'new')->get('column')->get_column_id($classnow);
		$this->check($data['access']);
		unset($data['id']);
		$this->add_array_input($data);
		$this->seo($data['name'], $data['keywords'], $data['description']);
		$this->seo_title($data['ctitle']);
		$this->add_input('page', $_M['form']['page']);
		require_once $this->template('tem/news');
  }

	public function doshownews(){
		global $_M;
		$data = load::sys_class('label', 'new')->get('news')->get_one_list_contents($_M['form']['id']);
		$this->check($data['access']);
		$this->add_array_input($data);
		$classnow = $data['class3'] ? $data['class3'] :($data['class2'] ? $data['class2'] : $data['class1']);
		$this->input_class($classnow);
		$this->seo($data['title'], $data['keywords'], $data['description']);
		require_once $this->template('tem/shownews');
	}

}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
