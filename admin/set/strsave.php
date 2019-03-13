<?php
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
?>