<!--<?php
require_once template('head'); 
require_once template('sidebar');
$fromarray=metlabel_feedback();
$fid_url=$fid?1:0;
echo <<<EOT
-->
        <div id="feedback">
            <form enctype='multipart/form-data' method='POST' class="ui-from" name='myform' action='index.php?action=add'>
				<div class="v52fmbx">
				<input type='hidden' name='lang' value='{$lang}' />
				<input type='hidden' name='fdtitle' value='{$title}' />
				<input type='hidden' name='ip' value='{$m_user_ip}' />
				<input type='hidden' name='id' value='{$id}' />
				<input type='hidden' name='fid_url' value='{$fid_url}' />
				<h3 class="v52fmbx_hr">{$title}</h3>
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
        <!--</div>-->
    <!--</div>-->
    <div class="clear"></div>
</div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>