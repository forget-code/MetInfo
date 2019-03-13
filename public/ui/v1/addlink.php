<!--<?php
require_once template('head'); 
require_once template('sidebar');
$addlinkform=metlabel_addlink(0);
echo <<<EOT
-->
        <div id="linksubmit">
		<form method='POST' name='myform' class="ui-from" action='addlink.php?action=add&lang={$lang}'>
		<div class="v52fmbx">
			<h3 class="v52fmbx_hr">{$lang_ApplyLink}</h3>
				<dl>
					<dt>{$lang_OurWebName}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							{$met_linkname}
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_OurWebLOGO}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<img src='{$met_logo}' alt='{$lang_OurWebName}' title='{$lang_OurWebName}' />
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_OurWebKeywords}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							{$met_keywords}
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_YourWebName}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input name='webname' type='text' placeholder="{$lang_YourWebName}" data-required=1 />
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_YourWebUrl}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input name='weburl' type='text' placeholder="{$lang_YourWebUrl}" value="http://" data-required=1 />
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_LinkType}</dt>
					<dd class="ftype_radio">
						<div class="fbox">
							<label><input name='link_type' type='radio' data-required=1 value='0' checked />{$lang_TextLink}</label>
							<label><input name='link_type' type='radio' value='1' />{$lang_PictureLink}</label>
						</div>
					</dd>
				</dl>
				<dl>
					<dt class="ftype_select">{$lang_YourWebLOGO}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input name='weblogo' type='text' placeholder="{$lang_YourWebLOGO}" value="http://" />
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_YourWebKeywords}</dt>
					<dd class="ftype_input">
						<div class="fbox">
							<input name='info' type='text' placeholder="{$lang_YourWebLOGO}" value="http://" />
						</div>
					</dd>
				</dl>
				<dl>
					<dt>{$lang_Contact}</dt>
					<dd class="ftype_textarea">
						<div class="fbox">
							<textarea name='contact' placeholder="{$lang_Contact}"></textarea>
						</div>
					</dd>
				</dl>
<!--
EOT;
if($met_memberlogin_code==1){
echo <<<EOT
-->
				<dl>
					<dt class="ftype_select">{$lang_memberImgCode}</dt>
					<dd class="ftype_input ftype_code">
						<div class="fbox">
							<input name='code' data-required='1' type='text' />
							<img align='absbottom' src='{$navurl}/member/ajax.php?action=code'  onclick=this.src='../member/ajax.php?action=code&'+Math.random() alt={$lang_memberTip1}'/>
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