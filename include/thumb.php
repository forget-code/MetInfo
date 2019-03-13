<?php
require_once './common.inc.php';
require_once '../'.$met_adminfile.'/include/upfile.class.php';
header("Content-type: image/jpeg");
//$thumb_src.'dir=原图路径&x=长&y=宽'
$dir = '../'.str_replace('../', '', $dir);
if(is_numeric($x) && is_numeric($y)){
	$ext1 = explode("/", $dir);
	$count = count($ext1);
	$count1 = $ext1[$count-1];
	$ext2 = explode(".", $count1);
	$ext3 = $ext2[1];
	$path1 = $ext2[0];
	$dir1 = '../upload/thumb_src/'.$x.'_'.$y.'/'.$path1.'.'.$ext3;
	if($ext3 == 'jpg'||$ext3 == 'jpeg'||$ext3 == 'bmp'||$ext3 == 'png'||$ext3 == 'gif'){
		if (stristr(PHP_OS,"WIN")) {
			$dir1 = @iconv("utf-8","GBK",$dir1);
		}
		if(file_exists($dir1)){
			readfile("$dir1");
		}else{
			$f = new upfile($met_img_type,'../upload/thumb_src/',$met_img_maxsize,'',1);
			$f->savename = $path1.'.'.$ext3;
			$imgurls = $f->createthumb($dir,$x,$y,$x.'_'.$y.'/');
			if (stristr(PHP_OS,"WIN")) {
				$imgurls = @iconv("utf-8","GBK",$imgurls);
			}
			readfile($imgurls);
		}
	}
}
?>