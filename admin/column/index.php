<?php
# 文件名称:index.php 2009-08-07 08:43:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
require_once '../login/login_check.php';
    $query = "SELECT * FROM $met_column order by no_order";
    $result = $db->query($query);
	 while($list = $db->fetch_array($result)) {
	 switch($list['access'])
     {
    	case '1':$list['access']=$lang_access1;break;
    	case '2':$list['access']=$lang_access2;break;
    	case '3':$list['access']=$lang_access3;break;
		default:$list['access']=$lang_access0;break;
	 }
	 $list['name']=$langusenow=="en"?$list['e_name']:($langusenow=="other"?$list['o_name']:$list['c_name']);
	 if($langusenow=="en" && $met_e_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['o_name'];
	 if($langusenow=="cn" && $met_c_lang_ok!=1) $list['name']=$met_e_lang_ok==1?$list['e_name']:$list['o_name'];
	 if($langusenow=="other" && $met_o_lang_ok!=1) $list['name']=$met_c_lang_ok==1?$list['c_name']:$list['e_name'];
	 $list['out_url']=$langusenow=="en"?$list['e_out_url']:($langusenow=="other"?$list['o_out_url']:$list['c_out_url']);
	 if($langusenow=="en" && $met_e_lang_ok!=1) $list['out_url']=$met_c_lang_ok==1?$list['c_out_url']:$list['o_out_url'];
	 if($langusenow=="cn" && $met_c_lang_ok!=1) $list['out_url']=$met_e_lang_ok==1?$list['e_out_url']:$list['o_out_url'];
	 if($langusenow=="other" && $met_o_lang_ok!=1) $list['out_url']=$met_c_lang_ok==1?$list['c_out_url']:$list['e_out_url'];
	 if($list[bigclass]==0){$column_big[]=$list;}
	 else{$column_small[]=$list;}
    }
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('column');
footer();
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn). All rights reserved.
?>