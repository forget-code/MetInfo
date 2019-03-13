<?php
echo <<<EOT
-->
<div class="stat_list">
  <ul>
    <li ><a  href="{$_M[url][own_form]}&a=doindex" title="{$_M[word][indexfeedbackm]}">{$_M[word][indexfeedbackm]}</a></li>
    <li {$listclass[2]}><a href="{$_M[url][site_admin]}index.php?n=parameter&c=parameter_admin&a=doparaset&module=8&lang={$_M[form][lang]}" title="{$_M[word][columnmfeedback]}">{$_M[word][columnmfeedback]}</a></li>
    <li {$listclass[3]}><a class="now" href="{$_M[url][own_form]}&a=dosyset&class1={$class[class1]}" title="{$_M[word][fdincTitle]}">{$_M[word][fdincTitle]}</a></li>
  </ul>
</div>
<div style="clear:both;"></div>
<!--
EOT;
?>