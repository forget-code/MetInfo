<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][modistauts]}
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" role="menu">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="comok">{$_M[word][recom]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="comno">{$_M[word][unrecom]}</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="topok">{$_M[word][top]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="topno">{$_M[word][untop]}</a></li>
	<li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="displayok">{$_M[word][frontshow]}</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:;" data-value="displayno">{$_M[word][fronthidden]}</a></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" name="move" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][columnmove1]}
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" data-type="move" role="menu" >
	<li role="presentation" class="dropdown-header">{$_M[word][admin_movetocolumn_v6]}</li>
	<li role="presentation" class="divider"></li>
<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
	<li role="presentation" class="divider"></li>
  </ul>
</div>
<div class="dropup pull-left" style="margin-left:5px;">
  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
    {$_M[word][Copy]}
	<span class="caret"></span>
  </button>
  <ul class="dropdown-menu list-type-update" data-type="copy" role="menu" >
	<li role="presentation" class="dropdown-header">{$_M[word][admin_copytocolumn_v6]}</li>
	<li role="presentation" class="divider"></li>
<!--
EOT;
require $this->template('own/mod_column');
echo <<<EOT
-->
	<li role="presentation" class="divider"></li>
  </ul>
  <input type="hidden" name="columnid" value="" />
  <input type="hidden" name="recycle" value="" />
</div>
<button type="submit" name="save" class="btn btn-default" style="margin-left:5px;">{$_M[word][keep_sorting]}</button>
<button type="submit" name="del" class="btn btn-default" style="margin-left:2px;" data-toggle="popover">{$_M[word][delete]}</button>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>