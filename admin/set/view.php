<?php
# 文件名称:skin.php 2009-08-03 15:48:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
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
  $query="select * from $met_flash where module=10000 or module=".$classnow." order by no_order";
  if(!$query)$query="select * from $met_flash order by no_order limit 0, 3";
  $result= $db->query($query);
  while($list = $db->fetch_array($result)){
  $list[img_path]=($list[c_img_path]!='')?$list[c_img_path]:(($list[e_img_path]!='')?$list[e_img_path]:$list[o_img_path]);
  $list[img_link]=($list[c_img_link]!='')?$list[c_img_link]:(($list[e_img_link]!='')?$list[e_img_link]:$list[o_img_link]);
  $list[img_title]=($list[c_img_title]!='')?$list[c_img_title]:(($list[e_img_title]!='')?$list[e_img_title]:$list[o_img_title]);
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
  require_once '../../config/flash.inc.php'; 
  $met_flasharray[$classnow][imgtype]=$flashtype;
  require_once '../../public/php/methtml.inc.php'; 
  $met_out=$methtml_flash;
  $met_view[]=array('title'=>'','out'=>$met_out);

  $nowtitle='Flash'.$lang_onlineskin.$flashtype;
  break;
  
  case 'online':
  $query="select * from $met_online order by no_order";
  $result= $db->query($query);
  while($list = $db->fetch_array($result)){
  $list[name]=($lang=="en")?$list[e_name]:(($lang=="other")?$list[o_name]:$list[c_name]);
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

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>