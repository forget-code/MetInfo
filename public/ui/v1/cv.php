<!--<?php
require_once template('head'); 
require_once template('sidebar');
$fromarray=metlabel_cv();
echo <<<EOT
-->
        <div id="cvlist">
            <form enctype='multipart/form-data' method='POST' class="ui-from" name='myform' action='save.php?action=add'>
				<div class="v52fmbx">
				<input type='hidden' name='lang' value='{$lang}' />
				<h3 class="v52fmbx_hr">{$lang_cvtitle}</h3>
				<dl>
					<dt>{$lang_memberPosition}</dt>
					<dd class="ftype_select">
						<div class="fbox">
							<select name='jobid'>{$selectjob}</select>
						</div>
					</dd>
				</dl>
<!--
EOT;
foreach($fromarray as $key=>$val){
echo <<<EOT
-->
				<dl>
					<dt class="ftype_select">{$val[name]}</dt>
					<dd class="{$val[type_class]}">
						<div class="fbox">
							{$val[type_html]}
						</div>
					</dd>
				</dl>
<!--
EOT;
}
echo <<<EOT
-->
				<dl class="noborder">
					<dt>&nbsp;</dt>
					<dd>
						<input type="submit" name="submit" value="{$lang_Submit}" class="submit" />
					</dd>
				</dl>
				</div>
			</form>
        </div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>