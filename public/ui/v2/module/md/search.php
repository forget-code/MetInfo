<?php
echo <<<EOT
-->
<form class='sidebar-search' method='get' action="{$navurl}search/search.php">
    <input type='hidden' name='lang' value='{$lang}' />
    <input type='hidden' name='class1' value='{$classphp[class1]}' />
<!--
EOT;
if($classphp[class2]){
echo <<<EOT
-->
    <input type='hidden' name='class2' value='{$classphp[class2]}' />
<!--
EOT;
}
if($classphp[class3]){
echo <<<EOT
-->
    <input type='hidden' name='class3' value='{$classphp[class3]}' />
<!--
EOT;
}
echo <<<EOT
-->
    <div class="form-group">
        <div class="input-search">
            <button type="submit" class="input-search-btn"><i class="icon wb-search" aria-hidden="true"></i></button>
            <input type="text" class="form-control" name="searchword" placeholder="{$lang_sidebar_search_placeholder}">
        </div>
    </div>
</form>
<!--
EOT;
?>