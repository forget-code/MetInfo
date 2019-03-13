<?php
foreach($message_list as $key=>$val){
	$vname1 = $db->get_one("select * from {$met_mlist} where listid='{$val[id]}' and paraid='{$met_message_fd_class}' and lang='{$lang}'");
	$vname2 = $db->get_one("select * from {$met_mlist} where listid='{$val[id]}' and paraid='{$met_message_fd_content}' and lang='{$lang}'");
echo <<<EOT
-->
<li class="list-group-item">
	<div class="media">
		<div class="media-left block pull-xs-left p-r-0">
			<i class="icon wb-user-circle blue-grey-400"></i>
		</div>
		<div class="media-body block pull-xs-left">
			<h4 class="media-heading font-weight-300 blue-grey-500">
				<small class="pull-xs-right">{$val[addtime]}</small>
				{$vname1[info]}
			</h4>
			<p class='m-b-0'>{$vname2[info]}</p>
<!--
EOT;
	if($val['useinfo']){
echo <<<EOT
-->
			<div class="content well m-t-10 m-b-0">
				{$val[useinfo]}
			</div>
<!--
EOT;
	}
echo <<<EOT
-->
		</div>
	</div>
</li>
<!--
EOT;
}
?>