<?php
// UI打包
class MetUiPack{
	public $cache = true;
	public $isLteIe9;
	public $returnFileurl = false;
	public function __construct() {
		$this->versionUpdate = false;
		$this->isLteIe9 = strpos($_SERVER["HTTP_USER_AGENT"],'MSIE 9')!=false || strpos($_SERVER["HTTP_USER_AGENT"],'MSIE 8')!=false;
	}
	// 获取UI
	public function getUi($paths,$filename,$fileurl,$isModule){
		global $_M,$met_skin_url;
		if($paths && !is_array($paths)) $paths = explode(',',$paths);// 路径分割
		$paths=array_filter($paths);// 删除空元素
		// UI名称、生成路径获取
		$filename=$filename?$filename:$paths[name];
		$fileurl=$fileurl?$fileurl:$paths[url];
		unset($paths[name],$paths[url]);// 删除不相关元素
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
		$paths=str_replace($_M['url']['site'],PATH_WEB,$new_paths);// 绝对路径转物理路径
		// 打包文件路径按格式分类
		foreach($paths as $val){
			if(file_exists($val) || $this->returnFileurl){
				$hz = pathinfo($val,PATHINFO_EXTENSION);
				if($hz){
					switch ($hz) {
						case 'css':
							$urls[css][] = $val;
							break;
						case 'js':
							$urls[js][] = $val;
							break;
						default:
							$urls[$hz][] = $val;
							break;
					}
				}else{
					$urls[other][] = $val;
				}
			}else{
				$val=str_replace(PATH_WEB,$_M['url']['site'],$val);
				echo "{$val} 文件不存在\n";
			}
		}
		if($urls || $this->returnFileurl){
			$paths=$urls;
			// 生成文件路径提取
			$fileurl=$fileurl?str_replace($_M['url']['site'],PATH_WEB,$fileurl):PATH_WEB."{$met_skin_url}cache/";
		}else{
			// 没有打包文件返回空值
			echo "{$filename} UI生成失败，没有找到需要打包的文件\n";
			return false;
		}
		if(!is_dir($fileurl)) mkdir($fileurl,0777,true);// 创建生成路径
		// CSS文件IE9兼容，分割CSS文件路径数组
		if($this->isLteIe9 && count($paths[css])>1){
			$lteie9_css_key=$lteie9_css_size=0;
			foreach ($paths[css] as $value){
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
		// 开始打包并返回生成文件路径
		foreach ($paths as $key => $value) {
			if($this->isLteIe9 && $key=='css' && $lteie9_css_num>1){
				// CSS IE9兼容
				$lteie9_order=0;
				foreach ($lteie9_css as $val) {
					if(count($val)>1) $lteie9_order++;
					$getui[css][]=$this->uiPack($val,'css',"{$filename}-lteie9-{$lteie9_order}",$fileurl);
				}
			}else{
				$getui[$key] = $this->uiPack($value,$key,$filename,$fileurl,$isModule);
			}
			if($getui[$key] && !is_array($getui[$key])) $getui[$key]=array($getui[$key]);
		}

		return $getui;
	}
	// 获取多个UI模块的打包生成文件路径
	public function getUiGroup($getUiGroup,$getui,$isModule){
		if($getUiGroup && is_array($getUiGroup)){
			array_filter($paths);//删除空元素
		    foreach ($getUiGroup as $key => $value) {
		        if($value){
		        	// 单个UI模块打包
		        	$value[name]=$value[name]?$value[name]:$key;
		           	$value=$this->getUi($value,$value[name],$value[url],$isModule);
		           	// UI数组合并
		            foreach ($value as $key => $val) {
	                	if($getui[$key]){
	                		$getui[$key]=array_merge($getui[$key],$val);
	                	}else{
	                		$getui[$key]=$val;
	                	}
		            }
		        }
		    }
		}
		return $getui;
	}
	// 文件打包
	public function uiPack($paths,$suffix,$filename,$fileurl,$isModule){
		global $_M,$navurl;
		$file_uipack=count($paths).length>1?"{$fileurl}{$filename}.{$suffix}":$paths[0];// 生成文件路径
		if(count($paths).length>1){
			$fwrite_ok=true;// 文件是否需要生成
			$module_name=$suffix=='js' && $isModule?$filename:'';// js封装判断
			if($this->cache || $this->returnFileurl){// 缓存状态
				if(file_exists($file_uipack) || $this->returnFileurl) $fwrite_ok=false;
			}else if(file_exists($file_uipack)){
				$file_code=$this->getContent($paths,$suffix,$fileurl,$module_name);// 获取新合并文件内容
				// 新旧合并文件内容比较
	            $md5_old=md5(file_get_contents($file_uipack));
	            $md5_new=md5($file_code);
	            if($md5_old==$md5_new) $fwrite_ok=false;
			}
			// 生成文件
			if($fwrite_ok){
				if(!$file_code) $file_code=$this->getContent($paths,$suffix,$fileurl,$module_name);// 获取合并文件内容
				file_put_contents($file_uipack,$file_code);
				$this->versionUpdate=true;// 有文件打包生成，缓存文件更新，更新模板版本文件
			}
		}else if(!$this->versionUpdate){
			if(date('YmdHis')-date('YmdHis',filemtime($file_uipack))<100) $this->versionUpdate=true;// 单个文件更新时更新模板版本文件
		}
		// 返回路径处理
		$url_replace=$this->returnFileurl?$_M[url][site]:$navurl;
		$file_uipack=str_replace(PATH_WEB,$url_replace,$file_uipack);//转换成url
		$file_uipack.='?'.date('YmdHis',filemtime($file_uipack));// 追加文件修改时间后缀

		return $file_uipack;
	}
	// 文件内容合并
	public function getContent($paths,$suffix,$fileurl,$moduleName){
		global $metresclass;
		// 生成的JS文件首尾添加模块化封装代码
		if($moduleName){
			$module_name=strtoupper(str_replace(array('-','.',' '),'_',$moduleName));
			$code.="window.MODULE_{$module_name}=(function(metmod){\n";
		}
		if($suffix=='css') $code.='@charset "utf-8";'."\n";//CSS声明
		// 打包文件代码合并
		foreach($paths as $key => $val){
			if($key>0) $code.="\n";
			$codeval[name]=pathinfo($val,PATHINFO_BASENAME);
			$codeval[code]=file_get_contents($val);
			if($suffix=='css'){// CSS样式中的路径转换
				$relaurl=dirname($metresclass->getRelativePath($fileurl,$val)).'/';
				$codeval[code]=preg_replace('/url\(["\']*([\.\/]*)([^:]*?)["\']*\)/', 'url('.$relaurl.'\1'.'\2'.')', $codeval[code]);
			}
			$code_val="/*{$codeval[name]}*/\n{$codeval[code]}";
			$code.= $code_val;
		}
		if($moduleName) $code.="\nreturn metmod;\n})(window.MODULE_{$module_name}||{});";// 生成的JS文件首尾添加模块化封装代码

		return $code;
	}
	/**
	 * [getFromMetui 从UI库获取文件]
	 * @param  [type] $path  [带有UI文件键名的数组]
	 * @return [type] $paths [UI库$metui[paths]中和$path数组键名相同的元素]
	 */
	public function getFromMetui($path){
		global $metui;
		foreach ($path as $key => $value) {
			if(array_key_exists($key,$metui[paths])) $paths[]=$metui[paths][$key];
	    }
		return $paths;
	}
}
$metuipack = new MetUiPack();
?>