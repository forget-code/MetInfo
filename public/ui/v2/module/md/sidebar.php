<?php
echo <<<EOT
-->
<div class="met-sidebar{$sidebar_position} bg-pageeditbg box-shadow1" boxmh-h>
<!--
EOT;
require_once template('module/md/search');
$classnow_module_name=metmodname($class_list[$classnow][module]);
if($GLOBALS["lang_{$classnow_module_name}_sidebar_list_ok"]){
    $classnow_sidebar_list_id=$GLOBALS["lang_{$classnow_module_name}_sidebar_list_id"];
    $sidebar_list_id=$classnow_sidebar_list_id?$classnow_sidebar_list_id:$class1;
    $sidebar_list_title=$GLOBALS["lang_{$classnow_module_name}_sidebar_list_title"];
    $sidebar_list_num=$GLOBALS["lang_{$classnow_module_name}_sidebar_list_num"];
    $sidebar_list_type=$GLOBALS["lang_{$classnow_module_name}_sidebar_list_type"];
    require_once template('module/md/newslist');
}
$sidebar_allcolumn=$GLOBALS["lang_{$classnow_module_name}_allcolumn"];
$sidebar_column_num=$GLOBALS["lang_{$classnow_module_name}_sidebar_column_num"];
if($lang_sidebar_column_ok) require_once template('module/md/columnlist');
if($lang_sidebar_piclist_ok) require_once template('module/md/piclist');
echo <<<EOT
-->
</div>
<!--
EOT;
?>