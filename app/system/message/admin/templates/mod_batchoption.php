<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->

<div class="dropup pull-left" style="margin-left:5px;">
 
  <ul class="dropdown-menu list-type-update" data-type="move" role="menu" >

<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
  <li role="presentation" class="divider"></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <ul class="dropdown-menu list-type-update" data-type="copy" role="menu" >
  

<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
  </ul>
  <input type="hidden" name="columnid" value="" />
  <input type="hidden" name="recycle" value="" />
</div>
<button type="submit" name="del" class="btn btn-default" style="margin-left:2px;" data-toggle="popover">{$_M[word][delete]}</button>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>