<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');

echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dosave_thumbs" target="_self">
<div class="v52fmbx" >
	<h3 class="v52fmbx_hr">{$_M['word']['batchtips9']}</h3>
	<dl>
        <dt>{$_M['word']['setimgWater']}:</dt>
        <dd class="ftype_checkbox">
            <div class="fbox">
                <label><input name="met_autothumb_ok" type="checkbox" data="{$_M['config']['met_autothumb_ok']}" value="1">{$_M['word']['setimgWaterok']}</label>
            </div>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['sethtmway']}:</dt>
        <dd class="ftype_radio">
            <div class="fbox">
                <label><input name="met_thumb_kind" type="radio" value="1" data-checked="{$_M['config']['met_thumb_kind']}">{$_M['word']['upfiletips20']}</label>
                <label><input name="met_thumb_kind" type="radio" value="2">{$_M['word']['upfiletips21']}</label>
                <label><input name="met_thumb_kind" type="radio" value="3">{$_M['word']['upfiletips22']}</label>
            </div>
            <span class="red">{$_M['word']['thumbs_tips1_v6']}</span>
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['modulemanagement3']}:</dt>
        <dd>
            <input type="text" name="met_productimg_x" style="width:50px;text-align: center;" value="{$_M['config']['met_productimg_x']}" class='ui-input listname' mid">
            &nbsp;X&nbsp;
            <input type="text" name="met_productimg_y" style="width:50px;text-align: center;" value="{$_M['config']['met_productimg_y']}" class='ui-input listname' mid">
            ({$_M['word']['setimgWidth']} &nbsp;X&nbsp;{$_M['word']['setimgHeight']})({$_M['word']['setflashPixel']})
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['modulemanagement5']}:</dt>
        <dd>
            <input type="text" name="met_imgs_x" style="width:50px;text-align: center;" value="{$_M['config']['met_imgs_x']}" class='ui-input listname' mid">
            &nbsp;X&nbsp;
            <input type="text" name="met_imgs_y" style="width:50px;text-align: center;" value="{$_M['config']['met_imgs_y']}" class='ui-input listname' mid">
            ({$_M['word']['setimgWidth']} &nbsp;X&nbsp;{$_M['word']['setimgHeight']})({$_M['word']['setflashPixel']})
        </dd>
    </dl>
    <dl>
        <dt>{$_M['word']['modulemanagement2']}:</dt>
        <dd>
            <input type="text" name="met_newsimg_x" style="width:50px;text-align: center;" value="{$_M['config']['met_newsimg_x']}" class='ui-input listname' mid">
            &nbsp;X&nbsp;
            <input type="text" name="met_newsimg_y" style="width:50px;text-align: center;" value="{$_M['config']['met_newsimg_y']}" class='ui-input listname' mid">
            ({$_M['word']['setimgWidth']} &nbsp;X&nbsp;{$_M['word']['setimgHeight']})({$_M['word']['setflashPixel']})
        </dd>
    </dl>
    <dl class="noborder">
		<dt> </dt>
		<dd>
			<input type="submit" name="submit" value="{$_M['word']['Submit']}" class="submit">
		</dd>
	</dl>
</div>
</form>
<!--
EOT;

require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>