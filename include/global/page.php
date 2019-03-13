<?php
	if(!isset($dataoptimize[$pagemark]['categoryname']))$dataoptimize[$pagemark]['categoryname']=$dataoptimize[10000]['categoryname'];
	if(!isset($dataoptimize[$pagemark]['para'][3]))$dataoptimize[$pagemark]['para'][3]=$dataoptimize[10000]['para'][3];
	if(!isset($dataoptimize[$pagemark]['para'][4]))$dataoptimize[$pagemark]['para'][4]=$dataoptimize[10000]['para'][4];
	if(!isset($dataoptimize[$pagemark]['para'][5]))$dataoptimize[$pagemark]['para'][5]=$dataoptimize[10000]['para'][5];
	if($met_member_use==2)$access_sql= " and access<=$metinfo_member_type";
	$numname = ' id,title,description,class1,class2,class3,updatetime,filename,access,top_ok,hits,issue,com_ok,no_order,';
	$listitem['news'] = $numname.'img_ok,imgurls,imgurl';
	$listitem['product'] = $numname.'new_ok,imgurls,imgurl,displayimg';
	$listitem['download'] = $numname.'downloadurl,filesize,downloadaccess';
	$listitem['img']= $numname.'new_ok,imgurls,imgurl,displayimg';
	$pagearry[0]=array(0=>'news',1=>'shownews',2=>'2',3=>'hitsnews',4=>$met_news);
	$pagearry[1]=array(0=>'product',1=>'showproduct',2=>'3',3=>'hitsproduct',4=>$met_product);
	$pagearry[2]=array(0=>'download',1=>'showdownload',2=>'4',3=>'hitsdownload',4=>$met_download);
	$pagearry[3]=array(0=>'img',1=>'showimg',2=>'5',3=>'hitsimg',4=>$met_img);
	$pagenum = count($pagearry);
	for($i=0;$i<$pagenum;$i++){
		$metmodule = $pagearry[$i][2];
		$pagename = $pagearry[$i][0];
		$nowpara = $i>0?$dataoptimize[$pagemark]['para'][$pagearry[$i][2]]:'';
		$tablename = $pagearry[$i][4];
		for($k=0;$k<2;$k++){
			$hits = $k>0?$pagearry[$i][3]:$pagename;
			$timetype = $k>0?'no_order':'updatetime desc';
			$nowhits=$k>0?'metinfo':'';
			if(!isset($dataoptimize[$pagemark][$hits]))$dataoptimize[$pagemark][$hits]=$dataoptimize[10000][$hits];
			if($dataoptimize[$pagemark][$hits]){
			    for($m=0;$m<2;$m++){
				    $ok = $m>0?0:1;
					$nowlabel=$m>0?'':'met_hot';
					$query = "SELECT $listitem[$pagename] FROM $tablename where top_ok='$ok' and lang='$lang' $access_sql order by $timetype limit 0, $met_sqlnum";
					$result = $db->query($query);
					while($list= $db->fetch_array($result)){
						$filename=$navurl.$class_list[$list['class1']]['foldername'];
						$filenamenow=$met_htmpagename==2?$class_list[$list['class1']]['foldername']:($met_htmpagename==1?date('Ymd',strtotime($list['updatetime'])):$pagearry[$i][1]);
						require 'infolist.php';
					}
				}
			}
		}
	}
?>