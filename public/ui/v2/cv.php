<!--<?php
require_once template('static/metresclass.class');//模板处理方法
echo <<<EOT
-->
<input type='hidden' name='lang' value='{$lang}' />
<input type='hidden' name='jobid' value='{$jobid}' />
<!--
EOT;
$fromarray = $metresclass->formSwitch($cv_para,true);
//参数1:表单数据
//参数2:是否极简化
require_once template('module/form');
?>-->