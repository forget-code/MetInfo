<?php
$ext1 = explode("/", @$_GET['dir']);
$count = count($ext1);
$count1 = $ext1[$count-1];
$ext2 = explode(".", $count1);
$ext3 = $ext2[1];
$path1 = $ext2[0];


$x = @$_GET['x'];
$y = @$_GET['y'];

if (is_numeric($x) && !is_numeric($y)) {
	$dir1 = '../upload/thumb_src/x_'.$x.'/'.$path1.'.'.$ext3;
} elseif (is_numeric($y) && !is_numeric($x)){
	$dir1 = '../upload/thumb_src/y_'.$y.'/'.$path1.'.'.$ext3;
}  elseif (is_numeric($x) && is_numeric($y)) {
	$dir1 = '../upload/thumb_src/'.$x.'_'.$y.'/'.$path1.'.'.$ext3;
}
if (stristr(PHP_OS,"WIN")) {
	$dir1 = @iconv("utf-8","GBK",$dir1);
}
if(file_exists($dir1)){
	header("Content-type: image/jpeg");
	readfile($dir1);
	die();
}

require_once './common.inc.php';
require_once './upfile.class.php';
header("Content-type: image/jpeg");
//$thumb_src.'dir=原图路径&x=长'
//$thumb_src.'dir=原图路径&y=宽'
//$thumb_src.'dir=原图路径&x=长&y=宽'
$dir = '../'.str_replace('../', '', $dir);
if (is_numeric($x) && !is_numeric($y)) {
	$image = $dir; // 原图
	$imgstream = file_get_contents($image);
	$im = imagecreatefromstring($imgstream);
	$xx = imagesx($im);//获取原图片的宽
	$yy = imagesy($im);//获取原图片的高
	$ext1 = explode("/", $dir);
	$count = count($ext1);
	$count1 = $ext1[$count-1];
	$ext2 = explode(".", $count1);
	$ext3 = $ext2[1];
	$path1 = $ext2[0];
	$bili = $x/$xx;
	$y = $bili*$yy;
	$dir1 = '../upload/thumb_src/'.'x_'.$x.'/'.$path1.'.'.$ext3;
	if(strtolower($ext3) == 'jpg'||strtolower($ext3) == 'jpeg'||strtolower($ext3) == 'bmp'||strtolower($ext3) == 'png'||strtolower($ext3) == 'gif'){
		if (stristr(PHP_OS,"WIN")) {
			$dir1 = @iconv("utf-8","GBK",$dir1);
		}
		if(file_exists($dir1)){
			readfile("$dir1");
		}else{
			$f = new upfile($met_img_type,'../upload/thumb_src/',$met_img_maxsize,'',1);
			$f->savename = $path1.'.'.$ext3;
			$imgurls = $f->createthumb($dir,$x,$y,'x_'.$x.'/');
			if (stristr(PHP_OS,"WIN")) {
				$imgurls = @iconv("utf-8","GBK",$imgurls);
			}
			readfile($imgurls);
		}
	}
} elseif (is_numeric($y) && !is_numeric($x)){
	$image = $dir; // 原图
	$imgstream = file_get_contents($image);
	$im = imagecreatefromstring($imgstream);
	$xx = imagesx($im);//获取原图片的宽
	$yy = imagesy($im);//获取原图片的高
	$ext1 = explode("/", $dir);
	$count = count($ext1);
	$count1 = $ext1[$count-1];
	$ext2 = explode(".", $count1);
	$ext3 = $ext2[1];
	$path1 = $ext2[0];
	$bili = $y/$yy;
	$x = $bili*$xx;
	$dir1 = '../upload/thumb_src/'.'y_'.$y.'/'.$path1.'.'.$ext3;
	if(strtolower($ext3) == 'jpg'||strtolower($ext3) == 'jpeg'||strtolower($ext3) == 'bmp'||strtolower($ext3) == 'png'||strtolower($ext3) == 'gif'){
		if (stristr(PHP_OS,"WIN")) {
			$dir1 = @iconv("utf-8","GBK",$dir1);
		}
		if(file_exists($dir1)){
			readfile("$dir1");
		}else{
			$f = new upfile($met_img_type,'../upload/thumb_src/',$met_img_maxsize,'',1);
			$f->savename = $path1.'.'.$ext3;
			$imgurls = $f->createthumb($dir,$x,$y,'y_'.$y.'/');
			if (stristr(PHP_OS,"WIN")) {
				$imgurls = @iconv("utf-8","GBK",$imgurls);
			}
			readfile($imgurls);
		}
	}
} elseif (is_numeric($x) && is_numeric($y)) {
	   if($x < 1930 && $y < 1000 && strstr($_SERVER['HTTP_REFERER'],$met_weburl)) {
				$ext1 = explode("/", $dir);
				$count = count($ext1);
				$count1 = $ext1[$count-1];
				$ext2 = explode(".", $count1);
				$ext3 = $ext2[1];
				$path1 = $ext2[0];
				$dir1 = '../upload/thumb_src/'.$x.'_'.$y.'/'.$path1.'.'.$ext3;
				if(strtolower($ext3) == 'jpg'||strtolower($ext3) == 'jpeg'||strtolower($ext3) == 'bmp'||strtolower($ext3) == 'png'||strtolower($ext3) == 'gif'){
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
       }
?>