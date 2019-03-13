<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

function methtml_imgdisplay($type='img'){
global $img_paraimg,$img,$product,$product_paraimg,$lang_BigPicture,$met_url,$met_img_x,$met_img_y,$met_imgdetail_x,$met_imgdetail_y,$met_img_detail,$met_productdetail_x,$met_productdetail_y,$met_product_detail;

if($type=='product'){
$img_paraimg=$product_paraimg;
$img=$product;
$met_imgdetail_x=$met_productdetail_x;
$met_imgdetail_y=$met_productdetail_y;
$met_img_detail=$met_product_detail;
}
 $metinfoimglist=0;
 if(count($img_paraimg)){
  foreach($img_paraimg as $key=>$val){
  if($img[$val[para]]<>''){
  $metinfolist.="<li><a href='".$img[$val[para]]."'><img src='".$img[$val[para]]."' /></a></li>\n";
  $metinfoimglist=1;
   }}
 }
if($metinfoimglist){
switch($met_img_detail){
case 1:
   $metinfo.="<style>\n";
   $metinfo.=".spic{margin:5px;}\n";
   $metinfo.=".spic a img{-moz-opacity:0.5; filter:alpha(opacity=50);border:0px;}\n";
   $metinfo.=".spic a:hover{font-size:9px;}\n";
   $metinfo.=".spic a:hover img{-moz-opacity:0.5; filter:alpha(opacity=100);cursor:hand;}\n";
   $metinfo.="</style>\n";
   $metinfo.="<script  LANGUAGE='JavaScript'>\n";
   $metinfo.="function metseeBig(nowimg) {\n";
   $metinfo.="document.getElementById('view_img').src=document.getElementById(nowimg).src;\n";
   $metinfo.="document.getElementById('view_bigimg').href=document.getElementById(nowimg).src;\n";
   $metinfo.="}\n";
   $metinfo.="</script>\n";
   $metinfo.="<span class='info_img' id='imgqwe'><a id='view_bigimg' href='".$img[imgurl]."' title=".$lang_BigPicture." target='_blank'><img id='view_img' border='0' width=".$met_imgdetail_x." height=".$met_imgdetail_y." src='".$img[imgurl]."'></a></span>\n";
   $metinfo.="<script type='text/javascript'>";
   $metinfo.="var zoomImagesURI   = '".$met_url."images/zoom/';"; 
   $metinfo.="</script>\n"; 
   $metinfo.="<script src='".$met_url."js/metzoom.js' language='JavaScript' type='text/javascript'></script>\n";
   $metinfo.="<script src='".$met_url."js/metzoomHTML.js' language='JavaScript' type='text/javascript'></script>\n";
   $metinfo.="<script type='text/javascript'>	window.onload==setupZoom();	</script>\n";
   $metinfo.="<div class='smallimg' style='text-align:center;'>\n";
   $i=0;
  foreach($img_paraimg as $key=>$val){
  if($img[$val[para]]<>''){
  $i++;
   $metinfo.="<span class='spic'><a href='###' onclick=metseeBig('smallimg".$i."')  style='cursor:pointer'><img border='0'  id='smallimg".$i."' src='".$img[$val[para]]."' width='50' height='50' alt='".$img[$val[paraname]]."' ></a></span>\n";
   }}
   $metinfo.="</div>\n";
break;
case 2:
   $metinfo.="<SCRIPT LANGUAGE='JavaScript'>;\n";
   $metinfo.="var rotate_delay = 5000; // delay in milliseconds (5000 = 5 secs)\n";
   $metinfo.="current = 0;\n";
   $metinfo.="function next() {\n";
   $metinfo.="if (document.slideform.slide[current+1]) {\n";
   $metinfo.="document.images.show.src = document.slideform.slide[current+1].value;\n";
   $metinfo.="document.slideform.slide.selectedIndex = ++current;\n";
   $metinfo.="  }\n";
   $metinfo.="else first();\n";
   $metinfo.="}\n";
   $metinfo.="function previous() {\n";
   $metinfo.="if (current-1 >= 0) {\n";
   $metinfo.="document.images.show.src = document.slideform.slide[current-1].value;\n";
   $metinfo.="document.slideform.slide.selectedIndex = --current;\n";
   $metinfo.=" }\n";
   $metinfo.="}\n";
   $metinfo.="function first() {\n";
   $metinfo.="current = 0;\n";
   $metinfo.="document.images.show.src = document.slideform.slide[0].value;\n";
   $metinfo.="document.slideform.slide.selectedIndex = 0;\n";
   $metinfo.="}\n";
   $metinfo.="function last() {\n";
   $metinfo.="current = document.slideform.slide.length-1;\n";
   $metinfo.="document.images.show.src = document.slideform.slide[current].value;\n";
   $metinfo.="document.slideform.slide.selectedIndex = current;\n";
   $metinfo.="}\n";
   $metinfo.="function ap(text) {\n";
   $metinfo.="document.slideform.slidebutton.value = (text == 'Stop') ? 'Start' : 'Stop';\n";
   $metinfo.="rotate();\n";
   $metinfo.="}\n";
   $metinfo.="function change() {\n";
   $metinfo.="current = document.slideform.slide.selectedIndex;\n";
   $metinfo.="document.images.show.src = document.slideform.slide[current].value;\n";
   $metinfo.="}\n";
   $metinfo.="function rotate() {\n";
   $metinfo.="if (document.slideform.slidebutton.value == 'Stop') {\n";
   $metinfo.="current = (current == document.slideform.slide.length-1) ? 0 : current+1;\n";
   $metinfo.="document.images.show.src = document.slideform.slide[current].value;\n";
   $metinfo.="document.slideform.slide.selectedIndex = current;\n";
   $metinfo.="window.setTimeout('rotate()', rotate_delay);\n";
   $metinfo.="   }\n";
   $metinfo.="}\n";
   $metinfo.="</script>\n";
   $metinfo.="<form name=slideform>\n";
   if($img[imgurl]<>"")$metinfo.="<span class='info_img'><img src='".$img[imgurl]."'  name='show' width=".$met_imgdetail_x." height=".$met_imgdetail_y." onclick='javascript:window.open(this.src);' style='cursor:pointer;'/></span>\n";
   $metinfo.="<span class='info_select'  style=' display:block; width:100%; text-align:center;'><select name='slide' onChange='change();'>\n";
   if($img[imgurl]<>"")$metinfo.="<option value='".$img[imgurl]."' selected>defualt</option>\n";
 foreach($img_paraimg as $key=>$val){
  if($img[$val[para]]<>''){
  $metinfo.="<option value='".$img[$val[para]]."'>".$img[$val[paraname]]."</option>\n";
   }}
  $metinfo.="</select>\n";
  $metinfo.="<input type=button onClick='first();' value='|<<' title='Beginning'>\n";
  $metinfo.="<input type=button onClick='previous();' value='<<' title='Previous'>\n";
  $metinfo.="<input type=button name='slidebutton' onClick='ap(this.value);' value='Start'  title='AutoPlay'>\n";
  $metinfo.="<input type=button onClick='next();' value='>>'   title='Next'>\n";
  $metinfo.="<input type=button onClick='last();' value='>>|' title='End'></span>\n";
  $metinfo.="</form>\n";
break;
case 3:
if($img[imgurl]<>""){
  $imgurl.=$img[imgurl]."|";
  $imglink.=$img[imgurl]."|";
  $imgtitle.=$img[title]."|";
  }
  foreach($img_paraimg as $key=>$val){
  if($img[$val[para]]<>''){
  $imgurl.=$img[$val[para]]."|";
  $imglink.=$img[$val[para]]."|";
  $imgtitle.=$img[$val[paraname]]."|";
   }}
  $imgurl=substr($imgurl, 0, -1);
  $imglink=substr($imglink, 0, -1);
  $imgtitle=substr($imgtitle, 0, -1);
  $metinfo.="<span class='info_img' id='flashcontent01'></span>\n";
  $metinfo.=methtml_flashimg(8,$met_imgdetail_x,$met_imgdetail_y,$imgurl,$imglink,$imgtitle);
break;

case 4:
if($img[imgurl]<>""){
  $imgurl.=$img[imgurl]."|";
  $imglink.=$img[imgurl]."|";
  $imgtitle.=$img[title]."|";
  }
  foreach($img_paraimg as $key=>$val){
  if($img[$val[para]]<>''){
  $imgurl.=$img[$val[para]]."|";
  $imglink.=$img[$val[para]]."|";
  $imgtitle.=$img[$val[paraname]]."|";
   }}
  $imgurl=substr($imgurl, 0, -1);
  $imglink=substr($imglink, 0, -1);
  $imgtitle=substr($imgtitle, 0, -1);
  $metinfo.=methtml_flashimg(9,$met_imgdetail_x,$met_imgdetail_y,$imgurl,$imglink,$imgtitle);
break;

case 5:
  $met_imgdetail_x1=$met_imgdetail_x+2;
  $met_imgdetail_y1=$met_imgdetail_y+44;
  $metinfo.="<div class='info_img'>\n";
  $metinfo.="<style type='text/css'>\n";
  $metinfo.=".metinfo_slide { border:1px solid #ccc; padding:3px; MARGIN: 8px 0px; OVERFLOW: hidden; width:".$met_imgdetail_x1."px; height:".$met_imgdetail_y1."px; }\n";
  $metinfo.="#metbimg {	FILTER: progid:DXImageTransform.Microsoft.Fade ( duration=0.5,overlap=1.0 ); overflow:hidden; height:".$met_imgdetail_y."px; }\n";
  $metinfo.="#metbimg img{border:0px;}\n";
  $metinfo.="#metimginfo{ font-weight:bold; font-size:14px; overflow:hidden; line-height:34px; text-align:center; width:35%; float:left;}\n";
  $metinfo.="#metimginfo a{color:#FFFFFF; text-decoration:none;}\n";
  $metinfo.=".metdis { display:block;}	\n";
  $metinfo.=".unmetdis { display:none;}\n";
  $metinfo.="#metsimg { margin:10px 0px 0px 0px; float:right;}\n";
  $metinfo.="#metsimg div{ font-size:12px; background:	#d6d6d6; float:left; width:18px; cursor:pointer; color:#FFFFFF; line-height:18px; margin-right:1px; height:18px; text-align:center;}\n";
  $metinfo.="#metsimg .f1 { background-color:#6f6f6f;}\n";
  $metinfo.=".imgbottom{ background-color:#343434; height:40px; float:left; width:".$met_imgdetail_x."px; margin:1px;}\n";
  $metinfo.="</style>\n";
  $metinfo.="<div class=metinfo_slide>\n";
  $metinfo.="<div id=metbimg>\n";
$i=0;
foreach($img_paraimg as $key=>$val){
if($img[$val[para]]<>''){
$i++;
$k=$i-1;
  $metdis=($i==1)?'metdis':'unmetdis';
  $metdis1=($i==1)?'':'f1';
  $metinfo.="<div class='".$metdis."' name='f'><A  href='".$img[$val[para]]."'  target=_blank ><IMG alt=".$img[$val[paraname]]."  src='".$img[$val[para]]."' width='".$met_imgdetail_x."' height='".$met_imgdetail_y."'></A></div>\n";
  $metinfo1.="<div class='".$metdis."' name='f'><A  href='".$img[$val[para]]."'   target=_blank >".$img[$val[paraname]]."</A></div>\n";
  $metinfo2.="<div class='".$metdis1."' onclick=metplay(x[".$k."],".$k.") name='f'>".$i."</div>\n";
  }}
  $metinfo.="</div>\n";
  $metinfo.="<div class='imgbottom' >\n";
  $metinfo.="<div id='metimginfo'>\n";
  $metinfo.=$metinfo1;
  $metinfo.="</div>\n";
  $metinfo.="<div id=metsimg>\n";
  $metinfo.=$metinfo2;
  $metinfo.="</div>\n";
  $metinfo.="</div>\n";
  $metinfo.="<SCRIPT src='".$met_url."js/imgdisplay5.js' type=text/javascript></SCRIPT>\n";
  $metinfo.="</div>\n";
  $metinfo.="</div>\n";
break;

case 6:
  $metinfo.="<div class='info_img'>\n";
  $metinfo.="<style type='text/css'>\n";
  $metinfo.="#carousel{margin:30px auto 10px; width:730px; height:120px;overflow:hidden;}\n";
  $metinfo.="#carousel_btn_lastgroup,#carousel_btn_nextgroup{float:left;width:27px;height:74px;margin:20px 14px 14px 15px;display:inline;overflow:hidden;text-indent:-999px;}\n";
  $metinfo.="#carousel_btn_lastgroup a.dis:link,#carousel_btn_lastgroup a.dis:visited,#carousel_btn_lastgroup a.dis:hover{background-position:0 -148px;}\n";
  $metinfo.="#carousel_btn_nextgroup{float:right;margin:20px 14px 14px 15px;}\n";
  $metinfo.="#carousel_btn_nextgroup a.dis:link,#carousel_btn_nextgroup a.dis:visited,#carousel_btn_nextgroup a.dis:hover{background-position:0 -222px;}\n";
  $metinfo.="#carousel_container{position:relative;z-index:2;float:left;width:610px;height:120px; overflow:auto; ppadding-bottom:5px; }\n";
  $metinfo.="#carousel_container ul{position:absolute;z-index:1;left:0;top:0;height:110px;overflow:hidden;}\n";
  $metinfo.="#carousel_container li{float:left;width:112px;height:102px;display:inline;margin-bottom:5px}\n";
  $metinfo.="#carousel_container li a:link img,#carousel_container li a:visited img,#carousel_container li a:hover img{float:left;width:80px;height:80px;padding:10px;display:inline;margin:0 5px;border:1px solid #999;}\n";
  $metinfo.="#carousel_container li a.current:link img,#carousel_container li a.current:visited img,#carousel_container li a.current:hover img{opacity:.5;-moz-opacity:.5;filter:alpha(opacity=50);border:1px solid #369;}\n";
  $metinfo.="#carousel_photo_container{position:relative;z-index:1;margin:20px auto; width:700px; overflow:hidden;clear:both;text-align:center;}\n";
  $metinfo.="#carousel_photo_shardow{position:absolute;z-index:4;left:0;top:0;width:100%;height:100%;background-color:#000;opacity:.5;-moz-opacity:.5;filter:alpha(opacity=50);}\n";
  $metinfo.="img#carousel_photo_loading{position:absolute;z-index:5;left:50%; top:50%;width:100px;height:100px;margin:-50px 0 0 -50px;}\n";
  $metinfo.="a.previous:link,a.previous:visited,a.previous:hover{position:absolute;z-index:3;top:0;left:0;text-indent:-999px;width:50%;height:100%;overflow:hidden;cursor:pointer;background-color:#FFF;opacity:.0;-moz-opacity:.0;filter:alpha(opacity=0);text-decoration:none;}\n";
  $metinfo.="a.previous:hover{background:transparent url(../last-photo.png) 0 50% no-repeat;opacity:.8;-moz-opacity:.8;filter:alpha(opacity=80);}\n";
  $metinfo.="a.next:link,a.next:visited,a.next:hover{position:absolute;z-index:3;top:0;right:0;text-indent:-999px;width:50%;height:100%;overflow:hidden;cursor:pointer;background-color:#FFF;opacity:.0;-moz-opacity:.0;filter:alpha(opacity=0);text-decoration:none;}\n";
  $metinfo.="a.next:hover{background:transparent url(../next-photo.gif) 100% 50% no-repeat;opacity:.8;-moz-opacity:.8;filter:alpha(opacity=80);}\n";
  $metinfo.="a.dis:link,a.dis:visited,a.dis:hover{background-image:none;}\n";
  $metinfo.="  #carousel_btn_lastgroup a:link,\n";
  $metinfo.="  #carousel_btn_lastgroup a:visited,\n";
  $metinfo.="  #carousel_btn_lastgroup a:hover {display:block; width:27px;  height:74px;  background:url(".$met_url."images/button.gif) 0px 0px no-repeat; overflow:hidden;}\n";
  $metinfo.="  #carousel_btn_nextgroup a:link,\n";
  $metinfo.="  #carousel_btn_nextgroup a:visited,\n";
  $metinfo.="  #carousel_btn_nextgroup a:hover {display:block;  width:27px;  height:74px;  background:url(".$met_url."images/button.gif) 0px -74px no-repeat;  overflow:hidden; }\n";
  $metinfo.="</style>\n";
  $metinfo.="<p id='carousel_photo_intro'>&nbsp;</p>\n";
  $metinfo.="<div class='img_list1'>\n";
  $metinfo.="<div class='metimg_list_img1' id='carousel_photo_container' ><a href='".$img[imgurl]."' target='_blank' ><img src='".$img[imgurl]."' id='carousel_photo' alt='' width='".$met_imgdetail_x."' height='".$met_imgdetail_y."' /></a></div>\n";
  $metinfo.="<div class='imgimg' id='carousel'>\n";
  $metinfo.="<div id='carousel_btn_lastgroup'><a href='#1'></a></div>\n";
  $metinfo.="<div id='carousel_container'>\n";
  $metinfo.="<ul id='samples_list'>\n";
  $metinfo.="<li><a href='".$img[imgurl]."' target='_blank'><img src='".$img[imgurl]."' id='carousel_photo' width=".$met_imgdetail_x." height=".$met_imgdetail_y."  alt='".$lang_BigPicture."' /></a></li>\n";
foreach($img_paraimg as $key=>$val){
if($img[$val[para]]<>''){
  $metinfo.="<li><a href='".$img[$val[para]]."'><img src='".$img[$val[para]]."' width=".$met_img_x." height=".$met_img_y." /></a></li>\n";
}}
  $metinfo.="</ul>\n";
  $metinfo.="</div>\n";
  $metinfo.="<div id='carousel_btn_nextgroup'><a href='#1'>&nbsp;</a></div>\n";
  $metinfo.="</div>\n";
  $metinfo.="<script language='javascript' type='text/javascript' src='".$met_url."js/yao.js'></script>\n";
  $metinfo.="<script language='javascript' type='text/javascript'>\n";
  $metinfo.="var Album = new YAO.YAlbum();\n";
  $metinfo.="YAO.YAlbum.prototype.CARSOUEL_STEP_WIDTH = 672;\n";
  $metinfo.="YAO.YAlbum.prototype.PHOTO_MAX_WIDTH = ".$met_imgdetail_x.";\n";
  $metinfo.="</script>\n";
  $metinfo.="</div>\n";
  $metinfo.="</div>\n";
break;
}  

 }else{
 $imgarr = getimagesize($img[imgurl]); 
 $imgxx=$imgarr[0]/$imgarr[1];
 $imgyy=$met_imgdetail_x/$met_imgdetail_y;
 if($imgxx>$imgyy){
 $met_imgdetail_y1=$imgarr[1]*($met_imgdetail_x/$imgarr[0]);
 $met_imgdetail_x1=$met_imgdetail_x;
 }else{
 $met_imgdetail_x1=$imgarr[0]*($met_imgdetail_y/$imgarr[1]);
 $met_imgdetail_y1=$met_imgdetail_y;
 }
 $metinfo.="<span class='info_img' id='imgqwe'><a href='".$img[imgurl]."' target='_blank'><img src=".$img[imgurl]." alt=".$lang_BigPicture." width=".$met_imgdetail_x1." height=".$met_imgdetail_y1."  /></a></span>\n";
 $metinfo.="<script type='text/javascript'>";
 $metinfo.="var zoomImagesURI   = '".$met_url."images/zoom/';"; 
 $metinfo.="</script>\n"; 
 $metinfo.="<script src='".$met_url."js/metzoom.js' language='JavaScript' type='text/javascript'></script>\n";
 $metinfo.="<script src='".$met_url."js/metzoomHTML.js' language='JavaScript' type='text/javascript'></script>\n";
 $metinfo.="<script type='text/javascript'>	window.onload==setupZoom();	</script>\n";
 }
return $metinfo;
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>