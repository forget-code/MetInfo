<?php
foreach($job_list as $key=>$val){
	$val['count'] = $val['count']==0?$lang_several:$val['count'];
echo <<<EOT
-->
<div class="card card-shadow">
	<h4 class='card-title p-0 font-size-24'>{$val[position]}</h4>
	<p class="card-metas font-size-12 blue-grey-400">
		<span>{$val[addtime]}</span>
		<span><i class="icon wb-map m-r-5" aria-hidden="true"></i>{$val[place]}</span>
		<span><i class="icon wb-user m-r-5" aria-hidden="true"></i>{$val[count]}</span>
		<span><i class="icon wb-payment m-r-5" aria-hidden="true"></i>{$val[deal]}</span>
	</p>
	<hr>
	<div class="met-editor clearfix">{$val[content]}</div>
	<hr>
	<div class="card-body-footer m-t-0">
		<a class="btn btn-outline btn-squared btn-primary met-job-cvbtn" href="javascript:;" data-toggle="modal" data-target="#met-job-cv" data-jobid="{$val[id]}" data-cvurl="cv.php?lang={$lang}&selected">{$lang_cvtitle}</a>
	</div>
</div>
<!--
EOT;
}
?>