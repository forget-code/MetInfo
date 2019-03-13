<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    状态修改
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">推荐</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">取消推荐</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">置顶</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">取消置顶</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">上架</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">下架</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">取消定时发布</a></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    移动商品
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation dropdown">
		<a role="menuitem" data-toggle="dropdown" class="dropdown-toggle" tabindex="-1" href="#">栏目一</a>
		<ul class="dropdown-menu">
			 <li><a href="#">栏目123123123</a></li>
			 <li><a href="#">栏目134653463423</a></li>
		</ul>
	</li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">栏目二</a></li>
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    复制商品
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">栏目一</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">栏目二</a></li>
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<button type="button" class="btn btn-default" style="margin-left:5px;">保存排序</button>
<button type="button" class="btn btn-default" style="margin-left:2px;">删除</button>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>