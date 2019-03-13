<?php
require_once '../login/login_check.php';
$admin_ok = 1;
if($admin_pop=="yes"){
$admin_type="metinfo";}
else{
for($i=1001;$i<=1019;$i++){
$admin_pop="admin_pop".$i;
if($$admin_pop!=""){
$admin_type.=$$admin_pop."-";
}
}
$query = "select * from $met_column where bigclass=0 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)){$column_list[]=$list;}
foreach($column_list as $key=>$val){
$column_pop="admin_pop".$val[id];
if($$column_pop!="")$admin_type=$admin_type."-".$$column_pop;
}
}
if($action=="add"){
$admin_if=$db->get_one("SELECT * FROM $met_admin_table WHERE admin_id='$useid'");
if($admin_if){
okinfo('javascript:history.back();',$lang[user_mudb1]);
}
$pass1=md5($pass1);
 $query = "INSERT INTO $met_admin_table SET
                      admin_id           = '$useid',
                      admin_pass         = '$pass1',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction    = '$admin_introduction',
				      admin_type          = '$admin_type',
					  admin_register_date= '$m_now_date',
					  admin_approval_date= '$m_now_date', 
					  admin_ok           = '$admin_ok'";
         $db->query($query);
okinfo('index.php',$lang[user_admin]);
}

if($action=="editor"){
$query = "update $met_admin_table SET
                      admin_id           = '$useid',
					  admin_name         = '$name',
					  admin_sex          = '$sex',
					  admin_tel          = '$tel',
					  admin_mobile       = '$mobile',
					  admin_email        = '$email',
					  admin_qq           = '$qq',
					  admin_msn          = '$msn',
					  admin_taobao       = '$taobao',
					  admin_introduction    = '$admin_introduction',
					  admin_register_date= '$m_now_date',
					  admin_approval_date= '$m_now_date', 
					  admin_ok           = '$admin_ok'";
if($editorpass!=1)$query .=", admin_type          = '$admin_type'";
if($pass1){
$pass1=md5($pass1);
$query .=", admin_pass         = '$pass1'";
}
$query .="  where id='$id'";
$db->query($query);
if($editorpass!=1){
okinfo('index.php',$lang[user_admin]);
}
else
{
okinfo('editor_pass.php?id='.$id,$lang[user_admin]);
}
}
?>
