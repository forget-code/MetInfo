<?php
echo <<<EOT
-->
<div class="modal fade modal-primary" id="met-job-cv" aria-hidden="true" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content radius0">
            <div class="modal-header radius0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">{$lang_cvtitle}</h4>
            </div>
            <form enctype="multipart/form-data" method='POST' class="met-form" action='{$navurl}{$class_list[$classnow][foldername]}/save.php?lang={$lang}&action=add'>
                <div class="modal-body p-b-0">
                </div>
                <div class="modal-footer text-xs-left">
                    <button type="submit" class="btn btn-primary btn-squared">{$lang_submit}</button>
                    <button type="button" class="btn btn-default btn-squared" data-dismiss="modal">{$lang_cancel}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--
EOT;
?>