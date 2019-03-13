<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');

load::sys_class('admin');

class language_admin extends admin {
	public $iniclass;
	function __construct() {
		global $_M;
		parent::__construct();
		$this->handle=load::mod_class('language/class/language_handle','new');
		$this->syn=load::mod_class('language/class/language_database','new');
		$this->column=load::mod_class('column/column_label', 'new');
	}


	public function doindex() {
	 	global $_M;
        $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::query($query);
        while($list_config=DB::fetch_array($result)){
	          $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
			 	$met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			   	$met_index_type = $met_index_type['value'];
				require $this->template('own/index');
	}

     /*语言设置*/
	 public function dolangset() {
	 	global $_M;
        if($_M['config']['met_admin_type_ok']==1)$met_admin_type_yes="checked";
		if($_M['config']['met_admin_type_ok']==0)$met_admin_type_no="checked";
		if($_M['config']['met_lang_mark']==1)$met_lang_mark_yes="checked";
		if($_M['config']['met_lang_mark']==0)$met_lang_mark_no="checked";
		if($_M['config']['met_ch_lang']==1)$met_ch_lang1="checked";
		if($_M['config']['met_ch_lang']==0)$met_ch_lang2="checked";
	    $met_langok=DB::get_all("select * from {$_M[table][lang]} where lang !='metinfo'");
	    require $this->template('own/langset');

	 }


      /*语言数据更新*/
	 public function doupdate(){
         global $_M;
         $query="UPDATE {$_M['table']['config']} SET value='{$_M[form]['met_admin_type_ok']}' where name='met_admin_type_ok'";
         DB::query($query);
         $query="UPDATE {$_M['table']['config']} SET value='{$_M['form']['met_lang_mark']}' where name='met_lang_mark'";
         DB::query($query);
         $query="UPDATE {$_M['table']['config']} SET value='{$_M['form']['met_ch_lang']}' where name='met_ch_lang'";\
         DB::query($query);
         turnover("{$_M[url][own_form]}a=dolangset",$_M[word][savesuccess]);
	 }
    
    /*语言编辑*/
	  public function dolangeditor(){
         global $_M;
         $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
         $result =DB::query($query);
         while($list_config=DB::fetch_array($result)){
	           $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
                $met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			   	$met_index_type = $met_index_type['value'];
        
        require $this->template('own/langeditor');
         
	}

     /*语言删除*/
	 public function dolangdelete(){
	 	    global $_M;
			$langeditor=$_M[form][langeditor];
            $tables= DB::get_all('show tables');
            foreach ($tables as $key => $value) {
            	 foreach ($value as $key => $tablename) {
            	 	$fields=DB::get_all("desc ".$tablename);
            	 	foreach ($fields as $key => $val) {
            	 		if($val[Field]=='lang'){
                           $query="delete from $tablename where lang ='$langeditor'" ;
                           if(strstr($tablename,'language')){
            	 		   	$query.=" and site ='0'";
            	 		   }
                           DB::query($query);
            	 		}
            	 	}
            	 }
            }
			$query = "SELECT * FROM {$_M[table][lang]} order by no_order where lang!='metinfo'";
            $result =DB::get_all($query); 
			if(count($result)==1)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langone]);
			if($langeditor==$_M[form][lang])turnover("{$_M[url][own_form]}a=doindex",$_M[word][langadderr2]);
			if($langeditor==$_M[config][met_index_type])turnover("{$_M[url][own_form]}a=doindex",$_M[word][langadderr5]);
			// $query = "delete from {$_M[table][language]} where site='0' and app='0' and lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][config]} where lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][templates]} where lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][user_group]} where lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][online]} where lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][otherinfo]} where lang='$langeditor'";
			// DB::query($query);
			$query = "select * from {$_M[table][column]} where lang='$langeditor'";
			$result = DB::query($query);
			while($list = DB::fetch_array($result)){
				$this->handle->delcolumn($list);
			}
			// if($this->syn->get_ui_by_lang($_M[form][langeditor])){
			// 	$this->syn->del_ui_by_lang($_M[form][langeditor]);
			// }
			// $query = "delete from {$_M[table][lang]} where lang='$langeditor'";
			// $result = DB::query($query);
			// $query = "delete from {$_M[table][admin_array]} where lang='$langeditor'";
			// DB::query($query);
			// $query = "delete from {$_M[table][admin_table]} where lang='$langeditor'";
			// DB::query($query);
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][physicaldelok]);
	 }


    /*语言添加*/
    public function dolangadd(){
  	    global $_M;
	    $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::query($query);
        while($list_config=DB::fetch_array($result)){
	          $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
                $met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			 	$met_index_type = $met_index_type['value'];
  	       require $this->template('own/langadd');
    }

   /*语言参数编辑*/
    public function doparaeditor(){
      global $_M;
      $langeditor=$_M[form][langeditor];
      $query="select * from {$_M[table][language]} where site='0' and app='0' and lang='{$langeditor}' ORDER BY no_order";
	  $result=DB::query($query);
	  while($list= DB::fetch_array($result)){
		$list['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list['value']));
		$langtext_b[]=$list;
		$langtext[$list['array']][]=$list;
		$langtext_a[$list['name']]=$list;
	    }
          require $this->template('own/paraeditor');
  }


	public function domodify(){
        global $_M;
        $langeditor=$_M[form][langeditor];
        $query="select * from {$_M[table][language]} where site='0' and app='0' and lang='{$langeditor}' ORDER BY no_order";
		$result=DB::query($query);
		while($list= DB::fetch_array($result)){
			$list['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list['value']));
			$langtext_b[]=$list;
			$langtext[$list['array']][]=$list;
			$langtext_a[$list['name']]=$list;
		}
       !defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
	   foreach($langtext_b as $key=>$val){
		$name=$val['name'].'_metinfo';
		$metino_name=$_M['form'][$name];
		if(isset($metino_name)&&$val['value']!=$metino_name){
			$metino_name = stripslashes($metino_name);
			$metino_name = str_replace("'","''",$metino_name);
			$metino_name = str_replace("\\","\\\\",$metino_name);
			$query="update {$_M[table][language]} set value='$metino_name' where id='$val[id]'";
			DB::query($query);
		}
	}
	
		$file=file_exists(PATH_WEB.'cache/lang_'.$langeditor.'.php');
		if(unlink(PATH_WEB.'cache/lang_'.$langeditor.'.php')||!$file){
			$relang=$_M[word][jsok];
			$relang.=$met_webhtm==0?'':$_M[word][otherinfocache1];
			turnover("{$_M[url][own_form]}a=doparaeditor&langeditor={$langeditor}",$relang,$depth);
		}else{
			turnover("{$_M[url][own_form]}a=doparaeditor&langeditor={$langeditor}",$_M[word][otherinfocache2],$depth);
	    }

}
    /*编辑保存*/
    public function dosave(){
    	 global $_M;
    	 $langname=$_M['form']['langname'];
		 $languseok=$_M['form']['languseok'];
		 $langorder=$_M['form']['langorder'];
		 $langmark=$_M['form']['langmark'];
		 $langflag=$_M['form']['langflag'];
		 $langlink= $_M['form']['langlink'] ? trim($_M['form']['langlink'],'/').'/' : '';
		 $langnewwindows=$_M['form']['langnewwindows'];
		 $langautor=$_M['form']['langautor'];
		 $langfile=$_M['form']['langfile'];
		 $langdlok=$_M['form']['langdlok'];
		 $langeditor=$_M['form']['langeditor'];
		 $met_index_type1=$_M['form']['met_index_type1'];
		 $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
         $result =DB::query($query);
         while($list_config=DB::fetch_array($result)){
			if($list_config['lang']!='metinfo'){
				$met_langok[$list_config['mark']]=$list_config;
			}
        }
    	 if($langname=='')turnover("{$_M[url][own_form]}a=doindex",$_M[word][langnamenull]);
			$met_langok[$langmark]=array(
									'name'	=>$langname,
									'useok'	=>$languseok,
									'order'	=>$langorder,
									'mark'	=>$langmark,
									'flag'	=>$langflag,
									'link'	=>$langlink,
									'newwindows'=>$langnewwindows);
			$i=0;
			$useoknow=0;
			foreach($met_langok as $key=>$val){
				$i++;
				if($val['mark']!=$langmark && $val['order'] == $langorder)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langnameorder]);
				if($val['useok']==1)$useoknow++;
			}
			if($useoknow==0&&$languseok==0)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langclose1]);
			if($met_index_type==$langmark&&$languseok==0)turnover("{$_M[url][own_form]}a=doindex",$_M[word][langclose2]);
			$query = "update {$_M[table][lang]} SET
				name          = '$langname',
				useok         = '$languseok',
				no_order      = '$langorder',
				mark          = '$langmark',
				flag          = '$langflag',
				link          = '$langlink',
				newwindows    = '$langnewwindows'
			    where lang='$langmark'";
			 DB::query($query);
			 if($met_index_type1){
				if($languseok){
					$met_index_type=$langmark;
					$query = "update {$_M[table][config]} set value = '{$_M[form][langmark]}' where name='met_index_type'";
					DB::query($query);
					$query = "SELECT * FROM {$_M[table][config]} WHERE lang='{$_M[form][lang]}' or lang='metinfo'";
					$result = DB::query($query);
					while($list_config= DB::fetch_array($result)){
						$settings_arr[]=$list_config;
						$_M[config][$list_config['name']]=$list_config['value'];
						if($metinfoadminok)$list_config['value']=str_replace('"', '&#34;', str_replace("'", '&#39;',$list_config['value']));
					}
                        $columnid=$columnid?$columnid:0;
						!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());

						foreach($settings_arr as $key=>$val){
							if($val['columnid']==$columnid){
								$name = $val['name'];
								$newvalue1 = stripslashes($_M[config][$name]);
								$newvalue1 = str_replace("'","''",$newvalue1);
								$newvalue = str_replace("\\","\\\\",$newvalue1);
								if($val['value']!=$newvalue1){
									$query1 = $columnid?"and columnid='$columnid'":'';
									$query = "update {$_M[table][config]} SET value = '$newvalue' where id ='$val[id]' $query1";
									DB::query($query);
								}
							}
						}
				}else{
					$retxt=$_M[word][jsok].$_M[word][langexplain12];
				}
			}
			unlink(PATH_WEB.'cache/lang_json_'.$_M[form][lang].'.php');
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
    }

	/*同步系统语言数据*/
	public function dosys(){
	    global $_M;
	    $langeditor=$_M[form][langeditor];
	    $post=array('newlangmark'=>$langeditor,'metcms_v'=>$_M[config][metcms_v],'newlangtype'=>$newlangtype);
		$site=$newlangtype=='admin'?1:0;
		$file_basicname=PATH_WEB.$_M['config']['met_adminfile'].'/update/lang/lang_'.$langeditor.'.ini';
		$re=$this->syn->syn_lang($post,$file_basicname,$langeditor,$site,0);
		if($site==0)unlink(PATH_WEB.'cache/lang_'.$langeditor.'.php');
		if($site==1)unlink(PATH_WEB.'cache/langadmin_'.$langeditor.'.php');
		if($re==1){
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
		}else{
			turnover("{$_M[url][own_form]}a=doindex",$_M[word][langadderr4]);
		}

	}


	/*国旗标志*/
	public function doflag(){
		 global $_M;
		 $dir=PATH_WEB.'/app/system/language/admin/templates/images/flag';
	     $handle = opendir($dir);
	     $url=$_M[url][own_tem].'/images/flag';
	     while(false !== $file=(readdir($handle))){
	        if($file !== '.' && $file != '..'){
			    $flags[] = $file;
			}
		}
	    closedir($handle);
		$k=count($flags);
		for($i=0;$i<$k;$i++){
		    $data.='<img src="'.$url.'/'.$flags[$i].'" />';
		}
	    echo $data;
	}

	/*语言数据保存*/
	public function dolangsave(){
		global $_M;
		$langname=$_M['form']['langname'];
		$languseok=$_M['form']['languseok'];
		$langorder=$_M['form']['langorder'];
		$langmark=$_M['form']['langmark'];
		$langflag=$_M['form']['langflag'];
		$langlink=$_M['form']['langlink'];
		$langnewwindows=$_M['form']['langnewwindows'];
		$langautor=$_M['form']['langautor'];
		$langfile=$_M['form']['langfile'];
		$langdlok=$_M['form']['langdlok'];
		$langeditor=$_M['form']['langeditor'];
        $query = "SELECT * FROM {$_M[table][lang]} order by no_order";
        $result =DB::query($query);
        while($list_config=DB::fetch_array($result)){
	          $list_config['order']=$list_config['no_order'];
			if($list_config['lang']=='metinfo'){
				$met_langadmin[$list_config['mark']]=$list_config;
				$_M[langlist][admin][$list_config['mark']]=$list_config;
			}else{
				$met_langok[$list_config['mark']]=$list_config;
				$_M[langlist][web][$list_config['mark']]=$list_config;
			}
        }
			 	$met_index_type = DB::get_one("SELECT * FROM {$_M[table][config]} WHERE name='met_index_type' and lang='metinfo'");
			   	$met_index_type = $met_index_type['value'];
	            if($langname=='')okinfo('-1',$_M[word][langnamenull],$depth);
				if($langautor!='')$langmark=$langautor;
				if($langautor!=''){
					$synchronous=$langautor;
					$lang=$langautor;
				}else{
					$synchronous=$langfile;
					$lang=$langmark;
				}
				if(!$langdlok)$synchronous=$langfile;
				$lancount=count($met_langok);
				$isaddlang=1;
				$langoflag=trim($langflag);
				$met_langok[0]=array(
								'name'		=>$langname,
								'useok'		=>$languseok,
								'order'		=>$langorder,
								'mark'		=>$langmark,
								'flag'		=>$langoflag,
								'link'		=>$langlink,
								'newwindows'=>$langnewwindows);
	    
				foreach($met_langok as $key=>$val){
					if($key){
						if($langmark==$val['mark'])okinfo('-1',$_M[word][langnamerepeat],$depth);
						if($val['order'] == $langorder)okinfo('-1',$_M[word][langnameorder],$depth);
					}
				}
				$met_webhtm =$met_langok[$langfile]['met_webhtm'];
				$met_htmtype=$met_langok[$langfile]['met_htmtype'];
				$met_weburl =$met_langok[$langfile]['met_weburl'];
                
				$re=$this->syn->copyconfig();
				if($re!=1){
					$langdlok=0;
					$langfile=$met_index_type;
					$this->syn->copyconfig();
					$retxt=$_M[word][jsok].'<br/>'.$_M[word][langadderr6];
				}
				if($_M[form][langui] && $_M[form][langconfig] ){
				$query="select * from {$_M[table][config]} where name ='met_skin_user' and lang ='{$_M[form][langui]}'";
				 $met_skin_user=DB::get_one($query);
                 $query="update {$_M[table][config]} set value='$met_skin_user[value]' where name ='met_skin_user' and lang ='$lang'";
				 DB::query($query);
				}
				$query = "INSERT INTO {$_M['table']['lang']} SET
					name          = '$langname',
					useok         = '$languseok',
					no_order      = '$langorder',
					mark          = '$langmark',
					synchronous   = '$synchronous',
					flag          = '$langflag',
					link          = '$langlink',
					newwindows    = '$langnewwindows',
					met_webhtm    = '$met_webhtm',
					met_htmtype   = '$met_htmtype',
					met_weburl    = '$met_weburl',
					lang          = '$langmark'
				";
                DB::query($query);
                if($_M[form][langconfig]){
                	$query="select * from {$_M[table][user_group]} where lang='{$_M[form][langconfig]}'";
                	$adminlist=DB::get_all($query);
                    foreach ($adminlist as $key => $value) {
	                	$query="INSERT INTO {$_M[table][user_group]} set name='$value[name]',access='$value[access]',lang='$langautor'";
					    DB::query($query);
                    }
                }
				
				// $query="INSERT INTO {$_M[table][admin_array]} set array_name='{$_M[word][access1]}',admin_type='',admin_ok='0',admin_op='',admin_issueok='0',admin_group='0',user_webpower='1',array_type='1',lang='$langmark',langok=''";
				// DB::query($query);
				// $query="INSERT INTO {$_M[table][admin_array]} set array_name='{$_M[word][access2]}',admin_type='',admin_ok='0',admin_op='',admin_issueok='0',admin_group='0',user_webpower='2',array_type='1',lang='$langmark',langok=''";
				// DB::query($query);
				if($met_index_type1){
					if($languseok){
						$met_index_type=$langmark;
						$query = "update {$_M[table][config]} set value = '{$_M[form][langmark]}' where name='met_index_type'";
					    DB::query($query);
					}else{
						$retxt=$retxt?$retxt.'<br/>'.$_M[word][langexplain12]:$_M[word][jsok].$_M[word][langexplain12];
					}
				}
				unlink(PATH_WEB.'cache/lang_json_'.$langeditor.'.php');
				turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);

	    }

     /*批量更新语言数据*/
	    public function domengenedit() {
        global $_M;

        require_once $this->template('own/mengenedit');
 }


 /*更新语言数据*/
public function doupdatelang(){
      global $_M;
     //$languagelist=explode('\\\\',str_replace("\r\n","",$_M['form']['langupdate']));

      $_M['form']['langupdate'] = preg_replace("/\'/", "''", $_M['form']['langupdate']);
      $languagelist=explode(PHP_EOL,$_M['form']['langupdate']);
      foreach ($languagelist as $key => $value) {
          $languagedata=explode('=',$value);
          $query="select * from {$_M[table][language]} where name='{$languagedata[0]}' and lang='{$_M[form][langeditor]}' and site ='0'";
          $result=DB::query($query);
          if($result){
              $query="update {$_M[table][language]} set value='{$languagedata[1]}' where name='{$languagedata[0]}' and lang='{$_M[form][langeditor]}' and site ='0'";
          }else{
              $query="insert into {$_M[table][language]} set value='{$languagedata[1]}',site='0',name='{$languagedata[0]}',lang='{$_M[form][langeditor]}'";
          }
           DB::query($query);
      }
     turnover("{$_M[url][own_form]}a=doindex",$_M[word][success]);
}


   /*获取后台语言包*/
   public function doget_adminlangpack(){
        global $_M;
        $query="select * from {$_M[table][language]} where lang='{$_M[form][langeditor]}' and site ='0'";
        $res=DB::get_all($query);
        $langpackurl=PATH_WEB.'cache/language'.$_M[form][langeditor].'.ini';
        if(file_exists($langpackurl)){
        	chmod($langpackurl,0777);
            unlink($langpackurl);
        }
        foreach ($res as $key => $val) {

           file_put_contents($langpackurl, $val[name].'='.$val[value].PHP_EOL,FILE_APPEND);

        }
    }
  /*导出语言包*/
   public function doexportpack(){
     global $_M;
     $this->doget_adminlangpack();
     $filename=PATH_WEB.'cache/language'.$_M[form][langeditor].'.ini';
     $filename=realpath($filename); //文件名
     Header( "Content-type:  application/octet-stream "); 
     Header( "Accept-Ranges:  bytes "); 
     Header( "Accept-Length: " .filesize($filename));
     header( "Content-Disposition:  attachment;  filename=language_".$_M[form][langeditor].".ini"); 
    // echo file_get_contents($filename);
     readfile($filename); 
   }


}
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>