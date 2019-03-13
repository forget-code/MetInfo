<?php
foreach($download_list as $key=>$val){
	$fiz=sprintf("%.2f",$val['filesize']/1024);
	$val['filesize']=$fiz>1?$fiz:$val['filesize'];
	$bd=$fiz>1?'Mb':'Kb';
echo <<<EOT
-->
<li class="list-group-item">
	<div class="media">
		<div class="media-left p-r-5 p-l-10 hidden-xs-down">
			<a href="{$val[url]}" title="{$val[title]}">
				<i class="icon fa-file-archive-o blue-grey-400"></i>
			</a>
		</div>
		<div class="media-body">
			<a class="btn btn-outline btn-primary btn-squared pull-xs-right" href="{$val[downloadurl]}" title="{$val[title]}">{$lang_download}</a>
			<h4 class="media-heading font-size-16">
				<a class="name" href="{$val[url]}" title="{$val[title]}" {$metblank}>{$val[title]}</a>
			</h4>
			<small class='font-size-14 blue-grey-500'>
				<span>{$val[filesize]}{$bd}</span>
				<span class="m-l-10">{$val[updatetime]}</span>
			</small>
		</div>
    </div>
</li>
<!--
EOT;
}
?>