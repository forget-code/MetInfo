<?php
# 文件名称:setflash.php 2009-08-01 21:01:57
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved.
require_once '../login/login_check.php';
require_once '../../config/flash.inc.php';
$query="select * from $met_column where if_in='0' order by no_order";
	$result= $db->query($query);
	$mod1[0]=$mod[10000]=array(
				id=>10000,
				name=>"$lang_flashGlobal",
				bigclass=>0
			);
	$mod1[1]=$mod[10001]=array(
				id=>10001,
				name=>"$lang_flashHome",
				bigclass=>0
			);
	$i=2;
	while($list = $db->fetch_array($result)){
	$list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);	
	if($langusenow=="en" && $met_e_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['o_name'];
	if($langusenow=="cn" && $met_c_lang_ok!=1) $list['name']=$met_e_lang_ok==1?$list['e_name']:$list['o_name'];
	if($langusenow=="other" && $met_o_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['e_name'];
	if(!isset($met_flasharray[$list[id]][type]))$met_flasharray[$list[id]]=$met_flasharray[10000];
	if($list[classtype]==1){
	                        $mod1[$i]=$list;
							$i++;
							}
	if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
	if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
	$mod[$list['id']]=$list;
	}

$metcolor[1]='red';
$metcolor[2]='blue';
$metcolor[3]='green';
$metcolor[4]='#CC0099';
$metcolor[5]='#FFCC00';
$metcolor[6]='#FF9900';
$metcolor[7]='#FF6600';
$metcolor[8]='#3366CC';
$metcolor[9]='#000066';
$metcolor[10]='black';


if($action=="modify"){
$met_flash_typeall=$met_flash_10000_type;
$met_flash_xall=$met_flash_10000_x;
$met_flash_yall=$met_flash_10000_y;
$met_flash_imgtypeall=$met_flash_10000_imgtype;
$config_save =  "<?php\n";
$config_save .=  "# MetInfo企业网站管理系统 \n";
$config_save .=  "# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn)). All rights reserved. \n";
$config_save .=  "$"."met_flasharray=array();\n";
foreach($mod as $key=>$val){
$met_flash_all="met_flash_".$val[id]."_all";
$met_flash_all=$$met_flash_all;
if($met_flash_all==1){
$met_flash_arrayvalue="array(type=>".$met_flash_typeall.",x=>".intval($met_flash_xall).",y=>".intval($met_flash_yall).",imgtype=>".$met_flash_imgtypeall.")";
$query = "update $met_flash SET
					  width				 = '$met_flash_xall',
					  height			 = '$met_flash_yall' 
					  where module='$val[id]'";
$db->query($query);
}else{
$met_flash_type="met_flash_".$val[id]."_type";
$met_flash_type=$$met_flash_type;
$met_flash_x="met_flash_".$val[id]."_x";
$met_flash_x=$$met_flash_x;
$met_flash_y="met_flash_".$val[id]."_y";
$met_flash_y=$$met_flash_y;
$met_flash_imgtype="met_flash_".$val[id]."_imgtype";
$met_flash_imgtype=$$met_flash_imgtype;
$met_flash_x=intval($met_flash_x)?$met_flash_x:$met_flash_xall;
$met_flash_y=intval($met_flash_y)?$met_flash_y:$met_flash_yall;
$met_flash_arrayvalue="array(type=>".$met_flash_type.",x=>".intval($met_flash_x).",y=>".intval($met_flash_y).",imgtype=>".$met_flash_imgtype.")";
$query = "update $met_flash SET
					  width				 = '$met_flash_x',
					  height			 = '$met_flash_y' 
					  where module='$val[id]'";
$db->query($query);
}
$met_flash_array="met_flasharray[".$val[id]."]";
$config_save.="$".$met_flash_array."=".$met_flash_arrayvalue.";\n";
}

$config_save       .="?>";

 $fp = fopen("../../config/flash.inc.php",w);
 fputs($fp, $config_save);
 fclose($fp);
okinfo('setflash.php',$lang_loginUserAdmin);
}
else{

$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('setflash');
footer();
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>