<?php 
# 文件名称:uploadfile_save.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
    require_once '../login/login_check.php';
	$met_file_maxsize=$met_file_maxsize*1024*1024;
	$file_size=$_FILES['imgurl']['size'];
	if($file_size>$met_file_maxsize){
	okinfo('javascript:history.go(-1)',$lang_filemaxsize);
	exit;
	}
	
  function upload($form, $met_file_format) {
	global $lang_FormatFailJS,$lang_upfileOK,$lang_upfileOver,$lang_upfileOver1,$lang_upfileOver2,$lang_upfileOver3;
    if (is_array($form)) {
      $filear = $form;
    } else {
      $filear = $_FILES[$form];
    }
    if (!is_writable('../../upload/file/')) {
	 okinfo('javascript:history.go(-1);',$lang_PathFailJS);   
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
		okinfo('javascript:history.go(-1);',$lang_FormatFailJS);      
    }
     
	 if (!copy($filear["tmp_name"],"../../upload/file/".$name)) {
	 
     $errors = array(0 => $lang_upfileOK,  1 =>$lang_upfileOver, 2 => $lang_upfileOver1, 3 => $lang_upfileOver2, 4 => $lang_upfileOver3);
      okinfo('upload_file.php',$errors[$filear["error"]]); 
    } else {
      @unlink($filear["tmp_name"]); //删除临时文件
    }
    return "../upload/file/".$name;
  }

$downloadurl=upload('imgurl',$met_file_format);
if($returnid=="")$returnid="downloadurl";  
echo "<SCRIPT language=javascript>\n";
echo "parent.document.myform.".$returnid.".value='".$downloadurl."';\n";
if($uploadtype==""){ 
echo "parent.document.myform.filesize.value='".round($file_size/1024,2)."';\n";
}
echo "alert('$lang_upfileSuccess";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_file.php'; </script>";	

# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>