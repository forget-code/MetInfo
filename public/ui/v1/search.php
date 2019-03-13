<!--<?php
require_once template('head'); 
require_once template('sidebar');
$methtml_searchlist=methtml_searchlist();
echo <<<EOT
-->
        <div id="searchlist">
            {$methtml_searchlist}
            {$page_list}
        </div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>