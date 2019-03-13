<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 
require_once '../login/login_check.php';
require_once '../include/global.func.php';
require_once 'copy.func.php';
$modulename[2]=array(0=>$met_news,1=>'');
$modulename[3]=array(0=>$met_product,1=>'');
$modulename[4]=array(0=>$met_download,1=>'');
$modulename[5]=array(0=>$met_img,1=>'');
$modulename[6]=array(0=>$met_job,1=>'');		
$modulename[9]=array(0=>$met_link,1=>'');	
$tablename[1]=array(0=>$met_column,1=>"../column/index.php?lang=$lang");	
$tablename[2]=array(0=>$met_flash,1=>"../flash/flash.php?lang=$lang");	
$tablename[3]=array(0=>$met_online,1=>"../online/index.php?lang=$lang");	
$tablename[4]=array(0=>$met_otherinfo,1=>"../set/other_info.php?lang=$lang");	
$tablename[5]=array(0=>$met_index,1=>"../set/index_content.php?lang=$lang");	
if($action=='copy'){  

	$copydb=$tablename[$table][0];
	$urls=$tablename[$table][1];
    $allidlist=explode(',',$allid);
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
    if($copydb==$met_column){	
	
	    $u=0;$b=0;
        for($l=1;$l<4;$l++){ //分栏目级别可对应写入bigclass
            $i=0;
            foreach($copy as $key=>$val){
                if($val[classtype]==$l){
				if($val[classtype]==2 && $b==0)okinfox($urls,$lang_modCopyTip3);
				if($val[classtype]==3 && $b==0)okinfox($urls,$lang_modCopyTip4);
		            $bigclass=$val[bigclass];
                    if($l<>1){  //不为一级栏目时
                        $chced=$l==2?$chce:$chce1;
                        foreach($chced as $key=>$vao){ 
							if($val[bigclass]==$vao[pn]){
								$val[bigclass]=$vao[dn];
								if($val[releclass]!=1)$val[foldername]=$vao[fd];
							}	
						}
                    }
					
					if($val[module]>5 && $val[module] !=8){
						if($copylang == $lang){
							okinfox($urls,"{$lang_modCopyTip1}{$val[name]}{$lang_modCopyTip2}");
						}else{
							$module_ok = $db->get_one("SELECT * FROM $met_column WHERE module='$val[module]' and lang='$copylang'");
							if($module_ok)okinfox($urls,"{$lang_modCopyTip1}{$val[name]}{$lang_modCopyTip2}");
						}
					}elseif($val[classtype]==1 || $val[releclass]==1){
						$yfolder = $val[foldername];
						$val[foldername] = copyfnameok($val[foldername],$copylang);
						if($val[foldername]!=$yfolder){
							$filedir="../../".$val[foldername];
							if(!file_exists($filedir)){ mkdir($filedir, 0777); }
							switch($val[module]){
								case 1:
									$oldfile  ="../../about/show.php";   //模块原始文件路径
									$newfile  ="../../".$val[foldername]."/show.php";  //新路径
									$address  ="../about/show.php";		//新文件require_once路径	
									Copyfile($address,$newfile);
								break;
								case 2:
									$oldfile ="../../news/news.php";   
									$newfile ="../../".$val[foldername]."/news.php"; 
									$address ="../news/news.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../news/shownews.php";   
									$newfile ="../../".$val[foldername]."/shownews.php"; 
									$address  ="../news/shownews.php"; 
									Copyfile($address,$newfile);
								break;
								case 3:
									$oldfile ="../../product/product.php";   
									$newfile ="../../".$val[foldername]."/product.php";  
									$address  ="../product/product.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../product/showproduct.php";   
									$newfile ="../../".$val[foldername]."/showproduct.php";  
									$address  ="../product/showproduct.php"; 
									Copyfile($address,$newfile);
								break;
								case 4:
									$oldfile ="../../download/download.php";   
									$newfile ="../../".$val[foldername]."/download.php";  
									$address  ="../download/download.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../download/showdownload.php";   
									$newfile ="../../".$val[foldername]."/showdownload.php";  
									$address  ="../download/showdownload.php"; 
									Copyfile($address,$newfile);
								break;
								case 5:
									$oldfile ="../../img/img.php";   
									$newfile ="../../".$val[foldername]."/img.php";  
									$address  ="../img/img.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../img/showimg.php";   
									$newfile ="../../".$val[foldername]."/showimg.php";  
									$address  ="../img/showimg.php"; 
									Copyfile($address,$newfile);
								break;
								case 8:
									$oldfile ="../../feedback/index.php";   
									$newfile ="../../".$val[foldername]."/index.php";  
									$address  ="../feedback/index.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../feedback/uploadfile_save.php";   
									$newfile ="../../".$val[foldername]."/uploadfile_save.php";  
									$address ="../feedback/uploadfile_save.php"; 
									Copyfile($address,$newfile);
									$oldfile ="../../feedback/config_$lang.inc.php";   
									$newfile ="../../".$val[foldername]."/config_$lang.inc.php";  
									if(!file_exists($newfile)){  
										if (!copy($oldfile,$newfile))okinfox($urls,$lang_columntip13);
									}
								break;
							}  
							if($val[module]!=8)Copyindx("../../".$val[foldername]."/index.php");
						}
					}
					if($val[module]==8){
						$oldfile      ="../../$val[foldername]/config_$lang.inc.php";   
						$newfile      ="../../$val[foldername]/config_$copylang.inc.php"; 
						if(!file_exists($newfile)){  
							if (!copy($oldfile,$newfile))okinfox($urls,$lang_langcopyfile);
						}
					}
                    $query = "INSERT INTO $met_column SET
                        name               = '$val[name]',
					    namemark           = '$val[namemark]',
					    no_order           = '$val[no_order]',
					    wap_ok             = '$val[wap_ok]',
					    list_order         = '$val[list_order]',
					    new_windows        = '$val[new_windows]',
					    bigclass           = '$val[bigclass]',
					    releclass          = '$val[releclass]',
					    nav                = '$val[nav]',
					    ctitle             = '$val[ctitle]',
					    if_in              = '$val[if_in]',
					    filename           = '',
					    foldername         = '$val[foldername]',
					    module             = '$val[module]',
					    index_num          = '$val[index_num]',
					    out_url            = '$val[out_url]',
					    classtype          = '$val[classtype]',
					    keywords           = '$val[keywords]', 
					    description        = '$val[description]',
					    content            = '$val[content]',
					    access      	   = '$val[access]',
					    indeximg		   = '$val[indeximg]',
					    columnimg		   = '$val[columnimg]',
					    lang			   = '$copylang',
					    isshow			   = '$val[isshow]'";
                    $db->query($query);
                    $paranum =$db->get_one("select * from $met_column where lang='$copylang' and id=(select max(id) from $met_column)");
				    if($l==1 || $val[releclass]==1)$chce[$i]=array('pn'=>$val[id],'dn'=>$paranum[id],'fd'=>$paranum[foldername]);$b++;
				    if($l==2 && $val[releclass]!=1)$chce1[$i]=array('pn'=>$val[id],'dn'=>$paranum[id],'fd'=>$paranum[foldername]);$b++;
				    if($l==3)$chce2[$i]=array('pn'=>$val[id],'dn'=>$paranum[id]);
			        //栏目相关参数复制
			        if(($val[classtype] == 1 || $val[releclass]==1)&& ($val[module]==8 || $val[module]<7)){
				        $copyparameter='';
						$queval='';
						$queval = " and class1='$val[id]'";
                        $query  = "select * from $met_parameter where lang='$lang' and module='$val[module]' $queval";
                        $result = $db->query($query);
	                    while($list= $db->fetch_array($result)){
	                        $copyparameter[]=$list;
	                    }
						$copyparaok=1;
						//$copyparaok = count($copyparameter)==0?1:0;
						//if($val[module]==6)$copyparaok = 1;
						if($copyparaok){
							$copyparameter=daddslashes($copyparameter,'1');
							foreach($copyparameter as $key=>$vap){
								$vapok = $vap[class1]==$chce[$i][pn]?1:0;
								if($vap[class1]==0 && $val[module]!=8)$vapok = 1;
								if($vapok){
									$vap[class1]=$vap[class1]==0?0:$chce[$i][dn];  
									$query = "INSERT INTO $met_parameter SET
										name             = '$vap[name]',
										no_order         = '$vap[no_order]',
										type             = '$vap[type]',
										access           = '$vap[access]',
										wr_ok            = '$vap[wr_ok]',
										class1           = '$vap[class1]',
										module           = '$vap[module]',
										lang             = '$copylang'";
									$db->query($query);
									$paranum = $db->get_one("select * from $met_parameter where lang='$copylang' and module='$val[module]' and class1='$val[class1]' and id=(select max(id) from $met_parameter)");
									$parameter[$u]=array('pn'=>$vap[id],'dn'=>$paranum[id]);
									if($vap[type]==2 || $vap[type]==4 || $vap[type]==6){
										$query  = "select * from $met_list where lang='$lang' and bigid='$vap[id]'";
										$result = $db->query($query);
										while($list= $db->fetch_array($result)){
											$copylist[]=$list;
										}
										$copylist=daddslashes($copylist,'1');
										foreach($copylist as $key=>$vak){
											$query = "INSERT INTO $met_list SET
												bigid            = '$paranum[id]',
												info             = '$vak[info]',
												no_order         = '$vak[no_order]',
												lang             = '$copylang'";
											$db->query($query);
										}
										$copylist='';
									}
									$u++;
								}
							}
						}
				    }
			        //是否复制该栏目内容
			        if($copycontent){
                        $copypart=$modulename[$val[module]][0];
						$mod=$val[module];
						if($copypart){
	                        $copymodule='';
	                        $copymin='';
				            if($val[classtype]==1 || $val[releclass]==1)$copymodule="and class1='$val[id]' and class2='0' and class3='0'";
				            if($val[classtype]==2 && $val[releclass]!=1)$copymodule="and class2='$val[id]' and class3='0'";
				            if($val[classtype]==3)$copymodule="and class2='$bigclass' and class3='$val[id]'";
				            if($copypart==$met_parameter ||$copypart==$met_plist)$copymodule ="and module='$copymodule'";
				            if($copypart==$met_job || $copypart==$met_link)$copymodule ='';
                            $query  = "select * from $copypart where lang='$lang' $copymodule";
                            $result = $db->query($query);
	                        while($list= $db->fetch_array($result)){
	                            $copymin[]=$list;
	                        }
		                    $copymin=daddslashes($copymin,'1');
					        copycontent($mod,$copymin,$parameter,$copylang,$lang,$chce,$chce1,$chce2);
					    }
                   }
                }
				$i++;
		    }
    }
}else if($copydb==$met_flash){
		foreach($copy as $key=>$val){
            $query = "INSERT INTO $met_flash SET
                      module             = '$val[module]',
					  img_title          = '$val[img_title]',
					  img_path           = '$val[img_path]',
					  img_link           = '$val[img_link]',
					  flash_path         = '$val[flash_path]',
					  flash_back         = '$val[flash_back]',
					  no_order           = '$val[no_order]',
					  width              = '$val[width]', 
					  height             = '$val[height]',
					  lang               = '$copylang'";
			$db->query($query);
		}
}else if($copydb==$met_online){
        foreach($copy as $key=>$val){
            $query = "INSERT INTO $met_online SET
                      name             = '$val[name]',
                      no_order         = '$val[no_order]',
                      qq               = '$val[qq]',
                      msn              = '$val[msn]',
                      taobao           = '$val[taobao]',
                      alibaba          = '$val[alibaba]',
                      skype            = '$val[skype]',
					  lang             = '$copylang'";
			$db->query($query);
			require_once '../../include/cache.func.php';
			cache_online($lang);
		}
}else if($copydb==$met_otherinfo){
        foreach($copy as $key=>$val){
            $query = "INSERT INTO $met_otherinfo SET
                      info1            = '$val[info1]',
                      info2            = '$val[info2]',
                      info3            = '$val[info3]',
                      info4            = '$val[info4]',
                      info5            = '$val[info5]',
                      info6            = '$val[info6]',
                      info7            = '$val[info7]',
                      info8            = '$val[info8]',
                      info9            = '$val[info9]',
                      info10           = '$val[info10]',
                      imgurl1          = '$val[imgurl1]',
                      imgurl2          = '$val[imgurl2]',
                      rightmd5         = '$val[rightmd5]',
                      righttext        = '$val[righttext]',
                      authcode         = '$val[authcode]',
                      authpass         = '$val[authpass]',
                      authtext         = '$val[authtext]',
                      data             = '$val[data]',
					  lang             = '$copylang'";
			$db->query($query);
		}
}else if($copydb==$met_index){
        foreach($copy as $key=>$val){
			$index_if = $db->get_one("SELECT * FROM $met_index where lang='$copylang'");
			if($index_if['id']!=''){
				$query = "update $met_index set
						  content  = '$val[content]',
						  lang     = '$copylang'
						  where id = '$index_if[id]'";
			}else{
				$query = "INSERT INTO $met_index SET
						  content            = '$val[content]',
						  lang               = '$copylang'";
			}
			$db->query($query);
		}
}
okinfo($urls);
}


footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>