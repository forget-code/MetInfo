<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
switch($type){
  case 'msn':
    for($i=1;$i<=$max;$i++){
	 $met_out="<img src='../../public/images/msn/msn".$i.".gif'>";
     $met_view[]=array('title'=>$lang_onlineskin.$i,'out'=>$met_out);
	 }
	 $nowtitle='MSN';
  break;
  
   case 'skype':
    for($i=1;$i<=$max;$i++){
	 $met_out="<img src='../../public/images/skype/skype".$i.".gif'>";
     $met_view[]=array('title'=>$lang_onlineskin.$i,'out'=>$met_out);
	 }
	  $nowtitle='SKYPE';
  break;
  
  case 'flash':
  $query="select * from $met_flash where lang='$lang' and (module=10000 or module=".$classnow.") order by no_order";
  if(!$query)$query="select * from $met_flash where lang='$lang' order by no_order limit 0, 3";
  $result= $db->query($query);
  while($list = $db->fetch_array($result)){
  $list[img_path]="../".$list[img_path];
  $met_flash_img=$met_flash_img.$list[img_path]."|";
  $met_flash_imglink=$met_flash_imglink.$list[img_link]."|";
  $met_flash_imgtitle=$met_flash_imgtitle.$list[img_title]."|";
  $met_flashimg[]=$list;
  }
  $met_flash_img=substr($met_flash_img, 0, -1);
  $met_flash_imglink=substr($met_flash_imglink, 0, -1);
  $met_flash_imgtitle=substr($met_flash_imgtitle, 0, -1);
  $met_url="../../public/";
  require_once '../../config/flash_'.$lang.'.inc.php'; 
  $met_flasharray[$classnow][imgtype]=$flashtype;
  require_once '../../public/php/methtml.inc.php'; 
  $met_out=$methtml_flash;
  $met_view[]=array('title'=>'','out'=>$met_out);

  $nowtitle='Flash'.$lang_onlineskin.$flashtype;
  break;
  
  case 'online':
  $query="select * from $met_online where lang='$lang' order by no_order";
  $result= $db->query($query);
  while($list = $db->fetch_array($result)){
  $online_list[]=$list;
  if($list[qq]!="")$qq_list[]=$list;
  if($list[msn]!="")$msn_list[]=$list;
  if($list[taobao]!="")$taobao_list[]=$list;
  if($list[alibaba]!="")$alibaba_list[]=$list;
  if($list[skype]!="")$skype_list[]=$list;
 }
  $met_online_skin=$onlinetype;
  $met_online_color=$color;
  $met_url="../../public/";
  require_once '../../public/php/methtml.inc.php'; 
  $met_out=methtml_online();
  $met_view[]=array('title'=>'','out'=>$met_out);
  $nowtitle=$lang_onlineskin.$onlinetype;
  break;
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('view');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>