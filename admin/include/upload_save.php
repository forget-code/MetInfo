<?php  
# 文件名称:upload_save.php 2009-08-18 08:53:03
# MetInfo企业网站管理系统 
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
    require_once '../login/login_check.php';
    require_once '../include/upfile.class.php';
    require_once '../include/watermark.class.php';
	$file_size=$_FILES['imgurl']['size'];
	if($file_size>$met_img_maxsize){
	okinfo('javascript:history.go(-1)',$lang_filemaxsize);
	exit;
	}
    $f = new upfile($met_img_type,'',$met_img_maxsize,'');
    $img = new Watermark();
//上传详细大图
    if($_FILES['imgurl']['name']!=''&&$returnid=="big"){
		 
        $imgurl   = $f->upload('imgurl');

        $met_big_img = $imgurl; 
        if($met_big_wate==1){
            if($met_wate_class==2){
                $img->met_image_name = $met_wate_img;//水印图片
                $img->met_image_pos  = $met_watermark;
            }else {
                $img->met_text       = $met_text_wate;
                $img->met_text_size  = $met_text_size;
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
        
   
        //缩图
       if($create_samll==1 && $_FILES['imgurl']['name']!='' ){
            file_unlink($imgurls);
			$met_big_img="../".$met_big_img;
            $imgurls = $f->createthumb($met_big_img,$met_img_x,$met_img_y);
			
            if($met_thumb_wate==1){
                if($met_wate_class==2){
                    $img->met_image_name = $met_wate_img;//水印图片
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
//上传缩略图		
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

//上传LOGO图		
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


//上传Flash图
if($_FILES['imgurl']['name']!=''&&$flash=="flash") { 
            $f->savepath = $f->savepath;
            $imgurls = $f->upload('imgurl');
     if($met_big_wate && $met_arrayimg){
            if($met_wate_class==2){
                $img->met_image_name = $met_wate_img;//水印图片
                $img->met_image_pos  = $met_watermark;
            }else {
                $img->met_text       = $met_text_wate;
                $img->met_text_size  = $met_text_size;
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
echo "<SCRIPT language=javascript>\n";
echo "parent.document.myform.".$returnid.".value='".$imgurls."';\n";
echo "alert('$lang_upfileSuccess";
echo round($file_size/1024,2);
echo "K');";
echo "location.href='upload_photo.php?returnid=";
echo $returnid;
echo "&flash=";
echo $flash;
echo "'; </script>";	
}
# 本程序是一个开源系统,使用时请你仔细阅读使用协议,商业用途请自觉购买商业授权.
# Copyright (C) 长沙米拓信息技术有限公司 (http://www.metinfo.cn).  All rights reserved.
?>