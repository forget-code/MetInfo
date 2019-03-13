<?php
require_once '../login/login_check.php';
switch($type){
case "3";
$p_title="产品参数设置";
$k=1;
break;
case "4";
$p_title="下载参数设置";
$k=11;
break;
case "5";
$p_title="图片参数设置";
$k=21;
break;
}
if($action=="Modify"){
for($i=$k;$i<$k+10;$i=$i+1){
$c_mark="c_mark".$i;
$e_mark="e_mark".$i;
$use_ok="use_ok".$i;
$no_order="no_order".$i;
$c_mark=$$c_mark;
$e_mark=$$e_mark;
$use_ok=$$use_ok;
$no_order=$$no_order;
if($use_ok==1&&$c_mark==""){
okinfo("javascript:history.go(-1)",$lang[c_mark]);
}
$query="update $met_parameter set
		c_mark = '$c_mark',
		e_mark = '$e_mark',
		use_ok = '$use_ok',
		no_order = '$no_order',
		type = '$type'
        where id='$i'";
$db->query($query);
}
okinfo('parameter.php?type='.$type,$lang[user_admin]);
}
else{
    $query="select * from $met_parameter where type='$type'  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$list1[use_ok]=($list1[use_ok]==1)?"checked='checked'":"";
	if($met_en_lang!=1){
	$e_markok="disabled='disabled'";
	$list1[e_mark1]="英文没有开启";
	}
	else{
	$list1[e_mark1]=$list1[e_mark];
	}
	$list[]=$list1;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter');
footer();
}
?>