<!--<?php
require_once template('head'); 
require_once template('sidebar');
$messagetable=metlabel_message();
echo <<<EOT
-->
			<div id="messagelist">
            <form enctype='multipart/form-data' method='POST' class="ui-from" name='myform' action='message.php?action=add'>
				<div class="v52fmbx">
				<input type='hidden' name='lang' value='{$lang}' />
<!--
EOT;
foreach($messagetable as $key=>$val){
echo <<<EOT
-->
				<dl>
					<dt class="ftype_select">{$val[name]}</dt>
					<dd class="{$val[type_class]}">
						<div class="fbox">
							{$val[type_html]}
						</div>
						<span class="tips">{$val[description]}</span>
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