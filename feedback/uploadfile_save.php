<?php  
# 文件名称:uploadfile_save.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
/**文件处理**/
require_once '../include/common.inc.php';
	$met_file_maxsize=$met_file_maxsize*1024*1024;
	$query = "SELECT * FROM $met_fdparameter where use_ok='1' and type=5 order by no_order";
$result = $db->query($query);
while($list = $db->fetch_array($result)) {
if($list[use_ok]==1)$list_p[]=$list;
}
  function upload($form, $met_file_format) {
  global $lang_js22,$lang_js23,$lang_fileOK,$lang_fileError1,$lang_fileError2,$lang_fileError3,$lang_fileError4;
    if (is_array($form)) {
      $filear = $form;
    } else {
      $filear = $_FILES[$form];
    }
    if (!is_writable('../upload/file/')) {
	 okinfo('javascript:history.go(-1);',$lang_js22);  
    }
	//取得扩展名
	$ext = explode(".", $filear["name"]);
	$extnum=count($ext)-1;
	$ext = $ext[$extnum];
	//设置保存文件名
	  srand((double)microtime() * 1000000);
      $rnd = rand(100, 999);
      $name = date('U') + $rnd;
      $name = $name.".".$ext;
    $met_file_format=str_replace("php","",strtolower($met_file_format));
	$met_file_format=str_replace("aspx","",strtolower($met_file_format));
    $met_file_format=str_replace("asp","",strtolower($met_file_format));
    $met_file_format=str_replace("jsp","",strtolower($met_file_format));
    $met_file_format=str_replace("js","",strtolower($met_file_format));
    if ($met_file_format != "" && !in_array(strtolower($ext), explode("|",
        strtolower($met_file_format)))) { 
		okinfo('javascript:history.go(-1);',$lang_js23);
    }
     
	 if (!copy($filear["tmp_name"],"../upload/file/".$name)) {
     $errors = array(0 => "$lang_fileOK",  1 =>"$lang_fileError1 ", 2 => "$lang_fileError2 ", 3 => "$lang_fileError3 ", 4 => "$lang_fileError4 ");
    } else {
      @unlink($filear["tmp_name"]); //删除临时文件
    }
    return $name;
  }
 
	foreach($list_p as $key=>$val)
	{
		$downloadurl="para".$val['id'];		
		if(isset($_FILES[$downloadurl]) && $_FILES[$downloadurl]['name']!='')
		{	
			$file_size=$_FILES[$downloadurl]['size'];
			if($file_size>$met_file_maxsize){
			okinfo('javascript:history.go(-1)',$lang_filemaxsize);
			exit;
			} 
			$$downloadurl=upload($downloadurl,$met_file_format);
		}
	}

 /**end**/
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>