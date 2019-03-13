<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

echo <<<EOT
-->
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][modistauts]}
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][recom]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][unrecom]}</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][top]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][untop]}</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][shelvesup]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][shelvesdown]}</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][timedreleasecancel]}</a></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][banner_Mobilegoods_v6]}
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation dropdown">
		<a role="menuitem" data-toggle="dropdown" class="dropdown-toggle" tabindex="-1" href="#">{$_M[word][banner_column1_v6]}</a>
		<ul class="dropdown-menu">
			 <li><a href="#">{$_M[word][banner_column_v6]}</a></li>
			 <li><a href="#">{$_M[word][banner_column_v6]}</a></li>
		</ul>
	</li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][banner_column2_v6]}</a></li>
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][copyproduct]}
  </button>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][banner_column1_v6]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">{$_M[word][banner_column2_v6]}</a></li>
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<button type="button" class="btn btn-default" style="margin-left:5px;">{$_M[word][keep_sorting]}</button>
<button type="button" class="btn btn-default" style="margin-left:2px;">{$_M[word][delete]}</button>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>