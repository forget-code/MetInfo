<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
$met_foot_txt = metlabel_foot();
echo <<<EOT
-->
<div class="met-footer">
	<footer class="container">
		{$met_foot_txt}
	</footer>
</div>
<script src="{$_M['url']['site']}app/system/include/public/js/seajs.js"></script>
<script>
	var pub = '{$_M['url']['pub']}',
		own_tem = '{$_M['url']['own_tem']}',
		page_type = '{$page_type}';
	seajs.config({
	  paths: {
		'pub': pub.substring(0,pub.length-1),
		'own_tem': own_tem.substring(0,own_tem.length-1)
	  },
	  alias: {
		"jquery": "jquery/1.11.1/jquery_seajs.js"
	  }
	});
	seajs.use("own_tem/js/own"); //载入入口模块
</script>
</body>
</html><!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->