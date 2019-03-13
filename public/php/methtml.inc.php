<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
//head
$methtml_head="";
$methtml_head.="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
$methtml_head.="<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
$methtml_head.="<head>\n";
$methtml_head.="<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n";
$methtml_head.="<meta name=\"description\" content=\"".$show[description]."\">\n";
$methtml_head.="<meta name=\"keywords\" content=\"".$show[keywords]."\">\n";
$methtml_head.="<meta name=\"robots\" content=\"all\">\n";
$methtml_head.="<meta name=\"GOOGLEBOT\" content=\"all\">\n";
$methtml_head.="<meta name=\"author\" content=\"$met_webname\">\n";
$methtml_head.="<meta name=\"copyright\" content=\"Copyright 2008-".$m_now_year." MetInfo\">\n";
$methtml_head.="<LINK href=\"".$navurl."favicon.ico\" rel=\"shortcut icon\">\n";
$methtml_head.=$met_js_access."\n";
if($met_skin_css=='')$met_skin_css='metinfo.css';
$methtml_head.="<link rel=\"stylesheet\" type=\"text/css\" href=\"".$img_url."css/".$met_skin_css."\">\n";
$methtml_head.="<style type=\"text/css\">\n";
$methtml_head.="<!--\n";
$methtml_head.="body {\n";
$lang_fontfamily=str_replace("&quot;","\"",$lang_fontfamily);
if($lang_fontfamily<>'')$methtml_head.=" font-family:".$lang_fontfamily.";\n";
if($lang_fontsize<>'')$methtml_head.="	font-size:".$lang_fontsize.";\n"; 
if($lang_backgroundcolor<>'')$methtml_head.="	background:".$lang_backgroundcolor."; \n";
if($lang_fontcolor<>'')$methtml_head.="	color:".$lang_fontcolor.";\n";
$methtml_head.="}\n";
if($lang_fontcolor<>'' or $lang_fontfamily<>''){
   $methtml_head.="table td{";
   if($lang_fontfamily<>'')$methtml_head.="font-family:".$lang_fontfamily.";"; 
   if($lang_fontcolor<>'')$methtml_head.="color:".$lang_fontcolor.";";
   $methtml_head.="}\n";
}
if($lang_fontcolor<>'' or $lang_fontfamily<>''){
   $methtml_head.="table th{";
   if($lang_fontfamily<>'')$methtml_head.="font-family:".$lang_fontfamily.";"; 
   if($lang_fontcolor<>'')$methtml_head.="color:".$lang_fontcolor.";";
   $methtml_head.="}\n";
}
if($lang_urlcolor<>'')$methtml_head.="a{color:".$lang_urlcolor.";}\n";
if($lang_hovercolor<>'')$methtml_head.="a:hover{color:".$lang_hovercolor.";}\n";
$methtml_head.="-->\n";
$methtml_head.="</style>\n";
$methtml_head.="<TITLE>".$met_title."</TITLE>\n";
$methtml_head.="</head>\n";
$methtml_head.="<script type='text/javascript' src='".$navurl."public/js/public.js'></script>\n";

//time
$methtml_now="";
$methtml_now.=$lang_now."\n";
$methtml_now.="<script language='JavaScript'>\n";
$methtml_now.="today=new Date();\n";
$methtml_now.="function initArray(){\n";
$methtml_now.="this.length=initArray.arguments.length\n";
$methtml_now.="for(var i=0;i<this.length;i++)\n";
$methtml_now.="this[i+1]=initArray.arguments[i]  }\n";
$methtml_now.="var d=new initArray(\n";
$methtml_now.="' ".$lang_sunday."',\n";
$methtml_now.="' ".$lang_monday."',\n";
$methtml_now.="' ".$lang_tuesday."',\n";
$methtml_now.="' ".$lang_wednesday."',\n";
$methtml_now.="' ".$lang_thursday."',\n";
$methtml_now.="' ".$lang_friday."',\n";
$methtml_now.="' ".$lang_saturday."');\n";
$methtml_now.="document.write(\n";
$methtml_now.="'',\n";
$methtml_now.="today.getFullYear(),'".$lang_year."',\n";
$methtml_now.="today.getMonth()+1,'".$lang_month."',\n";
$methtml_now.="today.getDate(),'".$lang_day."',\n";
$methtml_now.="d[today.getDay()+1],\n";
$methtml_now.="''); \n";
$methtml_now.="</script>\n";

//set home page
$methtml_sethome="<a href='#' onclick='SetHome(this,window.location);' style='cursor:pointer;' title='".$lang_sethomepage."'  >".$lang_sethomepage."</a>";

//bookmark
$methtml_addfavorite="<a href='#' onclick='addFavorite();' style='cursor:pointer;' title='".$lang_bookmark."'  >".$lang_bookmark."</a>";


//language switch
function methtml_lang($label,$type=1){
global $lang,$lang_chchinese,$met_ch_mark,$met_ch_lang,$met_langok,$met_url,$index_url,$met_index_url,$met_lang_mark;
if($met_lang_mark){
switch($type){
case 1:
$metinfo='';
foreach($met_langok as $key=>$val){
$urlnew=$val[newwindows]?"target='_blank'":"";
if($val[useok] and $val[mark]!=$lang)$metinfo.="<a href='".$met_index_url[$val[mark]]."' title='$val[name]' $urlnew >".$val[name]."</a>".$label;
}
if($met_ch_lang and $lang==$met_ch_mark){
$metinfo="<a class=fontswitch id=StranLink href=\"javascript:StranBody()\">".$lang_chchinese."</a><script src=\"".$met_url."js/ch.js\" type=\"text/javascript\"></script>".$label.$metinfo;
}
break;
case 2:
$metinfo='';
foreach($met_langok as $key=>$val){
$urlnew=$val[newwindows]?"target='_blank'":"";
if($val[useok] and $val[mark]!=$lang)$metinfo.="<a href='".$met_index_url[$val[mark]]."' title='$val[name]' $urlnew ><img src='$val[flag]' border='0' /></a>".$label;
}
if($met_ch_lang and $lang==$met_ch_mark){
$metinfo="<a class=fontswitch id=StranLink href=\"javascript:StranBody()\"><img src='".$met_langok[$met_ch_mark][flag]."' border='0' /></a><script src=\"".$met_url."js/ch.js\" type=\"text/javascript\"></script>".$label.$metinfo;
}
break;
}
$labellen=strlen($label);
$metinfo=$labellen?substr($metinfo, 0, -$labellen):$metinfo;
return $metinfo;
}
}

//top nav
function methtml_topnav($type,$label,$max=100,$maxclass2=100,$classtitlemax=100,$homeclass=1,$homeok=1){
global $index_url,$lang_home,$nav_list,$lang,$classnow,$class1,$class_list,$class_index,$nav_list2;
switch($type){
case 1:
$metinfo="";
if($homeok)$metinfo.="<a id='nav_10001' href='".$index_url."'>".$lang_home."</a>".$label;
$i=$homeok;
foreach($nav_list as $key=>$val){
$i++;
$metinfo.="<a id='nav_".$val[id]."' href='".$val[url]."' ".$val[new_windows]." title='".$val[name]."'>".$val[name]."</a>".$label;
if($i>=$max)break;
}
$labellen=strlen($label);
$metinfo=$labellen?substr($metinfo, 0, -$labellen):$metinfo;
return $metinfo;
break;

case 2:
if($class_list[$classnow][nav]==1 or $class_list[$classnow][nav]==3 or $classnow==10001){
    $navdown=$classnow;
  }else{
    $navdown=($class_list[$class1][nav]==1 or $class_list[$class1][nav]==3 )?$class1:'10001';
  }
$metinfo="<SCRIPT language=JavaScript type=text/JavaScript>\n";
$metinfo.="function topnavMouseOver(param1)\n";
$metinfo.="    {\n";
$metinfo.="     var param2='".$navdown."' \n";
$metinfo.="     document.getElementById('nav_'+param1).className='navdown';\n";
$metinfo.="		document.getElementById('nav_'+param2).className='navup';\n";
$metinfo.="    }	\n";
$metinfo.="	    function topnavMouseOut(param3)\n";
$metinfo.="    {   \n";
$metinfo.="     var param4='".$navdown."' \n";
$metinfo.="     document.getElementById('nav_'+param3).className='navup';\n";
$metinfo.="		document.getElementById('nav_'+param4).className='navdown';\n";
$metinfo.="    }\n";
$metinfo.="</SCRIPT>\n";
$metinfo.="<ul>\n";
if($homeok)$metinfo.="<li class='navdown' id='nav_10001'><a href='".$index_url."' onMouseOver=topnavMouseOver('10001') onMouseOut=topnavMouseOut('10001') >".$lang_home."</a></li>".$label."\n";
$i=$homeok;
foreach($nav_list as $key=>$val){
$i++;
$metinfo.="<li class='navup' id='nav_".$val[id]."'><a href='".$val[url]."' ".$val[new_windows]." title='".$val[name]."' onMouseOver=topnavMouseOver('".$val[id]."') onMouseOut=topnavMouseOut('".$val[id]."')>".$val[name]."</a></li>".$label."\n";
if($i>=$max)break;
}
$metinfo.="<div style='clear:both;'></div>\n";
$metinfo.="</ul>\n";
$metinfo.="<SCRIPT language=JavaScript type=text/JavaScript>\n";
$metinfo.="     document.getElementById('nav_10001').className='navup';\n";
$metinfo.="   	document.getElementById('nav_'+".$navdown.").className='navdown';\n";
$metinfo.="</SCRIPT>\n";
return $metinfo;
break;

case 3:
if($homeok)$metinfo.="<div class='nav1'><a href='".$index_url."'  id='nav_10001'>".$lang_home."</a></div>".$label."\n";
$i=$homeok;
foreach($nav_list as $key=>$val){
$i++;
$metinfo.="<div class='nav1'  onmouseover=topnavMouseOver('".$val[id]."'); onMouseOut=topnavMouseOut('".$val[id]."');><a href='".$val[url]."' ".$val[new_windows]." title='".$val[name]."' id='nav_".$val[id]."'>".$val[name]."</a>\n";
$metinfo.="<div class='nav2' style='display:none' id='nav2_".$val[id]."' >\n";
$j=0;
foreach($nav_list2[$val[id]] as $key=>$val2){
$j++;
$val2[name]=utf8substr($val2[name], 0, $classtitlemax); 
$metinfo.="		<li><a href='".$val2[url]."' ".$val2[new_windows]." title='".$val2[name]."'>".$val2[name]."</a></li>\n";
if($j>=$maxclass2)break;
} 
$metinfo.="</div>\n";	
$metinfo.="</div>".$label."\n";		 
if($i>=$max)break;
}
if($class_list[$classnow][nav]==1 or $class_list[$classnow][nav]==3 or $classnow==10001){
    $navdown=$classnow;
  }else{
    $navdown=($class_list[$class1][nav]==1 or $class_list[$class1][nav]==3 )?$class1:'10001';
  }
$metinfo.="<SCRIPT language=JavaScript type=text/JavaScript>\n";
$metinfo.="     document.getElementById('nav_".$navdown."').className='navdown';\n";
$metinfo.="		function topnavMouseOver(id){document.getElementById('nav2_'+id).style.display = ''; }\n";
$metinfo.="		function topnavMouseOut(id){document.getElementById('nav2_'+id).style.display = 'none';	 }\n";
$metinfo.="</script>	\n";	
$metinfo.="<div style='clear:both;'></div>\n";
return $metinfo;
break;

case 4:
$metinfo.="<ul>\n";
if($homeok)$metinfo.="<li class='navl' id='nav_10001' onMouseOver=topnavMouseOver('10001') ><a class='' href='".$index_url."'  title='".$lang_home."' id='navq_10001'><span>".$lang_home."</span></a></li>".$label."\n";
$i=$homeok;
foreach($nav_list as $key=>$val){
$i++;
$metinfo.="<li class='navl'  id='nav_".$val[id]."' onMouseOver=topnavMouseOver('".$val[id]."') ><a class='' href='".$val[url]."' ".$val[new_windows]." title='".$val[name]."' id='navq_".$val[id]."'><span>".$val[name]."</span></a></li>".$label."\n";
if($i>=$max)break;
}
$metinfo.="<div style='clear:both;'></div>\n";
$metinfo.="</ul>\n";
if($homeok){
$metinfo.="<ul class='nav2' id='nav2_10001' style='display:none;' >\n";
$i=0;
foreach($nav_list2[$class_index[$homeclass][id]] as $key=>$val){
$i++;
$metinfo.="<li><a href='".$val[url]."' target='_blank' title='".$val[name]."'><span>".$val[name]."</span></a></li>\n";
if($i>=$maxclass2)break;
}
$metinfo.="</ul>\n";
}
$i=0;
foreach($nav_list as $key=>$val){
$i++;
$metinfo.="<ul id='nav2_".$val[id]."' class='nav2' style='display:none;' >\n";
$d=0;
foreach($nav_list2[$val[id]] as $key=>$val2){
$val2[name]=utf8substr($val2[name], 0, $classtitlemax); 
$d++;
$metinfo.="<li><a href='".$val2[url]."' ".$val2[new_windows]." title='".$val2[name]."'><span>".$val2[name]."</span></a></li>\n";
if($d>=$maxclass2)break;
}		 
$metinfo.="</ul>\n";
if($i>=$max)break;
}
if($class_list[$classnow][nav]==1 or $class_list[$classnow][nav]==3 or $classnow==10001){
    $navdown=$classnow;
  }else{
    $navdown=($class_list[$class1][nav]==1 or $class_list[$class1][nav]==3 )?$class1:'10001';
  }
$metinfo.="<script language=JavaScript type=text/JavaScript>\n";
$metinfo.="document.getElementById('navq_'+'".$navdown."').className='navdown';\n";
$metinfo.="document.getElementById('nav2_'+'".$navdown."').style.display = 'block';\n";
$metinfo.="var navcount;\n";
$metinfo.="subnav = new Array();\n";
if($homeok)$metinfo.="subnav[0] ='10001';\n";
$m=$homeok;
foreach($nav_list as $key=>$val){
$metinfo.="subnav[".$m."] = '".$val[id]."';\n";
$m++;
}
$metinfo.="navcount=".$m.";\n";
$metinfo.="function topnavMouseOver(ao){\n";
$metinfo.="      for(j=0;j<=navcount;j++){\n";
$metinfo.="			  if(ao==subnav[j]){\n";
$metinfo.="		    document.getElementById('nav2_' + subnav[j]).style.display = 'block';\n";
$metinfo.="			document.getElementById('navq_'+ subnav[j]).className='navdown';\n"; 
$metinfo.="			}else{\n";
$metinfo.="			document.getElementById('nav2_' + subnav[j]).style.display = 'none';\n";
$metinfo.="			document.getElementById('navq_'+ subnav[j]).className=''; \n";
$metinfo.="			} \n"; 
$metinfo.="			}\n";
$metinfo.="		   }\n";
$metinfo.="</script>\n";
return $metinfo;
break;
}

}

//foot nav
function methtml_footnav($label){
global $index_url,$lang_home,$navfoot_list,$lang;
$metinfo="";
foreach($navfoot_list as $key=>$val){
$metinfo.="<a href='".$val[url]."' ".$val[new_windows]." title='".$val[name]."'>".$val[name]."</a>".$label;
}
$labellen=strlen($label);
$metinfo=$labellen?substr($metinfo, 0, -$labellen):$metinfo;
return $metinfo;
}

//x nav
$nav_x[name]="<a href=".$class1_info[url]." >".$class1_info[name]."</a>";
if($class2<>0){
$nav_x[name]=$nav_x[name]." > "."<a href=".$class2_info[url]." >".$class2_info[name]."</a>";
}
if($class3<>0){
$nav_x[name]=$nav_x[name]." > "."<a href=".$class3_info[url]." >".$class3_info[name]."</a>";
}
$nav_x[1]=$nav_x[name];
$nav_x[2]="<a href=".$class_list[$classnow][url]." >".$class_list[$classnow][name]."</a>";

//y nav
if($class_list[$class1][module]==100){
foreach($module_list1[3] as $key=>$val){
$navlist_y1.="<li><a href='$val[url]' $val[new_windows] title='$val[name]'>$val[name]</a></li>";
$class_2=$val[id];
foreach($nav_list2[$class_2] as $key=>$val2){
$navlist_y1.="<br />&nbsp;&nbsp;&nbsp;<font style='font-size:12px'><a href='$val2[url]' $val2[new_windows] title='$val2[name]' >-$val2[name]</a></font>";
}
}
}else{
foreach($nav_list2[$class1] as $key=>$val){
$navlist_y1.="<li><a href='$val[url]' $val[new_windows] title='$val[name]'>$val[name]</a></li>";
$class_2=$val[id];
foreach($nav_list3[$class_2] as $key=>$val2){
$navlist_y1.="<br />&nbsp;&nbsp;&nbsp;<font style='font-size:12px'><a href='$val2[url]' $val2[new_windows] title='$val2[name]' >-$val2[name]</a></font>";
}
}
}

function methtml_classlist($type,$namelen,$mark,$class3ok=1,$class3now=1,$class2char=1,$class3char=0){
global $navlist_y1,$class1,$class2,$class3,$classnow,$nav_list2,$nav_list3,$class_index,$module_list1,$class_list;
  switch($type){
  default:
  $metinfo=$navlist_y1;
  break;
  
  case 1:
    $metinfo='';
    $metinfo.="<ul>\n";
  if(intval($mark))$class1=$class_index[$mark][id];
  $nav2=$nav_list2[$class1];
  if($class_list[$class1][module]==100)$nav2=$module_list1[3];
  if($class_list[$class1][module]==101)$nav2=$module_list1[5];
  foreach($nav2 as $key=>$val){
    $val[name]=intval($namelen)?utf8substr($val[name], 0, $namelen):$val[name]; 
	$metinfo.="<li class='li_class2' id='product".$val[id]."' ";
	if($class3ok)$metinfo.="onmousedown='met_showhide1".$mark."(".$val[id].")'";
	$metinfo.="><a href='".$val[url]."' >".$val[name]."</a></li>\n";
	if($class3ok){
	if($class3now){
	  $metinfo.="<span id='".$val[id]."' style='display:none;' class='span_class3'>\n";
	 }else{
	  $metinfo.="<span id='".$val[id]."' class='span_class3'>\n";
	 }
	$nav3=$nav_list3[$val[id]];
	if($class_list[$class1][module]==100 or $class_list[$class1][module]==101)$nav3=$nav_list2[$val[id]];
  foreach($nav3 as $key=>$val1){
    $val1[name]=intval($namelen)?utf8substr($val1[name], 0, $namelen):$val1[name];
    $metinfo.="<li class='li_class3' id='product".$val1[id]."' ><a href='".$val1[url]."'>".$val1[name]."</a></li>\n";
   }
    $metinfo.="</span>\n";
   }}
    $metinfo.="</ul>\n";
    $metinfo.="<script type='text/javascript'>\n";
  if($class3ok){
    $metinfo.="function met_showhide1".$mark."(d)\n";
    $metinfo.="{  \n";     
    $metinfo.="var d1=document.getElementById(d);\n";
    $metinfo.="if(d1.style.display=='none')\n";
    $metinfo.="{ d1.style.display='block';\n";
    $metinfo.="}else{\n";
    $metinfo.="d1.style.display='none';\n";
    $metinfo.="}\n";
    $metinfo.="}\n";
	}
	if($class2){
	if($class3ok)$metinfo.="document.getElementById('".$class2."').style.display='block';\n";
	if($class2char)$metinfo.="document.getElementById('product".$class2."').className='classnow';\n";
	if($class3 and $class3ok and $class3char)$metinfo.="document.getElementById('product".$class3."').className='classnow3';\n";
	}
    $metinfo.="</script>\n";

  break;
   }
  return $metinfo;
}
//Flashimg
function methtml_flashimg($type,$width,$height,$imgurl,$imglink,$imgtitle){
global $met_flasharray,$classnow,$met_url,$met_flash_img,$met_flash_imglink,$met_flash_imgtitle;
if($width=='')$width=$met_flasharray[$classnow][x];
if($height=='')$height=$met_flasharray[$classnow][y];
if($imgurl=='')$imgurl=$met_flash_img;
if($imglink=='')$imglink=$met_flash_imglink;
if($imgtitle=='')$imgtitle=$met_flash_imgtitle;
switch($type){
case 1:
   $methtml_flash.="<script type=\"text/javascript\">\n";
   $methtml_flash.="var pic_width=".$width.";\n";
   $methtml_flash.="var pic_height=".$height.";\n";
   $methtml_flash.="var text_height=0;\n";
   $methtml_flash.="var swfpath = '".$met_url."'+'flash/flash01.swf';\n";
   $methtml_flash.="var pics='".$imgurl."';\n";
   $methtml_flash.="var links='".$imglink."';\n";
   $methtml_flash.="var texts='';\n";
   $methtml_flash.="document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\"";
   $methtml_flash.="codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ pic_width +'\" height=\"'+ pic_height +'\">');\n";
   $methtml_flash.="document.write('<param name=\"allowScriptAccess\" value=\"sameDomain\"><param name=\"movie\" value=\"'+swfpath+'\"><param name=\"quality\" value=\"high\"><param name=\"bgcolor\" value=\"#ffffff\">');\n";
   $methtml_flash.="document.write('<param name=\"menu\" value=\"false\"><param name=wmode value=\"opaque\">');\n";
   $methtml_flash.="document.write('<param name=\"FlashVars\" value=\"pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+pic_width+'&borderheight='+pic_height+'&textheight='+text_height+'\">');\n";
   $methtml_flash.="document.write('<embed src=\"'+swfpath+'\" wmode=\"opaque\" FlashVars=\"pics='+pics+'&links='+links+'&texts='+texts+'&borderwidth='+pic_width+'&borderheight='+pic_height+'&textheight='+text_height+'\" menu=\"false\" bgcolor=\"#ffffff\" quality=\"high\" width=\"'+ pic_width +'\" height=\"'+ pic_height +'\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />');document.write('</object>');\n";
   $methtml_flash.="</script>\n";
break;

case 2:
   $methtml_flash.="<script type=\"text/javascript\">\n";
   $methtml_flash.="var swf_width=".$width.";\n";
   $methtml_flash.="var swf_height=".$height.";\n";
   $methtml_flash.="var files='".$imgurl."';\n";
   $methtml_flash.="var links='".$imglink."';\n";
   $methtml_flash.="var texts='';\n";
   $methtml_flash.="var swfpath = '".$met_url."'+'flash/flash02.swf';\n";
   $methtml_flash.="var AutoPlayTime=6; //间隔时间：单位是秒\n";
   $methtml_flash.="document.write('<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\">');\n";
   $methtml_flash.="document.write('<param name=\"movie\" value='+swfpath+'><param name=\"quality\" value=\"high\">');\n";
   $methtml_flash.="document.write('<param name=\"menu\" value=\"false\"><param name=wmode value=\"opaque\">');\n";
   $methtml_flash.="document.write('<param name=\"FlashVars\" value=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&AutoPlayTime='+AutoPlayTime+'\">');\n";
   $methtml_flash.="document.write('<embed src='+swfpath+' wmode=\"opaque\" FlashVars=\"bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&AutoPlayTime='+AutoPlayTime+'\" menu=\"false\" quality=\"high\" width=\"'+ swf_width +'\" height=\"'+ swf_height +'\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" />'); \n";
   $methtml_flash.="document.write('</object>'); \n";
   $methtml_flash.="</script>\n";
break;

case 3:
   $methtml_flash.="<script src='".$met_url."js/flash3.js' type='text/javascript'></script> \n"; 
   $methtml_flash.="<SCRIPT language=javascript type=text/javascript>\n";
   $methtml_flash.="var titles = '".$imgtitle."';\n";
   $methtml_flash.="var imgs='".$imgurl."'; \n";
   $methtml_flash.="var urls='".$imglink."';\n";
   $methtml_flash.="var pw =".$width.";                //flash宽度\n";
   $methtml_flash.="var ph =".$height.";                //flash高度\n";
   $methtml_flash.="var sizes = 14;              //flash底部文字大小\n";
   $methtml_flash.="var Times = 4000;            //flash图片翻转时间\n";
   $methtml_flash.="var umcolor = 0xFFFFFF;      //flash按钮文字颜色\n";     
   $methtml_flash.="var btnbg =0xFF7E00;         //flash按钮背景颜色（当前图片，鼠标经过）\n";
   $methtml_flash.="var txtcolor =0xFFFFFF;      //flash图片名称 文字颜色\n";
   $methtml_flash.="var txtoutcolor = 0xff0000;\n";
   $methtml_flash.="var flash = new SWFObject('".$met_url."flash/flash03.swf', 'mymovie', pw, ph, '7', '');\n";
   $methtml_flash.="flash.addParam('allowFullScreen', 'true');\n";
   $methtml_flash.="flash.addParam('allowScriptAccess', 'always');\n";
   $methtml_flash.="flash.addParam('quality', 'high');\n";
   $methtml_flash.="flash.addParam('wmode', 'Transparent');\n";
   $methtml_flash.="flash.addVariable('pw', pw);\n";
   $methtml_flash.="flash.addVariable('ph', ph);\n";
   $methtml_flash.="flash.addVariable('sizes', sizes);\n";
   $methtml_flash.="flash.addVariable('umcolor', umcolor);\n";
   $methtml_flash.="flash.addVariable('btnbg', btnbg);\n";
   $methtml_flash.="flash.addVariable('txtcolor', txtcolor);\n";
   $methtml_flash.="flash.addVariable('txtoutcolor', txtoutcolor);\n";
   $methtml_flash.="flash.addVariable('urls', urls);\n";
   $methtml_flash.="flash.addVariable('Times', Times);\n";
   $methtml_flash.="flash.addVariable('titles', titles);\n";
   $methtml_flash.="flash.addVariable('imgs', imgs);\n";
   $methtml_flash.="flash.write('dplayer2');\n";
   $methtml_flash.="</SCRIPT>\n";
break;

case 4:
   $methtml_flash.="<script language='javascript' src='".$met_url."js/flash4.js'></script>\n";
   $methtml_flash.="<script language='javascript'>\n";
   $methtml_flash.="var pics='".$imgurl."';\n";
   $methtml_flash.="var mylinks='".$imglink."';\n";
   $methtml_flash.="var texts='".$imgtitle."';\n";
   $methtml_flash.="var _str='".$met_url."flash/flash04.swf';\n";
   $methtml_flash.="var ivWidth=".$width.";\n";
   $methtml_flash.="var ivHeight=".$height.";\n";
   $methtml_flash.="_str+='?Width='+ivWidth;\n";
   $methtml_flash.="_str+='&Height='+ivHeight;\n";
   $methtml_flash.="_str+='&Titles='+encodeURI(texts);\n";
   $methtml_flash.="_str+='&ImgUrls='+pics;\n";
   $methtml_flash.="_str+='&LinkUrls='+mylinks;\n";
   $methtml_flash.="creatHexunFlashObject(_str,ivWidth,ivHeight);\n";
   $methtml_flash.="</script>\n";
break;

case 5:
   $methtml_flash.="<SCRIPT language=javascript src='".$met_url."js/flash5.js' type=text/javascript></SCRIPT>\n";
   $methtml_flash.="<SCRIPT type=text/javascript>\n";
   $methtml_flash.="var focus_width=".$width.";\n";
   $methtml_flash.="var focus_height=".$height.";\n";
   $methtml_flash.="var text_height=20;\n";
   $methtml_flash.="var swf_height=focus_height + text_height;\n";
   $methtml_flash.="var pics='".$imgurl."';\n";
   $methtml_flash.="var links='".$imglink."';\n";
   $methtml_flash.="var texts='".$imgtitle."';\n";
   $methtml_flash.="var fo = new SWFObject('".$met_url."/flash/flash05.swf', '_FocusObj', focus_width, swf_height, '7','F6F8FA');\n";
   $methtml_flash.="fo.addVariable('pics', pics);\n";
   $methtml_flash.="fo.addVariable('links', links);\n";
   $methtml_flash.="fo.addVariable('texts', texts); \n";
   $methtml_flash.="fo.addVariable('borderwidth', focus_width);\n";
   $methtml_flash.="fo.addVariable('borderheight', focus_height);\n";
   $methtml_flash.="fo.addVariable('textheight', text_height);\n";
   $methtml_flash.="fo.addVariable('border_color', '0x000000'); \n";
   $methtml_flash.="fo.addVariable('fontsize', '14'); \n";
   $methtml_flash.="fo.addVariable('fontcolor', '5d5d5d');\n";
   $methtml_flash.="fo.addVariable('is_border', '');\n";
   $methtml_flash.="fo.addVariable('is_text', '1');\n";
   $methtml_flash.="fo.addParam('wmode', 'opaque');\n";
   $methtml_flash.="fo.write('FocusObj');\n";
   $methtml_flash.="</SCRIPT>\n";
break;

case 6:
   $methtml_flash.="<script src='".$met_url."js/flash7.js' type='text/javascript'></script> \n"; 
   $methtml_flash.="<script type='text/javascript'>\n";	
   $methtml_flash.="var speed = 4000;\n";		
   $methtml_flash.="var pics='".$imgurl."';\n";	
   $methtml_flash.="var mylinks='".$imglink."';\n";
   $methtml_flash.="var texts='".$imgtitle."';\n";			
   $methtml_flash.="var sohuFlash2 = new sohuFlash('".$met_url."flash/flash07.swf','flashcontent01','".$width."','".$height."','8','#ffffff');\n";										
   $methtml_flash.="sohuFlash2.addParam('quality', 'medium');\n";
   $methtml_flash.="sohuFlash2.addParam('wmode', 'opaque');\n";						
   $methtml_flash.="sohuFlash2.addVariable('speed',speed);\n";
   $methtml_flash.="sohuFlash2.addVariable('p',pics);\n";	
   $methtml_flash.="sohuFlash2.addVariable('l',mylinks);\n";
   $methtml_flash.="sohuFlash2.addVariable('icon',texts);\n";
   $methtml_flash.="sohuFlash2.write('flashcontent01');\n";
   $methtml_flash.="</script> \n";
break;

case 7:
   $methtml_flash.="<script src='".$met_url."js/flash9.js' type='text/javascript'></script> \n"; 
   $methtml_flash.="<div id=sasFlashFocus27></div>\n"; 
   $methtml_flash.="<SCRIPT>\n"; 
   $methtml_flash.="var sohuFlash2 = new sohuFlash(\"".$met_url."flash/flash09.swf\", \"27\", ".$width.", ".$height.", \"7\");\n"; 
   $methtml_flash.="sohuFlash2.addParam(\"quality\", \"high\");\n"; 
   $methtml_flash.="sohuFlash2.addParam(\"wmode\", \"opaque\");\n"; 
   $methtml_flash.="sohuFlash2.addVariable(\"image\",\"".$imgurl."\");\n"; 
   $methtml_flash.="sohuFlash2.addVariable(\"url\",\"".$imglink."\");\n";
   $methtml_flash.="sohuFlash2.addVariable(\"info\", \"".$imgtitle."\");\n";
   $methtml_flash.="sohuFlash2.addVariable(\"stopTime\",\"5000\");\n";
   $methtml_flash.="sohuFlash2.write(\"sasFlashFocus27\");\n";
   $methtml_flash.="</SCRIPT>\n";
break;

case 8:
   $methtml_flash.="<SCRIPT src='".$met_url."js/flash8.js' type='text/javascript'></SCRIPT>\n";
   $methtml_flash.="<SCRIPT type=text/javascript>\n";
   $methtml_flash.="var pics='".$imgurl."';\n";	
   $methtml_flash.="var mylinks='".$imglink."';\n";
   $methtml_flash.="var texts='".$imgtitle."';\n";
   $methtml_flash.="var sohuFlash2 = new sohuFlash('".$met_url."flash/flash08.swf','sohuFlashID01','".$width."','".$height."','5','#ffffff');\n";
   $methtml_flash.="sohuFlash2.addParam('quality', 'high');\n";
   $methtml_flash.="sohuFlash2.addParam('salign', 't');\n";
   $methtml_flash.="sohuFlash2.addParam('wmode','transparent');\n";
   $methtml_flash.="sohuFlash2.addVariable('p',pics);	\n";
   $methtml_flash.="sohuFlash2.addVariable('l',mylinks);\n";
   $methtml_flash.="sohuFlash2.addVariable('icon',texts);\n";
   $methtml_flash.="sohuFlash2.write('flashcontent01');\n";
   $methtml_flash.="</SCRIPT>\n";
break;

case 9:
   $methtml_flash.="<div id=met3dswf align='center'></div>\n";
   $methtml_flash.="<script language=JavaScript src='".$met_url."js/flash09.js'></script>\n";
   $methtml_flash.="<script language='javascript'>\n";
   $imgurlarray=explode('|',$imgurl);
   $imglinkarray=explode('|',$imglink);
   $imgtitlearray=explode('|',$imgtitle);
   $totalurl=count($imgurlarray);
   if($totalurl>4){
   $imgurl='';
   $imglink='';
   $imgtitle='';
   for($i=0;$i<$totalurl;$i++){
    $imgurl.=$i?"|".$imgurlarray[$i]:$imgurlarray[$i];
	if(($i==3&&$totalurl!==4) or ($i==7&&$totalurl!==8))$imgurl.="|_";
	$imglink.=$i?"|".$imglinkarray[$i]:$imglinkarray[$i];
	if(($i==3&&$totalurl!==4) or ($i==7&&$totalurl!==8))$imglink.="|_";
	$imgtitle.=$i?"|".$imgtitlearray[$i]:$imgtitlearray[$i];
	if(($i==3&&$totalurl!==4) or ($i==7&&$totalurl!==8))$imgtitle.="|_";
    }
	}
   $methtml_flash.="var pics='".$imgurl."'\n";
   $methtml_flash.="var links='".$imglink."'\n"; 	
   $methtml_flash.="var texts='".$imgtitle."'\n";	
   $methtml_flash.="var sohuFlash2 = new sohuFlash('".$met_url."flash/flash9.swf','sohuFlashID01','".$width."','".$height."','6','#ffffff');\n";
   $methtml_flash.="sohuFlash2.addParam('quality', 'high');\n";
   $methtml_flash.="sohuFlash2.addParam('salign', 't');\n";
   $methtml_flash.="sohuFlash2.addParam('wmode', 'opaque');\n";
   $methtml_flash.="sohuFlash2.addVariable('pics',pics);\n";
   $methtml_flash.="sohuFlash2.addVariable('links',links);\n";
   $methtml_flash.="sohuFlash2.addVariable('texts',texts);\n";
   $methtml_flash.="sohuFlash2.write('met3dswf')\n";
   $methtml_flash.="</script>\n";
break;
}

return $methtml_flash;
}

//Flash
$methtml_flash="";
switch($met_flasharray[$classnow][type]){
case 0:
$methtml_flash="";
break;


case 1:
  switch($met_flasharray[$classnow][imgtype]){
  case 1:
   $methtml_flash.="<div class=\"flash\">\n";
   $methtml_flash.=methtml_flashimg(1);
   $methtml_flash.="</div>";
  break;
  
  case 2:
   $methtml_flash.="<div class=\"flash\">\n";
   $methtml_flash.=methtml_flashimg(2);  
   $methtml_flash.="</div>";
  break;
  
 case 3:
   $methtml_flash.="<div class=\"flash\" id='dplayer2'>\n";
   $methtml_flash.=methtml_flashimg(3);
   $methtml_flash.="</div>\n";
 break;
 
 case 4:
   $methtml_flash.="<div class='flash' >\n";
   $methtml_flash.=methtml_flashimg(4);   
   $methtml_flash.="</div>\n";
 break;
 
 case 5:
   $methtml_flash.="<div class='flash' id=FocusObj></div>\n";
   $methtml_flash.=methtml_flashimg(5);
 break;
 
 case 6:
   $methtml_flash.="<style type='text/css'>\n";
   $methtml_flash.=".tab_btn_num{position:absolute; right:10px; bottom:5px;}\n";
   $methtml_flash.=".tab_btn_num li{width:15px; height:15px; background:#00CC33; overflow:hidden; color:#fff; filter:alpha(opacity=80); opacity:0.8; float:left;cursor:default; font-size:12px; line-height:15px; margin:0px 5px; font-family:Arial; text-align:center;}\n";
   $methtml_flash.=".tab_btn_num li img{vertical-align:bottom; border:0px; margin:0px;}\n";
   $methtml_flash.=".tab_btn_num li.hot{background:#FFCC00; color:#993300; }\n";
   $methtml_flash.=".flash_content{width:100%; height:100%; overflow:hidden; text-align:left; }\n";
   $methtml_flash.="</style>\n";
   $methtml_flash.="<div class='flash' style='position:relative; height:".$met_flasharray[$classnow][y]."px; width:".$met_flasharray[$classnow][x]."px;'>\n";
   $methtml_flash.="<ul class='tab_btn_num' id='myTab_btns2'>";
   $i=0;
   foreach($met_flashimg as $key=>$val){ 
   $i++;
   if($i==1){
     $methtml_flash.="<li class='hot'>".$i."</li>";
    }else{
     $methtml_flash.="<li>".$i."</li>";
    }
	}
   $methtml_flash.="</ul>\n";
   $methtml_flash.="<div class='flash_content' id='main2'>\n";
   $methtml_flash.="<ul>\n";
   foreach($met_flashimg as $key=>$val){  
   $methtml_flash.="<li style='width:".$met_flasharray[$classnow][x]."px; height:".$met_flasharray[$classnow][y]."px;'><a href='".$val[img_link]."' target='_blank'>\n";
   $methtml_flash.="<img src='".$val[img_path]."' alt='".$val[img_title]."'></a></li>\n"; 
   }
   $methtml_flash.="</ul>\n";
   $methtml_flash.="</div>\n";
   $methtml_flash.="</div>\n";
   $methtml_flash.="<SCRIPT language=javascript type=text/javascript>
var Ex=function (o){for(var k in o)this[k]=o[k];return this}
var UI=function (id){return document.getElementById(id)}
var UIs=function (tag){return Ex.call([],this.getElementsByTagName(tag))}
var Each=function (a,fn){for(var i=0;i<a.length;i++)fn.call(a[i],i,a)}
var dhooo=function (ini){
this.bind(ini,this);
this.autoIndex=0;
};
Ex.call(dhooo.prototype,{
bind:function (ini,me){
var dir=ini.dir=='top'?'scrollTop':'scrollLeft',pan=UI(ini.contentID);
var start=function (o){
Each(ini.btns,function(){this.className=''});
o.className=ini.className;
me.autoIndex=o.index;
me.begin(o.index,pan,ini.len,dir);
};
pan.onmouseover=function (){me.stop=true};
Each(ini.btns,function (i){
this.index=i;
this.onmouseover=function (){me.stop=true;start(this)};
pan.onmouseout=this.onmouseout=function(){me.stop=false}
});
var auto=function(){
if(!me.stop){
me.autoIndex=me.autoIndex==".($i-1)."?0:++me.autoIndex;
start(ini.btns[me.autoIndex]);
}
};
if(ini.auto)this.autoPlay=window.setInterval(auto,2500);
}
,begin:function (i,o,len,dir){
(function (me){
clearInterval(me.only);
me.only=setInterval(function (){
var diff=(i*len-o[dir])*0.1;
o[dir]+=Math[diff>0?'ceil':'floor'](diff);
if(diff==0)clearInterval(me.only);
},10)
})(this)
}
})

new dhooo({
btns:UIs.call(UI('myTab_btns2'),'LI')
,className:'hot'
,contentID:'main2'
,len:".$met_flasharray[$classnow][y]."
,dir:'top'
,auto:true
});   
  
   </SCRIPT>\n";
 break;
 
 case 7:
   $methtml_flash.="<div id='flashcontent01' class='flash'></div>\n";
   $methtml_flash.=methtml_flashimg(6);
 break;
 
 case 8:
   $methtml_flash.="<div class='flash'>\n"; 
   $methtml_flash.=methtml_flashimg(7);
   $methtml_flash.="</div>\n";
 break;
 
  }
  
  
break;

case 2:
if($met_flash_url<>''){
$methtml_flash.="<div class=\"flash\" style=\"background-image: url(".$met_flash_back."); width:".$met_flash_x."px; height:".$met_flash_y."px;\">\n";
$methtml_flash.="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"".$met_flash_x."\" height=\"".$met_flash_y."\">\n";
$methtml_flash.="            <param name=\"movie\" value=\"".$met_flash_url."\">\n";
$methtml_flash.="            <param name=\"quality\" value=\"high\">\n";
$methtml_flash.="            <param name=\"wmode\" value=\"transparent\" />\n";
$methtml_flash.="		 <embed src=\"".$met_flash_url."\" width=\"".$met_flash_x."\" height=\"".$met_flash_y."\" quality=\"high\" wmode=\"transparent\"\n";
$methtml_flash.="pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>\n";
$methtml_flash.="</object>\n";
$methtml_flash.="</div>";
}
break;

case 3:
if($flash_imgone_img<>''){
$methtml_flash.="<div class=\"flash\">\n";
$methtml_flash.="<a href='$flash_imgone_url' target='_blank'><img src='".$flash_imgone_img."' width='".$met_flasharray[$classnow][x]."' alt='$flash_imgone_title' height='".$met_flasharray[$classnow][y]."'></a>\n";
$methtml_flash.="</div>";
}
break;
}

//loop array 
function methtml_getarray($mark,$type,$order,$module){
global $listall,$listcom,$listnew,$listimg,$classlistall,$classlistcom,$classlistnew,$classlistimg,$hitslistall,$hitslistcom,$hitslistnew,$hitslistimg,$hitsclasslistall,$hitsclasslistcom,$hitsclasslistnew,$hitsclasslistimg,$class_index;
if(intval($mark)<>0){
$listnowid=$class_index[$mark][id];
$listnowmodule=methtml_module($class_index[$mark][module]);
 if($order=='hits'){
   switch($type){
   default:
   $listnow=$hitsclasslistall[$listnowmodule][$listnowid];
   break;
   case 'com':
   $listnow=$hitsclasslistcom[$listnowmodule][$listnowid];
   break;
   case 'new':
   $listnow=$hitsclasslistnew[$listnowmodule][$listnowid];
   break;
   case 'img':
   $listnow=$hitsclasslistimg[$listnowmodule][$listnowid];
   break;
   }
 }else{
   switch($type){
   default:
   $listnow=$classlistall[$listnowmodule][$listnowid];
   break;
   case 'com':
   $listnow=$classlistcom[$listnowmodule][$listnowid];
   break;
   case 'new':
   $listnow=$classlistnew[$listnowmodule][$listnowid];
   break;
   case 'img':
   $listnow=$classlistimg[$listnowmodule][$listnowid];
   break;
   }
  }
}elseif($module<>''){
  if($order=='hits'){
   switch($type){
   default:
   $listnow=$hitslistall[$module];
   break;
   case 'com':
   $listnow=$hitslistcom[$module];
   break;
   case 'new':
   $listnow=$hitslistnew[$module];
   break;
   case 'img':
   $listnow=$hitslistimg[$module];
   break;
   }
 }else{
   switch($type){
   default:
   $listnow=$listall[$module];
   break;
   case 'com':
   $listnow=$listcom[$module];
   break;
   case 'new':
   $listnow=$listnew[$module];
   break;
   case 'img':
   $listnow=$listimg[$module];
   break;
   }
  }
}else{
 $listnow=$listall[news];
 }
return $listnow;
}

//array info
function methtml_module($module){
  switch($module){
  case 2:
  return 'news';
  break;
  
  case 3:
  return 'product';
  break;
  
  case 4:
  return 'download';
  break;
  
  case 5:
  return 'img';
  break;
  }
}

//list display
function methtml_list($listtype,$mark,$type,$order,$module,$titlenum,$color,$max,$newwindow=1,$classname=1,$time=1,$news=1,$hot=1,$top=1,$hits=0,$description,$deslen){
global $listall,$listcom,$listnew,$listimg,$classlistall,$classlistcom,$classlistnew,$classlistimg,$hitslistall,$hitslistcom,$hitslistnew,$hitslistimg,$hitsclasslistall,$hitsclasslistcom,$hitsclasslistnew,$hitsclasslistimg,$class_index,$index;
global $met_img_x,$met_img_y;
$listarray=methtml_getarray($mark,$type,$order,$module);
 $i=0;
 $listtext.="<ul>\n";
 foreach($listarray as $key=>$val){
 $i++;
 if(intval($titlenum)<>0)$val[title]=utf8substr($val[title], 0, $titlenum); 
 if($i==1)$firsttitle=$color;
 $listtext.="<li>";
if($listtype=='img'){
 $listtext.="<span class='info_img'><a href='".$val[url]."'";
 if($newwindow==1)$listtext.=" target='_blank' ";
 $listtext.=" ><img src=".$val[imgurls]." alt='".$val[title]."' width=".$met_img_x." height=".$met_img_y." /></a></span>";
 if($classname==2)$listtext.="<span class='info_class'>[<a href='".$val[class3_url]."' title='".$val[class3_name]."' >".$val[class3_name]."</a>]</span>";
 $listtext.="<span class='info_title'><a href='".$val[url]."'";
 if($newwindow==1)$listtext.=" target='_blank' ";
 if($i==1)$listtext.="style='color:".$firsttitle.";'";
 $listtext.="  title='".$val[title]."' >".$val[title]."</a></span>";
 if($description==1){
 $listtext.="<span class='info_discription'><a href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 if(intval($deslen))$val[description]=utf8substr($val[title], 0, $deslen); 
 $listtext.="  title='".$val[title]."' >".$val[description]."</a></span>";
  }
}else{
 if($classname==1)$listtext.="<span class='info_class'>[<a href='".$val[class3_url]."' title='".$val[class3_name]."' >".$val[class3_name]."</a>]</span>";
 $listtext.="<span class='info_title'><a  href=".$val[url];
 if($newwindow==1)$listtext.=" target='_blank' ";
 if($i==1)$listtext.=" style='color:".$firsttitle.";'";
 $listtext.=" title='".$val[title]."' >".$val[title]."</a></span>";
 if($hits==1)$listtext.="<span class='info_hits'>[<font>".$val[hits]."</font>]</span>";
 if($top==1)$listtext.=$val[top];
 if($news==1)$listtext.=$val[news];
 if($hot==1)$listtext.=$val[hot];
 if($time==1)$listtext.="<span class='info_updatetime'>".$val[updatetime]."</span>";
}
 $listtext.="</li>\n";
 $maxmodule=($module=='')?methtml_module($class_index[$mark][module]):$module;
 $maxmodule=$maxmodule."_no";
 if(intval($max)==0)$max=$index[$maxmodule];
 if($i>=$max)break;
 }
 $listtext.="</ul>";
 return $listtext;
}

function methtm_link($listtype='text',$type,$display,$max,$linkpage){
global $link_text_com,$link_text,$link_img_com,$link_img,$link,$link_com,$index,$lang_FriendlyLink;
if($index[link_ok]==1 || $linkpage){
  $index[link_img]=$max==""?$index[link_img]:$max;
  $index[link_text]=$max==""?$index[link_text]:$max;
  $linktext="<ul>\n";
  if($display=='select')$linktext="<select name='link' onchange=javascript:window.open(this.options[this.selectedIndex].value) >\n<option >".$lang_FriendlyLink."</option>\n";
  if($listtype=='img'){
     $linkarray=($type=='com')?$link_img_com:$link_img;
     $i=0;
     foreach($linkarray as $key=>$val){
      $i++;
      $linktext.="<li><a href='".$val[weburl]."' target='_blank'><img src='".$val[weblogo]."' alt='".$val[webname]."' /></a></li>\n";
	  if($i>=$index[link_img])break;
	  }
   }else{
     $linkarray=($type=='com')?$link_text_com:$link_text;
	 $i=0;
     foreach($linkarray as $key=>$val){
      $i++;
	  if($display=='select'){
	    $linktext.="<option value='".$val[weburl]."' >".$val[webname]."</option>\n";
	    }else{
        $linktext.="<li><a href='".$val[weburl]."' target='_blank' title='".$val[info]."'>".$val[webname]."</a></li>\n";
		}
	  if($i>=$index[link_text])break;
	  }
     }
  $linktext.=($display=='select')?"</select>":"</ul>\n";
}else{
  $linktext='';
}
return $linktext;
}

//foot info
$methtml_foot="<ul>\n";
if($met_footright<>"" or $met_footstat<>"")$methtml_foot.="<li>".$met_footright." ".$met_footstat."</li>\n";
if($met_footaddress<>"")$methtml_foot.="<li>".$met_footaddress."</li>\n";
if($met_foottel<>"")$methtml_foot.="<li>".$met_foottel."</li>\n";
if($met_footother<>"")$methtml_foot.="<li>".$met_footother."</li>\n";
if($met_foottext<>"")$methtml_foot.="<li>".$met_foottext."</li>\n";
$methtml_foot.="</ul>\n";

//online
function methtml_online(){
global $met_online_type,$online_list,$qq_list,$msn_list,$taobao_list,$alibaba_list,$skype_list,$met_url,$lang_Close;
global $met_qq_type,$met_msn_typ,$met_taobao_type,$met_msn_type,$met_alibaba_type,$met_skype_type,$lang_Online,$met_onlinetel,$met_online_skin,$met_online_color;
global $met_onlineleft_left,$met_onlineleft_top,$met_onlineright_right,$met_onlineright_top,$met_onlinenameok;
$cssonlinealign=$met_onlinenameok?"center":"left";
if($met_online_type==1 or $met_online_type==2){
 switch($met_online_skin){
  case 1:
  case 3:
  $qqcolor[1]='#025f9d';
  $qqcolor[2]='#a4381f';
  $qqcolor[3]='#21198F';
  $qqcolor[4]='#048720';
  $qqcolor[5]='#666666';
  $qqwidth=($met_online_skin==1)?'112':'130';
  $metinfocss.="<style type=\"text/css\">\n";
  $metinfocss.=".floatonline_1{ padding:1px; width:".$qqwidth."px; }\n";
  $metinfocss.=".scroll_title_1{font-weight:bold; padding-top:12px; text-align:left; color:".$qqcolor[$met_online_color]."; background:url(".$met_url."images/qq/online".$met_online_skin."_1_".$met_online_color.".gif) no-repeat 0px 0px; height:22px; padding-left:12px; }\n";
  $metinfocss.=".scroll_title_1{ position:relative;}\n";
  $metinfocss.=".scroll_title_1 a{ display:block; position:absolute; right:10px; top:10px; height:15px; width:20px;}\n";
  $metinfocss.=".scroll_title_1 a:hover{ text-decoration:none !important; cursor:pointer;}\n";
  $metinfocss.=".scroll_qq_1{padding:5px 10px 0px 10px; text-align:".$cssonlinealign."; font-weight:bold; color:#333333; }\n";
  $metinfocss.=".scroll_qq_1 img{padding:5px 0px 0px 0px;}\n";
  $metinfocss.=".scroll_skype_1{ padding:5px 0px 5px 0px; text-align:center;}\n";
  $metinfocss.=".scroll_alibaba_1{ padding:5px 0px 5px 0px; text-align:center;}\n";
  $metinfocss.=".online_left_1{ background:url(".$met_url."images/qq/online".$met_online_skin."_3_".$met_online_color.".gif) no-repeat 0px 0px; width:".$qqwidth."px;}\n";
  $metinfocss.=".online_right_1{ background: #FFFFFF url(".$met_url."images/qq/online".$met_online_skin."_5_".$met_online_color.".gif) no-repeat  right top;}\n";
  $metinfocss.=".scroll_foot1_1{ height:14px; font-size:0px; background:url(".$met_url."images/qq/online".$met_online_skin."_4_".$met_online_color.".gif) no-repeat 0px 0px;}\n";
  $metinfocss.=".scroll_foot2_1{ height:auto; text-align:center; min-height:18px;   line-height:18px; background:url(".$met_url."images/qq/online".$met_online_skin."_6_".$met_online_color.".gif) repeat-y 0px 0px;}\n";
  $metinfocss.=".scroll_foot3_1{ height:8px; font-size:0px; background:url(".$met_url."images/qq/online".$met_online_skin."_7_".$met_online_color.".gif) no-repeat 0px 0px;}\n";
  $metinfocss.="</style>\n";
  
  $metinfofloat.="<div class='scroll_title_1'><span>".$lang_Online."</span><a href='#' title='".$lang_Close."' onmousedown='Mouseclose()'>&nbsp;</a></div>\n";
  $metinfofloat.="<div class='online_right_1'>\n";
  $metinfofloat.="<div class='online_left_1'>\n";
 foreach($online_list as $key=>$val){
  $metinfofloat.="<div class='scroll_qq_1'>";
  if(!$met_onlinenameok)$metinfofloat.=$val[name];
  $metinfofloat.="\n";
  if($val[qq]!=""){
  if(strlen($val[qq])<30){
  $metinfofloat.="<a href='tencent://message/?uin=".$val[qq]."&Site=&Menu=yes'  title='QQ".$val[name]."' style='text-decoration:none;'>
<img border='0' SRC='http://wpa.qq.com/pa?p=1:".$val[qq].":".$met_qq_type."'></a>\n";
}else{
   if($met_qq_type){
        $qq1a=explode('http://wpa.qq.com/pa',$val[qq]);
		$qq2a=explode(':',$qq1a[1]);
		$qq3a=explode('\'',$qq2a[2]);
		$val[qq]=str_replace($qq3a[0],$met_qq_type,$val[qq]);
   }
$metinfofloat.=$val[qq]."\n";
}
}
 if($val[msn]!="")$metinfofloat.="<a href='msnim:chat?contact=".$val[msn]."'><img border='0'  alt='MSN".$val[name]."' src='".$met_url."images/msn/msn".$met_msn_type.".gif'/></a>\n";
 if($val[taobao]!="")$metinfofloat.="<a target='_blank' href='http://amos.im.alisoft.com/msg.aw?v=".$met_taobao_type."&uid=".$val[taobao]."&site=cntaobao&s=2&charset=utf-8' ><img border='0' src='http://amos.im.alisoft.com/online.aw?v=2&uid=".$val[taobao]."&site=cntaobao&s=".$met_taobao_type."&charset=utf-8' alt='".$val[name]."' /></a>\n";
 $metinfofloat.="</div>\n"; 
  }
 foreach($skype_list as $key=>$val){
 $metinfofloat.="<div class='scroll_skype_1'><a href='callto://".$val[skype]."'><img src='".$met_url."images/skype/skype".$met_skype_type.".gif' border='0'></a></div>\n";
  }
 foreach($alibaba_list as $key=>$val){
 $metinfofloat.="<div class='scroll_alibaba_1'><a target=_blank href=http://amos1.sh1.china.alibaba.com/msg.atc?v=1&uid=".$val[alibaba]."><img border=0 src=http://amos1.sh1.china.alibaba.com/online.atc?v=1&uid=$val[alibaba]&s=".$met_alibaba_type." alt='".$val[name]."'></a></div>\n";
 }
 $metinfofloat.="</div></div>\n";
 $metinfofloat.="<div class='scroll_foot1_1'></div>\n";
 if($met_onlinetel!="") $metinfofloat.="<div class='scroll_foot2_1'>".$met_onlinetel."</div>\n";
 $metinfofloat.="<div class='scroll_foot3_1'></div>\n";
 $metinfofloat.="</DIV>\n";
 break;
 
 case 2:
 case 4:
  $qqcolor[1]=array(1=>'#c5e2f8',2=>'#498bcf',3=>'#a7d8d7');
  $qqcolor[2]=array(1=>'#ffe5e5',2=>'#d27762',3=>'#f7c6c6');
  $qqcolor[3]=array(1=>'#E7E1FF',2=>'#624db3',3=>'#C2B6F0');
  $qqcolor[4]=array(1=>'#E6FFE5',2=>'#46bd43',3=>'#ADF3AC');
  $qqcolor[5]=array(1=>'#DFDFDF',2=>'#9a9a99',3=>'#CCCCCC');
  $qqwidth=($met_online_skin==2)?'112':'130';
  $metinfocss.="<style type=\"text/css\">\n";
  $metinfocss.=".floatonline_1{ padding:1px; width:".$qqwidth."px; text-align:left;}\n";
  $metinfocss.=".scroll_title_2{height:25px; line-height:25px; background:url(".$met_url."images/qq/online".$met_online_skin."_".$met_online_color.".gif) no-repeat 0px 0px; position:relative;}\n";
  $metinfocss.=".scroll_title_2 span{ padding-left:15px; font-weight:bold; color:#FFFFFF;}\n";
  $metinfocss.=".scroll_title_2 a{ display:block; position:absolute; right:8px; top:6px; line-height:15px;  width:11px; height:11px; background:url(".$met_url."images/qq/close2_".$met_online_color.".gif) no-repeat 0px 0px;}\n";
  $metinfocss.=".scroll_main2{ padding:4px; background:".$qqcolor[$met_online_color][1]."; border:1px solid ".$qqcolor[$met_online_color][2].";}\n";
  $metinfocss.=".scroll_text2{ background:#FFFFFF; border:1px solid ".$qqcolor[$met_online_color][3]."; padding:3px;}\n";
  $metinfocss.=".scroll_qq_1{padding:2px 2px 0px 2px; text-align:".$cssonlinealign."; font-weight:bold; color:#333333; }\n";
  $metinfocss.=".scroll_qq_1 img{padding:5px 0px 0px 0px;}\n";
  $metinfocss.=".scroll_skype_1{padding:5px 0px 5px 0px; text-align:center;}\n";
  $metinfocss.=".scroll_alibaba_1{padding:5px 0px 5px 0px; text-align:center;}\n";
  $metinfocss.=".scroll_foot_2{ background:#FFFFFF; border:1px solid ".$qqcolor[$met_online_color][3]."; text-align:center; padding:3px; line-height:18px; margin-top:5px;}}\n";
  $metinfocss.="</style>\n";
    
  $metinfofloat.="<div class='scroll_title_2'><span>".$lang_Online."</span><a href='#' title='".$lang_Close."' onmousedown='Mouseclose()'>&nbsp;</a></div>\n";
  $metinfofloat.="<div class='scroll_main2'>\n";
  $metinfofloat.="<div class='scroll_text2'>\n";
 foreach($online_list as $key=>$val){
  $metinfofloat.="<div class='scroll_qq_1'>";
  if(!$met_onlinenameok)$metinfofloat.=$val[name];
  $metinfofloat.="\n";
  if($val[qq]!=""){
  if(strlen($val[qq])<30){
  $metinfofloat.="<a href='tencent://message/?uin=".$val[qq]."&Site=&Menu=yes'  title='QQ".$val[name]."' style='text-decoration:none;'>
<img border='0' SRC='http://wpa.qq.com/pa?p=1:".$val[qq].":".$met_qq_type."'></a>\n";
}else{
   if($met_qq_type){
        $qq1a=explode('http://wpa.qq.com/pa',$val[qq]);
		$qq2a=explode(':',$qq1a[1]);
		$qq3a=explode('\'',$qq2a[2]);
		$val[qq]=str_replace($qq3a[0],$met_qq_type,$val[qq]);
   }
$metinfofloat.=$val[qq]."\n";
}
}
 if($val[msn]!="")$metinfofloat.="<a href='msnim:chat?contact=".$val[msn]."'><img border='0'  alt='MSN".$val[name]."' src='".$met_url."images/msn/msn".$met_msn_type.".gif'/></a>\n";
 if($val[taobao]!="")$metinfofloat.="<a target='_blank' href='http://amos.im.alisoft.com/msg.aw?v=".$met_taobao_type."&uid=".$val[taobao]."&site=cntaobao&s=2&charset=utf-8' ><img border='0' src='http://amos.im.alisoft.com/online.aw?v=2&uid=".$val[taobao]."&site=cntaobao&s=".$met_taobao_type."&charset=utf-8' alt='".$val[name]."' /></a>\n";
 $metinfofloat.="</div>\n"; 
  }
 foreach($skype_list as $key=>$val){
 $metinfofloat.="<div class='scroll_skype_1'><a href='callto://".$val[skype]."'><img src='".$met_url."images/skype/skype".$met_skype_type.".gif' border='0'></a></div>\n";
  }
 foreach($alibaba_list as $key=>$val){
 $metinfofloat.="<div class='scroll_alibaba_1'><a target=_blank href=http://amos1.sh1.china.alibaba.com/msg.atc?v=1&uid=".$val[alibaba]."><img border=0 src=http://amos1.sh1.china.alibaba.com/online.atc?v=1&uid=$val[alibaba]&s=".$met_alibaba_type." alt='".$val[name]."'></a></div>\n";
 }
 $metinfofloat.="</div>\n";
 if($met_onlinetel!="") $metinfofloat.="<div class='scroll_foot_2'>".$met_onlinetel."</div>\n";
 $metinfofloat.="</div>\n";
 $metinfofloat.="</DIV>\n";
 break;
 }

}
switch($met_online_type){
 case 0:
  $metinfo.="<div class='met_online'>{$lang_Online}</div>\n";
foreach($online_list as $key=>$val){
   $metinfofloat.="<div class='met_onlinelist'>";
  if(!$met_onlinenameok)$metinfofloat.="<span class='met_onlinename'>".$val[name]."</span>";
  $metinfofloat.="\n";
  if($val[qq]!=""){
  if(strlen($val[qq])<30){
  $metinfofloat.="<a href='tencent://message/?uin=".$val[qq]."&Site=&Menu=yes'  title='QQ".$val[name]."' style='text-decoration:none;'>
<img border='0' SRC='http://wpa.qq.com/pa?p=1:".$val[qq].":".$met_qq_type."'></a>\n";
}else{
   if($met_qq_type){
        $qq1a=explode('http://wpa.qq.com/pa',$val[qq]);
		$qq2a=explode(':',$qq1a[1]);
		$qq3a=explode('\'',$qq2a[2]);
		$val[qq]=str_replace($qq3a[0],$met_qq_type,$val[qq]);
   }
$metinfofloat.=$val[qq]."\n";
}
}
 if($val[msn]!="")$metinfo.="<span class='met_msn'><a href='msnim:chat?contact=".$val[msn]."'><img border='0'  alt='MSN".$val[name]."' src='".$met_url."images/msn/msn".$met_msn_type.".gif'/></a></span>\n";
 if($val[taobao]!="")$metinfo.="<span class='met_taobao'><a target='_blank' href='http://amos.im.alisoft.com/msg.aw?v=".$met_taobao_type."&uid=".$val[taobao]."&site=cntaobao&s=2&charset=utf-8' ><img border='0' src='http://amos.im.alisoft.com/online.aw?v=2&uid=".$val[taobao]."&site=cntaobao&s=".$met_taobao_type."&charset=utf-8' alt='".$val[name]."' /></a></span>\n";
 $metinfo.="</div>\n"; 
  }
 foreach($skype_list as $key=>$val){
 $metinfo.="<div class='met_skype'><a href='callto://".$val[skype]."'><img src='".$met_url."images/skype/skype".$met_skype_type.".gif' border='0'></a></div>\n";
  }
 foreach($alibaba_list as $key=>$val){
 $metinfo.="<div class='met_alibaba'><a target=_blank href=http://amos1.sh1.china.alibaba.com/msg.atc?v=1&uid=".$val[alibaba]."><img border=0 src=http://amos1.sh1.china.alibaba.com/online.atc?v=1&uid=$val[alibaba]&s=".$met_alibaba_type." alt='".$val[name]."'></a></div>\n";
 } 
 break;
 case 1:
  $metinfo=$metinfocss;
  $metinfo.="<script type='text/javascript' src='".$met_url."js/online.js'></script>\n";
  $metinfo.="<div id='floatDiv' style='position: absolute;' class='floatonline_1'>\n";
  $metinfo.=$metinfofloat;
  $metinfo.="<SCRIPT language=JavaScript type=text/JavaScript>\n";
  $metinfo.=" function Mouseclose(){document.getElementById('floatDiv').style.display='none';}\n";
  $metinfo.="window.onload = function(){\n";
  $metinfo.="var floatObj = document.getElementById('floatDiv');	\n";
  $metinfo.="Floaters.addItem(floatObj,".$met_onlineleft_left.",".$met_onlineleft_top.");\n";
  $metinfo.="Floaters.sPlay();\n";
  $metinfo.="}\n";
  $metinfo.="</SCRIPT>\n";
 break;
 case 2:
  $metinfo=$metinfocss;
  $metinfo.="<script type='text/javascript' src='".$met_url."js/online.js'></script>\n";
  $metinfo.="<div id='floatDivr' style='position: absolute;' class='floatonline_1'>\n";
  $metinfo.=$metinfofloat;
  $metinfo.="<SCRIPT language=JavaScript type=text/JavaScript>\n";
  $metinfo.=" function Mouseclose(){document.getElementById('floatDivr').style.display='none';}\n";
  $metinfo.="window.onload = function(){\n";
  $metinfo.="var floatObjr = document.getElementById('floatDivr');	\n";
  $metinfo.="Floaters.addItem(floatObjr,screen.width-".$met_onlineright_right.",".$met_onlineright_top.");\n";
  $metinfo.="Floaters.sPlay();\n";
  $metinfo.="}\n";
  $metinfo.="</SCRIPT>\n";
 break;
 case 3:
 $metinfo="";
 break;
}

return $metinfo;
}

function methtml_hits($module){
global $news,$product,$img,$download,$lang_Hits,$lang_Printing,$lang_Printing,$lang_UpdateTime,$lang_Close;
$listnow=$$module;
$metinfo.=$lang_Hits.":<span><script language='javascript' src='../include/hits.php?type=".$module."&id=".$listnow[id]."'></script></span>&nbsp;&nbsp;";
$metinfo.=$lang_UpdateTime.":".$listnow[updatetime]."&nbsp;&nbsp;【<a href='javascript:window.print()'>".$lang_Printing."</a>】&nbsp;&nbsp;【<a href='javascript:self.close()'>".$lang_Close."</a>】";
return $metinfo;
}

function methtml_prenextinfo($type=0){
global $lang_Previous,$lang_Next,$lang_Noinfo,$preinfo,$nextinfo;
 if($type==1){
  $metinfo=$lang_Previous.":";
  $metinfo.=$preinfo?"<a href='".$preinfo[url]."' >".$preinfo[title]."</a>":$lang_Noinfo;
  $metinfo.="&nbsp;&nbsp;".$lang_Next.":";
  $metinfo.=$nextinfo?"<a href='".$nextinfo[url]."' >".$nextinfo[title]."</a>":$lang_Noinfo;
 }else{
  $metinfo=$lang_Previous.":";
  $metinfo.=$preinfo?"<a href='".$preinfo[url]."' >".$preinfo[title]."</a>":$lang_Noinfo;
  $metinfo.="<br>".$lang_Next.":";
  $metinfo.=$nextinfo?"<a href='".$nextinfo[url]."' >".$nextinfo[title]."</a>":$lang_Noinfo;
 }
 return $metinfo;
}

function methtml_login($type=1){
global $met_member_use,$navurl,$lang,$lang_memberName,$lang_memberPs,$met_memberlogin_code,$lang_memberImgCode,$lang_memberTip1,$lang_register,$lang_memberGo,$lang_memberIndex2,$metinfo_member_name,$lang_memberIndex1,$member_index_url,$lang_memberIndex10,$member_registerurl;
global $lang_memberPassword,$lang_memberRegisterName;
if($met_member_use){ 
  $metinfo.="<script type='text/javascript'>\n";
  $metinfo.="function check_main_login()\n";
  $metinfo.="{\n";
  $metinfo.="var m=document.main_login;\n";
  $metinfo.="if(m.login_name.value.length=='')\n";
  $metinfo.="{\n";
  $metinfo.="	alert('".$lang_memberRegisterName."');\n";
  $metinfo.="	m.login_name.focus();\n";
  $metinfo.="	return false;\n";
  $metinfo.="}\n";
  $metinfo.="if(m.login_pass.value.length=='')\n";
  $metinfo.="{\n";
  $metinfo.="	alert('".$lang_memberPassword."');\n";
  $metinfo.="	m.login_pass.focus();\n";
  $metinfo.="	return false;\n";
  $metinfo.="}\n";
  $metinfo.="}\n";
  $metinfo.="function checkcookie(){\n";
  $metinfo.="if (document.cookie == '')\n"; 
  $metinfo.="{	\n";
  $metinfo.="var tmp=document.getElementById('remember');\n";
  $metinfo.="	alert('{$lang_memberCookie}');\n";
  $metinfo.="	tmp.checked=false;\n";
  $metinfo.="}}\n";
  $metinfo.="function pressCaptcha(obj){obj.value = obj.value.toUpperCase();}\n";
  $metinfo.="</script>\n";
if($type){
  $metinfo.="<div class='login_x' id='login_x1' style='display:none'>";
  }else{
  $metinfo.="<div class='login_x' id='login_x1'>";
  }
  $metinfo.="<form method='post' action='".$navurl."member/login_checkout.php?lang=".$lang."' name='main_login' onSubmit='javascript: return check_main_login()'>";
  $metinfo.="<input type='hidden' name='action' value='login'/>";
  $metinfo.="<span class='log1'><span class='log1_name'>".$lang_memberName."</span><input type='text' name='login_name' id='user_name' /></span>";
  $metinfo.="<span class='log4'><span class='log4_name'>".$lang_memberPs."</span><input type='password' name='login_pass' id='user_pass'/></span>";
if($met_memberlogin_code==1){
  $metinfo.="<span class='log2'><span class='log2_name'>".$lang_memberImgCode."</span><input name='code' onKeyUp='pressCaptcha(this)' type='text' class='inp' id='code' maxlength='8' />";
  $metinfo.="<img align='absbottom' src='".$navurl."member/outlogin/ajax.php?action=code'  onclick=this.src='".$navurl."member/outlogin/ajax.php?action=code&'+Math.random()  style='cursor: pointer;' title=".$lang_memberTip1."/>";
  $metinfo.="</span>";}
  $metinfo.="<span class='log3'><input type='submit' class='index_login1' value='".$lang_memberGo."' />";
  $metinfo.="<span><a href='".$member_registerurl."' class='index_login2'/>".$lang_register."</a></span>";
  $metinfo.="</span>";
  $metinfo.="</form>";
  $metinfo.="</div>";
if($type){
  $metinfo.="<div class='login_x' id='login_x2' style='display:none' >";
  $metinfo.="<span class='login_okname' ><span class='login_okname1'>".$lang_memberIndex2."</span><span class='login_okname2'><font style='color:red'>";
  $metinfo.="<script language='javascript' src='".$navurl."member/member.php?memberaction=membername'></script>";
  $metinfo.="</font></span></span>&nbsp;&nbsp;";
  $metinfo.="<span class='login_okmember' ><span class='login_okmember1'><a href='".$navurl."member/".$member_index_url."' >".$lang_memberIndex1."</a></span><span class='login_okmember2'>|</span><span class='login_okmember3'><a href='".$navurl."member/login_out.php?lang=".$lang."' >".$lang_memberIndex10."</a></span></span>";
  $metinfo.="</div>";
  $metinfo.="<script language='javascript' src='".$navurl."member/member.php?memberaction=login'></script>";
 }
 }
  return $metinfo;
}
require_once 'searchhtml.inc.php';
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
