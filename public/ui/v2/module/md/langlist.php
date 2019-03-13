<?php
$metlang_num=0;
foreach($met_langok as $val){
	if($val['useok']){
		$metlang_num++;
		if($metlang_num>1) break;
	}
}
if($metlang_num>1){
	$met_lang_icon=$metresclass->flagSwitch($met_langok[$lang][synchronous]);
	$langlist_position_class=$lang_langlist_position?'':' pull-xs-right';
	$langname_hide=$lang_langlist_position?'':'class="hidden-xs-down"';
echo <<<EOT
-->
<div class="met-langlist vertical-align{$langlist_position_class}">
<!--
EOT;
	if($lang_langlist_type==1){
		$langlist_drop_class=$lang_langlist_position?'dropup':'dropdown';
echo <<<EOT
-->
	<div class="inline-block {$langlist_drop_class}">
		<button type="button" data-toggle="dropdown" class="btn btn-outline btn-default btn-squared dropdown-toggle btn-lang">
<!--
EOT;
		if ($lang_langlist_icon_ok){
echo <<<EOT
-->
			<span class="flag-icon flag-icon-{$met_lang_icon}"></span>
<!--
EOT;
		}
echo <<<EOT
-->
			<span {$langname_hide}>{$met_langok[$lang][name]}</span>
		</button>
		<ul class="dropdown-menu dropdown-menu-right animate animate-reverse" id="met-langlist-dropdown" role="menu">
<!--
EOT;
		foreach($met_langok as $val){
			if($val['useok']){
				$val['iconname'] = $metresclass->flagSwitch($val[synchronous]);//转VGA国旗图标
echo <<<EOT
-->
			<a href="{$val[met_weburl]}" title="{$val[name]}" class='dropdown-item'>
<!--
EOT;
				if ($lang_langlist_icon_ok) {
echo <<<EOT
-->
				<span class="flag-icon flag-icon-{$val['iconname']}"></span>
<!--
EOT;
				}
echo <<<EOT
-->
				{$val[name]}
			</a>
<!--
EOT;
			}
		}
echo <<<EOT
-->
		</ul>
	</div>
<!--
EOT;
	}else{
echo <<<EOT
-->
	<button type="button" class="btn btn-outline btn-default btn-squared btn-lang" data-toggle="modal" data-target="#met-langlist-modal">
<!--
EOT;
		if ($lang_langlist_icon_ok) {
echo <<<EOT
-->
		<span class="flag-icon flag-icon-{$met_lang_icon}"></span>
<!--
EOT;
		}
echo <<<EOT
-->
		<span {$langname_hide}>{$met_langok[$lang][name]}</span>
	</button>
	<div class="modal fade modal-3d-flip-vertical" id="met-langlist-modal" aria-hidden="true" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-center modal-lg">
			<div class="modal-content radius0">
				<div class="modal-body p-y-40">
					<button type="button" class="close font-size-40" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<div class="blocks-xs-100 blocks-sm-2 blocks-md-3 text-xs-center blocks-lang">
<!--
EOT;
		foreach($met_langok as $val){
			if($val['useok']){
				$val['iconname'] = $metresclass->flagSwitch($val[synchronous]);//转VGA国旗图标
echo <<<EOT
-->
						<li class='m-b-0 p-x-0'>
							<a href="{$val[met_weburl]}" class="btn btn-block btn-outline btn-default btn-squared p-y-0 text-xs-left text-sm-center" title="{$val[name]}">
<!--
EOT;
				if ($lang_langlist_icon_ok) {
echo <<<EOT
-->
								<span class="flag-icon flag-icon-{$val['iconname']}"></span>
<!--
EOT;
				}
echo <<<EOT
-->
								{$val[name]}
							</a>
						</li>
<!--
EOT;
			}
		}
echo <<<EOT
-->
					</div>
				</div>
			</div>
		</div>
	</div>
<!--
EOT;
	}
echo <<<EOT
-->
</div>
<!--
EOT;
}
?>