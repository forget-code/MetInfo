<?php
require_once '../login/login_check.php';

if($action=="Modify"){
for($i=1;$i<21;$i=$i+1){
$c_name="c_name".$i;
$e_name="e_name".$i;
$use_ok="use_ok".$i;
$wr_ok = "wr_ok".$i;
$no_order="no_order".$i;
$c_name=$$c_name;
$e_name=$$e_name;
$use_ok=$$use_ok;
$wr_ok =$$wr_ok;
$no_order=$$no_order;
if($use_ok==1&&$c_name==""){
okinfo("javascript:history.go(-1)",$lang[c_mark]);
}
$query="update $met_fdparameter set
		c_name = '$c_name',
		e_name = '$e_name',
		use_ok = '$use_ok',
		wr_ok  = '$wr_ok',
		no_order = '$no_order'
        where id='$i'";
$db->query($query);
}
okinfo('parameter.php',$lang[user_admin]);
}
else{
    $query="select * from $met_fdparameter order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$list1[use_ok]=($list1[use_ok]==1)?"checked='checked'":"";
	$list1[wr_ok]=($list1[wr_ok]==1)?"checked='checked'":"";
	
switch($list1[type]){
case "1";
$list1[type]="简短字段";
break;
case "2";
$list1[type]="<font color='#ff0000'>下拉菜单</font> <a href='list.php?bigid=$list1[id]'>设置参数</a>";
break;
case "3";
$list1[type]="文本字段";
break;
}
	
	if($met_en_lang!=1){
	$e_markok="disabled='disabled'";
	$list1[e_mark1]="英文没有开启";
	}
	else{
	$list1[e_name1]=$list1[e_name];
	}
	$list[]=$list1;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('fd_parameter');
footer();
}
?>