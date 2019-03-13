<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<form method="POST" class="ui-from" name="myform" action="{$_M[url][own_form]}a=dolistsave&sub_type=editor" target="_self" onsubmit='flashListSub()'>
	<div class="v52fmbx product_index">
		<div class="v52fmbx-table-top">
			<div class="ui-float-left">
				<a class="btn btn-danger" href="{$_M[url][own_form]}a=doadd" role="button">{$_M[word][indexflashaddflash]}</a>
			</div>
			<div class="ui-float-right">
				<form  method="POST" style="position:relative; top:2px;" name="filterform" class='ui-from' action="{$_M[url][own_form]}a=doceshi&search=detail_search&kuaijieskin={$kuaijieskin}" target="_self">
					<input name="class1" type="hidden" value="250">
					<input name="class2" type="hidden" value="">
					<input name="class3" type="hidden" value="">
					&nbsp;{$_M[word][category]}
					<select name="modulex" style="margin:3px 0px;" onchange='javascript:window.location.href=$(this).val();'>
<!--
EOT;
foreach($mod1 as $key=>$val){
    if($val[id]==10000){
        $value="{$_M[url][own_form]}a=domanage";
    }else{
        $value="{$_M[url][own_form]}a=domanage&module={$val[id]}&kuaijieskin={$kuaijieskin}";
    }
    echo <<<EOT
-->
						<option value='{$value}' {$module1[$val[id]]}>$val[name]</option>
<!--
EOT;
    foreach($mod2[$val[id]] as $key=>$val2){
        echo <<<EOT
-->
    					<option value='{$_M[url][own_form]}a=domanage&module={$val2[id]}&kuaijieskin={$kuaijieskin}' {$module1[$val2[id]]}>&nbsp;&nbsp;-- $val2[name]</option>
<!--
EOT;
        foreach($mod3[$val2[id]] as $key=>$val3){
            echo <<<EOT
-->
    					<option value='{$_M[url][own_form]}a=domanage&module={$val3[id]}&kuaijieskin={$kuaijieskin}' {$module1[$val3[id]]}>&nbsp;&nbsp;&nbsp;&nbsp;-- $val3[name]</option>
<!--
EOT;
        }
    }
}
echo <<<EOT
-->
            		</select>
					<!--&nbsp;{$_M[word][type]}
					<select name="ftype" id="shaix-top" onchange="javascript:window.location.href=$(this).val();">
						<option value="{$_M[url][own_form]}a=domanage&ftype=all&search=detail_search" {$ftype1[all]}>{$_M[word][selected]}</option>
						<option value="{$_M[url][own_form]}a=domanage&ftype=1&search=detail_search" {$ftype1[1]}>{$_M[word][image]}</option>
						<option value="{$_M[url][own_form]}a=domanage&ftype=0&search=detail_search" {$ftype1[0]}>{$_M[word][flashMode2]}</option>
					</select>-->
				</form>
			</div>
			<input id="class1id" name="class1" data-table-search="1" value="{$_M['form']['class1']}" class="ui-input" type="hidden" />
			<input id="class2id" name="class2" data-table-search="1" value="{$_M['form']['class2']}" class="ui-input" type="hidden" />
			<input id="class3id" name="class3" data-table-search="1" value="{$_M['form']['class3']}" class="ui-input" type="hidden" />
			<table class="display dataTable ui-table" data-table-ajaxurl="{$_M[url][own_form]}a=dotable_json_list&class1={$_M['form']['class1']}&class2={$_M['form']['class2']}&class3={$_M['form']['class3']}&module={$_M['form']['module']}&search={$_M['form']['search']}&ftype={$_M[form][ftype]}"  data-table-pageLength="20">
				<thead>
					<tr>
						<th width="20" data-table-columnclass="met-center">{$_M[word][selected]}</th>
						<th data-table-columnclass="met-center" width="40"> <abbr title="{$_M[word][article4]}">{$_M[word][sort]}</abbr>
						</th>
						<th data-table-columnclass="met-center" width="120">{$_M[word][category]}</th>
						<th data-table-columnclass="met-center" width="160" >{$_M[word][setflashName]}</th>
						<th data-table-columnclass="met-center" width="100" >{$_M[word][banner_pcheight_v6]}</th>
						<th data-table-columnclass="met-center" width="100" >{$_M[word][banner_pidheight_v6]}</th>
						<th data-table-columnclass="met-center" width="100" >{$_M[word][banner_phoneheight_v6]}</th>
						<th data-table-columnclass="met-center" width="160">{$_M[word][setflashImgHref]}</th>
						<th>{$_M[word][operate]}</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th>
							<input name="id" type="checkbox" data-table-chckall="id" value="">
						</th>
						<th colspan="8" class="formsubmit" style="text-align:left!important;">
<!--
EOT;
require $this->template('own/mod_batchoption');
echo <<<EOT
-->
						</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>