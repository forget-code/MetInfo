<?php

Class Watermark{
var $src_image_name = "";      //输入图片的文件名(必须包含路径名)
var $jpeg_quality = 90;        //jpeg图片质量
var $save_file = "";          //输出文件名
var $met_image_name = "";            //水印图片的文件名(必须包含路径名.)
var $met_image_pos = 3;             //水印图片放置的位置
// 0 = middle
// 1 = top left
// 2 = top right
// 3 = bottom right
// 4 = bottom left
// 5 = top middle
// 6 = middle right
// 7 = bottom middle
// 8 = middle left
//other = 3
var $met_image_transition = 80;            //水印图片与原图片的融合度 (1=100)

var $met_text = "";                        //水印文字(支持中英文以及带有\r\n的跨行文字)
var $met_text_size = 20;                   //水印文字大小
var $met_text_angle = 5;                   //水印文字角度,这个值尽量不要更改
var $met_text_pos = 3;                     //水印文字放置位置
var $met_text_font = "";                   //水印文字的字体
var $met_text_color = "#cccccc";           //水印字体的颜色值


function create($filename="")
{
if ($filename) {
 $this->src_image_name = strtolower(trim($filename));
}

$src_image_type = $this->get_type($this->src_image_name);
$src_image = $this->createImage($src_image_type,$this->src_image_name);
if (!$src_image) return;
$src_image_w=ImageSX($src_image);
$src_image_h=ImageSY($src_image);


if ($this->met_image_name){
       $this->met_image_name = strtolower(trim($this->met_image_name));
       $met_image_type = $this->get_type($this->met_image_name);
       $met_image = $this->createImage($met_image_type,$this->met_image_name);
       $met_image_w=ImageSX($met_image);
       $met_image_h=ImageSY($met_image);
       $temp_met_image = $this->getPos($src_image_w,$src_image_h,$this->met_image_pos,$met_image);
       $met_image_x = $temp_met_image["dest_x"];
       $met_image_y = $temp_met_image["dest_y"];
       imagecopymerge($src_image,$met_image,$met_image_x,$met_image_y,0,0,$met_image_w,$met_image_h,$this->met_image_transition);
}

if ($this->met_text){
       $this->met_text = iconv("gb2312", "UTF-8", $this->met_text);
       $temp_met_text = $this->getPos($src_image_w,$src_image_h,$this->met_text_pos);
       $met_text_x = $temp_met_text["dest_x"];
       $met_text_y = $temp_met_text["dest_y"];
      if(preg_match("/([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])([a-f0-9][a-f0-9])/i", $this->met_text_color, $color))
      {
         $red = hexdec($color[1]);
         $green = hexdec($color[2]);
         $blue = hexdec($color[3]);
         $met_text_color = imagecolorallocate($src_image, $red,$green,$blue);
      }else{
         $met_text_color = imagecolorallocate($src_image, 255,255,255);
      }

       imagettftext($src_image, $this->met_text_size, $this->met_text_angle, $met_text_x, $met_text_y, $met_text_color,$this->met_text_font,  $this->met_text);
}

if ($this->save_file)
{
  switch ($this->get_type($this->save_file)){
   case 'gif':$src_img=ImagePNG($src_image, $this->save_file); break;
   case 'jpeg':$src_img=ImageJPEG($src_image, $this->save_file, $this->jpeg_quality); break;
   case 'png':$src_img=ImagePNG($src_image, $this->save_file); break;
   default:$src_img=ImageJPEG($src_image, $this->save_file, $this->jpeg_quality); break;
  }
}
else
{
if ($src_image_type = "jpg") $src_image_type="jpeg";
  header("Content-type: image/{$src_image_type}");
  switch ($src_image_type){
   case 'gif':$src_img=ImagePNG($src_image); break;
   case 'jpg':$src_img=ImageJPEG($src_image, "", $this->jpeg_quality);break;
   case 'png':$src_img=ImagePNG($src_image);break;
   default:$src_img=ImageJPEG($src_image, "", $this->jpeg_quality);break;
  }
}
imagedestroy($src_image);
}

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
/*
createImage     根据文件名和类型创建图片
内部函数

$type:                图片的类型，包括gif,jpg,png
$img_name:  图片文件名，包括路径名，例如 " ./mouse.jpg"
*/
function createImage($type,$img_name){
         if (!$type){
              $type = $this->get_type($img_name);
         }
          switch ($type){
                  case 'gif':
                        if (function_exists('imagecreatefromgif'))
                               $tmp_img=@imagecreatefromgif($img_name);
                        break;
                  case 'jpg':
                        $tmp_img=imagecreatefromjpeg($img_name);
                        break;
                  case 'png':
                        $tmp_img=imagecreatefrompng($img_name);
                        break;
                  default:
                        $tmp_img=imagecreatefromstring($img_name);
                        break;
          }
          return $tmp_img;
}

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
getPos               根据源图像的长、宽，位置代码，水印图片id来生成把水印放置到源图像中的位置
内部函数

$sourcefile_width:        源图像的宽
$sourcefile_height: 原图像的高
$pos:               位置代码
// 0 = middle
// 1 = top left
// 2 = top right
// 3 = bottom right
// 4 = bottom left
// 5 = top middle
// 6 = middle right
// 7 = bottom middle
// 8 = middle left
$met_image:           水印图片ID
*/
function getPos($sourcefile_width,$sourcefile_height,$pos,$met_image=""){
         if  ($met_image){
              $insertfile_width = ImageSx($met_image);
              $insertfile_height = ImageSy($met_image);
         }else {
              $lineCount = explode("\r\n",$this->met_text);
              $fontSize = imagettfbbox($this->met_text_size,$this->met_text_angle,$this->met_text_font,$this->met_text);
              $insertfile_width = $fontSize[2] - $fontSize[0];
              $insertfile_height = count($lineCount)*($fontSize[1] - $fontSize[3]);
         }

         switch ($pos){
                case 0:
                   $dest_x = ( $sourcefile_width / 2 ) - ( $insertfile_width / 2 );
                   $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                   break;

                case 1:
                   $dest_x = 0;
                   if ($this->met_text){
                       $dest_y = $insertfile_height;
                   }else{
                       $dest_y = 0;
                   }
                   break;

                case 2:
                  $dest_x = $sourcefile_width - $insertfile_width;
                  if ($this->met_text){
                     $dest_y = $insertfile_height;
                  }else{
                      $dest_y = 0;
                  }
                  break;

                case 3:
                  $dest_x = $sourcefile_width - $insertfile_width;
                  $dest_y = $sourcefile_height - $insertfile_height;
                  break;

                case 4:
                  $dest_x = 0;
                  $dest_y = $sourcefile_height - $insertfile_height;
                  break;

                case 5:
                 $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
                 if ($this->met_text){
                    $dest_y = $insertfile_height;
                 }else{
                    $dest_y = 0;
                 }
                 break;

                case 6:
                 $dest_x = $sourcefile_width - $insertfile_width;
                 $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                 break;

                case 7:
                 $dest_x = ( ( $sourcefile_width - $insertfile_width ) / 2 );
                 $dest_y = $sourcefile_height - $insertfile_height;
                 break;

                case 8:
                 $dest_x = 0;
                 $dest_y = ( $sourcefile_height / 2 ) - ( $insertfile_height / 2 );
                 break;

                default:
                  $dest_x = $sourcefile_width - $insertfile_width;
                  $dest_y = $sourcefile_height - $insertfile_height;
                  break;
         }
        return array("dest_x"=>$dest_x,"dest_y"=>$dest_y);
}
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
get_type                获得图片的格式，包括jpg,png,gif
内部函数

$img_name：        图片文件名，可以包括路径名
*/
function get_type($img_name)//获取图像文件类型
{
$name_array = explode(".",$img_name);
if (preg_match("/\.(jpg|jpeg|gif|png)$/", $img_name, $matches))
{
  $type = strtolower($matches[1]);
}
else
{
  $type = "string";
}
  return $type;
}

}
?>