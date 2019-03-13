
<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

/**
 * ajax����
 */
class ajax_user extends ajax {
	public function douserlist(){
        global $_M;
		$userlist = $this->userclass->userlist($_M['form']['page']);
	}
} 

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>