<!--<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<link rel="stylesheet" href="{$_M[url][own_tem]}css/metinfo.css?{$jsrand}" />
<input type="hidden" id="applist" value="{$applist}" />
<form method="POST" class="ui-from">
	<div class="appbox_left">
		<div class="appbox_left_box">
			<section class="myapplist">
				<h3>{$_M['word']['myapp']}
<!--
EOT;
  if($_M['config']['met_agents_type']<=1){
echo <<<EOT
-->
  				<div style="float: right;padding-right: 10px">
    				<a href="{$_M['url']['site_admin']}index.php?lang=cn&anyid=65&n=appstore&c=appstore&a=doappstore&type=1"> 免费应用 |</a>
    				<a href="{$_M['url']['site_admin']}index.php?lang=cn&anyid=65&n=appstore&c=appstore&a=doappstore&type=2"> 商业会员应用 | </a>
    				<a href="{$_M['url']['site_admin']}index.php?lang=cn&anyid=65&n=appstore&c=appstore&a=doappstore&type=3"> 收费应用</a>
          </div>
<!--
EOT;
  }
echo <<<EOT
-->
				</h3>
				<div class="container-fluid">
					<div class="row">
<!--
EOT;
foreach($appl as $key=>$val){
	if($val['update'] && $_M['config']['met_agents_app'] && ($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507'))){
		$val['updatehtml'] = "<li class=\"update hidden\" id=\"{$val['no']}\" data-ver=\"{$val['ver']}\"><a href=\"{$val['update']}\"><span class=\"glyphicon glyphicon-arrow-up\"></span>{$_M['word']['appupgrade']}</a></li>";
	}
	if($val['uninstall'] && $_M['config']['met_agents_app'] && ($privilege['navigation'] == 'metinfo' || strstr($privilege['navigation'], '1507'))){
		$val['uninstallhtml'] = "<li class=\"uninstall\"><a href=\"{$val['uninstall']}\" data-confirm=\"{$_M['word']['app_datele']}\"><span class=\"glyphicon glyphicon-trash\"></span>{$_M['word']['dlapptips6']}</a></li>";
	}
	$val['info'] = get_word($val['info']);
  	if($val['target']){
	 	$target="target='_blank'";
  	}
	/*
	if(strstr($val[info],"lang_")){
		$info = explode('lang_',$val[info]);
		$val['info'] = get_word($_M['word'][$info[1]]);
	}
	*/
	if($val['display']==1){
echo <<<EOT
-->
						<div class="col-md-4 col-sm-6 col-xs-12 index_stat_chart">
							<div class="media">
								<div class="media-left">
									<a href="{$val['url']}" {$target}>
										<img class="media-object" src="{$val['ico']}" width="80">
									</a>
								</div>
								<div class="media-body">
									<ul class="media-tool">{$val['updatehtml']}{$val['uninstallhtml']}</ul>
									<a href="{$val['url']}" {$target}>
										<h4 class="media-heading">{$val[appname]}</h4>
										<p>{$val[info]}</p>
									</a>
								</div>
							</div>
						</div>
<!--
EOT;
	}
}
echo <<<EOT
-->
					</div>
				</div>
			</section>
		</div>
	</div>
</form>
<!--
EOT;
require $this->template('ui/foot');
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
