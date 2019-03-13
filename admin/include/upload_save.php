<?php  
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
    require_once '../login/login_check.php';
    require_once '../include/upfile.class.php';
    require_once '../include/watermark.class.php';
    $met_img_maxsize=$met_img_maxsize*1024*1024;
	$file_size=$_FILES['imgurl']['size'];
	if($file_size>$met_img_maxsize){
	okinfoy('javascript:history.go(-1)',$lang_filemaxsize);
	exit;
	}
    $f = new upfile($met_img_type,'',$met_img_maxsize,'');
    $img = new Watermark();
//big image
    if($_FILES['imgurl']['name']!=''&&$returnid=="big"){
		 
        $imgurl   = $f->upload('imgurl');
        $met_big_img = $imgurl; 
        if($met_big_wate==1){
            if($met_wate_class==2){
                $img->met_image_name = $met_wate_bigimg;
                $img->met_image_pos  = $met_watermark;
            }else {
                $img->met_text       = $met_text_wate;
                $img->met_text_size  = $met_text_bigsize;
                $img->met_text_color = $met_text_color;
                $img->met_text_angle = $met_text_angle;
                $img->met_text_pos   = $met_watermark;
                $img->met_text_font  = $met_text_fonts;
            }
            $img->src_image_name ="../".$imgurl;
            $img->save_file = $f->waterpath.$f->savename;
            $img->create();
			$imgurl ="../upload/".date('Ym')."/watermark/".$f->savename;
        }
//Sub-module     
function imgstyle(){
       global $met_img_x,$met_img_y,$imgtype,$met_productimg_x,$met_productimg_y,$met_imgs_x,$met_imgs_y,$met_newsimg_x,$met_newsimg_y;
	   $defaultimg_x=$met_img_x;
	   $defaultimg_y=$met_img_y;
	   switch($imgtype){
	        case '1': $met_img_x=$met_productimg_x; $met_img_y=$met_productimg_y; break;
	        case '2': $met_img_x=$met_imgs_x; $met_img_y=$met_imgs_y; break;
	        case '3': $met_img_x=$met_newsimg_x; $met_img_y=$met_newsimg_y; break;
			default:break;
        }
		if($met_img_x=='')$met_img_x=$defaultimg_x;
		if($met_img_y=='')$met_img_y=$defaultimg_y;
}
        //small image
       if($create_samll==1 && $_FILES['imgurl']['name']!='' ){
	        if($met_img_style==1)imgstyle();
            file_unlink($imgurls);
			$met_big_img="../".$met_big_img;
            $imgurls = $f->createthumb($met_big_img,$met_img_x,$met_img_y);
            if($met_thumb_wate==1){
                if($met_wate_class==2){
                    $img->met_image_name = $met_wate_img;
                    $img->met_image_pos = $met_watermark;
                }else {
                    $img->met_text = $met_text_wate;
                    $img->met_text_size = $met_text_size;
                    $img->met_text_color = $met_text_color;
                    $img->met_text_angle = $met_text_angle;
                    $img->met_text_pos   = $met_watermark;
                    $img->met_text_font = $met_text_fonts;
                }
                $img->save_file =$imgurls;
                $img->create($imgurls);
            }
				$imgurls_a=explode("../",$imgurls);
				$imgurls="../".$imgurls_a[2];
			
        }
echo "<SCRIPT language=javascript>\n";
echo "parent.document.myform.imgurl.value='".$imgurl."';\n";
echo "parent.document.myform.imgurls.value='".$imgurls."';\n";
echo "alert('$lang_upfileSuccess";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_photo.php?returnid=";
echo $returnid;
echo "&create_samll=";
echo $create_samll;
echo "'; </script>";		
 } 
//small image		
if($_FILES['imgurl']['name']!=''&&$returnid=="small") {  
            $f->savepath = $f->savepath.'/thumb/';
            $imgurls = $f->upload('imgurl');
			$imgurls_array=explode("/",$imgurls);
			$imgurls=$imgurls_array[0]."/".$imgurls_array[1]."/".$imgurls_array[2]."/thumb/".$imgurls_array[3];
       

echo "<SCRIPT language=javascript>\n";
echo "parent.document.myform.imgurls.value='".$imgurls."';\n";
echo "alert('$lang_upfileSuccess";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_photo.php?returnid=";
echo $returnid;
echo "&create_samll=";
echo $create_samll;
echo "'; </script>";	
}

//logo		
if($_FILES['imgurl']['name']!=''&&$returnid=="logo") { 
            $f->savepath = $f->savepath;
            $imgurls = $f->upload('imgurl');
echo "<SCRIPT language=javascript>\n";
echo "parent.document.myform.met_logo.value='".$imgurls."';\n";
echo "alert('$lang_upfileSuccess";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_photo.php?returnid=";
echo $returnid;
echo "&create_samll=";
echo $create_samll;
echo "'; </script>";	
}


//flash
if($_FILES['imgurl']['name']!=''&&$flash=="flash") {
            $f->savepath = $f->savepath;
            $imgurls = $f->upload('imgurl');
     if($met_big_wate && $met_arrayimg){
            if($met_wate_class==2){
                $img->met_image_name = $met_wate_bigimg;
                $img->met_image_pos  = $met_watermark;
            }else {
                $img->met_text       = $met_text_wate;
                $img->met_text_size  = $met_text_bigsize;
                $img->met_text_color = $met_text_color;
                $img->met_text_angle = $met_text_angle;
                $img->met_text_pos   = $met_watermark;
                $img->met_text_font  = $met_text_fonts;
            }
            $img->src_image_name ="../".$imgurls;
            $img->save_file = $f->waterpath.$f->savename;
            $img->create();
			$imgurls ="../upload/".date('Ym')."/watermark/".$f->savename;

        }
$img_url="../templates/".$met_skin."/images";		
$num = 	round($file_size/1024,2);	
$jslist = "
            <script type='text/javascript' src='../../public/js/metinfo-min.js'></script>
            <script language='javascript'>\n	
                $(window.parent.document).find(\"input[name='{$returnid}']\").val('{$imgurls}');\n
                alert('{$lang_upfileSuccess}{$num}K');\n
                location.href='upload_photo.php?returnid={$returnid}&flash={$flash}';\n
		    </script>
           ";
 
echo $jslist;
	
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>