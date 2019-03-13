<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
require_once '../include/global.func.php';
require_once 'copy.func.php';
$modulename[2]=array(0=>$met_news,1=>"../article/index.php?lang=$lang&class1=$class1");
$modulename[3]=array(0=>$met_product,1=>"../product/index.php?lang=$lang&class1=$class1");
$modulename[4]=array(0=>$met_download,1=>"../download/index.php?lang=$lang&class1=$class1");
$modulename[5]=array(0=>$met_img,1=>"../img/index.php?lang=$lang&class1=$class1");
$modulename[6]=array(0=>$met_job,1=>"../job/index.php?lang=$lang&class1=$class1");		
$modulename[9]=array(0=>$met_link,1=>"../link/index.php?lang=$lang");
    $copydb=$modulename[$module][0];
    $allidlist=explode(',',$allid);
	$urls=$modulename[$module][1];	
    $k=count($allidlist)-1;
    $query = "select * from $copydb where ";
    if($copydb!=$tablename[4][0] && $copydb!=$tablename[5][0]){
        $query.= "id IN(";
        for($i=0;$i<$k; $i++){
            $query.=$i==$k-1?"'$allidlist[$i]'":"'$allidlist[$i]',";
        } 
        $query.= ") and ";
    }
    $query.= "lang='$lang'";
    $result = $db->query($query);
	while($list= $db->fetch_array($result)){
	    $copy[]=$list;
	}
    $copy=daddslashes($copy,'1');
	$parameter='';
	$chce=$copyclass1;
	$chce1=$copyclass2==''?0:$copyclass2;
	$chce2=$copyclass3==''?0:$copyclass3;
    if(!$module){
        if($action=='para')$allparas=explode(',',$allpara);
		$class[0]=$class1; 
		$class[1]=$copyclass1; 
		$langue[0]=$lang; 
		$langue[1]=$copylang;
        for($i=0;$i<2;$i++){
	        $query  = "select * from $met_parameter where lang='$langue[$i]' and module='$module' or class1='$class[$i]' order by no_order";
            $result = $db->query($query);
	        while($list= $db->fetch_array($result)){
	            $para[$i][]=$list;
	        }
        }
		if(count($para[0])==0||count($para[1])==0)copycontent($module,$copy,$parameter,$copylang,$lang,$chce,$chce1,$chce2);
		if(count($para[0])>0 && count($para[1])>0){
            $max=count($para[0])>count($para[1])?count($para[0]):count($para[1]);
            for($i=0;$i<$max;$i++){
				$pdn=$para[1][$i][id];
				if($action=='para')$pdn=$allparas[$i];
                $parameter[$i]=array('pn'=>$para[0][$i][id],'dn'=>$pdn);
            }
		}
        if($class1==$copyclass1 || $action=='para')copycontent($module,$copy,$parameter,$copylang,$lang,$chce,$chce1,$chce2);
	}else{
	    copycontent($module,$copy,$parameter,$copylang,$lang,$chce,$chce1,$chce2);
	}  
//if($module>2&&$module<6){
if(!$module){
okinfox("copypara.php?lang=$lang&module=$module&action=$action&mdnoes=copypara&class1=$class1&copylang=$copylang&copyclass1=$copyclass1&copyclass2=$copyclass2&copyclass3=$copyclass3&allid=$allid");
}else{
	okinfox($urls);
}
if($mdnoes='copypara'){
	$css_url="../templates/".$met_skin."/css";
	$img_url="../templates/".$met_skin."/images";
	include template('copypara');
	footer();
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>