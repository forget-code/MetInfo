<?php
$paths[form]=1;
$paths[editor]=1;
$paths[job]=1;
$page_type='job';
if(!$class_list[$classnow]['releclass']) $subcolumn_no = 1;
require_once template('head');
echo <<<EOT
-->
<main class="met-job page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="row">
                    <div class="met-job-list">
                        <section class="card card-shadow m-b-0">
                            <h1 class='card-title p-0 font-size-24'>{$job[position]}</h1>
                            <p class="card-metas font-size-12 blue-grey-400">
                                <span class='m-r-10'>{$job[addtime]}</span>
                                <span class='m-r-10'><i class="icon wb-map m-r-5" aria-hidden="true"></i>{$job[place]}</span>
                                <span class='m-r-10'><i class="icon wb-user m-r-5" aria-hidden="true"></i>{$job[count]}</span>
                                <span><i class="icon wb-payment m-r-5" aria-hidden="true"></i>{$job[deal]}</span>
                            </p>
                            <hr>
                            <div class="met-editor clearfix">{$job[content]}</div>
                            <hr>
                            <div class="card-body-footer m-t-0">
                                <a class="btn btn-outline btn-squared btn-primary met-job-cvbtn" href="javascript:;" data-toggle="modal" data-target="#met-job-cv" data-jobid="{$job[id]}" data-cvurl="cv.php?lang={$lang}&selected">{$lang_cvtitle}</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!--
EOT;
require_once template('module/job/job_form');// 应聘表单
require_once template('foot');
?>

