<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<script>
var ownlangtxt = {
	"enter_amount":"{$_M[word][enter_amount]}",
	"downloads":"{$_M[word][downloads]}",
	"click_rating":"{$_M[word][click_rating]}",
	"sys_evaluation":"{$_M[word][sys_evaluation]}",
	"download_application":"{$_M[word][download_application]}",
	"appupgrade":"{$_M[word][appupgrade]}",
	"appinstall":"{$_M[word][appinstall]}",
	"have_bought":"{$_M[word][have_bought]}",
	"usertype1":"{$_M[word][usertype1]}",
	"please_again":"{$_M[word][please_again]}",
	"password_mistake":"{$_M[word][password_mistake]}",
	"product_commented":"{$_M[word][product_commented]}",
	"goods_comment":"{$_M[word][goods_comment]}",
	"permission_download":"{$_M[word][permission_download]}",
	"installations":"{$_M[word][installations]}",
	"attention":"{$_M[word][attention]}",
	"cvall":"{$_M[word][cvall]}",
	"please_again":"{$_M[word][please_again]}",
	"password_mistake":"{$_M[word][password_mistake]}"
};
</script>
<!--
EOT;
require $this->template('tem/logininfo');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>