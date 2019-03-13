<?php
echo <<<EOT
-->
<div class="stat_list">
  <ul>
    <li ><a class="now" href="../../content/message/index.php?anyid={$anyid}&lang={$lang}&class1={$class1}&cs=1" title="{$_M[word][messageTitle]}">{$_M[word][messageTitle]}</a></li>
    <li {$listclass[2]}><a href="../../column/parameter/parameter.php?module=7&anyid={$anyid}&lang={$lang}&class1={$class1}&cs=2" title="{$_M[word][messageVoice]}">{$_M[word][messageVoice]}</a></li>
    <li {$listclass[3]}><a href="../../content/message/inc.php?anyid={$anyid}&lang={$lang}&class1={$class1}&cs=3" title="{$_M[word][messageincTitle]}">{$_M[word][messageincTitle]}</a></li>
  </ul>
</div>
<div style="clear:both;"></div>
<!--
EOT;
?>