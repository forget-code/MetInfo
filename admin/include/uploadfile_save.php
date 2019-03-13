<?php  /**文件处理**/
    require_once '../login/login_check.php';
	$met_file_maxsize=$met_file_maxsize*1024*1024;
	$file_size=$_FILES['imgurl']['size'];
	if($file_size>$met_file_maxsize){
	okinfo('javascript:history.go(-1)',$lang[filemaxsize]);
	exit;
	}
	
  function upload($form, $met_file_format) {
    if (is_array($form)) {
      $filear = $form;
    } else {
      $filear = $_FILES[$form];
    }
    if (!is_writable('../../upload/file/')) {
	 okinfo('javascript:history.go(-1);','指定的路径不可写，或者没有此路径!');   
    }
	//取得扩展名
	$ext = explode(".", $filear["name"]);
	$ext = $ext[1];
	//设置保存文件名
	  srand((double)microtime() * 1000000);
      $rnd = rand(100, 999);
      $name = date('U') + $rnd;
      $name = $name.".".$ext;

    if ($met_file_format != "" && !in_array(strtolower($ext), explode("|",
        strtolower($met_file_format)))) { 
		okinfo('javascript:history.go(-1);','文件格式不允许上传。');      
    }
     
	 if (!copy($filear["tmp_name"],"../../upload/file/".$name)) {
     $errors = array(0 => "文件上传成功",  1 =>"上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 ", 2 => "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。 ", 3 => "文件只有部分被上传。 ", 4 => "没有文件被上传。 ");
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
echo "alert('上传成功,文件大小：";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_file.php'; </script>";	

 /**end**/
?>