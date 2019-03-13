<?php
# 文件名称:strsave.php 2009-08-15 16:34:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
$query = "SELECT * FROM $met_label order BY id";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$str_list[]=$list;
}
$i=0;
foreach($str_list as $key=>$val){
if(!strstr($val[url],"http://"))$val[url]="http://".$val[url];
$config_save1=$config_save1.
              "$"."str[".$i."]=array('$val[oldwords]','<a title=$val[newwords] target=_blank href=$val[url]>$val[newwords]</a>');\n";
$i=$i+1;
}
$config_save       = "<?php
$config_save1
?>";
$fp = fopen("../../config/str.inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>