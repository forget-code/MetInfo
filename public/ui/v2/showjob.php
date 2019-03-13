<?php
$bordernone=1;
if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
require_once template('head');
echo <<<EOT
-->
<section class="met-job met-page-body bg-pagebg1">
    <div class="container">
        <div class="row">
            <div class="card card-shadow">
                <h1 class='card-title p-0 font-size-24'>{$job[position]}</h1>
                <p class="card-metas font-size-12 blue-grey-400">
                    <span>{$job[addtime]}</span>
                    <span><i class="icon wb-map m-r-5" aria-hidden="true"></i>{$job[place]}</span>
                    <span><i class="icon wb-user m-r-5" aria-hidden="true"></i>{$job[count]}</span>
                    <span><i class="icon wb-payment m-r-5" aria-hidden="true"></i>{$job[deal]}</span>
                </p>
                <hr>
                <div class="met-editor clearfix">{$job[content]}</div>
                <hr>
                <div class="card-body-footer m-t-0">
                    <a class="btn btn-outline btn-squared btn-primary met-job-cvbtn" href="javascript:;" data-toggle="modal" data-target="#met-job-cv" data-jobid="{$job[id]}" data-cvurl="cv.php?lang={$lang}&selected">{$lang_cvtitle}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--
EOT;
require_once template('module/job/job_form');// 应聘表单
require_once template('foot');
?>

