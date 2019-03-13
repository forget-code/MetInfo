<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

/**
 * 系统标签类
 */

class language_handle {
  /**
	 * 为字段赋值
	 * @param  string  $column 栏目数组
	 * @return array           处理过后的栏目数组
	 */
	function delcolumn($column){
		global $_M;
		$adminurl=PATH_WEB.$_M['config']['met_adminfile'].'\\';
		if($column['releclass']){
		$classtype="class1";
		}else{
		$classtype="class".$column['classtype'];
		}
		$langcolumn = $column['lang'];
		switch ($column['module']){
			default:
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
		    break;
			case 2:
			 $query = "select * from {$_M[table][news]} where $classtype='$column[id]'";
			 $del = DB::get_all($query);
			 $this->delimg($del,2,2);
			 $query = "delete from {$_M[table][news]} where $classtype='$column[id]'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 3:
			 $query = "select * from {$_M[table][product]} where $classtype='$column[id]'";
		     $del = DB::get_all($query);
			 $this->delimg($del,2,3);
			 foreach($del as $key=>$val){
				$query = "delete from {$_M[table][plist]} where listid='$val[id]' and module='$column[module]'";
			    DB::query($query);
			 }
			 $query = "delete from {$_M[table][product]} where $classtype='$column[id]'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 4:
			 $query = "select * from {$_M[table][download]} where $classtype='$column[id]'";
			 $del = DB::get_all($query);
			 $this->delimg($del,2,4);
			 foreach($del as $key=>$val){
				$query = "delete from {$_M[table][plist]} where listid='$val[id]' and module='$column[module]'";
			    DB::query($query);
			 }
			 $query = "delete from {$_M[table][download]} where $classtype='$column[id]'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 5:
			 $query = "select * from {$_M[table][img]} where $classtype='$column[id]'";
			 $del = DB::get_all($query);
			 $this->delimg($del,2,5);
			 foreach($del as $key=>$val){
				$query = "delete from {$_M[table][plist]} where listid='$val[id]' and module='$column[module]'";
			    DB::query($query);
			 }
			 $query = "delete from {$_M[table][img]} where $classtype='$column[id]'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 6:
			$query = "select * from {$_M[table][cv]} where lang='$langcolumn'";
			$del = DB::get_all($query);
			$this->delimg($del,2,6);	
			 $query = "delete from {$_M[table][plist]} where lang='$langcolumn' and module='$column[module]'";
			 DB::query($query);
			 $query = "delete from {$_M[table][cv]} where lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][job]} where lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 7:
			 $query = "delete from {$_M[table][message]} where lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			 $query="delete from {$_M[table][config]} where columnid='$column[id]' and lang='$langcolumn'";
			 DB::query($query);
			 $query="delete from {$_M[table][parameter]} where lang='$langcolumn' and module=7";
			 DB::query($query);
			 $query="delete from {$_M[table][mlist]} where lang='$langcolumn' and module=7";
			 DB::query($query);
			break;
			case 8:
			 $query = "select * from {$_M[table][feedback]} where class1='$column[id]'";
			 $del = DB::get_all($query);
			 $this->delimg($del,2,8);
			 foreach($del as $key=>$val){
				$query = "delete from {$_M[table][flist]} where listid='$list[id]'";
			    DB::query($query);
			 }
			 $query = "delete from {$_M[table][parameter]} where module='$column[module]' and class1='$column[id]' and lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][feedback]} where class1='$column[id]' and lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			 $query="delete from {$_M[table][config]} where columnid='$column[id]' and lang='$langcolumn'";
			 DB::query($query);
			break;
			case 9:
			 $query = "delete from {$_M[table][link]} where lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
			case 10:
			 $query = "delete from {$_M[table][admin_table]} where usertype!=3 and lang='$langcolumn'";
			 DB::query($query);
			 $query = "delete from {$_M[table][column]} where id='$column[id]'";
		     DB::query($query);
			break;
		}
		/*删除文件*/
		$admin_lists = DB::get_one("SELECT * FROM {$_M[table][column]} WHERE foldername='$column[foldername]'");
		if(!$admin_lists['id'] && ($column['classtype'] == 1 || $column['releclass'])){
			if($column['foldername']!='' && ($column['module']<6 || $column['module']==8) && $column['if_in']!=1){
				if(!$this->unkmodule($column['foldername'])){
					$foldername=PATH_WEB.$column['foldername'];
					$this->deldir($foldername);
				}
			}
		}
		/*删除栏目图片*/
		$this->file_unlink($adminurl.$column[indeximg]);
		$this->file_unlink($adminurl.$column[columnimg]);

	}
	function delimg($del,$type,$module=0,$para_list=NULL){
            global $_M;
			$table=$module==8?$_M[table][feedback]:$_M[table][plist];
			if($para_list==NULL&&$module!=2){
				$query = "select * from {$_M[table][parameter]} where lang='$lang' and module='$module' and (class1='$del[class1]' or class1=0) and type='5'";
				$para_list=DB::get_all($query);
			}
			if($type==1){
				$delnow[]=$del;
			}
			else if($type==2){
				$delnow=$del;
			}
			else{
				$table=$this->moduledb($module);
				$query="select * from $table where id='$id'";
				echo $query;
				$del=DB::get_one($query);
				$delnow[]=$del;
			}	
			foreach($delnow as $key=>$val){
				if($val['recycle']!=2||$module!=2){
					foreach($para_list as $key1=>$val1){
						if(($module==$val1['module']||$val['recycle']==$val1['module'])&&($val1['class1']==0||$val1['class1']==$val['class1'])){
							$imagelist=DB::get_one("select * from $table where lang='$lang' and  paraid='$val1[id]' and listid='$val[id]'");
							$this->file_unlink($adminurl.$imagelist['info']);
							$imagelist['info']=str_replace('watermark/','',$imagelist['info']);
							$this->file_unlink($adminurl.$imagelist['info']);
						}
					}
				}
				if($module==6||$module==8)continue;
				if($val['displayimg']!=NULL){
					$displayimg=explode('|',$val['displayimg']);
					foreach($displayimg as $key2=>$val2){
						$display_val=explode('*',$val2);
						$this->file_unlink($adminurl.$display_val[1]);
						$display_val[1]=str_replace('watermark/','',$display_val[1]);
						$this->file_unlink($adminurl.$display_val[1]);
						$imgurl_diss=explode('/',$display_val[1]);
						$this->file_unlink($adminurl.$imgurl_diss[0].'/'.$imgurl_diss[1].'/'.$imgurl_diss[2].'/thumb_dis/'.$imgurl_diss[count($imgurl_diss)-1]);
						
					}
				}
				if($val['downloadurl']==NULL){
					$this->file_unlink($adminurl.$val['imgurl']);
					$this->file_unlink($adminurl.$val['imgurls']);
					$val['imgurlbig']=str_replace('watermark/','',$val['imgurl']);
					$this->file_unlink($adminurl.$val['imgurlbig']);
					$imgurl_diss=explode('/',$val['imgurlbig']);
					$this->file_unlink($adminurl.$imgurl_diss[0].'/'.$imgurl_diss[1].'/'.$imgurl_diss[2].'/thumb_dis/'.$imgurl_diss[count($imgurl_diss)-1]);
				}
				else{
					$this->file_unlink($adminurl.$val['downloadurl']);
				}
				
				$content[0]=$val[content];
				$content[1]=$val[content1];
				$content[2]=$val[content2];
				$content[3]=$val[content3];
				$content[4]=$val[content4];
				foreach($content as $contentkey=>$contentval){
					if($contentval){
						$tmp1 = explode("<",$contentval);
						foreach($tmp1 as $key=>$val){
							$tmp2=explode(">",$val);
							if(strcasecmp(substr(trim($tmp2[0]),0,3),'img')==0){
								preg_match('/http:\/\/([^\"]*)/i',$tmp2[0],$out);
								$imgs[]=$out[1];
							}
						}
					}
				}
				foreach($imgs as $key=>$val){
					$vals=explode('/',$val);		
					$this->file_unlink(PATH_WEB."upload/images/".$vals[count($vals)-1]);
					$this->file_unlink(PATH_WEB."upload/images/watermark/".$vals[count($vals)-1]);
				}
			}
        
	}


	/*模块返回表名*/
	function moduledb($module){
		global $_M;
		switch($module){
			case 1:
				$moduledb=$_M[table][column];
				break;
			case 2:
				$moduledb=$_M[table][news];
				break;
			case 3:
				$moduledb=$_M[table][product];
			    break;
			case 4:
				$moduledb=$_M[table][download];
			    break;
			case 5:
				$moduledb=$_M[table][img];
			    break;
			case 6:
				$moduledb=$_M[table][job];
			    break;
			case 100:
				$moduledb=$_M[table][product];
			    break;
			case 101:
				$moduledb=$_M[table][img];
			    break;
		}
		return $moduledb;
	}


	/*是否是系统模块*/
	function unkmodule($filename){
		$modfile = array('about','news','product','download','img','job','cache','config','feedback','include','lang','link','member','message','public','search','sitemap','templates','upload','wap');
		$ok=0;
		foreach($modfile as $key=>$val){
			if($filename==$val)$ok = 1;
		}
		return $ok;
	}
		function file_unlink($file_name) {
		if(stristr(PHP_OS,"WIN")){
			$file_name=@iconv("utf-8","gbk",$file_name);
		}
		if(file_exists($file_name)) {
			//@chmod($file_name,0777);
			$area_lord = @unlink($file_name);
		}
		return $area_lord;
	}

	/*删除目录和其下所有文件*/
	function deldir($dir,$dk=1) {
	  $dh=opendir($dir);
	  while ($file=readdir($dh)) {
	    if($file!="." && $file!="..") {
	      $fullpath=$dir."/".$file;
	      if(!is_dir($fullpath)) {
	          unlink($fullpath);
	      } else {
	          deldir($fullpath);
	      }
	    }
	  }
	  closedir($dh);
	  if($dk==0 && $dir!=PATH_WEB.'upload')$dk=1;
	  if($dk==1){
		  if(rmdir($dir)){
			return true;
		  }else{
			return false;
		  }
	    }
	}


}

# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>
