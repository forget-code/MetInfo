<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
$query = "SELECT * FROM $met_label where lang='$lang' order BY id";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
$str_list[]=$list;
}
$i=0;
foreach($str_list as $key=>$val){
if(trim($val[url])==""){
$config_save1=$config_save1.
"$"."str[".$i."]=array('$val[oldwords]','$val[newwords]');\n";
}else{
if(!strstr($val[url],"http://"))$val[url]="http://".$val[url];

$config_save1=$config_save1.
              "$"."str[".$i."]=array('$val[oldwords]',\"<a title='$val[newtitle]' target='_blank' href='$val[url]' class='seolabel'>$val[newwords]</a>\");\n";
}
$i=$i+1;
}
$config_save       = "<?php
$config_save1
?>";
if(!is_writable("../../config/str_".$lang.".inc.php"))@chmod("../../config/str_".$lang.".inc.php",0777);
$fp = fopen("../../config/str_".$lang.".inc.php",w);
    fputs($fp, $config_save);
    fclose($fp);
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>