<?php
# MetInfo Enterprise Content Management System
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved.

defined('IN_MET') or exit('No permission');

load::mod_class('base/admin/base_admin');

class banner_admin extends base_admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		// $this->handle=load::mod_class('language/class/language_handle','new');
		// $this->banner=load::mod_class('language/class/language_database','new');
	    //$this->database = load::mod_class('job/job_database', 'new');
		$this->database = load::mod_class('banner/banner_database', 'new');
		$this->tabledata = load::sys_class('tabledata', 'new');
	}
	 public function doindex(){
	 	global $_M;
	 	require_once $this->template('own/index');
	 }


	 function dojson_list(){
		global $_M;
		$img_url=$_M[url][site_admin].'templates/met/images/';
		$array = column_sorting(2);
		$met_class1 = $array['class1'];
		$met_class2 = $array['class2'];
		$met_class3 = $array['class3'];
		$where="lang='{$this->lang}' and (if_in='0' or module>1000) order by no_order";
		$result =$this->tabledata->getdata($_M[table][column],'*',$where);
        $mod1[0]=$mod[10000]=array(
			id=>10000,
			name=>"{$_M[word][flashGlobal]}",
			url=>$_M[config][met_weburl]."index.php?lang=".$this->lang,
			bigclass=>0
		);
		$mod1[1]=$mod[10001]=array(
					id=>10001,
					name=>"{$_M[word][flashHome]}",
					url=>$_M[config][met_weburl]."index.php?lang=".$this->lang,
					bigclass=>0
				);
		$i=2;
        $met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
        if(file_exists(PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php")){
			require_once PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
		}
		if($metinfover == 'v1' || $metinfover == 'v2'){// 新模板框架v2增加判断
			$v1dispaly = "style='display:none'";
		}
        foreach ($result as $key => $list) {

         	  if(!isset($met_flasharray[$list[id]][type]))$met_flasharray[$list[id]]=$met_flasharray[10000];
					$list['url']=$this->linkrules($list);
					if($list[classtype]==1){
						$mod1[$i]=$list;
						$mod1[$i][flash_height]=$met_flasharray[$list[id]][y];
						$i++;
					}
					if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
					if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
					$mod[$list['id']]=$list;
         }

		foreach($mod1 as $key=>$val){
	        $val[displaytype]='<td class="list-text">
			<select name="met_flash_'.$val[id].'_type" onChange="flashselect($(this))" data-checked="'.$met_flasharray[$val[id]][type].'">
			<option value="0" >'.$_M[word][close].'</option>
			<option value="1"  style="color:#FF0000">'.$_M[word][flashMode1].'</option>';
			if(!$v1dispaly){
			 $val[displaytype].='<option value="2"  style="color:#003399">'.$_M[word][flashMode2].'</option>';
			}
	         $val[displaytype].='<option value="3"  style="color:#339933">'.$_M[word][setflashMode3].'</option>
			</select>';
			$i++;
			$checked="";
			if($met_flasharray[$val[id]][x]==$met_flasharray[10000][x] && $met_flasharray[$val[id]][y]==$met_flasharray[10000][y]&&$met_flasharray[$val[id]][type]==$met_flasharray[10000][type]&&$met_flasharray[$val[id]][imgtype]==$met_flasharray[10000][imgtype])
			$checked="checked=checked";
			$met_flash_imgtype[$met_flasharray[$val[id]][imgtype]]="selected";
			$classnow[id]=count($met_class2[$val[id]]);
			if($i!=1)$nowimg[$val[id]]="";
			$nowimg[$val[id]]="<div style='width:22px; height:10px; overflow:hidden; float:left;' class='lanmu1'></div>";
			if($classnow[id])$nowimg[$val[id]]="<img src='$img_url/colum1nx.gif' class='columnimg' onclick='showclass({$val[id]})' style=' margin-bottom:2px;' />";
			$imgtypedisply=$met_flasharray[$val[id]][type]==1?'':'style="display:none;"';
			$diyi='';
            if($i==1)$diyi="onclick=\"CheckAllx($(this),'myform')\"";
			$list = array();
			$list[] =$nowimg[$val[id]]."<span style='font-weight:700;color:#000';>{$val['name']}<span>";
			$list[] = $val['displaytype'];
			$list[] = "<input name='' type='text' class='ui-input text-center'  value='{$met_flasharray[$val[id]][y]}'>";
			$list[]=$val[url]==''?'':"<a href='{$val[url]}' target='_blank' onclick='return viewflash($(this),\"{$val[id]}\")'>{$_M[word][preview]}</a>";
			$list[] ="<input name='met_flash_{$val[id]}_all' type='checkbox' {$met_flash_all[$val[id]]} value='1' $checked id='select_{$val[id]}' {$diyi}>";
			$rarray[] = $list;

			foreach($mod2[$val[id]] as $key=>$val2){
	        $val2[displaytype]='<td class="list-text">
			<select name="met_flash_'.$val2[id].'_type" onChange="flashselect($(this))" data-checked="'.$met_flasharray[$val2[id]][type].'">
			<option value="0" >'.$_M[word][close].'</option>
			<option value="1"  style="color:#FF0000">'.$_M[word][flashMode1].'</option>';
			if(!$v1dispaly){
			 $val2[displaytype].='<option value="2"  style="color:#003399">'.$_M[word][flashMode2].'</option>';
			}
	         $val2[displaytype].='<option value="3"  style="color:#339933">'.$_M[word][setflashMode3].'</option>
			</select><input type="hidden" name="is_nav2" value="1">';
			$i++;
			$checked="";
			if($met_flasharray[$val2[id]][x]==$met_flasharray[10000][x] && $met_flasharray[$val2[id]][y]==$met_flasharray[10000][y]&&$met_flasharray[$val2[id]][type]==$met_flasharray[10000][type]&&$met_flasharray[$val2[id]][imgtype]==$met_flasharray[10000][imgtype])
			$checked="checked=checked";
			$met_flash_imgtype[$met_flasharray[$val2[id]][imgtype]]="selected";
			$classnow2[id]=count($met_class3[$val2[id]]);
			if($i!=1)$nowimg[$val2[id]]="";
			$nowimg[$val2[id]]="<div style='width:22px; height:10px; overflow:hidden; float:left;'></div>";
			if($classnow2[id])$nowimg[$val2[id]]="<img src='$img_url/colum1nx.gif' class='columnimg' onclick='showclass({$val2[id]})' style=' margin-bottom:2px;' />";
			$imgtypedisply=$met_flasharray[$val2[id]][type]==1?'':'style="display:none;"';
			$diyi='';
            if($i==1)$diyi="onclick=\"CheckAllx($(this),'myform')\"";
			$list = array();
			$list[] =$nowimg[$val2[id]]."<img src='$img_url/bg_columnx.gif'/><div style='width:22px; height:10px; overflow:hidden; float:left;'></div><span style='color:#000';>{$val2['name']}<span>"."<input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val['id']}_{$val2['id']}'>";
			$list[] = $val2['displaytype'];
			$list[] = "<input name='' type='text' class='ui-input text-center'  value='{$met_flasharray[$val2[id]][y]}'><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val['id']}_{$val2['id']}'>";
			$list[]=$val[url]==''?'':"<a href='{$val[url]}' target='_blank' onclick='return viewflash($(this),\"{$val[id]}\")'>{$_M[word][preview]}</a><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val['id']}_{$val2['id']}'>";
			$list[] ="<input name='met_flash_{$val[id]}_all' type='checkbox' {$met_flash_all[$val2[id]]} value='1' $checked id='select_{$val[id]}' {$diyi}><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val['id']}_{$val2['id']}'>";
			$rarray[] = $list;

            foreach($mod3[$val2[id]] as $key=>$val3){
	        $val3[displaytype]='<td class="list-text">
			<select name="met_flash_'.$val3[id].'_type" onChange="flashselect($(this))" data-checked="'.$met_flasharray[$val3[id]][type].'">
			<option value="0" >'.$_M[word][close].'</option>
			<option value="1"  style="color:#FF0000">'.$_M[word][flashMode1].'</option>';
			if(!$v1dispaly){
			 $val3[displaytype].='<option value="2"  style="color:#003399">'.$_M[word][flashMode2].'</option>';
			}
	         $val3[displaytype].='<option value="3"  style="color:#339933">'.$_M[word][setflashMode3].'</option>
			</select>';
			$i++;
			$checked="";
			if($met_flasharray[$val3[id]][x]==$met_flasharray[10000][x] && $met_flasharray[$val3[id]][y]==$met_flasharray[10000][y]&&$met_flasharray[$val3[id]][type]==$met_flasharray[10000][type]&&$met_flasharray[$val3[id]][imgtype]==$met_flasharray[10000][imgtype])
			$checked="checked=checked";
			$met_flash_imgtype[$met_flasharray[$val3[id]][imgtype]]="selected";
			if($i!=1)$nowimg[$val3[id]]="";
			$nowimg[$val3[id]]="<div style='width:22px; height:10px; overflow:hidden; float:left;'></div>";
			$imgtypedisply=$met_flasharray[$val3[id]][type]==1?'':'style="display:none;"';
			$diyi='';
            if($i==1)$diyi="onclick=\"CheckAllx($(this),'myform')\"";
			$list = array();
			$list[] ="<img src='$img_url/bg_column1.gif'/><div style='width:22px; height:10px; overflow:hidden; float:left;'></div><span style='color:#000';>{$val3['name']}<span><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val2['id']}_{$val3['id']}'>";
			$list[] = $val3['displaytype']."<input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val2['id']}_{$val3['id']}'>";
			$list[] = "<input name='' type='text' class='ui-input text-center'  value='{$met_flasharray[$val3[id]][y]}'><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val2['id']}_{$val3['id']}'>";
			$list[]=$val[url]==''?'':"<a href='{$val[url]}' target='_blank' onclick='return viewflash($(this),\"{$val[id]}\")'>{$_M[word][preview]}</a><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val2['id']}_{$val3['id']}'>";
			$list[] ="<input name='met_flash_{$val[id]}_all' type='checkbox' {$met_flash_all[$val3[id]]} value='1' $checked id='select_{$val[id]}' {$diyi}><input type='hidden' name='is_nav2' value='1' class='lanmu' id='class_{$val2['id']}_{$val3['id']}'>";
			$rarray[] = $list;

           }

		}

	}

		$this->tabledata->rdata($rarray);
}


	function linkrules($listc){
	    global $_M;
		$modulename[1] = array(0=>'show',1=>'show');
		$modulename[2] = array(0=>'news',1=>'shownews');
		$modulename[3] = array(0=>'product',1=>'showproduct');
		$modulename[4] = array(0=>'download',1=>'showdownload');
		$modulename[5] = array(0=>'img',1=>'showimg');
		$modulename[6] = array(0=>'job',1=>'showjob');
		$modulename[7] = array(0=>'message',1=>'index');
		$modulename[8] = array(0=>'feedback',1=>'index');
		$modulename[9] = array(0=>'link',1=>'index');
		$modulename[10]= array(0=>'member',1=>'index');
		$modulename[11]= array(0=>'search',1=>'search');
		$modulename[12]= array(0=>'sitemap',1=>'sitemap');
		$modulename[100]= array(0=>'product',1=>'showproduct');
		$modulename[101]= array(0=>'img',1=>'showimg');
		$urltop = $_M[config][met_weburl].$listc['foldername'].'/';
		$langmark='lang='.$this->lang;
		switch($listc['module']){
			default:
				$urltop2 = $urltop.$modulename[$listc['module']][0].'.php?'.$langmark;
				if($listc['releclass']){
					$listc['url']=$urltop2."&class1=".$listc['id'];
				}else{
					$classtypenum=$cache_column[$listc['bigclass']]['releclass']?$listc['classtype']-1:$listc['classtype'];
					switch($classtypenum){
						case 1:
						$listc['url']=$urltop2."&class1=".$listc['id'];
						break;
						case 2:
						$listc['url']=$urltop2."&class2=".$listc['id'];
						break;
						case 3:
						$listc['url']=$urltop2."&class3=".$listc['id'];
						break;
					}
				}
				break;
			case 1:
				if($listc['isshow']!=0){
					$listc['url']=$urltop.'show.php?'.$langmark.'&id='.$listc['id'];
				}
				break;
			case 6:
				$listc['url']=$urltop.'index.php?'.$langmark;
				break;
			case 7:
				$listc['url']=$urltop.'index.php?'.$langmark;
				break;
			case 8:
				$listc['url']=$urltop.'index.php?'.$langmark.'&id='.$listc['id'];
				break;
			case 9:
			case 10:
			case 12:
				$listc['url']=$urltop.'index.php?'.$langmark;
				break;
			case 11:
				$listc['url']=$urltop.'index.php?'.$langmark;
				break;
		}
	return $listc['url'];
}


public function doflashset(){
	    global $_M;
        $lang=$_M[form][lang];
        $id=$_M[form][id];
        $met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
        $flashrec1=DB::get_one("SELECT * FROM {$_M[table][flash]} where id='$id'");
        $mtype=$met_flasharray[$module][type];
        $flashmdtype=$flashrec1['img_path']!=''?1:2;
        $mtype=$flashmdtype==2?2:1;
        $flashmdtype1[$flashmdtype]='selected';
        $query="select * from {$_M[table][column]} where lang='$lang' and (if_in='0' or module>1000 )order by no_order";
        $result= DB::query($query);
        while($list = DB::fetch_array($result)){
          if(!$met_flasharray[$list[id]]){
            $met_flasharray[$list[id]]=$met_flasharray[10000];
            $name='flash_'.$list[id];
            $value=$met_flasharray[10000]['type'].'|'.$met_flasharray[10000]['x'].'|'.$met_flasharray[10000]['y'].'|'.$met_flasharray[10000]['imgtype'];
            $query = "INSERT INTO {$_M[table][config]} SET
                name              = '$name',
                value             = '$value',
                flashid           = '$list[id]',
                lang              = '$lang'
                ";
            DB::query($query);
          }
        }
        if($flashrec1['module']=='metinfo'){
          $met_clumid_all1='checked';
        }else{
          $lmod = explode(',',$flashrec1['module']);
          for($i=0;$i<count($lmod);$i++){
            if($lmod[$i]!='')$feditlist[$lmod[$i]]=1;
          }
        }
        foreach($met_flasharray as $key=>$val){
          if($val['type']==$flashmdtype || ($flashmdtype==1 && $val['type']==3)){
            if($key==10001){
              $modclumlist[]=array('id'=>10001,'name'=>$_M[word][indexhome]);
            }else{
              $met_class[$key]=DB::get_one("SELECT * FROM {$_M[table][column]} where id='$key'");
              $modclumlist[]=$met_class[$key];
            }
          }
        }
        $i=1;
        foreach($modclumlist as $key=>$list){
          if($list[classtype]==1 || $list['id']==10001){
            $mod1[$i]=$list;
            $i++;
          }
          if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
          if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
          $mod[$list['id']]=$list;
        }
        require_once $this->template('own/flashset');
}

public function domanage(){
	  global $_M;
        $lang=$_M[form][lang];
        $img_url=$_M[url][site_admin].'templates/met/images/';
		$array = column_sorting(2);
		$met_class1 = $array['class1'];
		$met_class2 = $array['class2'];
		$met_class3 = $array['class3'];
		//$where="lang='{$this->lang}' and (if_in='0' or module>1000) order by no_order";
		//$result =$this->tabledata->getdata($_M[table][column],'*',$where);
		$query="select * from {$_M[table][column]} where lang='{$this->lang}' and (if_in='0' or module>1000) order by no_order";
		$result=DB::get_all($query);
        $mod1[0]=$mod[10000]=array(
			id=>10000,
			name=>"{$_M['word']['allcategory']}",
			url=>'{$_M[url][own_form]}a=domanage',
			bigclass=>0
		);
		$mod1[1]=$mod[10001]=array(
					id=>10001,
					name=>"{$_M[word][flashHome]}",
					url=>$_M[config][met_weburl]."index.php?lang=".$this->lang,
					bigclass=>0
				);
		$i=2;
        $met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
        if(file_exists(PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php")){
			require_once PATH_WEB."templates/{$_M[config][met_skin_user]}/metinfo.inc.php";
		}
		if($metinfover == 'v1' || $metinfover == 'v2'){// 新模板框架v2增加判断
			$v1dispaly = "style='display:none'";
		}
        foreach ($result as $key => $list) {
           if(!isset($met_flasharray[$list[id]][type]))$met_flasharray[$list[id]]=$met_flasharray[10000];
					$list['url']=$this->linkrules($list);
					if($list[classtype]==1){
						$mod1[$i]=$list;
						$mod1[$i][flash_height]=$met_flasharray[$list[id]][y];
						$i++;
					}
					if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
					if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
					$mod[$list['id']]=$list;
         }
         if($_M[form][ftype]=='1'){
              $ftype1[1]="selected=selected";
         }else if($_M[form][ftype]=='0'){
              $ftype1[0]="selected=selected";
         }else{
              $ftype1[all]="selected=selected";
         }
		if($_M[form][module]) $module1[$_M[form][module]]='selected';
		$_M['url']['help_tutorials_helpid']="107#2、内容：";
      	require $this->template('own/article_index');
   }


     /**
	 * 分页数据
	 */
	function dotable_json_list(){
		global $_M;
		$lang=$_M[lang];
		$module=$_M[form][module];
		$met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
		$where ="lang='$lang' and wap_ok='0' order by no_order";
		if($_M[form][search]=='detail_search' && $_M[form][ftype]!='all'){
			$tp = $_M[form][ftype]==1?"and img_path!=''":"and flash_path!=''";
			$where ="lang='$lang' and wap_ok='0' {$tp} order by no_order";
		}
		$ftype1[$ftype]='selected=selected';
		if($module<>""){
			$dule = $met_flasharray[$module]['type']==2?"(flash_path !='' and module = 'metinfo')":"(img_path !='' and module = 'metinfo')";
			$where ="lang='$lang' and wap_ok='0' and (module like '%,{$module},%' or {$dule}) order by no_order";
			$module1[$module]='selected';
		}
		$result =$this->tabledata->getdata($_M[table][flash],'*',$where);
		foreach ($result as $key => $list) {
			if(trim($list[module], ',')=='metinfo'){
		       $list['modulename']=$_M[word][allcategory];
			}else{
				$lmod = explode(',',$list[module]);
				$cname=',';
				for($i=0;$i<count($lmod);$i++){
					if($lmod[$i]!=''){
						if($lmod[$i]==10001){
							$cname.=$_M[word][htmHome].',';
						}else{
							$columnids=DB::get_one("select * from {$_M[table][column]} where id='{$lmod[$i]}' and lang='{$lang}'");
							$cname.=$columnids[name].',';
						}
					}
				}
				$list['modulename']=$cname;
			}
			$flashrec_list[]=$list;
		 }


		$admininfo = admin_information();

		foreach($flashrec_list as $key=>$val){
			$valmdy=explode(',',$val[modulename]);
			if(count($valmdy)==3){
				$val[modulename]=$valmdy[1];
			}elseif(count($valmdy)>3){
				$val[modulename]='';
				for($i=0;$i<count($valmdy);$i++){
					if($valmdy[$i]!='')$val[modulename].=$i==(count($valmdy)-2)?$valmdy[$i]:$valmdy[$i].'-';
				}
			}
			$valmname=utf8substr($val[modulename],0,6);
			$val[ftype]=$val['img_path']!=''?$_M[word][image]:$_M[word][flashMode2];
			$val[img_path]=$val['img_path']!=''?$val['img_path']:$val['flash_path'];
			$val[img_path]="<a href='{$val[img_path]}' target='_blank'>{$_M[word][clickview]}</a>";
			$list = array();
			$list[] = "<input type=\"checkbox\" name=\"id\" value=\"{$val[id]}\">";
			$list[] ="<input type=\"text\" name=\"no_order_{$val['id']}\" value=\"{$val['no_order']}\" class='ui-input'>";
			//$list[] =$val['no_order'];
			$list[] = $valmname."<input type='hidden' value={$val[modulename]}  class='columntitle'>";
			//$list[] = $val['readok'];
			$list[] =$val['img_title'];
			if(!$val['height']) $val['height']=$_M['word']['adaptive'];
			if(!$val['height_t']) $val['height_t']=$_M['word']['adaptive'];
			if(!$val['height_m']) $val['height_m']=$_M['word']['adaptive'];
			$list[] = "<input type='text' name='height_{$val['id']}' value='{$val['height']}' class='ui-input'>";
			$list[] = "<input type='text' name='height_t_{$val['id']}' value='{$val['height_t']}' class='ui-input'>";
			$list[] = "<input type='text' name='height_m_{$val['id']}' value='{$val['height_m']}' class='ui-input'>";
			$list[] = $val['img_path'];
			$list[] = "<a href=\"{$_M[url][own_form]}a=doeditor&id={$val['id']}&class1={$val['class1']}&class2={$val['class2']}&class3={$val['class3']}\" class=\"edit\">{$_M['word']['editor']}</a><span class=\"line\">-</span><a href=\"{$_M[url][own_form]}a=dolistsave&submit_type=del&allid={$val['id']}\" data-toggle=\"popover\" class=\"delet\">{$_M['word']['delete']}</a>
			";
			$rarray[] = $list;
		}

        $rarray =$this->tabledata->rdata($rarray);
	}

	/**
	 * 编辑文章页面
	 */
	function doeditor() {
		global $_M;
        $lang=$_M[lang];
        $id=$_M[form][id];
        $met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
        $flashrec1=DB::get_one("SELECT * FROM {$_M[table][flash]} where id='$id'");
        $mtype=$met_flasharray[$module][type];
        $flashmdtype=$flashrec1['img_path']!=''?1:2;
        $mtype=$flashmdtype==2?2:1;
        $flashmdtype1[$flashmdtype]='selected';
        $query="select * from {$_M[table][column]} where lang='$lang' and (if_in='0' or module>1000 )order by no_order";
        $result= DB::query($query);
        while($list = DB::fetch_array($result)){
          if(!is_array($met_flasharray[$list[id]]) || !$met_flasharray[$list[id]]['type']){

          	if(version_compare($_M['config']['metcms_v'], '6.0.0') >= 0){
          		$met_flasharray[10000]['type'] = 3;
          	}
            $met_flasharray[$list[id]]=$met_flasharray[10000];
            $name='flash_'.$list[id];
            $value=$met_flasharray[10000]['type'].'|'.$met_flasharray[10000]['x'].'|'.$met_flasharray[10000]['y'].'|'.$met_flasharray[10000]['imgtype'];
            $query = "INSERT INTO {$_M[table][config]} SET
                name              = '$name',
                value             = '$value',
                flashid           = '$list[id]',
                lang              = '$lang'
                ";
            DB::query($query);
          }
        }
        if($flashrec1['module']=='metinfo'){
          $met_clumid_all1='checked';
        }else{
          $lmod = explode(',',$flashrec1['module']);
          for($i=0;$i<count($lmod);$i++){
            if($lmod[$i]!='')$feditlist[$lmod[$i]]=1;
          }
        }
        foreach($met_flasharray as $key=>$val){
          if($val['type']==$flashmdtype || ($flashmdtype==1 && $val['type']==3)){
            if($key==10001){
              $modclumlist[]=array('id'=>10001,'name'=>$_M[word][indexhome]);
            }else{
              $met_class[$key]=DB::get_one("SELECT * FROM {$_M[table][column]} where id='$key'");
              $modclumlist[]=$met_class[$key];
            }
          }
        }
        $i=1;
        foreach($modclumlist as $key=>$list){
          if($list[classtype]==1 || $list['id']==10001){
            $mod1[$i]=$list;
            $i++;
          }
          if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
          if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
          $mod[$list['id']]=$list;
        }
        require_once $this->template('own/flashset');
	}

   	function dolistsave(){
		global $_M;
		$list = explode(",",$_M['form']['allid']) ;
		foreach($list as $id){
			if($id){
				switch($_M['form']['submit_type']){
					case 'save':
						$list['no_order'] 	 = $_M['form']['no_order_'.$id];
						if($_M['form']['height_'.$id]==$_M[word][adaptive] || $_M['form']['height_'.$id]=='' ){
                            $_M['form']['height_'.$id]=0;
						}
						if($_M['form']['height_t_'.$id]==$_M[word][adaptive] || $_M['form']['height_'.$id]=='' ){
                            $_M['form']['height_t_'.$id]=0;
						}
						if($_M['form']['height_m_'.$id]==$_M[word][adaptive] || $_M['form']['height_'.$id]=='' ){
                            $_M['form']['height_m_'.$id]=0;
						}
						$list['height'] 	 = $_M['form']['height_'.$id];
						$list['height_t'] 	 = $_M['form']['height_t_'.$id];
						$list['height_m'] 	 = $_M['form']['height_m_'.$id];
						$this->list_no_order($id,$list['no_order'],$list['height'],$list['height_t'],$list['height_m']);
					break;
					case 'del':
					    $this->database->del_by_id($id);
						//$this->del_list($id,$_M['form']['recycle']);
						//if($_M['form']['recycle']==0)$this->shop->del_product($id);
					break;
					case 'comok':
						$this->list_com($id,1);
					break;
					case 'comno':
						$this->list_com($id,0);
					break;
					case 'topok':
						$this->list_top($id,1);
					break;
					case 'topno':
						$this->list_top($id,0);
					break;
					case 'displayok':
						$this->list_display($id,1);
					break;
					case 'displayno':
						$this->list_display($id,0);
					break;
					case 'move':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$this->list_move($id,$class1,$class2,$class3);
					break;
					case 'copy':
						$class = explode("-",$_M['form']['columnid']);
						$class1 = $class[0];
						$class2 = $class[1];
						$class3 = $class[2];
						$newid = $this->list_copy($id,$class1,$class2,$class3);
						//开启在线订购时
						//if($_M['config']['0'])$this->shop->copy_product($id,$newid);
						//
						$this->shop->copy_product($id,$newid);
						//
					break;
				}
			}
		}
		turnover("{$_M[url][own_form]}a=domanage");
	}


    public function list_no_order($id,$no_order,$height,$height_t,$height_m){
		$list['id'] = $id;
    	$list['no_order'] = $no_order;
		$list['height'] = $height;
		$list['height_t'] = $height_t;
		$list['height_m'] = $height_m;
		return $this->database->update_by_id($list);
		// $query = "UPDATE {$this->tablename} SET no_order = '{$no_order}' WHERE id = '{$id}'";
		// DB::query($query);
	}



	/**
	 * 新增内容
	 */
	public function doadd() {
		global $_M;
		$lang=$this->lang;
		$met_flasharray = load::sys_class('label', 'new')->get('banner')->get_config();
		$mtype=$met_flasharray[$module]['type'];
		$flashmdtype=$flashmdtype?$flashmdtype:1;
		$mtype=2;
		$flashmdtype1[$flashmdtype]='selected';
		$query="select * from {$_M[table][column]} where lang='$lang' and if_in='0' order by no_order";
		$result= DB::query($query);
		while($list = DB::fetch_array($result)){
			if(!is_array($met_flasharray[$list[id]]) || !$met_flasharray[$list[id]]['type']){

          	if(version_compare($_M['config']['metcms_v'], '6.0.0') >= 0){
          		$met_flasharray[10000]['type'] = 3;
          	}
				$met_flasharray[$list[id]]=$met_flasharray[10000];
				$name='flash_'.$list[id];
				$value=$met_flasharray[10000]['type'].'|'.$met_flasharray[10000]['x'].'|'.$met_flasharray[10000]['y'].'|'.$met_flasharray[10000]['imgtype'];
				$query = "INSERT INTO {$_M[table][config]} SET
						name              = '$name',
						value             = '$value',
						flashid           = '$list[id]',
						lang              = '$lang'
						";
				DB::query($query);
			}
		}
		foreach($met_flasharray as $key=>$val){
			if($val['type']==$flashmdtype || ($flashmdtype==1 && $val['type']==3)){
				if($key==10001){
					$modclumlist[]=array('id'=>10001,'name'=>$_M[word][indexhome]);
				}else{
					$met_class[$key]=DB::get_one("SELECT * FROM {$_M[table][column]} where id='$key'");
					$modclumlist[]=$met_class[$key];
				}
			}
		}
		switch($mtype){
			case 1:
				$met_module_type=$_M[word][flashMode1];
			break;
			case 2:
				$met_module_type=$_M[word][flashMode2];
			break;
			case 3:
				$met_module_type=$_M[word][setflashMode3];
			break;
		}
		if($module==10000||$module==10001){
			$columnid=$module==10000?array('name'=>$_M[word][flashGlobal]):array('name'=>$_M[word][indexhome]);
		}else{
			$columnid=DB::get_one("select * from {$_M[table][column]} where id='{$module}' and lang='{$lang}'");
		}
		$i=1;
		foreach($modclumlist as $key=>$list){
			if($list[classtype]==1 || $list['id']==10001){
				$mod1[$i]=$list;
				$i++;
			}
			if($list[classtype]==2)$mod2[$list[bigclass]][]=$list;
			if($list[classtype]==3)$mod3[$list[bigclass]][]=$list;
			$mod[$list['id']]=$list;
		}
		$met_flash_type[$met_flasharray[10000][type]]="checked='checked'";
		$style1=$met_flasharray[10000][type]==1?"style='display:block;'":"style='display:none;'";
		$_M['url']['help_tutorials_helpid']='107#添加 Banner';
		require $this->template('own/article_add');
	}
   /*数据添加保存*/
   public function doeditorsave() {
		global $_M;
		$module=$_M[form][met_clumid_all]==10002?'metinfo':$_M[form][f_columnlist];
		if($_M[form][met_clumid_all]!=10002){
	        $module=','.$module.',';
		}
	    // 添加banner属性img_title_color、img_des、img_des_color、img_text_position（新模板框架v2）
	    if($_M[form][action]=='add'){
            $query = "INSERT INTO {$_M[table][flash]} SET
			module             = '$module',
			img_path           = '{$_M[form][img_path]}',
			mobile_img_path    = '{$_M[form][mobile_img_path]}',
			img_link           = '{$_M[form][img_link]}',
			img_title          = '{$_M[form][img_title]}',
			img_title_color    = '{$_M[form][img_title_color]}',
			img_des            = '{$_M[form][img_des]}',
			img_des_color      = '{$_M[form][img_des_color]}',
			img_text_position  = '{$_M[form][img_text_position]}',
			flash_path         = '{$_M[form][flash_path]}',
			flash_back         = '{$_M[form][flash_back]}',
			no_order           = '{$_M[form][no_order]}',
			width			   = '{$_M[form][width]}',
			height		       = '{$_M[form][height]}',
			height_t		   = '{$_M[form][height_t]}',
			height_m		   = '{$_M[form][height_m]}',
			wap_ok			   = '0',
			lang               = '{$_M[lang]}'";
			DB::query($query);
	    }
	    if($_M[form][action]=='editor'){
            $query = "UPDATE  {$_M[table][flash]} SET
			module             = '$module',
			img_path           = '{$_M[form][img_path]}',
			mobile_img_path    = '{$_M[form][mobile_img_path]}',
			img_link           = '{$_M[form][img_link]}',
			img_title          = '{$_M[form][img_title]}',
			img_title_color    = '{$_M[form][img_title_color]}',
			img_des            = '{$_M[form][img_des]}',
			img_des_color      = '{$_M[form][img_des_color]}',
			img_text_position  = '{$_M[form][img_text_position]}',
			flash_path         = '{$_M[form][flash_path]}',
			flash_back         = '{$_M[form][flash_back]}',
			no_order           = '{$_M[form][no_order]}',
			width			   = '{$_M[form][width]}',
			height		       = '{$_M[form][height]}',
			height_t		   = '{$_M[form][height_t]}',
			height_m		   = '{$_M[form][height_m]}',
			wap_ok			   = '0',
			lang               = '{$_M[lang]}'
			where id='{$_M[form][id]}'";
			DB::query($query);
	   }


		turnover("{$_M[url][own_form]}a=domanage");
	}

}