<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
    状态修改 
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" role="menu">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="comok">推荐</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="comno">取消推荐</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="topok">置顶</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="topno">取消置顶</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="displayok">前台显示</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="displayno">前台隐藏</a></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" name="move" data-toggle="dropdown" aria-expanded="true">
    移动 
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" data-type="move" role="menu" >
	<li role="presentation" class="dropdown-header">移动到指定栏目</li>
	<li role="presentation" class="divider"></li>
<!--
EOT;
require $this->template('tem/mod_column');
echo <<<EOT
-->
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
    复制 
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" data-type="copy" role="menu" >
	<li role="presentation" class="dropdown-header">复制到指定栏目</li>
	<li role="presentation" class="divider"></li>
<!--
EOT;
require $this->template('tem/mod_column');
echo <<<EOT
-->
	<li role="presentation" class="divider"></li>
  </ul>
  <input type="hidden" name="columnid" value="" />
  <input type="hidden" name="recycle" value="" />
</div>
<button type="submit" name="save" class="btn btn-default" style="margin-left:5px;">保存排序</button>
<button type="submit" name="del" class="btn btn-default" style="margin-left:2px;" data-toggle="popover">删除</button>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>