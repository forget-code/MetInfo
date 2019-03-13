<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=doadminlangsave" target="_self" id="adminlangset">
	<div class="v52fmbx">
		<dl>
			<dt>{$_M[word][sort]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="number" min="0" name="order"  value="{$new_no_order}" data-required="1" />
				</div>
				<span class="tips">{$_M[word][langorderinfo]}</span>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M[word][langselect]}</dt>
			<dd class="ftype_select">
				<div class="fbox">
					<select name="langautor">
                        <option value="0">{$_M[word][langselect1]}</option>
                        <option value="">{$_M[word][managertyp5]}...</option>
                        <option value="sq">{$_M[word][lang1]}</option><option value="ar">{$_M[word][lang2]}</option>
                        <option value="az">{$_M[word][lang3]}</option><option value="ga">{$_M[word][lang4]}</option>
                        <option value="et">{$_M[word][lang5]}</option><option value="be">{$_M[word][lang6]}</option>
                        <option value="bg">{$_M[word][lang7]}</option><option value="is">{$_M[word][lang8]}</option>
                        <option value="pl">{$_M[word][lang9]}</option><option value="fa">{$_M[word][lang10]}</option>
                        <option value="af">{$_M[word][lang11]}</option><option value="da">{$_M[word][lang12]}</option>
                        <option value="de">{$_M[word][lang13]}</option><option value="ru">{$_M[word][lang14]}</option>
                        <option value="fr">{$_M[word][lang15]}</option><option value="tl">{$_M[word][lang16]}</option>
                        <option value="fi">{$_M[word][lang17]}</option><option value="ht">{$_M[word][lang20]}</option>
                        <option value="ko">{$_M[word][lang21]}</option><option value="nl">{$_M[word][lang22]}</option>
                        <option value="gl">{$_M[word][lang23]}</option><option value="ca">{$_M[word][lang24]}</option>
                        <option value="cs">{$_M[word][lang25]}</option><option value="hr">{$_M[word][lang26]}</option>
                        <option value="la">{$_M[word][lang27]}</option><option value="lv">{$_M[word][lang28]}</option>
                        <option value="lt">{$_M[word][lang29]}</option><option value="ro">{$_M[word][lang30]}</option>
                        <option value="mt">{$_M[word][lang31]}</option><option value="ms">{$_M[word][lang32]}</option>
                        <option value="mk">{$_M[word][lang33]}</option>
                        <option value="no">{$_M[word][lang35]}</option><option value="pt">{$_M[word][lang36]}</option>
                        <option value="ja">{$_M[word][lang37]}</option><option value="sv">{$_M[word][lang38]}</option>
                        <option value="sr">{$_M[word][lang39]}</option><option value="sk">{$_M[word][lang40]}</option>
                        <option value="sl">{$_M[word][lang41]}</option><option value="sw">{$_M[word][lang42]}</option>
                        <option value="th">{$_M[word][lang43]}</option><option value="tr">{$_M[word][lang44]}</option>
                        <option value="cy">{$_M[word][lang45]}</option><option value="uk">{$_M[word][lang46]}</option>
                        <option value="iw">{$_M[word][lang47]}</option><option value="el">{$_M[word][lang48]}</option>
                        <option value="eu">{$_M[word][lang49]}</option><option value="es">{$_M[word][lang50]}</option>
                        <option value="hu">{$_M[word][lang51]}</option>
                        <option value="it">{$_M[word][lang53]}</option><option value="yi">{$_M[word][lang54]}</option>
                        <option value="ur">{$_M[word][lang59]}</option><option value="id">{$_M[word][lang60]}</option>
                        <option value="en">{$_M[word][lang61]}</option><option value="vi">{$_M[word][lang62]}</option>
                        <option value="zh">{$_M[word][lang63]}</option><option value="cn">{$_M[word][lang64]}</option>
					</select>
				</div>
			</dd>
		</dl>
		
		<dl>
			<dt>{$_M[word][langname]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="langname" data-size="2-10"  value="" data-required="1" />
				</div>
			</dd>
		</dl>
		
		<dl style="display:none">
			<dt>{$_M[word][langexplain2]}</dt>
			<dd class="ftype_input">
				<div class="fbox">
					<input type="text" name="langmark" data-size=1-5  value="" data-required="1" />
				</div>
				<span class="tips">{$_M[word][langmarkinfo]}</span>
			</dd>
		</dl>
		
<!--
        <dl>
            <dt>{$_M[word][langexplain3]}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="langdlok" type="radio" value="0"  data-checked="0">{$_M[word][langexplain6]}</label>
                    <label><input name="langdlok" type="radio" value="1" disabled='disabled'>{$_M[word][langexplain5]}</label>
                </div>
                <span class="tips">{$_M[word][langexplain8]}</span>
            </dd>
        </dl>
-->        
        
        <dl style="display:">
        <dt>{$_M[word][langexplain6]}</dt>
        <dd class="ftype_select">
            <div class="fbox">
                <select name="ftype_select" data-checked="{$_M['lang']}">
<!--
EOT;
foreach($met_langok as $val){
    echo <<<EOT
-->
						<option value="{$val['mark']}" >{$val[name]}</option>
<!--
EOT;
}
echo <<<EOT
-->
					</select>
				</div>
			</dd>
		</dl>
		
		<dl>
            <dt>{$_M[word][langtype]}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="languseok" type="radio" value="1"  data-checked="1">{$_M[word][open]}</label>
                    <label><input name="languseok" type="radio" value="0">{$_M[word][close]}</label>
                </div>
            </dd>
        </dl>
        
        <dl>
            <dt>{$_M[word][langhome]}</dt>
            <dd class="ftype_radio">
                <div class="fbox">
                    <label><input name="met_admin_type" type="radio" value="1">{$_M[word][yes]}</label>
                    <label><input name="met_admin_type" type="radio" value="0" checked="checked">{$_M[word][no]}</label>
                </div>
                <span class="tips"></span>
            </dd>
        </dl>
		
		<dl class="noborder">
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" name="submit" value="{$_M[word][submit]}" class="submit" />
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