<?php
global $resui;
// UI文件打包
class MetUiPack{
	public $cache = true;
	public $isLteIe9;
	public $versionUpdate=false;
	public function __construct() {
		global $_M,$metui;
		$this->isLteIe9=strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 9')!==false || strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 8')!==false;
		// 获取模板版本信息
		$this->version_path=str_replace($_M['url']['site'], PATH_WEB, $metui['url']['tem']).'version.json';
		$this->tem_version=file_exists($this->version_path)?json_decode(file_get_contents($this->version_path),true):'';
		$this->file_version=$this->tem_version?$this->tem_version['file_version']:'';
	}
	/**
	 * getUi 获取UI模块打包生成文件url数组
	 * @param  array   $paths    UI模块打包文件url数组
	 * @param  String  $filename 生成文件的文件名
	 * @param  String  $fileurl  生成文件的url
	 * @param  Boolean $isModule JS生成文件是否封装
	 * @return array   $getui    UI模块打包生成文件url数组
	 */
	public function getUi($paths,$filename='',$fileurl='',$isModule=''){
		global $_M,$met_skin_url;
		if($paths && !is_array($paths)) $paths = explode(',',$paths);// url分割
		$paths=array_filter($paths);// 删除空元素
		// 生成文件名称、生成文件url获取
		$filename=$filename?$filename:$paths['name'];
		if(!$fileurl) $fileurl=$paths['url'];
		unset($paths['name'],$paths['url']);// 删除不相关元素
		// 二维数组合并为一维数组
		$new_paths=array();
		foreach ($paths as $key => $value) {
			if(is_array($value)){
				if($key>0){
					$new_paths=array_merge($new_paths,$value);
				}else{
					$new_paths=$value;
				}
			}else{
				$new_paths[]=$value;
			}
		}
		$paths=str_replace($_M['url']['site'],PATH_WEB,$new_paths);// 打包文件url转物理路径
		// 打包文件路径按格式分类
		foreach($paths as $val){
			if(file_exists($val)){
				$hz = pathinfo($val,PATHINFO_EXTENSION);
				if($hz){
					switch ($hz) {
						case 'css':
							$urls['css'][] = $val;
							break;
						case 'js':
							$urls['js'][] = $val;
							break;
						default:
							$urls[$hz][] = $val;
							break;
					}
				}else{
					$urls['other'][] = $val;
				}
			}else{
				$val=str_replace(PATH_WEB,$_M['url']['site'],$val);
				echo "{$val} 文件不存在\n";
			}
		}
		if($urls){
			$paths=$urls;
			// 生成文件路径提取
			$fileurl=$fileurl?strReplace($_M['url']['site'],PATH_WEB,$fileurl):PATH_WEB."{$met_skin_url}cache/";
		}else{
			// 没有打包文件返回空值
			echo "{$filename} UI生成失败，没有找到需要打包的文件\n";
			return false;
		}
		// 创建生成目录
		if(is_array($fileurl)){
			foreach ($fileurl as $key => $value) {
				if(!is_dir($value)) mkdir($value,0777,true);
			}
		}else if(!is_dir($fileurl)) mkdir($fileurl,0777,true);
		// CSS文件IE9兼容，分割CSS文件路径数组
		if($this->isLteIe9 && count($paths['css'])>1){
			$lteie9_css_key=$lteie9_css_size=0;
			foreach ($paths['css'] as $value){
			    $size=filesize($value)/1024;
			    $lteie9_css_size+=$size;
			    if($lteie9_css_size>220) {
			        $lteie9_css_key++;
			        $lteie9_css_size=$size;
			    }
			    $lteie9_css[$lteie9_css_key][]=$value;
			}
			$lteie9_css_num=count($lteie9_css);
		}
		$this->file_pack['url']=$fileurl;// 生成文件路径
		// 开始打包并返回生成文件url
		foreach ($paths as $key => $value) {
			// 单次打包和生成文件信息数组
			$this->file_pack['paths']=$value;// 打包文件路径数组
			$this->file_pack['name']=$filename;// 生成文件文件名
			$this->file_pack['suffix']=$key;// 生成文件后缀名
			$this->file_pack['module_name']=$isModule?($key=='js'?$filename:''):'';// JS生成文件是否封装
			if(is_array($fileurl)) $this->file_pack['url']=$fileurl[$key];
			if($this->isLteIe9 && $key=='css' && $lteie9_css_num>1){
				// CSS IE9兼容
				$lteie9_order=0;
				foreach ($lteie9_css as $val) {
					if(count($val)>1){
						$lteie9_order++;
						$this->file_pack['name']="{$filename}-lteie9-{$lteie9_order}";
					}
					$this->file_pack['paths']=$val;
					$getui['css'][]=$this->uiPack();
				}
			}else{
				$getui[$key][] = $this->uiPack();
			}
		}
		return $getui;
	}
	/**
	 * getUiGroup 获取多个UI模块的打包生成文件url数组
	 * @param  array   $uiGroup  多个UI模块打包文件url数组
	 * @param  Boolean $isModule JS生成文件是否封装
	 * @return array   $getui    多个UI模块打包生成文件url数组
	 */
	public function getUiGroup($uiGroup,$isModule=''){
		if($uiGroup && is_array($uiGroup)){
			array_filter($uiGroup);// 删除空元素
		    foreach ($uiGroup as $key => $value) {
	        	// 单个UI模块打包
	        	if(!is_array($value)) $value=array($value);
	        	if(!isset($value['name'])) $value['name']=$key;
	           	$value=$this->getUi($value,$value['name'],$value['url'],$isModule);
	           	// UI数组合并
	            foreach ($value as $key => $val) {
                	if(isset($getui[$key])){
                		$getui[$key]=array_merge($getui[$key],$val);
                	}else{
                		$getui[$key]=$val;
                	}
	            }
		    }
		}
		return $getui;
	}
	/**
	 * uiPack 打包生成文件，返回生成文件url
	 * @return String $file_pack 生成文件url
	 */
	public function uiPack(){
		global $_M;
		// 生成文件路径
		$file_pack=count($this->file_pack['paths'])>1?"{$this->file_pack['url']}{$this->file_pack['name']}.{$this->file_pack['suffix']}":$this->file_pack['paths']['0'];
		if(count($this->file_pack['paths'])>1){
			$fwrite_ok=true;
			// 生成文件的版本信息的键名数组
			$file_version['dir']=str_replace(array($_M['url']['site'],PATH_WEB), '', $this->file_pack['url']);
			$file_version['name']=$this->file_pack['name'].'.'.$this->file_pack['suffix'];
			// 文件是否需要生成
			if(file_exists($file_pack)){
				if($this->cache){
					$fwrite_ok=false;
				}else{
					$file_pack_version=$this->filePackVersion($this->file_pack['paths']);// 计算需要生成文件的版本信息
					if(isset($this->file_version[$file_version['dir']][$file_version['name']])){
						if($file_pack_version==$this->file_version[$file_version['dir']][$file_version['name']]) $fwrite_ok=false;// 新旧生成文件版本信息比较
					}
				}
			}
			// 生成文件
			if($fwrite_ok){
				$file_code=$this->getContent();// 获取合并文件内容
				file_put_contents($file_pack,$file_code);// 生成文件
				// 更新模板版本文件
				$this->versionUpdate=true;
				if(!$file_pack_version) $file_pack_version=$this->filePackVersion($this->file_pack['paths']);// 计算需要生成文件的版本信息
				$this->file_version[$file_version['dir']][$file_version['name']]=$file_pack_version;
			}
		}
		// 返回路径处理
		$file_pack.='?'.date('YmdHis',filemtime($file_pack));// 追加文件修改时间后缀
		$file_pack=str_replace(PATH_WEB,$_M['url']['site'],$file_pack);// 转换成url
		return $file_pack;
	}
	/**
	 * getContent 打包文件内容合并处理
	 * @return String $file_code 生成文件内容
	 */
	public function getContent(){
		$file_code='';
		// 生成的JS文件首尾添加模块化封装代码
		if($this->file_pack['module_name']){
			$this->file_pack['module_name']=strtoupper(str_replace(array('-','.',' '),'_',$this->file_pack['module_name']));
			$file_code="window.METUI_{$this->file_pack['module_name']}=(function(metui){\n";
		}
		if($this->file_pack['suffix']=='css') $file_code.="@charset \"utf-8\";\n";// CSS声明
		// 打包文件内容合并
		foreach($this->file_pack['paths'] as $key => $val){
			if($key>0) $file_code.="\n";
			$file_code_val['path']=str_replace(PATH_WEB, '', $val);
			$file_code_val['code']=file_get_contents($val);
			if($this->file_pack['suffix']=='css'){// CSS样式中的url转换
				$relaurl=dirname(getRelativePath($this->file_pack['url'],$val)).'/';
				$file_code_val['code'] = preg_replace_callback('/url\(["\']*([\.\/]*)([^:]*?)["\']*\)/', function($match) use ($relaurl){
					return 'url('.$relaurl.$match[1].$match[2].')';
				}, $file_code_val['code']);
			}
			$file_code_val['code']="/*{$file_code_val['path']}*/\n{$file_code_val['code']}";
			$file_code.=$file_code_val['code'];
		}
		if($this->file_pack['module_name']) $file_code.="\nreturn metui;\n})(window.METUI_{$this->file_pack['module_name']}||{});";// 生成的JS文件首尾添加模块化封装代码
		return $file_code;
	}
	/**
	 * scssc SCSS预处理
	 * @param array  $scssUrl SCSS文件url数组
	 * @param String $cssDir  生成文件目录
	 */
	// public function scssc($scssUrl,$cssDir){
	// 	global $_M,$scssc;
	// 	if(!$this->cache){
	// 		if(!is_array($scssUrl)) $scssUrl=array($scssUrl);
	// 		$scssUrl=str_replace($_M['url']['site'], PATH_WEB, $scssUrl);
	// 		if(!$cssDir) $cssDir=pathinfo($scssUrl['0'],PATHINFO_DIRNAME).'/';
	// 		$cssDir=str_replace($_M['url']['site'], PATH_WEB, $cssDir);
	// 		// 引入SCSS预处理类
	// 		require_once PATH_WEB.'public/ui/v2/static/scss.class.php';
	// 		$scssc->setFormatter('scss_formatter_compressed');
	// 		$scssc->setImportPaths($cssDir);
	// 		// 开始预处理SCSS文件
	// 		foreach ($scssUrl as $value) {
	// 			$val['scssc']=true;
	// 			$val['name']=pathinfo($value,PATHINFO_BASENAME);
	// 			if(strpos($val['name'], '*')!==false || !strpos($val['name'], '.')){// 路径为目录时
	// 				if(strpos($val['name'], '.')!==false || strpos($val['name'], '*')!==false) $value=str_replace($val['name'], '', $value);
	// 				if(substr($value, -1)!='/') $value.='/';
	// 				foreach (scandir($value) as $values) {
	// 					if(pathinfo($values,PATHINFO_EXTENSION)=='scss') $val['scss'][]=$value.$values;
	// 				}
	// 				$this->scssc($val['scss']);
	// 				$val['scssc']=false;
	// 			}
	// 			if(file_exists($value) && $val['scssc']){// 路径为文件时
	// 				$val['css']=$cssDir.str_replace('.scss', '.css', $val['name']);
	// 				$val['version']=$this->filePackVersion($value);
	// 				$val['dir']=str_replace(PATH_WEB, '', pathinfo($value,PATHINFO_DIRNAME)).'/';
	// 				if(!file_exists($val['css']) || $val['version']!=$this->file_version[$val['dir']][$val['name']]){
	// 					file_put_contents($val['css'],$scssc->compile("@import '{$val['name']}'"));// 生成CSS文件
	// 					$this->file_version[$val['dir']][$val['name']]=$val['version'];// 更新SCSS文件版本信息
	// 				}
	// 			}
	// 		}
	// 	}
	// }
	/**
	 * filePackVersion 计算生成文件的版本信息
	 * @param  array $paths             打包文件路径数组
	 * @return array $file_pack_version 生成文件的版本信息
	 */
	public function filePackVersion($paths){
		if(!is_array($paths)) $paths=array($paths);
		foreach ($paths as $value) {
			$file_pack_version.=$value.filemtime($value);
			// SCSS文件版本信息计算
			if(pathinfo($value,PATHINFO_EXTENSION)=='scss'){
				$scss_file['content']=file_get_contents($value);
				preg_match_all("/@import\s['\"](.*)['\"];/",$scss_file['content'],$match);
				if(count($match['1'])){// SCSS文件中引入的SCSS文件
					$scss_file['name']=pathinfo($value,PATHINFO_BASENAME);
					foreach ($match['1'] as $val) {
						$val_path=str_replace($scss_file['name'], $val.'.scss', $value);
						$file_pack_version.=$val_path.filemtime($val_path);
					}
				}
			}
		}
		$file_pack_version=md5($file_pack_version);
		return $file_pack_version;
	}
	/**
	 * getFromMetui 从UI库获取文件
	 * @param  array $paths        带有UI文件键名的数组
	 * @return array $samekeypaths UI库$metui['paths']中和$paths中元素键名相同的元素数组
	 */
	public function getFromMetui($paths){
		global $metui;
		foreach ($metui['paths'] as $key => $value) {
			if(array_key_exists($key,$paths) && $paths[$key]) $samekeypaths[]=$value;
	    }
		return $samekeypaths;
	}
	// 更新模板版本文件
	public function setUiVersion(){
		global $_M,$met_skin,$resui;
		$file_pack_version='';
		// 删除不存在文件的版本信息
		if(!$this->cache || $this->versionUpdate){
			foreach ($resui as $key => $value) {
				$new_resui[$key]=array();
				foreach ($value as $keys => $val) {
					$info = explode("?",$val);
					$new_resui[$key][]=$info[0];
				}
			}
			foreach ($this->file_version as $key => $value) {
				foreach ($value as $keys => $val) {
					$suffix=pathinfo($keys,PATHINFO_EXTENSION);
					if(!file_exists(PATH_WEB.$key.$keys) || !in_array($_M['url']['site'].$key.$keys, $new_resui[$suffix])){
						unset($this->file_version[$key][$keys]);
						$this->versionUpdate=true;
					}
				}
				if(is_array($value) && !count($value)){
					unset($this->file_version[$key]);
					$this->versionUpdate=true;
				}
			}
		}
		if(!$this->file_version) $this->versionUpdate=true;
		// 更新模板版本文件
		if($this->versionUpdate){
			if(!$this->tem_version['name']){// 加入模板名称等信息
				$tem_version['name']=$met_skin;
				$tem_version['version']='1.0';
				$tem_version['updatetime']=date('Y.m.d',time());
				if($this->tem_version){
					$this->tem_version=array_merge($tem_version,$this->tem_version);
				}else{
					$this->tem_version=$tem_version;
				}
			}
			$this->tem_version['updatetime']=date('Y.m.d',time());
			$this->tem_version['file_version']=$this->file_version;// 更新模板UI版本信息
			if(version_compare(PHP_VERSION,'5.4.0','>=')){
				$tem_version_str=json_encode($this->tem_version,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
			}else{
				$tem_version_str=json_encode($this->tem_version);
				$tem_version_str=str_replace('{"', "{\r\"", $tem_version_str);
				$tem_version_str=str_replace(',"', ",\r\"", $tem_version_str);
				$tem_version_str=str_replace('"}', "\"\r}", $tem_version_str);
				$tem_version_str=str_replace('}}', "}\r}\r", $tem_version_str);
			}
			file_put_contents($this->version_path,$tem_version_str);
		}
	}
}
$metuipack=new MetUiPack();
?>