<?php
$depth='../';
require_once $depth.'../login/login_check.php';
require_once $depth.'../include/config.php';
if($id!=null){
	$querys = "SELECT * FROM $met_wapmenu where lang='$lang' and id='$id'";
	$menus=$db->query($querys);
	while($list = $db->fetch_array($menus)) {
		$menur=$list;
	}
	if($menur['type']==5){
		$typer=explode("|",$menur['values']);
		$class1=$typer[0];
		$class2=$typer[1];
		$class3=$typer[2];
		$selected_class1[$class1]="selected='selected'";
		$selected_class2[$class2]="selected='selected'";
		$selected_class3[$class3]="selected='selected'";
		$icons=array('icon-mees','icon-pencil','icon-file-alt','icon-file','icon-align-justify','icon-user','icon-picture','icon-envelope','icon-barcode','icon-food','icon-tint','icon-truck','icon-edit','icon-gift','icon-warning-sign','icon-trophy','icon-bullhorn','icon-facetime-video','icon-shopping-cart','icon-star','icon-thumbs-up');
		for($i=0;$i<21;$i++){
			if($menur['columnicon']==$icons[$i]){
				$selected_icon[$i]='checked="checked"';
				$selected_iconbg[$i]='#000000';
			}else{
				$selected_iconbg[$i]='#b5b5c7';
			}
		}
	}else{
		$selected_icon[0]='checked="checked"';
		$selected_iconbg[0]='#000000';
		for($i=1;$i<21;$i++){
					$selected_iconbg[$i]='#b5b5c7';
			}
	}
	if($menur['type']==1){
		$bell=$menur['value'];
	}
	if($menur['type']==2){
		$qq=$menur['value'];
	}
	if($menur['type']==3&&$menutype!=1){
		$mapcan=explode("[!]",$menur['value']);
		$met_maplng=$mapcan[1];
		$met_maplat=$mapcan[2];
		$met_mapzoom=$mapcan[3];
		$met_maptitle=$mapcan[4];
		$met_mapcontents=$mapcan[5];
	}
}else{
	$selected_icon[0]='checked="checked"';
	$selected_iconbg[0]='#000000';
	for($i=1;$i<21;$i++){
				$selected_iconbg[$i]='#b5b5c7';
		}
	$querys = "SELECT * FROM $met_wapmenu where lang='$lang'";
	$menus=$db->query($querys);
	while($list = $db->fetch_array($menus)) {
		$menursr[]=$list;
	}
	if(count($menursr)>3){
		metsave('../app/wap/custommenu.php?anyid='.$anyid.'&cs='.$cs.'&lang='.$lang,'最多只能添加4个菜单',$depth);
	}
}
switch($menur['type']){
	case 1:
		$displaytext='';
		$dispalyimgtext='style="display:none"';
		$dispalyurl='style="display:none"';
		$displaycontents='style="display:none"';
		$dispalyimgtexts='style="display:none"';
		$menu_type1[1]="selected='selected'";
	break;
	case 2:
		$displaytext='style="display:none"';
		$dispalyimgtext='';
		$dispalyurl='style="display:none"';
		$displaycontents='style="display:none"';
		$dispalyimgtexts='style="display:none"';
		$menu_type1[2]="selected='selected'";
	break;
	case 3:
        $displaytext='style="display:none"';
		$dispalyimgtext='style="display:none"';
		$dispalyurl='style="display:none"';
		$displaycontents='style="display:none"';
		$dispalyimgtexts='';
		$menu_type1[3]="selected='selected'";
	break;
	case 4:
		$displaytext='style="display:none"';
		$dispalyimgtext='style="display:none"';
		$dispalyurl='';
		$displaycontents='style="display:none"';
		$dispalyimgtexts='style="display:none"';
		$menu_type1[4]="selected='selected'";
	break;	
	case 5:
		$displaytext='style="display:none"';
		$dispalyimgtext='style="display:none"';
		$dispalyurl='style="display:none"';
		$displaycontents='';
		$dispalyimgtexts='style="display:none"';
		$menu_type1[5]="selected='selected'";
	break;	
}
if($action=='editor'){
	if($menu_type==1){
		$type=$menu_type;
		$values=$displayname;
	}
	if($menu_type==2){
		$type=$menu_type;
		$values=$qqs;
	}
	if($menu_type==3){
		require_once $depth.'../include/config.php';
		$type=$menu_type;
		$values='[!]'.$met_maplng.'[!]'.$met_maplat.'[!]'.$met_mapzoom.'[!]'.$met_maptitle.'[!]'.$met_mapcontents;		
		$querys = "UPDATE $met_config SET `value`='' where name='met_maplng'";
		$db->query($querys);
		$querys = "UPDATE $met_config SET `value`='' where name='met_maplat'";
		$db->query($querys);
		$querys = "UPDATE $met_config SET `value`='' where name='met_mapzoom'";
		$db->query($querys);
		$querys = "UPDATE $met_config SET `value`='' where name='met_maptitle'";
		$db->query($querys);
		$querys = "UPDATE $met_config SET `value`='' where name='met_mapcontents'";
		$db->query($querys);	
	}
	if($menu_type==4){
		$type=$menu_type;
		$values=$http;
	}
	if($menu_type==5){
		$type=$menu_type;
		if($_POST[class3]!=0){
			$values=$_POST[class3];
		}else{
			if($_POST[class2]!=0){
				$values=$_POST[class2];
			}else{
				$values=$_POST[class1];
			}
		}
	}
	$classs=$_POST[class1]."|".$_POST[class2]."|".$_POST[class3];
	if(!$menu_iconrgb){
		$menu_iconrgb='#ffffff';
	}
	if(!$menu_wordrgb){
		$menu_wordrgb='#ffffff';
	}
	if($id!=null){
		$querys = "UPDATE $met_wapmenu SET `sequence`='$menu_list_order', `name`='$menu_name', `value`='$values',`columnicon`='$met_icon',`menu_iconrgb`='$menu_iconrgb' ,`menu_wordrgb`='$menu_wordrgb' , `values`='$classs',`type`='$type',`lang`='$lang' where id='$id'";
		$menus=$db->query($querys);
	}else{
		$querys = "INSERT INTO $met_wapmenu SET `sequence`='$menu_list_order', `name`='$menu_name', `value`='$values',`columnicon`='$met_icon',`menu_iconrgb`='$menu_iconrgb' ,`menu_wordrgb`='$menu_wordrgb' , `values`='$classs',`type`='$type',`lang`='$lang'";
		$menus=$db->query($querys);
	}
	metsave('../app/wap/custommenu.php?anyid='.$anyid.'&cs='.$cs.'&lang='.$lang,'操作成功',$depth);
}

$querys = "SELECT value FROM $met_config where name='met_wapshowtype' and lang='$lang'";
$menus=$db->query($querys);
while($list = $db->fetch_array($menus)) {
	$sql=$list;
}
$sqls='';
if($sql[value]==1){
    $sqls="and wap_ok='1'";
}
$query = "SELECT * FROM $met_column where  lang='$lang' $sqls";

$result = $db->query($query);
while($list = $db->fetch_array($result)) {
	$clist[]=$list;
	if(($list['classtype']==1||$list['releclass'])){$clist1now[]=$list;}
	if((($list['classtype']==2&&$list['bigclass']==$class1)||($met_class[$list['bigclass']]['releclass']&&$list['classtype']==3&&$list['bigclass']==$class1))){$clist2now[]=$list;}
	if(($list['classtype']==3&&$list['bigclass']==$class2)){$clist3now[]=$list;}
}

$i=0;
$listjs = "<script language = 'JavaScript'>\n";
$listjs.= "var onecount;\n";
$listjs.= "lev = new Array();\n";
foreach($clist as $key=>$vallist){
	if($vallist['releclass']){
		$listjs.= "lev[".$i."] = new Array('".$vallist[name]."','0','".$vallist[id]."','".'0'."','".$vallist[module]."','".$vallist[lang]."');\n";
		$i=$i+1;
	}
	else{
		$listjs.= "lev[".$i."] = new Array('".$vallist[name]."','".$vallist[bigclass]."','".$vallist[id]."','".'0'."','".$vallist[module]."','".$vallist[lang]."');\n";
		$i=$i+1;
	}
}
$listjs.= "onecount=".$i.";\n";
$listjs.= "</script>";
$weixin_menu_type1[$menu['type']]="selected='selected'";
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('app/wap/custommenueditor');
footer();
?>