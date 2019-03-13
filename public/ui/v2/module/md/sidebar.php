<?php
echo <<<EOT
-->
<aside class="met-sidebar{$sidebar_position} panel panel-body m-b-0" boxmh-h>
<!--
EOT;
require_once template('module/md/search');
if($lang_sidebar_column_ok) require_once template('module/md/columnlist');
if($lang_sidebar_newslist_ok) require_once template('module/md/newslist');
if($lang_sidebar_piclist_ok) require_once template('module/md/piclist');
echo <<<EOT
-->
</aside>
<!--
EOT;
?>