<?php
$index_c_url=$met_webhtm?$met_weburl."index.htm":$met_weburl."index.php";
$index_e_url=$met_webhtm?$met_weburl."index_en.htm":$met_weburl."index.php?en=en";
if($met_index_type){
$index_e_url=$met_webhtm?$met_weburl."index.htm":$met_weburl."index.php";
$index_c_url=$met_webhtm?$met_weburl."index_ch.htm":$met_weburl."index.php?ch=ch";
}
$searchurl=($en=="en")?$navurl."search/search.php?en=en":$navurl."search/search.php";

$otherinfo = $db->get_one("SELECT * FROM $met_otherinfo order by id desc");
if($index=="index"){
$otherinfo[c_imgurl1]=explode("../",$otherinfo[c_imgurl1]);
$otherinfo[c_imgurl1]=$otherinfo[c_imgurl1][1];
$otherinfo[c_imgurl2]=explode("../",$otherinfo[c_imgurl2]);
$otherinfo[c_imgurl2]=$otherinfo[c_imgurl2][1];
$otherinfo[e_imgurl1]=explode("../",$otherinfo[e_imgurl1]);
$otherinfo[e_imgurl1]=$otherinfo[e_imgurl1][1];
$otherinfo[e_imgurl2]=explode("../",$otherinfo[e_imgurl2]);
$otherinfo[e_imgurl2]=$otherinfo[e_imgurl2][1];
}

$query="select * from $met_online order by no_order";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
$online_list[]=$list;
if($list[qq]!="")$qq_list[]=$list;
if($list[msn]!="")$msn_list[]=$list;
if($list[taobao]!="")$taobao_list[]=$list;
if($list[alibaba]!="")$alibaba_list[]=$list;
if($list[skype]!="")$skype_list[]=$list;
}

if($en==en){
$rightok=explode('--',$met_e_webname);
}else{
$rightok=explode('--',$met_c_webname);
}
if(md5($rightok[1])!=$otherinfo[rightmd5]){
okinfo('http://www.metinfo.cn',$otherinfo[righttext]);
}

if($index=="index"){
$met_logoarray=explode("../",$met_logo);
$met_logo=$met_logoarray[1];
for($i=1;$i<6;$i++){
$met_flash="met_flash_".$i;
$met_flash_array=explode("../",$$met_flash);
$$met_flash=$met_flash_array[1];
}
for($i=1;$i<6;$i++){
$met_e_flash="met_e_flash_".$i;
$met_e_flash_array=explode("../",$$met_e_flash);
$$met_e_flash=$met_e_flash_array[1];
}


$met_flash_backarray=explode("../",$met_flash_back);
$met_flash_back=$met_flash_backarray[1];

$met_flash_urlarray=explode("../",$met_flash_url);
$met_flash_url=$met_flash_urlarray[1];

$met_e_flash_backarray=explode("../",$met_e_flash_back);
$met_e_flash_back=$met_e_flash_backarray[1];

$met_e_flash_urlarray=explode("../",$met_e_flash_url);
$met_e_flash_url=$met_e_flash_urlarray[1];
}

$met_flash_1=($met_flash_1=="")?"":$met_flash_1."|";
$met_flash_2=($met_flash_2=="")?"":$met_flash_2."|";
$met_flash_3=($met_flash_3=="")?"":$met_flash_3."|";
$met_flash_4=($met_flash_4=="")?"":$met_flash_4."|";
$met_flash_5=($met_flash_5=="")?"":$met_flash_5."|";
$met_flash_img=$met_flash_1.$met_flash_2.$met_flash_3.$met_flash_4.$met_flash_5;
$met_flash_img=substr($met_flash_img, 0, -1);

$met_e_flash_1=($met_e_flash_1=="")?"":$met_e_flash_1."|";
$met_e_flash_2=($met_e_flash_2=="")?"":$met_e_flash_2."|";
$met_e_flash_3=($met_e_flash_3=="")?"":$met_e_flash_3."|";
$met_e_flash_4=($met_e_flash_4=="")?"":$met_e_flash_4."|";
$met_e_flash_5=($met_e_flash_5=="")?"":$met_e_flash_5."|";
$met_e_flash_img=$met_e_flash_1.$met_e_flash_2.$met_e_flash_3.$met_e_flash_4.$met_e_flash_5;
$met_e_flash_img=substr($met_e_flash_img, 0, -1);

$met_flashurl_1=($met_flashurl_1=="")?"":$met_flashurl_1."|";
$met_flashurl_2=($met_flashurl_2=="")?"":$met_flashurl_2."|";
$met_flashurl_3=($met_flashurl_3=="")?"":$met_flashurl_3."|";
$met_flashurl_4=($met_flashurl_4=="")?"":$met_flashurl_4."|";
$met_flashurl_5=($met_flashurl_5=="")?"":$met_flashurl_5."|";
$met_flashurl=$met_flashurl_1.$met_flashurl_2.$met_flashurl_3.$met_flashurl_4.$met_flashurl_5;
$met_flashurl=substr($met_flashurl, 0, -1);

$met_flash_xpx=$met_flash_x."px";
$met_flash_ypx=$met_flash_y."px";


    $query="select * from $met_column where classtype='1' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$nav_list_1[]=$list;
	if($list[module]==2 or $list[module]==3 or $list[module]==4 or $list[module]==5)$nav_search[]=$list;  
	}
	$query="select * from $met_column where classtype='2' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$nav_list_2[]=$list;
	}
	$query="select * from $met_column where classtype='3' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$nav_list_3[]=$list;
	}
    $query="select * from $met_column where (nav='1' or nav='3') order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	switch($list[classtype]){
	case 1;
	$c_urllast="?class1=".$list[id];
	$e_urllast="?en=en&class1=".$list[id];
	break;
	case 2;
	$c_urllast="?class1=".$list[bigclass]."&class2=".$list[id];
	$e_urllast="?en=en&class1=".$list[bigclass]."&class2=".$list[id];
	break;
	case 3;
	$urlclass1 = $db->get_one("SELECT * FROM $met_column where id='$list[bigclass]'");
	$c_urllast="?class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	$e_urllast="?en=en&class1=".$urlclass1[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	break;
	}
	
	
	switch($list[module]){
	case 0;
	$list[c_url]=(strstr($list[c_out_url], 'http://'))?$list[c_out_url]:$navurl.$list[c_out_url];
	$list[e_url]=(strstr($list[e_out_url], 'http://'))?$list[e_out_url]:$navurl.$list[e_out_url];
	break;
	case 1;
	$list[c_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename].".htm":$navurl.$list[foldername]."/show.php?id=".$list[id];
	$list[e_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename]."_en.htm":$navurl.$list[foldername]."/show.php?en=en&id=".$list[id];
	break;
	case 2;
	$list[c_url]=$navurl.$list[foldername]."/news.php".$c_urllast;
	$list[e_url]=$navurl.$list[foldername]."/news.php".$e_urllast;
	break;
	case 3;
	$list[c_url]=$navurl.$list[foldername]."/product.php".$c_urllast;
	$list[e_url]=$navurl.$list[foldername]."/product.php".$e_urllast;
	break;
	case 4;
	$list[c_url]=$navurl.$list[foldername]."/download.php".$c_urllast;
	$list[e_url]=$navurl.$list[foldername]."/download.php".$e_urllast;
	break;
	case 5;
	$list[c_url]=$navurl.$list[foldername]."/img.php".$c_urllast;
	$list[e_url]=$navurl.$list[foldername]."/img.php".$e_urllast;
	break;
	case 6;
	$list[c_url]=$navurl.$list[foldername]."/job.php";
	$list[e_url]=$navurl.$list[foldername]."/job.php?en=en";
	break;
	case 7;
	$list[c_url]=$navurl.$list[foldername]."/message.php";
	$list[e_url]=$navurl.$list[foldername]."/message.php?en=en";
	break;
	}
	if($list[id]==$id&&$list[module]==1){$nav_listabout[]=$list;}
	if($show[bigclass]==$list[id]&&$list[module]==1){$nav_listabout[]=$list;}
	if($show3[bigclass]==$list[id]&&$list[module]==1){$nav_listabout[]=$list;}
	$nav_list[]=$list;
	}
foreach($nav_list_1 as $key=>$val){
    $query="select * from $met_column where bigclass='$val[id]' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	switch($list[module]){
	case 0;
	$list[c_url]=(strstr($list[c_out_url], 'http://'))?$list[c_out_url]:$navurl.$list[c_out_url];
	$list[e_url]=(strstr($list[e_out_url], 'http://'))?$list[e_out_url]:$navurl.$list[e_out_url];
	break;
	case 1;
	$list[c_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename].".htm":$navurl.$list[foldername]."/show.php?id=".$list[id];
	$list[e_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename]."_en.htm":$navurl.$list[foldername]."/show.php?en=en&id=".$list[id];
	break;
	case 2;
	$list[c_url]=$navurl.$list[foldername]."/news.php?class1=".$list[bigclass]."&class2=".$list[id];
	$list[e_url]=$navurl.$list[foldername]."/news.php?en=en&class1=".$list[bigclass]."&class2=".$list[id];
	break;
	case 3;
	$list[c_url]=$navurl.$list[foldername]."/product.php?class1=".$list[bigclass]."&class2=".$list[id];
	$list[e_url]=$navurl.$list[foldername]."/product.php?en=en&class1=".$list[bigclass]."&class2=".$list[id];
	break;
	case 4;
	$list[c_url]=$navurl.$list[foldername]."/download.php?class1=".$list[bigclass]."&class2=".$list[id];
	$list[e_url]=$navurl.$list[foldername]."/download.php?en=en&class1=".$list[bigclass]."&class2=".$list[id];
	break;
	case 5;
	$list[c_url]=$navurl.$list[foldername]."/img.php?class1=".$list[bigclass]."&class2=".$list[id];
	$list[e_url]=$navurl.$list[foldername]."/img.php?en=en&class1=".$list[bigclass]."&class2=".$list[id];
	break;
	case 6;
	$list[c_url]=$navurl.$list[foldername]."/job.php";
	$list[e_url]=$navurl.$list[foldername]."/job.php?en=en";
	break;
	case 7;
	$list[c_url]=$navurl.$list[foldername]."/message.php";
	$list[e_url]=$navurl.$list[foldername]."/message.php?en=en";
	break;
	}
	$nav_list2[$val[id]][]=$list;
	}
}
if($show[module]==1){
  $count=count($nav_list2[$class1]);
   for($i=$count;$i>0;$i=$i-1){
   $nav_list2[$class1][$i]=$nav_list2[$class1][$i-1];
   }
  $nav_list2[$class1][0]=$nav_listabout[0];
}

foreach($nav_list_2 as $key=>$val){
    $query="select * from $met_column where bigclass='$val[id]' order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class2_foot=$db->get_one("select * from $met_column where id='$list[bigclass]'");
	$class_type="class1=".$class2_foot[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	switch($list[module]){
	case 0;
	$list[c_url]=(strstr($list[c_out_url], 'http://'))?$list[c_out_url]:$navurl.$list[c_out_url];
	$list[e_url]=(strstr($list[e_out_url], 'http://'))?$list[e_out_url]:$navurl.$list[e_out_url];
	break;
	case 1;
	$list[c_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename].".htm":$navurl.$list[foldername]."/show.php?id=".$list[id];
	$list[e_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename]."_en.htm":$navurl.$list[foldername]."/show.php?en=en&id=".$list[id];
	break;
	case 2;
	$list[c_url]=$navurl.$list[foldername]."/news.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/news.php?en=en&".$class_type;
	break;
	case 3;
	$list[c_url]=$navurl.$list[foldername]."/product.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/product.php?en=en&".$class_type;
	break;
	case 4;
	$list[c_url]=$navurl.$list[foldername]."/download.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/download.php?en=en&".$class_type;
	break;
	case 5;
	$list[c_url]=$navurl.$list[foldername]."/img.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/img.php?en=en&".$class_type;
	break;
	case 6;
	$list[c_url]=$navurl.$list[foldername]."/job.php";
	$list[e_url]=$navurl.$list[foldername]."/job.php?en=en";
	break;
	case 7;
	$list[c_url]=$navurl.$list[foldername]."/message.php";
	$list[e_url]=$navurl.$list[foldername]."/message.php?en=en";
	break;
	}
	$nav_list3[$val[id]][]=$list;
	}
}


 $query="select * from $met_column where (nav='2' or nav='3') order by no_order";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
	$class_type="class1=".$list[id];
	if($list[classtype]==2)$class_type="class1=".$list[bigclass]."&class2=".$list[id];
	if($list[classtype]==3){
	$class2_foot=$db->get_one("select * from $met_column where id='$list[bigclass]'");
	$class_type="class1=".$class2_foot[bigclass]."&class2=".$list[bigclass]."&class3=".$list[id];
	}
	switch($list[module]){
	case 0;
	$list[c_url]=(strstr($list[c_out_url], 'http://'))?$list[c_out_url]:$navurl.$list[c_out_url];
	$list[e_url]=(strstr($list[e_out_url], 'http://'))?$list[e_out_url]:$navurl.$list[e_out_url];
	break;
	case 1;
	$list[c_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename].".htm":$navurl.$list[foldername]."/show.php?id=".$list[id];
	$list[e_url]=$met_webhtm?$navurl.$list[foldername]."/".$list[filename]."_en.htm":$navurl.$list[foldername]."/show.php?en=en&id=".$list[id];
	break;
	case 2;
	$list[c_url]=$navurl.$list[foldername]."/news.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/news.php?en=en&".$class_type;
	break;
	case 3;
	$list[c_url]=$navurl.$list[foldername]."/product.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/product.php?en=en&".$class_type;
	break;
	case 4;
	$list[c_url]=$navurl.$list[foldername]."/download.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/download.php?en=en&".$class_type;
	break;
	case 5;
	$list[c_url]=$navurl.$list[foldername]."/img.php?".$class_type;
	$list[e_url]=$navurl.$list[foldername]."/img.php?en=en&".$class_type;
	break;
	case 6;
	$list[c_url]=$navurl.$list[foldername]."/job.php";
	$list[e_url]=$navurl.$list[foldername]."/job.php?en=en";
	break;
	case 7;
	$list[c_url]=$navurl.$list[foldername]."/message.php";
	$list[e_url]=$navurl.$list[foldername]."/message.php?en=en";
	break;
	}
	$navfoot_list[]=$list;
	}
	
foreach($nav_list2[$class1] as $key=>$val){
$nav_c_list.="<li><a href='$val[c_url]' $val[new_windows] title='$val[c_name]'>$val[c_name]</a></li>";
$class_2=$val[id];
foreach($nav_list3[$class_2] as $key=>$val2){
$nav_c_list.="<br />&nbsp;&nbsp;&nbsp;<font style='font-size:12px'><a href='$val2[c_url]' $val2[new_windows] title='$val2[c_name]' >-$val2[c_name]</a></font>";
}
}
foreach($nav_list2[$class1] as $key=>$val){
$nav_e_list.="<li><a href='$val[e_url]' $val[new_windows] title='$val[e_name]'>$val[e_name]</a></li>";
$class_2=$val[id];
foreach($nav_list3[$class_2] as $key=>$val2){
$nav_e_list.="<br />&nbsp;&nbsp;&nbsp;<font style='font-size:12px'><a href='$val2[e_url]' $val2[new_windows] title='$val2[e_name]' >-$val2[e_name]</a></font>";
}
}
?>