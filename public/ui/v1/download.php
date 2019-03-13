<!--<?php
require_once template('head'); 
require_once template('sidebar');
$weblist=metlabel_download();
echo <<<EOT
-->
        <div class="active" id="downloadlist">
			{$weblist}
			{$page_list}
		</div>
<!--
EOT;
require_once template('gap');
require_once template('foot'); 
?>