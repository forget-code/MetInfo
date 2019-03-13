<?php
$classsearch = $class1;
if($class_list[$classnow]['releclass'])$classsearch = $classnow;
echo <<<EOT
-->
<form class='sidebar-search' method='get' action="{$navurl}search/search.php">
    <input type='hidden' name='lang' value='{$lang}' />
    <input type='hidden' name='class1' value='{$classsearch}' />
    <div class="form-group">
        <div class="input-search">
            <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
            <input type="text" class="form-control" name="searchword" placeholder="{$lang_sidebar_placeholder}">
        </div>
    </div>
</form>
<!--
EOT;
?>