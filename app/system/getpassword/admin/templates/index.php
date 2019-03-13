<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. .

echo <<<EOT
-->
<title>{$_M[word][getTip5]} - {$_M[word][metinfo]}</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="{$_M[url][own_tem]}/css/own.css">
<div id="adminbacktype">
	<div class="lo">
EOT;
if($_M['config']['met_agents_linkurl']){
echo <<<EOT
    <a href="{$_M['config']['met_agents_linkurl']}" style="font-size:0px;" target="_blank" title="{$_M[word][metinfo]}">
EOT;
}else{
    echo <<<EOT
    <a href="http://www.metinfo.cn" style="font-size:0px;" target="_blank" title="{$_M[word][metinfo]}">
EOT;
}
echo <<<EOT
	<!--<a href="http://www.metinfo.cn" style="font-size:0px;" target="_blank" title="{$_M[word][metinfo]}">-->
		<img src="{$_M[config][met_agents_logo_login]}" alt="{$_M[word][metinfo]}" title="{$_M[word][metinfo]}" />
	</a>
	</div>
	<p class="desc round">{$description}</p>
	<form method='post' action='{$_M[url][own_form]}a=dogetpassword&langset={$_M[form][langset]}' class="round shadow">
<!--
EOT;
if($action=='next1'){
echo <<<EOT
-->
		<input type='hidden' name='action' value='next2' />
		<input type='hidden' name='abt_type' value='{$abt_type}' />
		<label class="next1_mob"><span>{$title}</span><br/><input type="text" name="admin_mobile" value='' class='text' /></label>
		<p class="submitnxt">
			<input type='submit' name='submit' value='{$_M[word][password20]}' class="submit" />
			<a href="../login/login.php" title="{$_M[word][password21]}" class="abt_turn">{$_M[word][password21]}</a>
		</p>
<!--
EOT;
}elseif($action=='next2' && $abt_type==1){
echo <<<EOT
-->
		<input type='hidden' name='action' value='next3' />
		<input type='hidden' name='abt_type' value='{$abt_type}' />
		<input type='hidden' name='nber' value='{$nber}-{$admin_list[admin_id]}' />
		<label class="next1_mob"><span>{$_M[word][password22]}</span><span>{$mobile}</span></label>
		<label class="next1_mob"><span>{$_M[word][password23]}</span><br/><input type="text" name="checkcode" value='' class='text' />
		<span style="position:relative; bottom:4px;">{$_M[word][password10]}[{$nber}]</span></label>
		<p class="submitnxt">
			<input type='submit' name='submit' value='{$_M[word][password20]}' class="submit" />
			<a href="{$_M[url][adminurl]}n=login&c=login&a=doindex" title="{$_M[word][password21]}" class="abt_turn">{$_M[word][password21]}</a>
		</p>
<!--
EOT;
}elseif($action=='next3'){
echo <<<EOT
-->
		<input type='hidden' name='action' value='next4' />
		<input type='hidden' name='abt_type' value='{$abt_type}' />
		<input type='hidden' name='cnde' value='{$cnde}' />
		<input type='hidden' name='p' value='{$_M[form][p]}' />
		<label class="next1_mob"><span>{$_M[word][password24]}{$nbers[1]}</span></label>
		<label class="next1_mob"><span>{$_M[word][password25]}</span><input type="text" name="password" class='text' /></label>
		<label class="next1_mob"><span>{$_M[word][password26]}</span><input type="text" name="passwordsr" class='text' /></label>
		<p class="submitnxt">
			<input type='submit' name='submit' value='{$_M[word][password20]}' class="submit" />
			<a href="{$_M[url][adminurl]}n=login&c=login&a=doindex" title="{$_M[word][password21]}" class="abt_turn">{$_M[word][password21]}</a>
		</p>
<!--
EOT;
}else{
echo <<<EOT
-->
		<input type='hidden' name='action' value='next1' />
<!--
EOT;
if($met_smspass){
echo <<<EOT
-->
		<p class="abt_type round"><label><input type="radio" name="abt_type" value="1" class="radio" /> 
		<span class="abt_tt">{$_M[word][password27]}</span><br/><span class="abt_dis"><a href="http://www.metinfo.cn/faq/sms_costs.htm" target="_blank">{$_M[word][password28]}</a></span>
		</label></p>
<!--
EOT;
}
echo <<<EOT
-->
		<p class="abt_type round on_abt"><label><input type="radio" name="abt_type" value="2" class="radio" checked /> 
		<span class="abt_tt">{$_M[word][password29]}</span><br/><span class="abt_dis">{$_M[word][password30]}</span>
		</label></p>
		<p class="submit">
			<a href="{$_M[url][adminurl]}n=login&c=login&a=doindex" title="{$_M[word][password21]}" class="abt_turn">{$_M[word][password21]}</a>
			<input type='submit' name='submit' value='{$_M[word][password20]}' class="submit" />
		</p>
<!--
EOT;
}
echo <<<EOT
-->
	</form>
</div>
<script type="text/javascript">
$('.abt_type').bind('click', function() {
	$('.abt_type').removeClass('on_abt');
	$(this).addClass('on_abt');
});
</script>
<!--
EOT;
require_once $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>