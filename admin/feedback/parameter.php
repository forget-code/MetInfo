<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
$module=8;
$p_title=($action=="addsave")?$lang_parameteradd."[".$lang_mod8."]":$lang_parameterName."[".$lang_mod8."]";
if($action=="editor"){
    $query="select * from $met_parameter where lang='$lang' and module=8  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$list1[name]="name_".$list1[id];
	$list1[name]=$$list1[name];
	$list1[no_order]="no_order_".$list1[id];
	$list1[no_order]=$$list1[no_order];
	$list1[type]="type_".$list1[id];
	$list1[type]=$$list1[type];
	$list1[access]="access_".$list1[id];
	$list1[access]=$$list1[access];
	$list1[wr_ok]="wr_ok_".$list1[id];
	$list1[wr_ok]=intval($$list1[wr_ok]);
    $list[]=$list1;
	}
foreach($list as $key=>$val){
           $query = "update $met_parameter SET 
                      name               = '$val[name]',
					  no_order           = '$val[no_order]',
					  type               = '$val[type]',
					  access             = '$val[access]',
					  wr_ok              = '$val[wr_ok]',
					  module             = '$val[module]'
					  where id=$val[id]";
		$db->query($query);

}
okinfo('parameter.php?lang='.$lang,$lang_jsok);
}elseif($action=="add"){
if($name_0==""){okinfo('javascript:history.back();',$lang_parameternamenull);}
$no_order_0=intval($no_order_0);
      $query = "INSERT INTO $met_parameter SET
                      name               = '$name_0',
					  no_order           = '$no_order_0',
					  type               = '$type_0',
					  access             = '$access_0',
					  lang               = '$lang',
					  wr_ok              = '$wr_ok_0',
					  module             = '8'";
        $db->query($query);
okinfo('parameter.php?lang='.$lang,$lang_jsok);
}elseif($action=="delete"){
      $query="delete from $met_parameter where id='$id'";
      $db->query($query);
  if($type==2 or $type==4 or $type==6){
      $query="delete from $met_list where bigid='$id'";
      $db->query($query);
   }
//delete images
  if($met_deleteimg && $type==5){
    $query="select * from $met_flist where paraid='$id'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
       file_unlink("../".$list[info]);
      }
  }
   $query="delete from $met_flist where paraid='$id'";
   $db->query($query);
  okinfo('parameter.php?lang='.$lang,$lang_jsok);
}else{
    $query="select * from $met_parameter where lang='$lang' and module=8  order by no_order";
	$result= $db->query($query);
	while($list1 = $db->fetch_array($result)){
	$typelist="type".$list1[type];
	$list1[$typelist]="selected='selected'";
	$list1[wr_ok]=($list1[wr_ok]==1)?"checked='checked'":"";
if($met_member_use){
	switch($list1['access'])
	{
		case '1':$list1['access1']="selected='selected'";break;
		case '2':$list1['access2']="selected='selected'";break;
		case '3':$list1['access3']="selected='selected'";break;
		default:$list1['access0']="selected='selected'";break;
	}
}
	$list[]=$list1;
	}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('parameter');
footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>